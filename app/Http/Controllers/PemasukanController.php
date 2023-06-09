<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;
use App\Models\Persediaan;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbpemasukan = Pemasukan::with('persediaan')->latest()->paginate(5);
        return view('fumigator.pages.pemasukan.index',compact('dbpemasukan'));
    }

    public function cetakpemasukan()
    {
        $dbcetakpemasukan = Pemasukan::with('persediaan')->get();
        return view('fumigator.pages.pemasukan.cetak',compact('dbcetakpemasukan'));
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
        return view('fumigator.pages.pemasukan.tambah',compact('dbpersediaan','temporary_penggunaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pemasukan::create([
            'id_persediaan'=> $request->id_persediaan,
            'jumlah_pemasukan'=> $request->jumlah_pemasukan,
            'tanggal_pemasukan'=> $request->tanggal_pemasukan,
            'biaya_total'=> $request->biaya_total,
        ]);

        $persediaan = Persediaan::where('id', $request->id_persediaan)->first();
        
        $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $request->jumlah_pemasukan;
        
        $persediaan->save();

        return redirect('pemasukan')->with('toast_success', 'Data Berhasil Ditambah');
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
        $pem = Pemasukan::with('persediaan')->findorfail($id);
        return view('fumigator.pages.pemasukan.ubah',compact('pem','dbpersediaan'));
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
        $pem = Pemasukan::findorfail($id);
        // $pem->update($request->all());
        $persediaan = Persediaan::where('id', $request->id_persediaan)->first();
        
        $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $pem->jumlah_pemasukan - $request->jumlah_pemasukan;
        
        $persediaan->save();

        $pem->jumlah_pemasukan = $request->jumlah_pemasukan;

        $pem->save();

        return redirect('pemasukan')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pem = Pemasukan::findorfail($id);
        $pem->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }
}
