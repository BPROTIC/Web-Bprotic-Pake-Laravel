<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\RedirectResponse;

class PublicDivisionController extends Controller
{
    public function index(): RedirectResponse
    {
        return redirect()->route('public.departments.index');
    }

    public function show(string $slug): RedirectResponse
    {
        return redirect()->route('public.departments.show', $slug);
    }
}
