<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicActivityController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->query('search');

        $activities = Activity::published()
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('excerpt', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%");
                });
            })
            ->paginate(9)
            ->withQueryString();

        return view('public.activities.index', compact('activities', 'search'));
    }

    public function show(string $slug): View
    {
        $activity = Activity::published()->where('slug', $slug)->firstOrFail();
        $relatedActivities = Activity::published()->where('id', '!=', $activity->id)->take(3)->get();

        return view('public.activities.show', compact('activity', 'relatedActivities'));
    }
}
