<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Traits\HandlesImageUploads;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDivisionController extends Controller
{
    use HandlesImageUploads;

    public function index(): View
    {
        $divisions = Division::orderBy('order', 'asc')->paginate(10);

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create(): View
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama divisi wajib diisi.',
        ]);

        $validated['slug'] = Division::generateUniqueSlug($validated['name']);
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $request->input('order', 0) ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'divisions');
        }

        Division::create($validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Divisi baru berhasil ditambahkan.');
    }

    public function edit(Division $division): View
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'icon' => ['nullable', 'string', 'max:100'],
            'order' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:2048'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        if ($validated['name'] !== $division->name) {
            $validated['slug'] = Division::generateUniqueSlug($validated['name'], $division->id);
        }

        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['order'] = $request->input('order', 0) ?? 0;

        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'divisions', $division->image);
        }

        $division->update($validated);

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Data divisi berhasil diperbarui.');
    }

    public function destroy(Division $division): RedirectResponse
    {
        if ($division->image) {
            $this->deleteImage($division->image);
        }

        $division->delete();

        return redirect()->route('admin.divisions.index')
            ->with('success', 'Divisi berhasil dihapus.');
    }
}
