@extends('layouts.admin')

@section('title', 'Manajemen Departemen')
@section('page_title', 'Manajemen Departemen')

@section('breadcrumbs')
    <span class="text-slate-400">/</span>
    <span class="text-slate-800 font-medium">Departemen</span>
@endsection

@section('header_actions')
    <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2 bg-[#0F2537] hover:bg-[#13334C] text-white rounded-xl text-xs font-bold transition-all shadow-sm cursor-pointer">
        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        <span>Tambah Departemen</span>
    </button>
@endsection

@section('content')
    <!-- Info Banner Organisasi -->
    <div class="mb-6 bg-gradient-to-r from-amber-50 to-[#FAF6ED] p-4 rounded-2xl border border-amber-200/80 flex items-start gap-3">
        <div class="w-8 h-8 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center shrink-0 mt-0.5 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="text-xs text-slate-700">
            <p class="font-bold text-[#0F2537]">Struktur Departemen & Bidang Keahlian BPROTIC</p>
            <p class="mt-0.5 text-slate-600">
                Departemen utama UKM BPROTIC memayungi bidang-bidang riset dan peminatan. Anda dapat mengedit informasi departemen atau mengelola bidang keahlian langsung melalui popup modal tanpa berpindah halaman.
            </p>
        </div>
    </div>

    <!-- Table of Departments -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left border-collapse text-xs">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-500 font-bold uppercase tracking-wider">
                        <th class="py-3.5 px-4 w-12 text-center">Urutan</th>
                        <th class="py-3.5 px-4">Nama Departemen & Slug</th>
                        <th class="py-3.5 px-4">Bidang Keahlian</th>
                        <th class="py-3.5 px-4">Deskripsi / Fokus</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($departments as $dept)
                        <tr class="hover:bg-slate-50/70 transition-colors">
                            <td class="py-4 px-4 text-center font-bold text-slate-700">
                                <span class="w-7 h-7 rounded-lg bg-[#0F2537] text-amber-400 inline-flex items-center justify-center text-xs">
                                    {{ $dept->order }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#FAF6ED] border border-amber-200 text-amber-700 flex items-center justify-center font-bold shrink-0">
                                        @if($dept->slug === 'software-development')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                        @elseif($dept->slug === 'iot')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#0F2537] text-sm">{{ $dept->name }}</p>
                                        <span class="text-[11px] text-slate-400 font-mono">{{ $dept->slug }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center gap-2">
                                    <span class="px-2.5 py-1 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[10px]">
                                        {{ $dept->fields_count }} Bidang
                                    </span>
                                    <button type="button" 
                                        onclick='openFieldsModal(@json($dept))'
                                        class="inline-flex items-center gap-1 text-[11px] font-bold text-amber-800 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 px-2.5 py-1 rounded-lg border border-amber-200 transition-colors cursor-pointer">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                                        <span>Kelola Bidang</span>
                                    </button>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-[11px] text-slate-600 line-clamp-2 max-w-xs leading-relaxed">
                                    {{ $dept->short_description ?? Str::limit($dept->description, 90) }}
                                </p>
                            </td>
                            <td class="py-4 px-4 text-center">
                                @if($dept->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('public.departments.show', $dept->slug) }}" target="_blank" class="p-1.5 text-slate-400 hover:text-slate-700 hover:bg-slate-100 rounded-lg transition-colors" title="Lihat di Web">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                                    </a>
                                    <button type="button" 
                                        onclick='openEditModal(@json($dept), "{{ $dept->image ? asset("storage/" . $dept->image) : "" }}")'
                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-[#FAF6ED] hover:bg-amber-100 text-[#0F2537] border border-amber-300 font-bold rounded-lg transition-colors text-xs cursor-pointer" 
                                        title="Edit Departemen">
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                        <span>Edit</span>
                                    </button>
                                    <form action="{{ route('admin.departments.destroy', $dept->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus departemen {{ $dept->name }} beserta seluruh bidang keahlian di dalamnya?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Departemen">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-500 italic">
                                Belum ada departemen yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ================= CREATE DEPARTMENT MODAL ================= -->
    <div id="createDepartmentModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Tambah Departemen Baru</h3>
                        <p class="text-[11px] text-slate-300">Lengkapi data departemen riset resmi BPROTIC</p>
                    </div>
                </div>
                <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form action="{{ route('admin.departments.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label for="create_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Departemen *</label>
                        <input type="text" id="create_name" name="name" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                            placeholder="Contoh: Artificial Intelligence & Robotics">
                    </div>
                    <div>
                        <label for="create_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Urutan Tampil</label>
                        <input type="number" id="create_order" name="order" value="1" min="0"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="create_short_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                    <input type="text" id="create_short_description" name="short_description"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="Ringkasan 1 kalimat yang muncul pada kartu header...">
                </div>

                <div>
                    <label for="create_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap</label>
                    <textarea id="create_description" name="description" rows="3"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="Penjelasan mendalam mengenai departemen..."></textarea>
                </div>

                <div>
                    <label for="create_learning_focus" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Fokus Pembelajaran (1 poin per baris)</label>
                    <textarea id="create_learning_focus" name="learning_focus" rows="3"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs font-mono focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="Tuliskan tiap poin kurikulum pada baris baru..."></textarea>
                </div>

                <div>
                    <label for="create_technologies" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Teknologi & Tools (Pisahkan dengan koma)</label>
                    <input type="text" id="create_technologies" name="technologies"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="PHP, Laravel, MySQL, Git, Postman">
                </div>

                <div>
                    <label for="create_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Banner Departemen</label>
                    <input type="file" id="create_image" name="image" accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked
                            class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                        <span class="text-xs font-semibold text-slate-700">Departemen Aktif</span>
                    </label>
                </div>

                <!-- Modal Footer -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0">
                    <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Simpan Departemen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= EDIT DEPARTMENT MODAL ================= -->
    <div id="editDepartmentModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Edit Data Departemen</h3>
                        <p class="text-[11px] text-slate-300" id="edit_modal_subtitle">Perbarui data departemen</p>
                    </div>
                </div>
                <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="editDepartmentForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="sm:col-span-2">
                        <label for="edit_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Departemen *</label>
                        <input type="text" id="edit_name" name="name" required
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    </div>
                    <div>
                        <label for="edit_order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Urutan Tampil</label>
                        <input type="number" id="edit_order" name="order" min="0"
                            class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    </div>
                </div>

                <div>
                    <label for="edit_short_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                    <input type="text" id="edit_short_description" name="short_description"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <div>
                    <label for="edit_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap</label>
                    <textarea id="edit_description" name="description" rows="3"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"></textarea>
                </div>

                <div>
                    <label for="edit_learning_focus" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Fokus Pembelajaran (1 poin per baris)</label>
                    <textarea id="edit_learning_focus" name="learning_focus" rows="3"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs font-mono focus:ring-2 focus:ring-[#0F2537] focus:outline-none"></textarea>
                </div>

                <div>
                    <label for="edit_technologies" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Teknologi & Tools</label>
                    <input type="text" id="edit_technologies" name="technologies"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <!-- Current Image Preview & Replacement -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Banner Saat Ini</label>
                    <div id="edit_image_preview_box" class="mb-2 hidden">
                        <div class="w-40 h-20 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-100">
                            <img id="edit_image_preview" src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <label for="edit_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Banner (Opsional)</label>
                    <input type="file" id="edit_image" name="image" accept="image/*"
                        class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
                </div>

                <div class="pt-2">
                    <label class="flex items-center gap-2.5 cursor-pointer">
                        <input type="checkbox" id="edit_is_active" name="is_active" value="1"
                            class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                        <span class="text-xs font-semibold text-slate-700">Departemen Aktif</span>
                    </label>
                </div>

                <!-- Modal Footer -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                        Perbarui Departemen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ================= MANAGE FIELDS MODAL ================= -->
    <div id="manageFieldsModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
            <!-- Modal Header -->
            <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-white">Kelola Bidang Keahlian</h3>
                        <p class="text-[11px] text-slate-300" id="fields_modal_dept_name">Departemen</p>
                    </div>
                </div>
                <button type="button" onclick="closeFieldsModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="p-6 space-y-6 overflow-y-auto flex-1">
                <!-- List of existing fields -->
                <div>
                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2">Bidang Keahlian Aktif:</h4>
                    <div id="fields_list_container" class="space-y-2">
                        <!-- Populated by JS -->
                    </div>
                </div>

                <!-- Add new field form -->
                <div class="pt-4 border-t border-slate-200">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-[#0F2537] mb-3 flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah Bidang Keahlian Baru</span>
                    </h4>
                    <form id="createFieldForm" method="POST" class="space-y-3 bg-[#FAF6ED] p-4 rounded-xl border border-amber-200">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="sm:col-span-2">
                                <label for="field_name" class="block text-[11px] font-bold text-slate-700 mb-1">Nama Bidang *</label>
                                <input type="text" id="field_name" name="name" required placeholder="Contoh: Web Development"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs bg-white focus:outline-none focus:ring-1 focus:ring-[#0F2537]">
                            </div>
                            <div>
                                <label for="field_order" class="block text-[11px] font-bold text-slate-700 mb-1">Urutan</label>
                                <input type="number" id="field_order" name="order" value="1" min="0"
                                    class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs bg-white focus:outline-none focus:ring-1 focus:ring-[#0F2537]">
                            </div>
                        </div>

                        <div>
                            <label for="field_description" class="block text-[11px] font-bold text-slate-700 mb-1">Deskripsi Singkat</label>
                            <textarea id="field_description" name="description" rows="2" placeholder="Fokus pembelajaran dan silabus bidang ini..."
                                class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs bg-white focus:outline-none focus:ring-1 focus:ring-[#0F2537]"></textarea>
                        </div>

                        <div class="flex items-center justify-between pt-1">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" checked
                                    class="w-3.5 h-3.5 rounded border-slate-300 text-[#0F2537]">
                                <span class="text-xs font-semibold text-slate-700">Aktif</span>
                            </label>
                            <button type="submit" class="px-4 py-2 rounded-lg bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-colors">
                                + Tambahkan Bidang
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Modal Footer -->
            <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-end shrink-0">
                <button type="button" onclick="closeFieldsModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-100 transition-colors">
                    Tutup
                </button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    const createModal = document.getElementById('createDepartmentModal');
    const editModal = document.getElementById('editDepartmentModal');
    const editForm = document.getElementById('editDepartmentForm');
    const fieldsModal = document.getElementById('manageFieldsModal');
    const createFieldForm = document.getElementById('createFieldForm');

    function openCreateModal() {
        createModal.classList.remove('hidden');
        document.getElementById('create_name').focus();
    }

    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    function openEditModal(dept, imageUrl) {
        editForm.action = `/admin/departemen/${dept.id}`;
        document.getElementById('edit_modal_subtitle').textContent = `Departemen: ${dept.name}`;
        document.getElementById('edit_name').value = dept.name || '';
        document.getElementById('edit_order').value = dept.order || 0;
        document.getElementById('edit_short_description').value = dept.short_description || '';
        document.getElementById('edit_description').value = dept.description || '';
        document.getElementById('edit_learning_focus').value = dept.learning_focus || '';
        document.getElementById('edit_technologies').value = dept.technologies || '';
        document.getElementById('edit_is_active').checked = !!dept.is_active;
        document.getElementById('edit_image').value = '';

        const previewBox = document.getElementById('edit_image_preview_box');
        const previewImg = document.getElementById('edit_image_preview');
        if (imageUrl) {
            previewImg.src = imageUrl;
            previewBox.classList.remove('hidden');
        } else {
            previewBox.classList.add('hidden');
        }

        editModal.classList.remove('hidden');
        document.getElementById('edit_name').focus();
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
    }

    function openFieldsModal(dept) {
        document.getElementById('fields_modal_dept_name').textContent = `Departemen: ${dept.name}`;
        createFieldForm.action = `/admin/departemen/${dept.id}/bidang`;

        const container = document.getElementById('fields_list_container');
        container.innerHTML = '';

        if (!dept.fields || dept.fields.length === 0) {
            container.innerHTML = '<p class="text-xs text-slate-400 italic p-3 rounded-lg bg-slate-50 border border-slate-200">Belum ada bidang keahlian di departemen ini.</p>';
        } else {
            dept.fields.forEach(f => {
                const item = document.createElement('div');
                item.className = 'p-3.5 rounded-xl bg-white border border-slate-200 shadow-xs flex items-center justify-between gap-3';
                item.innerHTML = `
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full ${f.is_active ? 'bg-emerald-500' : 'bg-slate-300'}"></span>
                            <span class="text-xs font-bold text-slate-900">${f.name}</span>
                            <span class="text-[10px] text-slate-400 font-mono">urutan: ${f.order}</span>
                        </div>
                        <p class="text-[11px] text-slate-500 mt-1 line-clamp-2">${f.description || 'Tidak ada deskripsi.'}</p>
                    </div>
                    <form action="/admin/departemen/bidang/${f.id}" method="POST" class="shrink-0" onsubmit="return confirmDelete('Hapus bidang ${f.name}?')">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer" title="Hapus Bidang">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </form>
                `;
                container.appendChild(item);
            });
        }

        fieldsModal.classList.remove('hidden');
    }

    function closeFieldsModal() {
        fieldsModal.classList.add('hidden');
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
            closeFieldsModal();
        }
    });

    createModal.addEventListener('click', (e) => {
        if (e.target === createModal) closeCreateModal();
    });

    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) closeEditModal();
    });

    fieldsModal.addEventListener('click', (e) => {
        if (e.target === fieldsModal) closeFieldsModal();
    });
</script>
@endpush
