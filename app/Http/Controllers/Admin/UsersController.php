<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('dashboard.admin.users.index',compact('users'));
    }
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->addMediaFromRequest('avatar')->usingName($user->name)->toMediaCollection('avatars','avatars');
        $user->roles()->attach($request->role);
        return redirect()->route('users.index')->with('success', 'user created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.edit', compact('user', 'departments', 'roles'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);
        
        $user->roles()->sync($request->role);
        $user->status = $request->status;
    
        if ($request->status == 3 && $request->filled('ban_reason')) {
            $user->ban_reason = $request->input('ban_reason');
        }
    
        $user->save();
        
        return redirect()->route('users.index')->with('success', 'User has been updated successfully');
    }
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return redirect()->route('users.index')->with('success', 'User restored successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();

        return redirect()->route('users.index')->with('success', 'User permanently deleted successfully');
    }
}
