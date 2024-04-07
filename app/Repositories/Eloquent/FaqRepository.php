<?php

namespace App\Repositories\Eloquent;

use App\Models\Faq;
use App\Repositories\Contracts\FaqInterface;

class FaqRepository implements FaqInterface
{
    public function all()
    {
        return Faq::all();
    }

    public function paginate($perPage)
    {
        return Faq::paginate($perPage);
    }

    public function findById($id)
    {
        return Faq::findOrFail($id);
    }

    public function create(array $data)
    {
        return Faq::create($data);
    }

    public function update($id, array $data)
    {
        $faq = Faq::findOrFail($id);
        $faq->update($data);
        return $faq;
    }

    public function delete($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
    }

    public function searchFaqs($searchQuery, $category, $status)
    {
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

        return $query->get();
    }
}
