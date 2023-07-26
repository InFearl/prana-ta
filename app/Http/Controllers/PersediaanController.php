<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PersediaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $dbpersediaan = Persediaan::all();
        // dd($persediaan);
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.persediaan.index', compact('dbpersediaan', 'checkrop', 'count_rop'));
    }

    public function cetakpersediaan()
    {
        $dbcetakpersediaan = Persediaan::get();
        $tanggal = Carbon::now()->format('d F Y');
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        $title = 'Laporan Persediaan'.' '. $tanggal;
        $pdf = Pdf::loadView('fumigator.pages.persediaan.cetak', compact('dbcetakpersediaan', 'checkrop', 'count_rop', 'tanggal','tanggal'));
        return $pdf->download('Laporan Persediaan'.' '.$tanggal.'.pdf');
        
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
