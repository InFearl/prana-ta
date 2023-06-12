<?php

namespace Database\Seeders;

use App\Models\DetailPemesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/detailpemesanan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            DetailPemesanan::create([
                'id_persediaan' => $data->id_persediaan,
                'id_pemesanan' => $data->id_pemesanan,
                'jumlah_pemesanan' => $data->jumlah_pemesanan
            ]);
        }
    }
}
