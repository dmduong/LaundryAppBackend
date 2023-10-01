<?php

namespace Database\Factories;

use App\Models\StoreModel;
use App\Traits\UniqueCodeTrait;
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

    use UniqueCodeTrait;
    public function definition(): array
    {

        $store_id = StoreModel::query()->inRandomOrder()->first();

        $year = '199' . rand(1, 9);
        return [
            'db_store_id' => $store_id->id,
            'db_customer_number' => $this->codeNumber(),
            'db_customer_name' => fake()->firstName() . ' ' . fake()->lastName(),
            'db_customer_gender' => rand(1, 2),
            'db_customer_birthday' => Carbon::create($year, rand(1, 12), rand(1, 29), 00, 00, 00),
            'db_customer_address' => fake()->address(),
            'db_customer_phone' => $this->faker->phoneNumber(),
            'db_customer_email' => fake()->email(),
            'db_customer_image' => fake()->imageUrl(),
            'db_customer_status' => null
        ];
    }
}