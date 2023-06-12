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
            session(["temporary_pemesanan" => $temporary_pemesanan]);
            // dd($data->total);
        }
        $temporary_pemesanan = session("temporary_pemesanan");
        // dd($temporary_pemesanan);
        // $temporary_pemesanan = session("temporary_pemesanan");
        return redirect()->route('tambah.pemesanan');
    }