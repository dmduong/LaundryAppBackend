<?php

namespace Database\Seeders;

use App\Models\StoreModel;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreModel::factory()->count(6)->create();
    }
}