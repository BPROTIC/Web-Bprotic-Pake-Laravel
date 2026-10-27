@extends('layouts.admin')

@section('title', 'Manajemen Halaman')
@section('page_title', 'Manajemen Halaman')
@section('breadcrumb', 'Kelola halaman statis dan informasi khusus')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-[#0F2537]">Daftar Halaman Khusus</h2>
            <p class="text-xs text-slate-500">Halaman statis seperti Tentang Kami, Kebijakan, atau Sejarah</p>
        </div>

        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-sm cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Buat Halaman Baru</span>
        </button>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Judul Halaman</th>
                        <th class="py-3.5 px-4">Slug URL</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages as $page)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 text-center font-medium text-slate-400">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div class="flex items-center gap-2">
                                    @if($page->image)
                                        <div class="w-8 h-8 rounded-lg overflow-hidden shrink-0 border border-slate-200 bg-slate-100">
                                            @if(file_exists(public_path($page->image)))
                                                <img src="{{ asset($page->image) }}" alt="" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('storage/' . $page->image) }}" alt="" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    @endif
                                    <span>{{ $page->title }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-mono text-[11px] text-slate-500">
                                /halaman/{{ $page->slug }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($page->is_published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Publikasi
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <a href="{{ route('public.pages.show', $page->slug) }}" target="_blank" title="Lihat di Web" class="inline-block p-1.5 text-slate-400 hover:text-slate-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <button type="button" 
                                    onclick='openEditModal(@json($page), "{{ $page->image ? (file_exists(public_path($page->image)) ? asset($page->image) : asset("storage/" . $page->image)) : "" }}")'
                                    title="Edit Halaman" 
                                    class="inline-block p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                @if($page->slug !== 'tentang-kami')
                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus halaman ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-xs text-slate-400 italic">Belum ada halaman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pages->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $pages->links() }}</div>
        @endif
    </div>
</div>

<!-- ================= CREATE PAGE MODAL ================= -->
<div id="createPageModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Buat Halaman Khusus Baru</h3>
                    <p class="text-[11px] text-slate-300">Tambahkan halaman statis publik dengan konten terstruktur</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
            @csrf

            <div>
                <label for="create_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Halaman *</label>
                <input type="text" id="create_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Contoh: Kebijakan Privasi & Etika Riset">
            </div>

            <div>
                <label for="create_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Gambar Header (Opsional)</label>
                <input type="file" id="create_image" name="image" accept="image/*"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
            </div>

            <div>
                <label for="create_content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konten Halaman *</label>
                <textarea id="create_content" name="content" rows="8" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Tuliskan teks isi halaman..."></textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" checked
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Publikasikan halaman</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Simpan Halaman
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT PAGE MODAL ================= -->
<div id="editPageModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Edit Data Halaman</h3>
                    <p class="text-[11px] text-slate-300" id="edit_modal_subtitle">Perbarui isi halaman</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form id="editPageForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Halaman *</label>
                <input type="text" id="edit_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <!-- Current Image Preview & Replacement -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Header Saat Ini</label>
                <div id="edit_image_preview_box" class="mb-2 hidden">
                    <div class="w-40 h-20 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-100">
                        <img id="edit_image_preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
                <label for="edit_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Header (Opsional)</label>
                <input type="file" id="edit_image" name="image" accept="image/*"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
            </div>

            <div>
                <label for="edit_content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konten Halaman *</label>
                <textarea id="edit_content" name="content" rows="8" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"></textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" id="edit_is_published" name="is_published" value="1"
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Publikasikan halaman</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Perbarui Halaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const createModal = document.getElementById('createPageModal');
    const editModal = document.getElementById('editPageModal');
    const editForm = document.getElementById('editPageForm');

    function openCreateModal() {
        createModal.classList.remove('hidden');
        document.getElementById('create_title').focus();
    }

    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    function openEditModal(page, imageUrl) {
        editForm.action = `/admin/halaman/${page.id}`;
        document.getElementById('edit_modal_subtitle').textContent = `Halaman: ${page.title}`;
        document.getElementById('edit_title').value = page.title || '';
        document.getElementById('edit_content').value = page.content || '';
        document.getElementById('edit_is_published').checked = !!page.is_published;
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
        document.getElementById('edit_title').focus();
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
    }

    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
        }
    });

    createModal.addEventListener('click', (e) => {
        if (e.target === createModal) closeCreateModal();
    });

    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) closeEditModal();
    });
</script>
@endpush
