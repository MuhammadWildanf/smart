<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CapacitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('capacities')->insert([
            ['kapasitas_mesin' => '1199 CC'],
            ['kapasitas_mesin' => '1408 CC'],
            ['kapasitas_mesin' => '1498 CC'],
            ['kapasitas_mesin' => '1500 CC'],
        ]);
    }
}
