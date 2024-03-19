<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(3)->create()->each(function($user){
            $user->roles()->attach(Role::inRandomOrder()->limit(rand(1,2))->pluck('id'));
        });
    }
}
