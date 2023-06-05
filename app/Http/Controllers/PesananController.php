<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $dbpesanan = Pesanan::latest()->paginate(5);
        return view('fumigator.pages.pesanan.index',compact('dbpesanan'));
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
        Pesanan::create([
            'nama_perusahaan'=> $request->nama_perusahaan,
            'c20ft'=> $request->c20ft,
            'c40ft'=> $request->c40ft,
            'tanggal_masuk'=> $request->tanggal_masuk,
            'tanggal_akhir'=> $request->tanggal_akhir,
            'status_pesanan'=> $request->status_pesanan,
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
        return view('fumigator.pages.pesanan.ubah',compact('pes'));
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
