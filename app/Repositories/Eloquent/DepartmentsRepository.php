<?php

namespace App\Repositories\Eloquent;

use App\Models\Department;
use App\Repositories\Contracts\DepartmentsInterface;

class DepartmentsRepository implements DepartmentsInterface
{
    public function allWithPaginate($perPage)
    {
        return Department::withTrashed()->paginate($perPage);
    }

    public function findById($id)
    {
        return Department::findOrFail($id);
    }

    public function findTrashedById($id)
    {
        return Department::withTrashed()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Department::create($data);
    }

    public function update($id, array $data)
    {
        $department = Department::findOrFail($id);
        $department->update($data);
        return $department;
    }

    public function delete($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
    }

    public function restore($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->restore();
    }

    public function forceDelete($id)
    {
        $department = Department::withTrashed()->findOrFail($id);
        $department->forceDelete();
    }

    public function searchDepartments($searchQuery)
    {
        return Department::where('name', 'like', '%' . $searchQuery . '%')->get();
    }
}
