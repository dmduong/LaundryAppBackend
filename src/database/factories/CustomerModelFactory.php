<?php

namespace Database\Factories;

use App\Models\StoreModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomerModel>
 */
class CustomerModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $store_id = StoreModel::query()->inRandomOrder()->first();

        $year = '199' . rand(1, 9);
        return [
            'db_store_id' => $store_id->id,
            'db_customer_number' => rand(000000, 999999),
            'db_customer_name' => fake()->firstName() . ' ' . fake()->lastName(),
            'db_customer_gender' => rand(1, 2),
            'db_customer_birthday' => Carbon::create($year, rand(1, 12), rand(1, 29), 00, 00, 00),
            'db_customer_address' => fake()->address(),
            'db_customer_phone' => rand(0000000000, 9999999999),
            'db_customer_email' => fake()->email(),
            'db_customer_image' => fake()->imageUrl(),
            'db_customer_status' => null,
            'db_customer_created_at' => Carbon::now()->timestamp,
            'db_customer_updated_at' => Carbon::now()->timestamp
        ];
    }
}