<?php

namespace App\Http\Controllers;

use App\Models\Persediaan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jumlah_pesanan = DB::table('pesanan')->count();
        $jumlah_pesanan_dijalankan = DB::table('pesanan')->where('status_pesanan',0)->count();
        $jumlah_pesanan_container_dijalankan = DB::table('pesanan')->where('status_pesanan',0)->sum('container');
        $jumlah_pesanan_container_selesai = DB::table('pesanan')->where('status_pesanan',1)->sum('container');

        $dbpersediaan = Persediaan::all();

        return view('fumigator.pages.dashboard.index',compact('jumlah_pesanan', 'jumlah_pesanan_dijalankan','dbpersediaan','jumlah_pesanan_container_dijalankan', 'jumlah_pesanan_container_selesai') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
