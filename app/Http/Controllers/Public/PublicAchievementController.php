<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicAchievementController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $achievements = Achievement::published()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('recipient', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->paginate(12)
            ->withQueryString();

        return view('public.achievements.index', compact('achievements', 'search'));
    }
}
