<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\DepartmentField;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AdminDepartmentFieldController extends Controller
{
    /**
     * Store a new field of expertise for a specific department
     */
    public function store(Request $request, Department $department): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama bidang keahlian wajib diisi.',
        ]);

        $validated['department_id'] = $department->id;
        $validated['slug'] = DepartmentField::generateUniqueSlug($validated['name'], $department->id);
        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        DepartmentField::create($validated);

        return redirect()->route('admin.departments.edit', $department)
            ->with('success', "Bidang keahlian '{$validated['name']}' berhasil ditambahkan ke {$department->name}.");
    }

    /**
     * Update an existing field of expertise
     */
    public function update(Request $request, DepartmentField $field): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'icon' => ['nullable', 'string', 'max:50'],
            'order' => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'name.required' => 'Nama bidang keahlian wajib diisi.',
        ]);

        if ($validated['name'] !== $field->name) {
            $validated['slug'] = DepartmentField::generateUniqueSlug($validated['name'], $field->department_id, $field->id);
        }

        $validated['order'] = $validated['order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        $field->update($validated);

        return redirect()->route('admin.departments.edit', $field->department_id)
            ->with('success', "Bidang keahlian '{$field->name}' berhasil diperbarui.");
    }

    /**
     * Delete a field of expertise
     */
    public function destroy(DepartmentField $field): RedirectResponse
    {
        $departmentId = $field->department_id;
        $name = $field->name;

        $field->delete();

        return redirect()->route('admin.departments.edit', $departmentId)
            ->with('success', "Bidang keahlian '{$name}' berhasil dihapus.");
    }
}
