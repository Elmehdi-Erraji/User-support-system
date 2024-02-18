<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Permission::create(['name'=>'user_create']);
       Permission::create(['name'=>'user_delete']);
       Permission::create(['name'=>'user_update']);
       Permission::create(['name'=>'user_access']);
    }
}
