<?php

namespace Database\Seeders;

use App\Models\EmployeeModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmployeeModel::factory()->count(5)->create();
    }
}