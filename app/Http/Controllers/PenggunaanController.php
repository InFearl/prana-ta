<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Penggunaan;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use App\Models\DetailPenggunaan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PenggunaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbpenggunaan = Penggunaan::with('persediaan')->latest()->paginate(5);
        return view('fumigator.pages.penggunaan.index',compact('dbpenggunaan'));
    }

    public function cetakpenggunaan()
    {
        $dbcetakpenggunaan = Penggunaan::with('persediaan')->get();
        return view('fumigator.pages.penggunaan.cetak',compact('dbcetakpenggunaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
        
    {   
        $temporary_penggunaan = session("temporary_penggunaan");
        $dbpersediaan = Persediaan::all();
        return view('fumigator.pages.penggunaan.tambah',compact('dbpersediaan','temporary_penggunaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbpenggunaan = Penggunaan::create([
            'tanggal_penggunaan'=> Carbon::now(),
            'jumlah_penggunaan'=> Carbon::now(),
        ]);             

        $temporary_penggunaan = session("temporary_penggunaan");
        foreach ($temporary_penggunaan as $temp) {
            DetailPenggunaan::create([
                'id_penggunaan' => $dbpenggunaan->id,
                'id_persediaan' => $temp['id'],
                'jumlah_penggunaan' => $temp['jumlah_penggunaan']
            ]);
        }
        session()->forget("temporary_penggunaan");
        // $persediaan = Persediaan::where('id', $request->id_persediaan)->first();
        
        // $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan - $request->jumlah_penggunaan;
        
        // $persediaan->save();

        return redirect('penggunaan')->with('toast_success', 'Data Berhasil Ditambah');
    }

    public function addListPenggunaan(Request $request)
    {
        $this->validate($request, [
            'id_persediaan' => 'required',
            'jumlah_penggunaan' => 'required'
        ]);
        $dbpersediaan = DB::table('persediaan')
            ->where('id', $request->id_persediaan)
            ->first();

        $temporary_penggunaan = session("temporary_penggunaan");

        $temporary_penggunaan[$request->id_persediaan] = [
            "id" => $request->id_persediaan,
            "nama_persediaan" => $dbpersediaan->nama_persediaan,
            "jumlah_penggunaan" => $request->jumlah_penggunaan
        ];

        session(["temporary_penggunaan" => $temporary_penggunaan]);

        return redirect()->route('tambah.penggunaan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $dbpersediaan = Persediaan::all();
        $pen = Penggunaan::with('persediaan')->findorfail($id);
        return view('fumigator.pages.penggunaan.ubah',compact('pen','dbpersediaan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pen = Penggunaan::findorfail($id);
        // $pen->update($request->all());

        $persediaan = Persediaan::where('id', $request->id_persediaan)->first();
        
        $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $pen->jumlah_penggunaan - $request->jumlah_penggunaan;
        
        $persediaan->save();

        $pen->jumlah_penggunaan = $request->jumlah_penggunaan;

        $pen->save();

        return redirect('penggunaan')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pen = Penggunaan::findorfail($id);
        $pen->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }
}
