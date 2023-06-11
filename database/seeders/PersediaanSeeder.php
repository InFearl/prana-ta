<?php

namespace Database\Seeders;

use App\Models\Persediaan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersediaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     
    public function run()
    {
        Persediaan::create([
            'nama_persediaan' => 'Gas Methyl Bromide',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
        Persediaan::create([
            'nama_persediaan' => 'Gas Oksigen',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
        Persediaan::create([
            'nama_persediaan' => 'Cartridge Gas Mask',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
        Persediaan::create([
            'nama_persediaan' => 'Plastik Fumigasi',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
        Persediaan::create([
            'nama_persediaan' => 'Sand Snake',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
        Persediaan::create([
            'nama_persediaan' => 'Kertas Sertifikat Fumigasi',
            'jumlah_persediaan' => '50',
            'biaya_penyimpanan' => '2000',
        ]);
    }
}
