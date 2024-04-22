<?php

namespace App\Repositories\Eloquent;

use App\Jobs\CreateUserJob;
use App\Mail\WelcomeEmail;
use App\Models\User;
use App\Repositories\Contracts\UsersInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UsersRepository implements UsersInterface
{
    public function getAllUsers()
    {
        return User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'client');
        })->withTrashed()->get();
    }

    public function getUsersByRole(string $roleName)
    {
        return User::whereHas('roles', function ($query) use ($roleName) {
            $query->where('name', $roleName);
        })->withTrashed()->get();
    }

    public function getUserById(string $id)
    {
        return User::findOrFail($id);
    }

    public function createUser(array $data)
    {
        $plaintextPassword = $data['password'];
    
        // Hash the password
        $data['password'] = Hash::make($data['password']);
        
        // Set first_time_login to true (1) explicitly
        $data['first_time_login'] = 1;

        // Dispatch the CreateUserJob with the provided data
        CreateUserJob::dispatch($data, $plaintextPassword);
    }
    

    
   

    public function updateUser(string $id, array $data)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($data['role']);
        
        if (isset($data['department_id'])) {
            $user->department_id = $data['department_id'];
        } 

        $user->status = $data['status'];
        if ($data['status'] == 3 && isset($data['ban_reason'])) {
            $user->ban_reason = $data['ban_reason'];
        }
    
        if ($data['role'] != 2) {
            $user->department_id = null; 
        }
    
        $user->save();
        return $user;
    }

    public function deleteUser(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function restoreUser(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
    }

    public function forceDeleteUser(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
    }

    public function getClients()
    {
        return User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'client');
        })->withTrashed()->paginate(9);
    }
}
