<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentStore;
use App\Models\Department;
use App\Repositories\Contracts\DepartmentsInterface;
use Illuminate\Http\Request;

class DepartmentsController extends Controller
{
    protected $departmentRepo;

    public function __construct(DepartmentsInterface $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    public function index()
    {
        $departments = $this->departmentRepo->allWithPaginate(8);
        return view('dashboard.admin.department.index', compact('departments'));
    }

    public function create()
    {
        return view('dashboard.admin.department.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $this->departmentRepo->create($request->all());
        return redirect()->route('department.index')->with('success', 'Department created successfully');
    }

    public function edit($id)
    {
        $department = $this->departmentRepo->findById($id);
        return view('dashboard.admin.department.edit', compact('department'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        $this->departmentRepo->update($id, $request->all());
        return redirect()->route('department.index')->with('success', 'Department updated successfully');
    }

    public function restore($id)
    {
        $department = $this->departmentRepo->findTrashedById($id);

        if ($department->trashed()) {
            $this->departmentRepo->restore($id);
            return redirect()->route('department.index')->with('success', 'Department restored successfully');
        } else {
            return redirect()->route('department.index')->with('error', 'Department is not soft deleted');
        }
    }

    public function destroy($id)
    {
        $department = $this->departmentRepo->findById($id);
        if (!$department)
        {
            return redirect()->back()->with('error', 'Department not found');
        }

        $openTicketsCount = 0;

        foreach ($department->categories as $category)
        {
            $openTicketsCount += $category->tickets()->count();
        }

        if ($openTicketsCount > 0)
        {
            return redirect()->route('department.index')->with('error', 'Department has open tickets');
        }
        $this->departmentRepo->delete($id);

        return redirect()->route('department.index')->with('success', 'Department deleted successfully');
    }


    public function forceDelete($id)
    {
        $department = $this->departmentRepo->findTrashedById($id);

        if ($department->trashed()) {
            $this->departmentRepo->forceDelete($id);
            return redirect()->route('department.index')->with('success', 'Department permanently deleted');
        } else {
            return redirect()->route('department.index')->with('error', 'Department is not soft deleted');
        }
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');

        $departments = $this->departmentRepo->searchDepartments($searchQuery);

        $transformedDepartments = $departments->map(function ($department) {
            return [
                'id' => $department->id,
                'name' => $department->name,
                'agentsCount' => $department->agents->count(),
                'categoriesCount' => $department->categories->count(),
            ];
        });

        return response()->json($transformedDepartments);
    }
}
