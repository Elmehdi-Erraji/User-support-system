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
        $categories = Category::orderBy('department_id')->get();
       
        return view('dashboard.admin.category.index',compact('categories'));
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
}
