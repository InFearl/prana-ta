<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Pemasukan;
use App\Models\Persediaan;
use Illuminate\Http\Request;
use App\Models\DetailPemasukan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class PemasukanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dbpemasukan = Pemasukan::latest()->paginate(5);
        return view('fumigator.pages.pemasukan.index', compact('dbpemasukan'));
    }

    public function cetakpemasukan()
    {
        $dbcetakpemasukan = Pemasukan::with('persediaan')->get();
        return view('fumigator.pages.pemasukan.cetak', compact('dbcetakpemasukan'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $temporary_pemasukan = session("temporary_pemasukan");
        $dbpersediaan = Persediaan::all();
        return view('fumigator.pages.pemasukan.tambah', compact('dbpersediaan', 'temporary_pemasukan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dbpemasukan = Pemasukan::create([
            'tanggal_pemasukan' => Carbon::now(),
        ]);

        DB::beginTransaction();
        try {
            $temporary_pemasukan = session("temporary_pemasukan");
            foreach ($temporary_pemasukan as $temp) {
                DetailPemasukan::create([
                    'id_pemasukan' => $dbpemasukan->id,
                    'id_persediaan' => $temp['id'],
                    'jumlah_pemasukan' => $temp['jumlah_pemasukan']
                ]);
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
                $persediaan = Persediaan::where('id', $temp['id'])->first();
                $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $temp['jumlah_pemasukan'];
                $persediaan->save();
                // Update stok persediaan sesuai dengan persediaan yang diinput ke detail penggunaan
            }
            DB::commit();
        } catch (\Exception $ex) {
            //throw $th;
            echo $ex->getMessage();
            DB::rollBack();
        }

        //Menghapus session 
        session()->forget("temporary_pemasukan");
        //Menghapus session 

        // $persediaan = Persediaan::where('id', $request->id_persediaan)->first();

        // $persediaan->jumlah_persediaan = $persediaan->jumlah_persediaan + $request->jumlah_pemasukan;

        // $persediaan->save();

        return redirect('pemasukan')->with('toast_success', 'Data Berhasil Ditambah');
    }

    public function addListPemasukan(Request $request)
    {
        // Validasi bahwa required itu harus diisi jika tidak maka akan dikembalikan ke halaman semula otomatis
        $request->validate([
            'id_persediaan' => 'required',
            'jumlah_pemasukan' => 'required'
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
        $temporary_pemasukan = session("temporary_pemasukan");
        // Inisialisasi session dan dimasukkan ke variabel

        // Memasukkan data array ke variabel session dengan id persediaan sebagai key
        $temporary_pemasukan[$request->id_persediaan] = [
            "id" => $request->id_persediaan,
            "nama_persediaan" => $dbpersediaan->nama_persediaan,
            "jumlah_pemasukan" => $request->jumlah_pemasukan
        ];
        // Memasukkan data array ke variabel session dengan id persediaan sebagai key

        // Memasukkan atau memperbarui isi dari variable temporary ke session
        session(["temporary_pemasukan" => $temporary_pemasukan]);
        // Memasukkan atau memperbarui isi dari variable temporary ke session

        return redirect()->route('tambah.pemasukan');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dbpemasukan = DetailPemasukan::with(['persediaan', 'pemasukan'])->where('id_pemasukan', $id)->get();
        // dd($dbpenggunaan);

        return view('fumigator.pages.pemasukan.detail', compact('dbpemasukan'));
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
        $pem = Pemasukan::with('persediaan')->findorfail($id);
        return view('fumigator.pages.pemasukan.ubah', compact('pem', 'dbpersediaan'));
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


    public function destroyItemTemp($id_persediaan)
    {
        $temporary_pemasukan = session("temporary_pemasukan");
        unset($temporary_pemasukan[$id_persediaan]);
        session(["temporary_pemasukan" => $temporary_pemasukan]);
        return redirect()->route('tambah.pemasukan');
    }
}
