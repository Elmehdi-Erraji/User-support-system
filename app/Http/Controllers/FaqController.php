<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::where('status','1')->paginate(9);
        $categories = Category::all();
        return view('dashboard.faqAll',compact('faqs','categories'));
    }
}
