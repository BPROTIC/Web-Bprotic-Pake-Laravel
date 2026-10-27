<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPageController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $pages = Page::latest()->paginate(50);

        return view('admin.pages.index', compact('pages'));
    }

    public function create(): View
    {
        return view('admin.pages.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul halaman wajib diisi.',
            'content.required' => 'Konten halaman tidak boleh kosong.',
        ]);

        $validated['slug'] = Page::generateUniqueSlug($validated['title']);
        $validated['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'pages');
        }

        Page::create($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman baru berhasil dibuat.');
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        if ($validated['title'] !== $page->title) {
            $validated['slug'] = Page::generateUniqueSlug($validated['title'], $page->id);
        }

        $validated['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'pages', $page->image);
        }

        $page->update($validated);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil diperbarui.');
    }

    public function destroy(Page $page): RedirectResponse
    {
        if ($page->slug === 'tentang-kami') {
            return back()->with('error', 'Halaman Tentang Kami adalah halaman inti dan tidak dapat dihapus.');
        }

        if ($page->image) {
            $this->deleteImage($page->image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
