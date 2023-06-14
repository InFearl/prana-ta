<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemasukan;
use App\Models\Pemesanan;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use App\Models\DetailPemasukan;
use App\Models\DetailPemesanan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $dbpemesanan = Pemesanan::with(['detailpemesanan.persediaan'])->latest()->paginate(20);
        return view('fumigator.pages.pemesanan.index', compact('dbpemesanan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // session()->forget("temporary_pemesanan");
        $temporary_pemesanan = session("temporary_pemesanan");
        $dbpersediaan = Persediaan::all();
        return view('fumigator.pages.pemesanan.tambah', compact('dbpersediaan', 'temporary_pemesanan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $biaya_pemesanan = 0;
        $temporary_pemesanan = session("temporary_pemesanan");
        foreach ($temporary_pemesanan as $temp) {
            $biaya_pemesanan = $temp['biaya_pemesanan'];
        }

        $dbpemesanan = Pemesanan::create([
            'tanggal_pemesanan' => Carbon::now(),
            'biaya_pemesanan' => $biaya_pemesanan
        ]);

        DB::beginTransaction();
        try {
            // $temporary_pemesanan = session("temporary_pemesanan");
            foreach ($temporary_pemesanan as $temp) {
                DetailPemesanan::create([
                    'id_pemesanan' => $dbpemesanan->id,
                    'id_persediaan' => $temp['id'],
                    'jumlah_pemesanan' => $temp['jumlah_pemesanan']
                ]);
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
                // $persediaan = Persediaan::where('id', $temp['id'])->first();
                // $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $temp['jumlah_pemesanan'];
                // $persediaan->save();
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
            }
            DB::commit();
        } catch (\Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
            DB::rollBack();
        }

        //Menghapus session 
        session()->forget("temporary_pemesanan");
        //Menghapus session 

        // $persediaan = Persediaan::where('id', $request->id_persediaan)->first();

        // $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $request->jumlah_pemasukan;

        // $persediaan->save();

        return redirect('pemesanan')->with('toast_success', 'Data Berhasil Ditambah');
    }

    public function addListPemesanan(Request $request)
    {
        // Validasi bahwa required itu harus diisi jika tidak maka akan dikembalikan ke halaman semula otomatis
        $request->validate([
            'id_persediaan' => 'required',
        ]);
        // Validasi bahwa required itu harus diisi jika tidak maka akan dikembalikan ke halaman semula otomatis

        // Mencari data menggunakan query builder
        // $dbpersediaan = DB::table('persediaan')
        //     ->where('id', $request->id_persediaan)
        //     ->first();
        // Mencari data menggunakan query builder

        // Mencari data menggunakan model
        $dbpersediaan = Persediaan::findorfail($request->id_persediaan);
        // Mencari data menggunakan model

        // Inisialisasi session dan dimasukkan ke variabel
        $temporary_pemesanan = session("temporary_pemesanan");
        // Inisialisasi session dan dimasukkan ke variabel

        // Memasukkan data array ke variabel session dengan id persediaan sebagai key
        $temporary_pemesanan[$request->id_persediaan] = [
            "id" => $request->id_persediaan,
            "nama_persediaan" => $dbpersediaan->nama_persediaan,
            "jumlah_pemesanan" => 0,
            "eoq" => 0,
            "biaya_pemesanan" => 0
        ];
        // Memasukkan data array ke variabel session dengan id persediaan sebagai key

        // Memasukkan atau memperbarui isi dari variable temporary ke session
        session(["temporary_pemesanan" => $temporary_pemesanan]);
        // Memasukkan atau memperbarui isi dari variable temporary ke session

        return redirect()->route('tambah.pemesanan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dbpemesanan = DetailPemesanan::with(['persediaan', 'pemesanan'])->where('id_pemesanan', $id)->get();
        // dd($dbpenggunaan);

        return view('fumigator.pages.pemesanan.detail', compact('dbpemesanan'));
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
        $peme = Pemesanan::with('persediaan')->findorfail($id);
        return view('fumigator.pages.pemasukan.ubah', compact('peme', 'dbpersediaan'));
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
        $peme = Pemesanan::findorfail($id);
        // $pem->update($request->all());
        // $persediaan = Persediaan::where('id', $request->id_persediaan)->first();

        // $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $peme->jumlah_pemasukan - $request->jumlah_pemesanan;

        // $persediaan->save();

        // $peme->jumlah_pemesanan = $request->jumlah_pemesanan;

        // $peme->save();

        return redirect('pemesanan')->with('toast_success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $peme = Pemesanan::findorfail($id);
        $peme->delete();
        return back()->with('info', 'Data Berhasil Dihapus');
    }

    public function destroyItemTemp($id_persediaan)
    {
        $temporary_pemesanan = session("temporary_pemesanan");
        unset($temporary_pemesanan[$id_persediaan]);
        session(["temporary_pemesanan" => $temporary_pemesanan]);
        return redirect()->route('tambah.pemesanan');
    }

    public function hitungEOQ(Request $request)
    {
        $request->validate([
            'biaya_pemesanan' => 'required',
        ]);

        $bulan_tahun = DB::table('penggunaan')
            ->selectRaw('DATE_FORMAT(MAX(tanggal_penggunaan),"%m-%Y") as bulan')
            ->whereRaw('DATE_FORMAT(tanggal_penggunaan, "%m-%Y") < DATE_FORMAT(now(), "%m-%Y")')
            ->first();

        // $hasil_hitung = [];
        $temporary_pemesanan = session("temporary_pemesanan");
        $s = $request->biaya_pemesanan;
        $no = 1;
        $month_before = Carbon::createFromFormat('m-Y', $bulan_tahun->bulan)->subMonth(2)->format('m-Y');
        // dd($month_before);

        foreach ($temporary_pemesanan as $temp) {
            $data = DB::table('detail_penggunaan as dp')
                ->join('penggunaan as p', 'dp.id_penggunaan', '=', 'p.id')
                ->join('persediaan as ps', 'dp.id_persediaan', '=', 'ps.id')
                ->selectRaw('max(dp.jumlah_penggunaan) as max, round(avg(dp.jumlah_penggunaan)) as avg, sum(dp.jumlah_penggunaan) as total')
                ->whereRaw('ps.id = "' . $temp['id'] . '" AND DATE_FORMAT(p.tanggal_penggunaan, "%m-%Y") >= "' . $month_before . '" AND DATE_FORMAT(p.tanggal_penggunaan, "%m-%Y") <= "' . $bulan_tahun->bulan . '"')
                ->first();
            $persediaan = Persediaan::findorfail($temp['id']);
            $temporary_pemesanan[$temp['id']]['eoq'] = $data->total > 0 ? round(sqrt((2 * $data->total * $request->biaya_pemesanan) / $persediaan->biaya_penyimpanan)) : 0;
            $temporary_pemesanan[$temp['id']]['jumlah_pemesanan'] = $data->total > 0 ? round(sqrt((2 * $data->total * $request->biaya_pemesanan) / $persediaan->biaya_penyimpanan)) : 0;
            $temporary_pemesanan[$temp['id']]['biaya_pemesanan'] = $request->biaya_pemesanan;
            session(["temporary_pemesanan" => $temporary_pemesanan]);
            // dd($data->total);
        }
        $temporary_pemesanan = session("temporary_pemesanan");
        // dd($temporary_pemesanan);
        // $temporary_pemesanan = session("temporary_pemesanan");
        return redirect()->route('tambah.pemesanan');
    }

    public function ubahJumlah(Request $request)
    {
        $request->validate([
            'jumlah_pemesanan_ubah' => 'required',
        ]);
        $temporary_pemesanan = session("temporary_pemesanan");
        $temporary_pemesanan[$request->id]['jumlah_pemesanan'] = $request->jumlah_pemesanan_ubah;
        session(["temporary_pemesanan" => $temporary_pemesanan]);
        // dd($request->all());
        return redirect()->route('tambah.pemesanan');
    }

    public function ChangeStatus($id){
        $dbpemesanan = DetailPemesanan::findorfail($id);
        
    }
}
