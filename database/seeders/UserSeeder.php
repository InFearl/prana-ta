<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'user_id' => '10001',
            'slug' => Str::random(16),
            'nama' => 'farel',
            'role' => 'fumigator',
            'password' => bcrypt('ngentot'),
        ]);
    }
}
