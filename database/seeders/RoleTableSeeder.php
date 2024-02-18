<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{


    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Truncate the roles and permissions tables
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();

        // Seed permissions
        $permissions = [
            'user_access',
            'user_edit',
            'user_delete',
            'user_create',
            // Add more permissions as needed
        ];

        foreach ($permissions as $permissionName) {
            Permission::create(['name' => $permissionName]);
        }

        // Define roles and their associated permissions
        $roles = [
            'admin' => ['user_access', 'user_edit', 'user_delete', 'user_create'],
            'developer' => ['user_access', 'user_create'],
            'support_agent' => ['user_access'],
            'client' => ['user_access'],
            // Add more roles and their associated permissions as needed
        ];

        foreach ($roles as $roleName => $permissionNames) {
            // Create role
            $role = Role::create(['name' => $roleName]);

            // Attach random permissions to the role
            $permissions = Permission::whereIn('name', $permissionNames)->pluck('id');
            $role->permissions()->attach($permissions);
        }
    }
}
