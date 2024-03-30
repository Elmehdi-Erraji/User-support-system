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

        $roles = Role::all();
        $departments = Department::all();
        $statuses = ['Pending', 'Active','Banned'];
        return view('dashboard.admin.users.index',compact('users','departments','roles','statuses'));
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
        })->withTrashed()->get();

        $statuses = ['Pending', 'Active','Banned'];
        return view('dashboard.admin.users.clients', compact('clients','statuses'));
    }

    


    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $status = $request->input('status');
        $departmentId = $request->input('department');

        $query = User::query();

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%')
                    ->orWhere('email', 'like', '%' . $searchQuery . '%');
            });
        }

       
        if (!empty($status) && $status !== 'null') {
            $query->where('status', $status);
        }

        if (!empty($departmentId) && $departmentId !== 'null') {
            $query->where('department_id', $departmentId);
        }

        $users = $query->get();

        $transformedUsers = $users->map(function ($user) {
            $avatarUrl = $user->getFirstMediaUrl('avatars') ?: null;
            $user['avatar_url'] = $avatarUrl;
            $user['role'] = $user->roles()->first()->name;
            if($user['department'] !== null){
            $user['department'] = $user->department->name;
        }
            return $user;
        });

        return response()->json($transformedUsers);
    }

    public function clientSearch(Request $request)
{
    $searchQuery = $request->input('search_query');
    $status = $request->input('status');

    $query = User::query();

    // Filter users by role "client"
    $query->whereHas('roles', function ($q) {
        $q->where('name', 'client'); // Assuming 'name' is the column that stores the role name
    });

    if (!empty($searchQuery)) {
        $query->where(function ($q) use ($searchQuery) {
            $q->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('email', 'like', '%' . $searchQuery . '%');
        });
    }
   
    if (!empty($status) && $status !== 'null') {
        $query->where('status', $status);
    }

    $users = $query->get();

    $transformedUsers = $users->map(function ($user) {
        $avatarUrl = $user->getFirstMediaUrl('avatars') ?: null;
        $user['avatar_url'] = $avatarUrl;
        $user['ticketCount'] = $user->tickets->count();
        return $user;
    });

    return response()->json($transformedUsers);
}

}


