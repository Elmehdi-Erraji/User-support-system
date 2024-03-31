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
        $departments = Department::withTrashed()->paginate(8);
        return view('dashboard.admin.department.index', compact('departments'));
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

    public function restore($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        
        if ($department->trashed()) {
            $department->restore();
            return redirect()->route('department.index')->with('success', 'Department restored successfully');
        } else {
            return redirect()->route('department.index')->with('error', 'Department is not soft deleted');
        }
    }

    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('department.index')->with('success','Department deleted successfully');
    }
    public function forceDelete($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        
        if ($department->trashed()) {
            $department->forceDelete();
            return redirect()->route('department.index')->with('success', 'Department permanently deleted');
        } else {
            return redirect()->route('department.index')->with('error', 'Department is not soft deleted');
        }
    }




    public function Search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $query = Department::query();

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

        $departments = $query->get();

        $transformedDepartments = $departments->map(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'agentsCount' => $department->agents->count(),
                'categoriesCount' => $department->categories->count()
            ];
        });
        return response()->json($transformedDepartments);
    }
    
}
