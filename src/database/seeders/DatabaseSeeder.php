<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $roles = ['admin', 'employee', 'customer'];

        $permissions = ['view', 'create', 'update', 'delete'];

        collect($roles)->map(fn($name) => DB::table('roles')->insert([
            'name' => $name,
            'guard_name' => 'api',
            'created_at' => now(),
            'updated_at' => now()
        ]));

        collect($permissions)
            ->map(
                fn($name) => DB::table('permissions')->insert([
                    'name' => $name,
                    'guard_name' => 'api',
                    'created_at' => now(),
                    'updated_at' => now()
                ])
            )
            ->toArray();

        $permissionIdsByRole = [
            $roles[0] => Permission::all()->pluck('id')->toArray(),
            $roles[1] => Permission::where(function ($query) use ($permissions) {
                $query->where('name', $permissions[0])->Orwhere('name', $permissions[2]);
            })->pluck('id')->toArray(),
            $roles[2] => Permission::where(function ($query) use ($permissions) {
                $query->where('name', $permissions[0]);
            })->pluck('id')->toArray()
        ];

        foreach ($permissionIdsByRole as $role => $permissionIds) {
            $role = Role::whereName($role)->first();

            DB::table('role_has_permissions')
                ->insert(
                    collect($permissionIds)->map(fn($id) => [
                        'role_id' => $role->id,
                        'permission_id' => $id
                    ])->toArray()
                );
        }

        $this->call([
            StoreSeeder::class,
            EmployeeSeeder::class,
            CustomerSeeder::class,
        ]);
    }
}