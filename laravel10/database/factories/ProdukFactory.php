<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProdukFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->unique()->word(),
            'kategori_id' => $this->faker->numberBetween(1, 6),
            'pesans_id' => $this->faker->numberBetween(1, 10),
            'harga' => $this->faker->randomFloat()
        ];
    }
}
