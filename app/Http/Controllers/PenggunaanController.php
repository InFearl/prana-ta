<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Penggunaan;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $dbpenggunaan = Penggunaan::with(['detailpenggunaan.persediaan.pesanan'])->latest()->paginate(5);
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.penggunaan.index', compact('dbpenggunaan', 'checkrop', 'count_rop'));
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
        $dbpesanan = Pesanan::where('status_pesanan', 0)->get();
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.penggunaan.tambah', compact('dbpersediaan', 'temporary_penggunaan', 'dbpesanan', 'checkrop', 'count_rop'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        DB::beginTransaction();
        try {
            $id_pesanan = '';
            $temporary_penggunaan = session("temporary_penggunaan");
            foreach ($temporary_penggunaan as $temp) {
                $id_pesanan = $temp['id_pesanan'];
            }
            $dbpenggunaan = Penggunaan::create([
                'tanggal_penggunaan' => Carbon::now(),
                'id_pesanan' => $id_pesanan
            ]);
            foreach ($temporary_penggunaan as $temp) {
                DetailPenggunaan::create([
                    'id_penggunaan' => $dbpenggunaan->id,
                    'id_persediaan' => $temp['id'],
                    'jumlah_penggunaan' => $temp['jumlah_penggunaan']
                ]);


                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
                $persediaan = Persediaan::where('id', $temp['id'])->first();
                $stok_sisa = $persediaan->jumlah_persediaan - $temp['jumlah_penggunaan'];
                if ($stok_sisa < $persediaan->safety_stock) {
                    return back()->with('peringatan', 'thousand stars');
                }
                $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan - $temp['jumlah_penggunaan'];
                $persediaan->save();
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
            }
            $dbpesanan = Pesanan::where('id', $id_pesanan)->first();
            $dbpesanan->status_pesanan = 1;
            $dbpesanan->save();
            DB::commit();
        } catch (\Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
            DB::rollBack();
        }

        //Menghapus session 
        session()->forget("temporary_penggunaan");
        //Menghapus session 


        return redirect('penggunaan')->with('toast_success', 'Data Berhasil Ditambah');
    }

    public function storeConfirm()
    {
        DB::beginTransaction();
        try {
            $id_pesanan = '';
            $temporary_penggunaan = session("temporary_penggunaan");
            foreach ($temporary_penggunaan as $temp) {
                $id_pesanan = $temp['id_pesanan'];
            }
            $dbpenggunaan = Penggunaan::create([
                'tanggal_penggunaan' => Carbon::now(),
                'id_pesanan' => $id_pesanan
            ]);
            foreach ($temporary_penggunaan as $temp) {
                DetailPenggunaan::create([
                    'id_penggunaan' => $dbpenggunaan->id,
                    'id_persediaan' => $temp['id'],
                    'jumlah_penggunaan' => $temp['jumlah_penggunaan']
                ]);

                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
                $persediaan = Persediaan::where('id', $temp['id'])->first();
                $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan - $temp['jumlah_penggunaan'];
                $persediaan->save();
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
            }
            $dbpesanan = Pesanan::where('id', $id_pesanan)->first();
            $dbpesanan->status_pesanan = 1;
            $dbpesanan->save();
            DB::commit();
        } catch (\Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
            DB::rollBack();
        }

        //Menghapus session 
        session()->forget("temporary_penggunaan");
        //Menghapus session 


        return redirect('penggunaan')->with('toast_success', 'Data Berhasil Ditambah');
    }

    public function addListPenggunaan(Request $request)
    {
        // Validasi bahwa required itu harus diisi jika tidak maka akan dikembalikan ke halaman semula otomatis
        $request->validate([
            'id_persediaan' => 'required',
            'jumlah_penggunaan' => 'required',
            'id_pesanan' => 'required'
        ]);
        // Validasi bahwa required itu harus diisi jika tidak maka akan dikembalikan ke halaman semula otomatis

        // Mencari data menggunakan model
        $dbpersediaan = Persediaan::findorfail($request->id_persediaan);
        // Mencari data menggunakan model

        // Inisialisasi session dan dimasukkan ke variabel
        $temporary_penggunaan = session("temporary_penggunaan");
        // Inisialisasi session dan dimasukkan ke variabel

        // Memasukkan data array ke variabel session dengan id persediaan sebagai key
        $temporary_penggunaan[$request->id_persediaan] = [
            "id" => $request->id_persediaan,
            "nama_persediaan" => $dbpersediaan->nama_persediaan,
            "jumlah_penggunaan" => $request->jumlah_penggunaan,
            "id_pesanan" => $request->id_pesanan
        ];
        // Memasukkan data array ke variabel session dengan id persediaan sebagai key

        // Memasukkan atau memperbarui isi dari variable temporary ke session
        session(["temporary_penggunaan" => $temporary_penggunaan]);
        // Memasukkan atau memperbarui isi dari variable temporary ke session

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
        $dbpenggunaan = DetailPenggunaan::with(['persediaan', 'penggunaan'])->where('id_penggunaan', $id)->latest()->paginate(5);
        // dd($dbpenggunaan);
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.penggunaan.detail', compact('dbpenggunaan', 'checkrop', 'count_rop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dbpersediaan = Persediaan::all();
        $pen = Penggunaan::with('persediaan')->findorfail($id);
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.penggunaan.ubah', compact('pen', 'dbpersediaan', 'checkrop', 'count_rop'));
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

    public function destroyItemTemp($id_persediaan)
    {
        $temporary_penggunaan = session("temporary_penggunaan");
        unset($temporary_penggunaan[$id_persediaan]);
        session(["temporary_penggunaan" => $temporary_penggunaan]);
        return redirect()->route('tambah.penggunaan');
    }

    public function formcetakpenggunaan()
    {
        $dbpenggunaan = DetailPenggunaan::with('persediaan', 'penggunaan')->get();
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        return view('fumigator.pages.penggunaan.form-cetak', compact('dbpenggunaan', 'checkrop', 'count_rop'));
    }

    public function cetakpenggunaan($bulan_tahun = null)
    {
        $dbpenggunaan = DB::table('penggunaan as pg')
            ->join('detail_penggunaan as dp', 'pg.id', '=', 'dp.id_penggunaan')
            ->join('persediaan as pd', 'pd.id', '=', 'dp.id_persediaan')
            ->whereMonth('pg.tanggal_penggunaan', substr($bulan_tahun, 5, 2))
            ->whereYear('pg.tanggal_penggunaan', substr($bulan_tahun, 0, 4))
            ->get();
        // dd($dbpenggunaan);   

        $tanggal = Carbon::now()->format('d F Y');
        $title = 'Laporan Penggunaan' . ' ' . $tanggal;
        $pdf = Pdf::loadView('fumigator.pages.penggunaan.cetak', compact('dbpenggunaan', 'tanggal', 'title'));

        return $pdf->download('Laporan Penggunaan' . ' ' . $tanggal . '.pdf');
        // dd($tanggal);
    }

    public function filterPenggunaan(Request $request)
    {
        // dd(substr($request->bulan_tahun, 5, 2));
        $dbpenggunaan = DB::table('penggunaan as pg')
            ->join('detail_penggunaan as dp', 'pg.id', '=', 'dp.id_penggunaan')
            ->join('persediaan as pd', 'pd.id', '=', 'dp.id_persediaan')
            ->whereMonth('pg.tanggal_penggunaan', substr($request->bulan_tahun, 5, 2))
            ->whereYear('pg.tanggal_penggunaan', substr($request->bulan_tahun, 0, 4))
            ->get();
        // dd($dbpenggunaan);

        // $dbpenggunaan = DetailPenggunaan::with('persediaan', 'penggunaan')->get();
        // dd($dbpesanan);
        $checkrop = DB::table('persediaan')->whereRaw('jumlah_persediaan <= rop')->get();
        $count_rop = count($checkrop);
        $bulan_tahun = $request->bulan_tahun;

        return view('fumigator.pages.penggunaan.form-cetak', compact('dbpenggunaan', 'checkrop', 'count_rop', 'bulan_tahun'));
    }
}
