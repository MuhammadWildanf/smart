<?php

namespace Database\Seeders;

use App\Models\Criteria;
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
        Criteria::create([
            'code' => 'C1',
            'name' => 'Price',
            'slug' => 'price',
            'bobot' => '35%',
            'normalisasi' => 0.35,
            'type' => 'cost',
        ]);

        Criteria::create([
            'code' => 'C2',
            'name' => 'Available Seat',
            'slug' => 'available_seat',
            'bobot' => '30%',
            'normalisasi' => 0.30,
            'type' => 'benefit',
        ]);

        Criteria::create([
            'code' => 'C3',
            'name' => 'Color',
            'slug' => 'color',
            'bobot' => '15%',
            'normalisasi' => 0.15,
            'type' => 'benefit',
        ]);

        Criteria::create([
            'code' => 'C4',
            'name' => 'Capacity Machine',
            'slug' => 'capacity_machine',
            'bobot' => '20%',
            'normalisasi' => 0.20,
            'type' => 'benefit',
        ]);
    }
}
