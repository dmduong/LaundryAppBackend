<?php

namespace Database\Seeders;

use App\Models\AccountModel;
use App\Models\EmployeeModel;
use App\Models\StoreModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $store = StoreModel::first();
        // $totalRow = 200;
        // $employee = [];
        // for ($i = 0; $i < $totalRow; $i++) {
        //     $employee[$i] = EmployeeModel::factory()->make([
        //         'db_store_id' => $store->id,
        //     ]);
        // }

        // $account = [];
        // for ($i = 0; $i < $totalRow; $i++) {
        //     $account[$i] = AccountModel::factory()->make([
        //         'db_employee_id'=> $employee[$i]->id,
        //     ]);
        // }

        // DB::beginTransaction();
        // try {
        //     DB::table('employees')->insert(collect($employee)->toArray());
        //     DB::table('accounts')->insert(collect($account)->toArray());
        //     DB::commit();
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     abort(500, $th->getMessage());
        // }
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