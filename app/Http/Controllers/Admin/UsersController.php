<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Role;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function create()
    {
        $departments = Department::all();
        $roles = Role::all();

        return view('dashboard.admin.users.create', compact('departments', 'roles'));
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
