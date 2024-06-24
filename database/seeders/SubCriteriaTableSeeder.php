<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_criteria')->insert([
            // Harga
            [
                'criteria_id' => 1,
                'interval' => '>616.000.000',
                'nilai' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'interval' => '380.000.000 – 540.000.000',
                'nilai' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'interval' => '285.000.000 – 320.000.000',
                'nilai' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 1,
                'interval' => '180.000.000 – 253.100.000',
                'nilai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Jumlah Seat
            [
                'criteria_id' => 2,
                'interval' => '8-9 seat',
                'nilai' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'interval' => '7-8 seat',
                'nilai' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'interval' => '4-5 seat',
                'nilai' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 2,
                'interval' => '2-3 seat',
                'nilai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Warna
            [
                'criteria_id' => 3,
                'interval' => 'Putih',
                'nilai' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'interval' => 'Pearl Gray Metallic',
                'nilai' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'interval' => 'Hitam',
                'nilai' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 3,
                'interval' => 'Lainnya',
                'nilai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Kapasitas Mesin
            [
                'criteria_id' => 4,
                'interval' => '1.500 CC',
                'nilai' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 4,
                'interval' => '1.498 CC',
                'nilai' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 4,
                'interval' => '1408 CC',
                'nilai' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'criteria_id' => 4,
                'interval' => '1.199 CC',
                'nilai' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
