<?php

namespace Database\Factories;

use App\Models\StoreModel;
use App\Traits\UniqueCodeTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EmployeeModel>
 */
class EmployeeModelFactory extends Factory
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
            'db_employee_number' => $this->codeNumber(),
            'db_employee_name' => fake()->firstName() . ' ' . fake()->lastName(),
            'db_employee_gender' => rand(1, 2),
            'db_employee_birthday' => Carbon::create($year, rand(1, 12), rand(1, 29), 00, 00, 00),
            'db_employee_address' => fake()->address(),
            'db_employee_phone' => $this->faker->phoneNumber(),
            'db_employee_email' => fake()->email(),
            'db_employee_image' => fake()->imageUrl(),
            'db_employee_status' => null
        ];
    }
}