<?php

namespace Database\Factories;

use App\Enums\StatusStoresEnums;
use App\Traits\UniqueCodeTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreModel>
 */
class StoreModelFactory extends Factory
{

    use UniqueCodeTrait;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'db_store_number' => $this->codeNumber(),
            'db_store_name' => fake()->company(),
            'db_store_image' => fake()->imageUrl(),
            'db_store_address' => fake()->address(),
            'db_store_status' => fake()->randomElement([StatusStoresEnums::Active, StatusStoresEnums::Block])
        ];
    }
}