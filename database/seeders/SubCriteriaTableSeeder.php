<?php

namespace Database\Seeders;

use App\Models\IntervalCriteria;
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
        IntervalCriteria::insert([
            ['criteria_id' => 1, 'range' => '> 616000000', 'value' => 4],
            ['criteria_id' => 1, 'range' => '380000000 - 540000000', 'value' => 3],
            ['criteria_id' => 1, 'range' => '285000000 - 320000000', 'value' => 2],
            ['criteria_id' => 1, 'range' => '180000000 - 253100000', 'value' => 1],

            ['criteria_id' => 2, 'range' => '8-9', 'value' => 4],
            ['criteria_id' => 2, 'range' => '7-8', 'value' => 3],
            ['criteria_id' => 2, 'range' => '4-5', 'value' => 2],
            ['criteria_id' => 2, 'range' => '2-3', 'value' => 1],

            ['criteria_id' => 3, 'range' => 'Putih', 'value' => 4],
            ['criteria_id' => 3, 'range' => 'Pearl Gray Metallic', 'value' => 3],
            ['criteria_id' => 3, 'range' => 'Hitam', 'value' => 2],
            ['criteria_id' => 3, 'range' => 'Lainnya', 'value' => 1],

            ['criteria_id' => 4, 'range' => '1500', 'value' => 4],
            ['criteria_id' => 4, 'range' => '1498', 'value' => 3],
            ['criteria_id' => 4, 'range' => '1408', 'value' => 2],
            ['criteria_id' => 4, 'range' => '1199', 'value' => 1],
        ]);
    }
}
