<?php

namespace Database\Seeders;

use App\Models\Pesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/pesanan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            Pesanan::create([
                'nama_perusahaan' => $data->nama_perusahaan,
                'container' => $data->container,
                'tanggal_masuk' => $data->tanggal_masuk,
                'tanggal_akhir' => $data->tanggal_akhir,
                'status_pesanan' => $data->status_pesanan,
            ]);
        }
    }
}
