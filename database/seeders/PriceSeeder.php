<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            ['harga' => '180.000.000 – 253.100.000'],
            ['harga' => '285.000.000 – 320.000.000'],
            ['harga' => '380.000.000 – 540.000.000'],
            ['harga' => '>616.000.000'],
        ]);
    }
}
