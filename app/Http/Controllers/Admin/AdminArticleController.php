<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminArticleController extends Controller
{
    use HandlesImageUploads;

    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $status = $request->query('status');

        $articles = Article::query()
            ->with('author')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%");
            })
            ->when($category, fn ($q) => $q->where('category', $category))
            ->when($status !== null && $status !== '', function ($query) use ($status) {
                $query->where('is_published', $status === 'published');
            })
            ->latest('published_at')
            ->latest()
            ->paginate(50)
            ->withQueryString();

        $categories = Article::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.articles.index', compact('articles', 'categories', 'search', 'category', 'status'));
    }

    public function create(): View
    {
        $categories = Article::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.articles.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'category.required' => 'Kategori artikel wajib diisi.',
            'content.required' => 'Isi artikel tidak boleh kosong.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        $validated['slug'] = Article::generateUniqueSlug($validated['title']);
        $validated['author_id'] = Auth::id();
        $validated['is_published'] = $request->boolean('is_published', true);
        $validated['published_at'] = $validated['is_published'] ? now() : null;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'articles');
        }

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diterbitkan.');
    }

    public function edit(Article $article): View
    {
        $categories = Article::reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('admin.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'is_published' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul artikel wajib diisi.',
            'category.required' => 'Kategori artikel wajib diisi.',
            'content.required' => 'Isi artikel tidak boleh kosong.',
        ]);

        if ($validated['title'] !== $article->title) {
            $validated['slug'] = Article::generateUniqueSlug($validated['title'], $article->id);
        }

        $wasPublished = $article->is_published;
        $isPublished = $request->boolean('is_published', true);
        $validated['is_published'] = $isPublished;

        if ($isPublished && !$wasPublished) {
            $validated['published_at'] = now();
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'articles', $article->image);
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->image) {
            $this->deleteImage($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}
