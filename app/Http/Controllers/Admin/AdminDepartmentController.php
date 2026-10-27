<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDepartmentController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $departments = Department::with(['fields' => fn ($q) => $q->orderBy('order', 'asc')])
            ->withCount('fields')
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.departments.index', compact('departments'));
    }

    public function create(): View
    {
        return view('admin.departments.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'learning_focus' => ['nullable', 'string'],
            'technologies' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama departemen wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        $validated['slug'] = Department::generateUniqueSlug($validated['name']);
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'departments');
        }

        Department::create($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Departemen baru berhasil ditambahkan.');
    }

    public function edit(Department $department): View
    {
        $department->load(['fields' => fn ($q) => $q->orderBy('order', 'asc')]);

        return view('admin.departments.edit', compact('department'));
    }

    public function update(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'learning_focus' => ['nullable', 'string'],
            'technologies' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:50'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama departemen wajib diisi.',
            'image.image' => 'File harus berupa gambar.',
        ]);

        if ($validated['name'] !== $department->name) {
            $validated['slug'] = Department::generateUniqueSlug($validated['name'], $department->id);
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'departments', $department->image);
        }

        $department->update($validated);

        return redirect()->route('admin.departments.index')
            ->with('success', 'Departemen berhasil diperbarui.');
    }

    public function destroy(Department $department): RedirectResponse
    {
        if ($department->image) {
            $this->deleteImage($department->image);
        }

        $department->delete();

        return redirect()->route('admin.departments.index')
            ->with('success', 'Departemen berhasil dihapus.');
    }
}
