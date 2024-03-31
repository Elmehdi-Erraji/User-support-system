<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('status','2')->paginate(9);
        $categories = Category::all();
        $statuses = ['Pending', 'Active','Inactive'];
        return view('dashboard.faqAll',compact('faqs','categories','statuses'));
    }


    public function Search(Request $request)
    {
        $searchQuery = $request->input('search_query');
        $category = $request->input('category');
    
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
    
        $query->where('status', 2); // Filter by status 2
    
        $faqs = $query->get();
    
        $transformedFaqs = $faqs->map(function ($faq) {
            $faq['id'] = $faq->id;
            $faq['question'] = $faq->question;
            $faq['answer'] = $faq->answer;
            return $faq;
        });
    
        return response()->json($transformedFaqs);
    }
    
}
