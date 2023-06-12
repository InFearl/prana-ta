<?php

namespace Database\Seeders;


use App\Models\Pemesanan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PemesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = file_get_contents('database/seeders/json/pemesanan.json');
        $datas = json_decode($datas);
        foreach ($datas as $data) {
            Pemesanan::create([
                'tanggal_pemesanan' => $data->tanggal_pemesanan,
                'biaya_pemesanan' => 0
            ]);
        }
    }
}
