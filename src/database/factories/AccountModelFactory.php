<?php

namespace Database\Factories;

use App\Models\StoreModel;
use App\Traits\UniqueCodeTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AccountModel>
 */
class AccountModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    use UniqueCodeTrait;
    public function definition(): array
    {
        $store = StoreModel::query()->inRandomOrder()->first();
        return [
            'db_store_id' => $store->id,
            'db_employee_id' => null,
            'db_customer_id' => null,
            'db_account_name' => fake()->userName(),
            'db_account_password' => Hash::make('x$M5SbXT'),
            'db_account_token' => null,
            'db_account_refresh_token' => null,
            'db_account_device' => '172.160.16.' . rand(1, 100),
            'db_account_status' => rand(1, 3)
        ];
    }
}