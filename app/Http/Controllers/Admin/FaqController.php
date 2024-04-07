<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Repositories\Contracts\FaqInterface;
use Illuminate\Http\Request;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\CssSelector\Node\FunctionNode;

class FaqController extends Controller
{
    protected $faqRepo;

    public function __construct(FaqInterface $faqRepo)
    {
        $this->faqRepo = $faqRepo;
    }

    public function index()
    {
        $faqs = $this->faqRepo->paginate(9);
        $categories = Category::all();
        $statuses = ['Pending', 'Published','Inactive'];
        return view('dashboard.admin.faq.index',compact('faqs','categories','statuses'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('dashboard.admin.faq.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $this->faqRepo->create($request->all());
        return redirect()->route('Faq.index')->with('success','Faq created successfully');
    }

    public function edit($id)
    {
        $faq = $this->faqRepo->findById($id);
        $categories = Category::all();
        return view('dashboard.admin.faq.edit',compact('faq','categories'));
    }

    public function update(Request $request, $id)
    {

        $this->faqRepo->update($id, $request->all());
        return redirect()->route('Faq.index')->with('success','Faq updated successfully');
    }

    public function destroy($id)
    {
        $this->faqRepo->delete($id);
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
