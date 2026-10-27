<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Activity;
use App\Models\Article;
use App\Models\ContactMessage;
use App\Models\Department;
use App\Models\Division;
use App\Models\Gallery;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total_activities' => Activity::count(),
            'total_articles' => Article::count(),
            'total_achievements' => Achievement::count(),
            'total_galleries' => Gallery::count(),
            'total_departments' => Department::count(),
            'total_divisions' => Department::count(),
            'unread_messages' => ContactMessage::unread()->count(),
            'total_users' => User::count(),
        ];

        $recentMessages = ContactMessage::latest()->take(5)->get();
        $upcomingActivities = Activity::where('event_date', '>=', now()->toDateString())
            ->orderBy('event_date', 'asc')
            ->take(5)
            ->get();
        $recentArticles = Article::with('author')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentMessages', 'upcomingActivities', 'recentArticles'));
    }
}
