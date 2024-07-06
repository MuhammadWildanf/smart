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
        $cars = [
            [
                'image_url' => 'Brio Satya.png',
                'name' => 'Brio Satya',
                'code' => 'P1',
                'price' => 187600000,
                'available_seat' => 5,
                'color' => 'Kuning',
                'capacity_machine' => 1199,
            ],
            [
                'image_url' => 'HR-V.png',
                'name' => 'HR-V',
                'code' => 'P2',
                'price' => 383900000,
                'available_seat' => 5,
                'color' => 'Platinum White Pearl',
                'capacity_machine' => 1498,
            ],
            [
                'image_url' => 'BR-V.png',
                'name' => 'BR-V',
                'code' => 'P3',
                'price' => 285000000,
                'available_seat' => 8,
                'color' => 'Putih',
                'capacity_machine' => 1198,
            ],
            [
                'image_url' => 'civic.png',
                'name' => 'Civic',
                'code' => 'P4',
                'price' => 606400000,
                'available_seat' => 4,
                'color' => 'Putih',
                'capacity_machine' => 1500,
            ],
            [
                'image_url' => 'WR-V.png',
                'name' => 'WR-V',
                'code' => 'P5',
                'price' => 274900000,
                'available_seat' => 5,
                'color' => 'Merah',
                'capacity_machine' => 1498,
            ],
            [
                'image_url' => 'city.png',
                'name' => 'City',
                'code' => 'P6',
                'price' => 352500000,
                'available_seat' => 5,
                'color' => 'Putih',
                'capacity_machine' => 1498,
            ],
            [
                'image_url' => 'CR-V.png',
                'name' => 'CR-V',
                'code' => 'P7',
                'price' => 749100000,
                'available_seat' => 5,
                'color' => 'Canyon River Blue Metallic',
                'capacity_machine' => 1993,
            ],
            [
                'image_url' => 'mobilio.png',
                'name' => 'Mobilio',
                'code' => 'P8',
                'price' => 239600000,
                'available_seat' => 8,
                'color' => 'Putih',
                'capacity_machine' => 1496,
            ],
            [
                'image_url' => 'accord.png',
                'name' => 'Accord',
                'code' => 'P9',
                'price' => 959900000,
                'available_seat' => 5,
                'color' => 'Platinum White Pearl',
                'capacity_machine' => 1993,
            ],
            [
                'image_url' => 'brio.png',
                'name' => 'Brio RS',
                'code' => 'P10',
                'price' => 243100000,
                'available_seat' => 5,
                'color' => 'Kuning',
                'capacity_machine' => 1200,
            ],
        ];


        Car::insert($cars);
    }
}
