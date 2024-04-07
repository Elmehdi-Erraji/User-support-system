<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CategoryInterface;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryInterface
{
    public function allWithPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return Category::orderBy('department_id')->paginate($perPage);
    }

    public function getAllDepartments(): Collection
    {
        return Department::all();
    }

    public function findById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Category::create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        $category = $this->findById($id);
        $category->update($attributes);
        return $category;
    }

    public function delete(int $id)
    {
        $category = $this->findById($id);
        $category->delete();
    }

    public function searchCategories(string $searchQuery = null, $departmentId = null): Collection
    {
        $query = Category::query();

        if ($searchQuery) {
            $query->where('name', 'like', '%' . $searchQuery . '%');
        }

        if ($departmentId) {
            $query->where('department_id', $departmentId);
        }

        return $query->get();
    }
}
