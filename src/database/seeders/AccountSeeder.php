<?php

namespace Database\Seeders;

use App\Enums\StatusAccountEnums;
use App\Models\AccountModel;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountModel::factory()->count(1)->create(
            [
                'db_customer_id' => null,
                'db_employee_id' => null,
                'db_store_id' => null,
                'db_account_status' => StatusAccountEnums::Active
            ]
        );
    }
}