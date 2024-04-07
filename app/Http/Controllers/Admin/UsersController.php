<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStore;
use App\Http\Requests\User\UserUpdate;
use App\Models\Department;
use App\Models\Role;
use App\Models\Ticket;
use App\Models\User;
use App\Repositories\Contracts\UsersInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    protected $userRepository;

    public function __construct(UsersInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAllUsers();
        $roles = Role::all();
        $departments = Department::all();
        $statuses = ['Pending', 'Active', 'Banned'];
        
        return view('dashboard.admin.users.index', compact('users', 'departments', 'roles', 'statuses'));
    }

    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.create', compact('departments', 'roles'));
    }

    public function store(UserStore $request)
    {
        $this->userRepository->createUser($request->validated());
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function show($id)
    {
        $user = $this->userRepository->getUserById($id);
        $tickets = $user->tickets;
        return view('dashboard.admin.users.show', compact('user', 'tickets'));
    }

    public function agentShow($id) 
    {
        $user = User::findOrFail($id);

        $assignedTickets = Ticket::where('support_agent_id', $id)->get();

        return view('dashboard.admin.users.agentShow',compact('user','assignedTickets'));
    }

    public function edit($id)
    {
        $user = $this->userRepository->getUserById($id);
        $departments = Department::all();
        $roles = Role::all();
        return view('dashboard.admin.users.edit', compact('user', 'departments', 'roles'));
    }

    public function update(UserUpdate $request, $id)
    {
        $this->userRepository->updateUser($id, $request->validated());
        return redirect()->route('users.index')->with('success', 'User has been updated successfully');
    }  

    public function destroy($id)
    {
        $this->userRepository->deleteUser($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function restore($id)
    {
        $this->userRepository->restoreUser($id);
        return redirect()->route('users.index')->with('success', 'User restored successfully');
    }

    public function forceDelete($id)
    {
        $this->userRepository->forceDeleteUser($id);
        return redirect()->route('users.index')->with('success', 'User permanently deleted successfully');
    }


    public function clientsList()
    {
        $clients = $this->userRepository->getClients();
        $statuses = ['Pending', 'Active', 'Banned'];
        return view('dashboard.admin.users.clients', compact('clients', 'statuses'));
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

        $query->whereHas('roles', function ($q) {
            $q->where('name', 'client'); 
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


