<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\FAQService;
use App\Http\Requests\StoreFAQ; // Import FormRequest untuk store
use App\Http\Requests\UpdateFAQ; // Import FormRequest untuk update
use Illuminate\Http\Request;

class FAQApiController extends Controller
{
    protected $faqService;

    public function __construct(FAQService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $faqs = $this->faqService->getAllFAQs();
        return response()->json($faqs);
    }

    public function store(StoreFAQ $request) // Menggunakan StoreFAQ untuk validasi
    {
        $data = $request->validated();
        $faq = $this->faqService->createFAQ($data);
        return response()->json($faq, 201);
    }

    public function show($id)
    {
        $faq = $this->faqService->getFAQById($id);
        return response()->json($faq);
    }

    public function update(UpdateFAQ $request, $id) // Menggunakan UpdateFAQ untuk validasi
    {
        $data = $request->validated();
        $faq = $this->faqService->updateFAQ($id, $data);
        return response()->json($faq);
    }

    public function destroy($id)
    {
        $this->faqService->deleteFAQ($id);
        return response()->json(['message' => 'FAQ deleted successfully']);
    }
}
