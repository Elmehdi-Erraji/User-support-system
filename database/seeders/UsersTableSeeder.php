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
             $admin = User::factory()->create([
                'email' => 'admin@mail.com',
                'password' => bcrypt('admin@mail.com'), // Password is the same as email
                'phone' => $this->generatePhoneNumber(),
            ]);
            $admin->roles()->attach(Role::where('name', 'admin')->first()->id);
    
            $supportAgent = User::factory()->create([
                'email' => 'support@mail.com',
                'password' => bcrypt('support@mail.com'), // Password is the same as email
                'phone' => $this->generatePhoneNumber(),
            ]);
            $supportAgent->roles()->attach(Role::where('name', 'support_agent')->first()->id);
    
            $client = User::factory()->create([
                'email' => 'client@mail.com',
                'password' => bcrypt('client@mail.com'), // Password is the same as email
                'phone' => $this->generatePhoneNumber(),
            ]);
            $client->roles()->attach(Role::where('name', 'client')->first()->id);
        }
    
        private function generatePhoneNumber()
        {
            return '0' . mt_rand(100000000, 999999999); // Generates a 10-digit random number starting with 0
        }
    
}
