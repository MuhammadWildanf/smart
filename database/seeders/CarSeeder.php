<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            [
                'nama' => 'BRV',
                'harga_id' => 2,
                'warna_id' => 1,
                'kapasitas_mesin_id' => 3,
                'seat_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Brio',
                'harga_id' => 1,
                'warna_id' => 4,
                'kapasitas_mesin_id' => 1,
                'seat_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Civic RS',
                'harga_id' => 4,
                'warna_id' => 2,
                'kapasitas_mesin_id' => 4,
                'seat_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'WR-V',
                'harga_id' => 3,
                'warna_id' => 2,
                'kapasitas_mesin_id' => 3,
                'seat_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
