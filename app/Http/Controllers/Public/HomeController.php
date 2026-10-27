<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Article;
use App\Models\Department;
use App\Models\Division;
use App\Models\Gallery;
use App\Models\Setting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $activities = Activity::published()->take(3)->get();
        $articles = Article::published()->take(3)->get();
        $departments = Department::active()->with('activeFields')->get();
        $divisions = $departments; // backward compatibility
        $achievements = Achievement::published()->take(3)->get();
        $galleries = Gallery::published()->take(6)->get();

        return view('public.home', compact(
            'activities',
            'articles',
            'departments',
            'divisions',
            'achievements',
            'galleries'
        ));
    }
}
