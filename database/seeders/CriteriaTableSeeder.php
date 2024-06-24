<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CriteriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('criteria')->insert([
            [
                'kode' => 'C1',
                'criteria' => 'Harga Mobil',
                'weight' => 0.35,
                'jenis' => 'Cost',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'criteria' => 'Jumlah Seat',
                'weight' => 0.30,
                'jenis' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'criteria' => 'Warna',
                'weight' => 0.15,
                'jenis' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'criteria' => 'Kapasitas Mesin',
                'weight' => 0.20,
                'jenis' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
