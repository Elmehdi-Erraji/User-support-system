<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Contracts\UsersInterface;
use Illuminate\Support\Facades\Hash;

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
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->addMediaFromRequest('avatar')->usingName($user->name)->toMediaCollection('avatars','avatars');
        $user->roles()->attach($data['role']);
        return $user;
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
