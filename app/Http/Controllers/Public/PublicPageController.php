<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use App\Models\Page;
use Illuminate\View\View;

class PublicPageController extends Controller
{
    public function about(): View
    {
        $page = Page::published()->where('slug', 'tentang-kami')->first();
        $departments = Department::active()->with('activeFields')->get();
        $divisions = $departments;

        return view('public.about', compact('page', 'departments', 'divisions'));
    }

    public function show(string $slug): View
    {
        $page = Page::published()->where('slug', $slug)->firstOrFail();

        return view('public.pages.show', compact('page'));
    }
}
