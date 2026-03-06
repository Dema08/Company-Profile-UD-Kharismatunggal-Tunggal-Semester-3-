<?php

namespace App\Services;

use App\Models\FAQ;

class FAQService
{
    public function getAllFAQs()
    {
        return FAQ::all();
    }

    public function searchpertanyaan($request){
        return FAQ::where('pertanyaan', 'like', '%' . $request->search . '%')->orWhere('jawaban', 'like', '%' . $request->search . '%')->get();
    }

    public function createFAQ($data)
    {
        return FAQ::create($data);
    }

    public function getFAQById($id)
    {
        return FAQ::findOrFail($id);
    }

    public function updateFAQ($id, $data)
    {
        $faq = FAQ::findOrFail($id);
        $faq->update($data);
        return $faq;
    }

    public function deleteFAQ($id)
    {
        $faq = FAQ::findOrFail($id);
        return $faq->delete();
    }
}
