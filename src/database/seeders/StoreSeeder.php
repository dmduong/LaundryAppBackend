<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\StoreModel;
use Database\Factories\AccountModelFactory;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreModel::factory()->count(1)->create();
    }
}