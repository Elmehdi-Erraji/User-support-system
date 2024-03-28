<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStore;
use App\Http\Requests\User\UserUpdate;
use App\Models\Department;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'client');
        })->withTrashed()->get();
        return view('dashboard.admin.users.index',compact('users'));
    }
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.create', compact('departments', 'roles'));
    }

    public function store(UserStore $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        $user->addMediaFromRequest('avatar')->usingName($user->name)->toMediaCollection('avatars','avatars');
        $user->roles()->attach($request->role);
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }


    public function show($id) 
    {
        $user = User::findOrFail($id);
        $tickets = $user->tickets;
        return view('dashboard.admin.users.show',compact('user','tickets'));
    }

    public function agentShow($id) 
    {
        $user = User::findOrFail($id);

        $assignedTickets = Ticket::where('support_agent_id', $id)->get();

        return view('dashboard.admin.users.agentShow',compact('user','assignedTickets'));
    }



    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.edit', compact('user', 'departments', 'roles'));
    }

    public function update(UserUpdate $request, string $id)
    {
        $user = User::findOrFail($id);
        $user->roles()->sync($request->role);
        
        if ($request->filled('department_id')) {
            $user->department_id = $request->department_id;
        } 

        $user->status = $request->status;
        if ($request->status == 3 && $request->filled('ban_reason')) {
            $user->ban_reason = $request->input('ban_reason');
        }
    
        if ($request->role != 2) {
            $user->department_id = null; 
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


    public function clientsList()
    {
        $clients = User::whereHas('roles', function ($query) {
            $query->where('name', '=', 'client');
        })->get();
        return view('dashboard.admin.users.clients', compact('clients'));
    }
}
