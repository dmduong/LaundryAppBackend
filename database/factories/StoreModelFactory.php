<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreModel>
 */
class StoreModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'db_store_number' => rand(000000, 999999),
            'db_store_name' => fake()->name(),
            'db_store_phone' => rand(0000000000, 9999999999),
            'db_store_image' => fake()->imageUrl(),
            'db_store_email' => fake()->email(),
            'db_store_address' => fake()->address(),
            'db_store_status' => null,
            'db_store_created_at' => Carbon::now()->timestamp,
            'db_store_updated_at' => Carbon::now()->timestamp
        ];
    }
}