<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\CustomerModel;
use App\Models\StoreModel;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = StoreModel::first();
        CustomerModel::factory()->count(200)->create([
            'db_store_id' => $store->id
        ])->each(
            function ($customer) {
                AccountModel::factory()->create([
                    'db_customer_id' => $customer->id
                ]);
            }
        );
    }
}