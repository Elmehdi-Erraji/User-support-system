<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::all();
        return view('dashboard.admin.faq.index',compact('faqs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.admin.faq.create',compact('categories'));
    }

    public function store (Request $request)
    {
        $faq = Faq::create($request->all());
        return redirect()->route('Faq.index')->with('success','Faq created successfully');
    }

    public function edit($id)
    {
        $faq = Faq::find($id);
        $categories = Category::all();
        return view('dashboard.admin.faq.edit',compact('faq','categories'));
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);
        $faq->update($request->all());
        return redirect()->route('Faq.index')->with('success','Faq updated successfully');
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);
        $faq->delete();
        return redirect()->route('Faq.index')->with('success','Faq deleted successfully');
    }
}
