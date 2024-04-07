<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use App\Repositories\Contracts\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    protected $categoryRepo;

    public function __construct(CategoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function index()
    {
        $categories = $this->categoryRepo->allWithPaginate(8);
        $departments = $this->categoryRepo->getAllDepartments();
        return view('dashboard.admin.category.index', compact('categories', 'departments'));
    }

    public function create()
    { 
        $departments = $this->categoryRepo->getAllDepartments();
        return view('dashboard.admin.category.create', compact('departments'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'department_id' => ['required', 'integer', Rule::exists('departments', 'id')],
        ]);
        
        $this->categoryRepo->create($request->all());
        return redirect()->route('categories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = $this->categoryRepo->findById($id);
        $departments = $this->categoryRepo->getAllDepartments();
        return view('dashboard.admin.category.edit', compact('category', 'departments'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryRepo->update($id, $request->all());
        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $this->categoryRepo->delete($id);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    } 

    public function search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $departmentId = $request->input('department');

        $categories = $this->categoryRepo->searchCategories($searchQuery, $departmentId);

        $transformedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'department' => optional($category->department)->name, // Using optional() to avoid potential null object errors
                'ticketsCount' => $category->tickets->count(),
                'faqsCount' => $category->faqs->count(),
            ];
        });

        return response()->json($transformedCategories);
    }
}


