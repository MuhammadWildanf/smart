<?php

namespace Database\Seeders;

use App\Models\Car;
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
        Car::insert([
            [
                'name' => 'BRV',
                'code' => 'P1',
                'price' => 350000000,
                'available_seat' => 8,
                'color' => 'Putih',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Brio',
                'code' => 'P2',
                'price' => 250000000,
                'available_seat' => 5,
                'color' => 'Merah',
                'capacity_machine' => 1200,
            ],
            [
                'name' => 'Civic RS',
                'code' => 'P3',
                'price' => 500000000,
                'available_seat' => 5,
                'color' => 'Hitam',
                'capacity_machine' => 1800,
            ],
            [
                'name' => 'WR-V',
                'code' => 'P4',
                'price' => 300000000,
                'available_seat' => 5,
                'color' => 'Silver',
                'capacity_machine' => 1400,
            ],
            [
                'name' => 'Ertiga',
                'code' => 'P5',
                'price' => 230000000,
                'available_seat' => 7,
                'color' => 'Biru',
                'capacity_machine' => 1300,
            ],
            [
                'name' => 'Xenia',
                'code' => 'P6',
                'price' => 200000000,
                'available_seat' => 7,
                'color' => 'Putih',
                'capacity_machine' => 1200,
            ],
            [
                'name' => 'Alphard',
                'code' => 'P7',
                'price' => 1000000000,
                'available_seat' => 7,
                'color' => 'Hitam',
                'capacity_machine' => 2500,
            ],
            [
                'name' => 'Fortuner',
                'code' => 'P8',
                'price' => 450000000,
                'available_seat' => 7,
                'color' => 'Silver',
                'capacity_machine' => 2400,
            ],
            [
                'name' => 'Xpander',
                'code' => 'P9',
                'price' => 270000000,
                'available_seat' => 7,
                'color' => 'Merah',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Pajero Sport',
                'code' => 'P10',
                'price' => 600000000,
                'available_seat' => 7,
                'color' => 'Putih',
                'capacity_machine' => 2500,
            ],
            [
                'name' => 'Grand Livina',
                'code' => 'P11',
                'price' => 280000000,
                'available_seat' => 7,
                'color' => 'Silver',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Innova',
                'code' => 'P12',
                'price' => 400000000,
                'available_seat' => 8,
                'color' => 'Hitam',
                'capacity_machine' => 2500,
            ],
            [
                'name' => 'Avanza',
                'code' => 'P13',
                'price' => 220000000,
                'available_seat' => 7,
                'color' => 'Putih',
                'capacity_machine' => 1300,
            ],
            [
                'name' => 'City',
                'code' => 'P14',
                'price' => 350000000,
                'available_seat' => 5,
                'color' => 'Merah',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'HR-V',
                'code' => 'P15',
                'price' => 380000000,
                'available_seat' => 5,
                'color' => 'Hitam',
                'capacity_machine' => 1800,
            ],
            [
                'name' => 'Livina',
                'code' => 'P16',
                'price' => 260000000,
                'available_seat' => 7,
                'color' => 'Silver',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Yaris',
                'code' => 'P17',
                'price' => 290000000,
                'available_seat' => 5,
                'color' => 'Putih',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Almera',
                'code' => 'P18',
                'price' => 240000000,
                'available_seat' => 5,
                'color' => 'Hitam',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Sienta',
                'code' => 'P19',
                'price' => 310000000,
                'available_seat' => 7,
                'color' => 'Silver',
                'capacity_machine' => 1500,
            ],
            [
                'name' => 'Rush',
                'code' => 'P20',
                'price' => 320000000,
                'available_seat' => 7,
                'color' => 'Merah',
                'capacity_machine' => 1500,
            ],
        ]);
    }
}
