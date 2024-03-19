<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->truncate();

        $permissions = [
            [
                'name' => 'user_create',
            ],
            [
                'name' => 'user_delete',
            ],
            [
                'name' => 'user_update',
            ],
            [
                'name' => 'user_access',
            ],
        ];

        foreach ($permissions as $permission) 
        {
            Permission::create($permission);
        }
    }
}
