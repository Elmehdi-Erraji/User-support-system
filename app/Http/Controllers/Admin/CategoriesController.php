<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('department_id')->paginate(8);
        $departments = Department::all();
        return view('dashboard.admin.category.index',compact('categories','departments'));
    }

    public function create()
    { 
        $departments = Department::orderBy('name')->get();
        return view('dashboard.admin.category.create',compact('departments'));
    }

    public function store(request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'department_id' => ['required','integer',Rule::exists('departments', 'id'),],
        ]);
        
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success','Department created successfully');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $departments = Department::all();
        return view('dashboard.admin.category.edit',compact('category','departments'));
    }

    public function update(Request $request,$id)
    {
        $category = Category::findOrFail($request->id);
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success','Category updated successfully');
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    } 

    public function Search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $departmentId = $request->input('department');

        $query = Category::query();

        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('name', 'like', '%' . $searchQuery . '%');
            });
        }

       
        if (!empty($departmentId) && $departmentId !== 'null') {
            $query->where('department_id', $departmentId);
        }

        $categories = $query->get();

        $transformedCategories = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
                'department' => $category->department->name,
                'ticketsCount' => $category->tickets->count(),
                'faqsCount' => $category->faqs->count()
            ];
        });
        return response()->json($transformedCategories);
    }

    
    
}
