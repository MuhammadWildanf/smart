<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\CarFactory;
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
        $this->call(
            [
                UserSeeder::class,
                RoleSeeder::class,
                CarSeeder::class,
                CriteriaTableSeeder::class,
                SubCriteriaTableSeeder::class,
            ]
        );
    }
}
