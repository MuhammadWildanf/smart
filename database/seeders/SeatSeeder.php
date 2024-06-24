<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seats')->insert([
            ['jumlah_seat' => '2-3 seat'],
            ['jumlah_seat' => '4-5 seat'],
            ['jumlah_seat' => '7-8 seat'],
            ['jumlah_seat' => '8-9 seat'],
        ]);
    }
}
