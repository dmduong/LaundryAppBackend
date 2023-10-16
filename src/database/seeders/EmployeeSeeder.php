<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\EmployeeModel;
use App\Models\StoreModel;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = StoreModel::first();
        EmployeeModel::factory()->count(200)->create([
            'db_store_id' => $store->id
        ])->each(
                function ($employee) {
                    AccountModel::factory()->create([
                        'db_employee_id' => $employee->id
                    ]);
                }
            );
    }
}