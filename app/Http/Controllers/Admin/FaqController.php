<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\CssSelector\Node\FunctionNode;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::paginate(9);
        $categories = Category::all();
        $statuses = ['Pending', 'Active','Inactive'];
        return view('dashboard.admin.faq.index',compact('faqs','categories','statuses'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
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




    public function Search(Request $request)
    {
      

        $searchQuery = $request->input('search_query');
        $category = $request->input('category');
        $status = $request->input('status');

        $query = Faq::query();


        if (!empty($searchQuery)) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('question', 'like', '%' . $searchQuery . '%')
                    ->orWhere('answer', 'like', '%' . $searchQuery . '%');
            });
        }
    
       
        if (!empty($category) && $category !== 'null') {
            $query->where('category_id', $category);
        }

        if (!empty($status) && $status !== 'null') {
            $query->where('status', $status);
        }



        $faqs = $query->get();

        $transformedFaqs = $faqs->map(function ($faq) {
            $faq['id'] = $faq->id;
            $faq['question'] = $faq->question;
            $faq['answered'] = $faq->answer;
            $faq['category'] = $faq->category;
            $faq['creator'] = $faq->user;
            $faq['status'] = $faq->status;
            return $faq;
        });

        return response()->json($transformedFaqs);
    }
}
