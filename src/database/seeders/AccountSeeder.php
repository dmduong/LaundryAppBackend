<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\CustomerModel;
use App\Models\EmployeeModel;
use App\Models\StoreModel;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = StoreModel::query()->inRandomOrder()->first();
        $employee = EmployeeModel::query()->inRandomOrder()->first();
        $customer = CustomerModel::query()->inRandomOrder()->first();

        AccountModel::factory()->count(1)->create(
            [
                'db_customer_id' => null,
                'db_employee_id' => null,
                'db_store_id' => $store->id,
                'db_account_status' => 1
            ]
        );

        AccountModel::factory()->count(1)->create(
            [
                'db_employee_id' => $employee->id,
                'db_customer_id' => null,
                'db_store_id' => null,
                'db_account_status' => 1
            ]
        );

        AccountModel::factory()->count(1)->create(
            [
                'db_store_id' => null,
                'db_employee_id' => null,
                'db_customer_id' => $customer->id,
                'db_account_status' => 1
            ]
        );
    }
}