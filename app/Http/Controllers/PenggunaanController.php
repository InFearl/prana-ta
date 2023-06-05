<?php

namespace App\Http\Controllers;

use App\Models\Penggunaan;
use App\Models\Persediaan;
use Illuminate\Http\Request;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $dbpersediaan = Persediaan::all();
        return view('fumigator.pages.penggunaan.tambah',compact('dbpersediaan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Penggunaan::create([
            'id_persediaan'=> $request->id_persediaan,
            'tanggal_penggunaan'=> $request->tanggal_penggunaan,
        ]);

        return redirect('penggunaan')->with('toast_success', 'Data Berhasil Ditambah');
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
        $pen->update($request->all());
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
