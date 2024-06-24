<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CreateSuperUserSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call([CreateSuperUserSeeder::class,
       ColorSeeder::class,
       CapacitySeeder::class,
       PriceSeeder::class,
       SeatSeeder::class,
       CarSeeder::class,
       CriteriaTableSeeder::class,
       SubCriteriaTableSeeder::class,]);
    }
}
