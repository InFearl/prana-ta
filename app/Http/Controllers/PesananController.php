<?php

namespace App\Http\Controllers;

use App\Models\Persediaan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbpesanan = Pesanan::latest()->paginate(5);
        return view('fumigator.pages.pesanan.index', compact('dbpesanan'));
    }

    public function cetakpesanan()
    {
        $dbcetakpesanan = Pesanan::get();
        return view('fumigator.pages.pesanan.cetak', compact('dbcetakpesanan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fumigator.pages.pesanan.tambah',);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $param_stok = [
            1 => 4,
            2 => 2,
            3 => 2,
            4 => 1,
            5 => 34,
            6 => 9
        ];
        // $bulan_tahun = DB::table('penggunaan')
        //     ->selectRaw('DATE_FORMAT(MAX(tanggal_penggunaan),"%m-%Y") as bulan')
        //     ->whereRaw('DATE_FORMAT(tanggal_penggunaan, "%m-%Y") < DATE_FORMAT(now(), "%m-%Y")')
        //     ->first();
        // $month_before = Carbon::createFromFormat('m-Y', $bulan_tahun->bulan)->subMonth(2)->format('m-Y');
        // $data = DB::table('detail_penggunaan as dp')
        //     ->join('penggunaan as p', 'dp.id_penggunaan', '=', 'p.id')
        //     ->join('persediaan as ps', 'dp.id_persediaan', '=', 'ps.id')
        //     ->selectRaw('ps.id ,ps.nama_persediaan ,max(dp.jumlah_penggunaan)  as max, round(avg(dp.jumlah_penggunaan)) as avg, sum(dp.jumlah_penggunaan) as total')
        //     ->whereRaw('DATE_FORMAT(p.tanggal_penggunaan, "%m-%Y") >= "' . $month_before . '" AND DATE_FORMAT(p.tanggal_penggunaan, "%m-%Y") <= "' . $bulan_tahun->bulan . '"')
        //     ->groupByRaw('ps.id ,ps.nama_persediaan')
        //     ->get();
        // dd($data);

        // foreach ($data as $d) {
        # code...
        $persediaan = DB::table('persediaan')->get();
        foreach ($persediaan as $data) {
            if ($data->jumlah_persediaan <= $param_stok[$data->id] * $request->container) {
                return back()->with('toast_warning', 'Ada persediaan yang kurang');
            }
        }

        // }
        // $persediaan = Persediaan::all();
        // dd($persediaan);

        Pesanan::create([
            'nama_perusahaan' => $request->nama_perusahaan,
            'container' => $request->container,
            'tanggal_masuk' => Carbon::now(),
            'tanggal_akhir' => $request->tanggal_akhir,
        ]);

        return redirect('pesanan')->with('toast_success', 'Data Berhasil Ditambah');
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
    {
        $pes = Pesanan::findorfail($id);
        return view('fumigator.pages.pesanan.ubah', compact('pes'));
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
        $pes = Pesanan::findorfail($id);
        $pes->update($request->all());
        return redirect('pesanan')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pes = Pesanan::findorfail($id);
        $pes->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }
}
