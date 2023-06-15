<?php

namespace Database\Seeders;

use App\Models\Pemasukan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PemasukanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/pemasukan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            Pemasukan::create([
                'id_pemesanan' => $data->id_pemesanan,
                'tanggal_pemasukan' => $data->tanggal_pemasukan
            ]);
        }
    }
}
