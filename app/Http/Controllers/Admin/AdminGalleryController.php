<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminGalleryController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $galleries = Gallery::query()
            ->when($search, fn ($q) => $q->where('title', 'like', "%{$search}%"))
            ->when($category, fn ($q) => $q->where('category', $category))
            ->latest('event_date')
            ->latest()
            ->paginate(50)
            ->withQueryString();

        $categories = Gallery::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.galleries.index', compact('galleries', 'categories', 'search', 'category'));
    }

    public function create(): View
    {
        $categories = Gallery::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul galeri wajib diisi.',
            'image.required' => 'Foto dokumentasi wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['image'] = $this->uploadImage($request->file('image'), 'galleries');

        Gallery::create($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil ditambahkan.');
    }

    public function edit(Gallery $gallery): View
    {
        $categories = Gallery::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string'],
            'event_date' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ]);

        $validated['is_published'] = $request->boolean('is_published', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'galleries', $gallery->image);
        }

        $gallery->update($validated);

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Data galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        if ($gallery->image) {
            $this->deleteImage($gallery->image);
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto galeri berhasil dihapus.');
    }
}
