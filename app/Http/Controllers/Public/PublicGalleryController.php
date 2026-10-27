<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicGalleryController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->query('category');

        $galleries = Gallery::published()
            ->when($category, fn ($q) => $q->where('category', $category))
            ->paginate(12)
            ->withQueryString();

        $categories = Gallery::published()->reorder()->whereNotNull('category')->distinct()->pluck('category')->filter();

        return view('public.galleries.index', compact('galleries', 'categories', 'category'));
    }
}
