<?php

namespace App\Http\Controllers;

use App\Services\FAQService;
use App\Http\Requests\StoreFAQ;
use App\Http\Requests\UpdateFAQ;

class FAQController extends Controller
{
    protected $faqService;

    public function __construct(FAQService $faqService)
    {
        $this->faqService = $faqService;
    }

    public function index()
    {
        $title = 'Hapus Data FAQ';
        $text = "Apakah anda yakin ingin menghapus data ini?";
        confirmDelete($title, $text);
        $faqs = $this->faqService->getAllFAQs();
        return view('admin.faq.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faq.create');
    }

    public function store(StoreFAQ $request)
    {
        $data = $request->validated();
        $this->faqService->createFAQ($data);
        toast('FAQ berhasil ditambahkan','success');
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $faq = $this->faqService->getFAQById($id);
        return view('admin.faq.edit', compact('faq'));
    }

    public function update(UpdateFAQ $request, $id)
    {
        $data = $request->validated();
        $this->faqService->updateFAQ($id, $data);
        toast('FAQ berhasil diperbarui','success');
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->faqService->deleteFAQ($id);
        toast('FAQ berhasil dihapus','success');
        return redirect()->route('faq.index')->with('success', 'FAQ berhasil dihapus.');
    }
}
