<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->name,
            'harga_id' => $this->faker->numberBetween(1, 4),
            'warna_id' => $this->faker->numberBetween(1, 4),
            'kapasitas_mesin_id' => $this->faker->numberBetween(1, 4),
            'seat_id' => $this->faker->numberBetween(1, 4),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
