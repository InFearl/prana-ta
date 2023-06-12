<?php

namespace Database\Seeders;

use App\Models\DetailPemasukan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailPemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/detailpemasukan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            DetailPemasukan::create([
                'id_persediaan' => $data->id_persediaan,
                'id_pemasukan' => $data->id_pemasukan,
                'jumlah_pemasukan' => $data->jumlah_pemasukan
            ]);
        }
    }
}
