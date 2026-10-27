<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Department;
use Illuminate\View\View;

class PublicDepartmentController extends Controller
{
    /**
     * Display list of 3 main departments and their fields of expertise
     */
    public function index(): View
    {
        $departments = Department::active()->with('activeFields')->get();

        return view('public.departments.index', compact('departments'));
    }

    /**
     * Display detailed page for a specific department
     */
    public function show(string $slug): View
    {
        $department = Department::active()
            ->with('activeFields')
            ->where('slug', $slug)
            ->firstOrFail();

        $otherDepartments = Department::active()
            ->with('activeFields')
            ->where('id', '!=', $department->id)
            ->get();

        $latestActivities = Activity::published()->take(3)->get();

        return view('public.departments.show', compact('department', 'otherDepartments', 'latestActivities'));
    }
}
