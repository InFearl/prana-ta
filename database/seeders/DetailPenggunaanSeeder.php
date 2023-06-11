<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DetailPenggunaan;

class DetailPenggunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/detailpenggunaan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            DetailPenggunaan::create([
                'id_persediaan' => $data->id_persediaan,
                'id_penggunaan' => $data->id_penggunaan,
                'jumlah_penggunaan' => $data->jumlah_penggunaan
            ]);
        }
    }
}
