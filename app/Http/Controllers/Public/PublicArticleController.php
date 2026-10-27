<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicArticleController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');
        $category = $request->query('category');

        $articles = Article::published()
            ->with('author')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%");
                });
            })
            ->when($category, fn ($q) => $q->where('category', $category))
            ->paginate(9)
            ->withQueryString();

        $categories = Article::published()->reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('public.articles.index', compact('articles', 'categories', 'search', 'category'));
    }

    public function show(string $slug): View
    {
        $article = Article::published()->with('author')->where('slug', $slug)->firstOrFail();
        $relatedArticles = Article::published()->where('id', '!=', $article->id)->take(3)->get();

        return view('public.articles.show', compact('article', 'relatedArticles'));
    }
}
