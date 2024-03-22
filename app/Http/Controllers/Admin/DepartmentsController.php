<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStore;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('dashboard.admin.department.index',compact('departments'));
    }

    public function create()
    {
        return view('dashboard.admin.department.create');
    }

    public function store(DepartmentStore $request)
    {
        Department::create($request->all());
        return redirect()->route('department.index')->with('success','Department created successfully');
    }

    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return view('dashboard.admin.department.edit',compact('department'));
    }

    public function update(DepartmentStore $request,$id)
    {
        $department = Department::findOrFail($request->id);
        $department->update($request->all());
        return redirect()->route('department.index')->with('success','Department updated successfully');
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('department.index')->with('success','Department deleted successfully');
    }
       
    
}
