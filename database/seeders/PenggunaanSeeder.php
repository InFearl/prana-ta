<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penggunaan;

class PenggunaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/penggunaan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            Penggunaan::create([
                'id_pesanan' => $data->id_pesanan,
                'tanggal_penggunaan' => $data->tanggal_penggunaan
            ]);
        }
    }
}
