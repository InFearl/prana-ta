<?php

namespace Database\Seeders;

use App\Models\DetailPemesanan;
use App\Models\Pemesanan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSeeder::class,
            PersediaanSeeder::class,
            PenggunaanSeeder::class,
            DetailPenggunaanSeeder::class,
            PemasukanSeeder::class,
            DetailPemasukanSeeder::class,
            PemesananSeeder::class,
            DetailPemesananSeeder::class,
            PesananSeeder::class,
        ]);
    }
}
