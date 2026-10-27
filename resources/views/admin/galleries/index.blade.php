@extends('layouts.admin')

@section('title', 'Manajemen Galeri')
@section('page_title', 'Manajemen Galeri')
@section('breadcrumb', 'Arsip foto dokumentasi kegiatan dan event')

@section('content')
<div class="space-y-6">
    <!-- Action & Filter Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <form action="{{ route('admin.galleries.index') }}" method="GET" class="flex flex-wrap items-center gap-2 w-full md:w-auto">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari foto galeri..."
                class="px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none w-full sm:w-60">
            <select name="category" class="px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ $category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
            <button type="submit" class="px-4 py-2 rounded-xl bg-[#0F2537] text-white text-xs font-semibold hover:bg-[#13334C] transition-colors cursor-pointer">
                Filter
            </button>
            @if($search || $category)
                <a href="{{ route('admin.galleries.index') }}" class="px-3 py-2 rounded-xl border border-slate-300 text-xs text-slate-600 hover:bg-slate-50">Reset</a>
            @endif
        </form>

        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-sm cursor-pointer shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Upload Foto Baru</span>
        </button>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-16 text-center" data-no-sort="true">Foto</th>
                        <th class="py-3.5 px-4">Judul Foto & Keterangan</th>
                        <th class="py-3.5 px-4">Kategori</th>
                        <th class="py-3.5 px-4">Tanggal Kegiatan</th>
                        <th class="py-3.5 px-4 text-right" data-no-sort="true">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($galleries as $gal)
                        @php
                            $imgUrl = $gal->image ? (file_exists(public_path($gal->image)) ? asset($gal->image) : asset('storage/' . $gal->image)) : '';
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4 text-center">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $gal->title }}" class="w-12 h-10 object-cover rounded-lg border border-slate-200 mx-auto shadow-xs">
                                @else
                                    <div class="w-12 h-10 rounded-lg bg-slate-100 border border-slate-200 text-[10px] text-slate-400 flex items-center justify-center mx-auto">No img</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-slate-900 max-w-xs">
                                <div class="font-bold text-slate-900">{{ $gal->title }}</div>
                                <div class="text-[11px] text-slate-400 font-normal truncate">{{ $gal->description ?? 'Tidak ada keterangan.' }}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-amber-50 text-amber-800 border border-amber-200/60">
                                    {{ $gal->category ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">
                                {{ optional($gal->event_date)->translatedFormat('d M Y') ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button type="button" 
                                    onclick='openEditModal(@json($gal), "{{ $imgUrl }}")'
                                    title="Edit Foto" 
                                    class="inline-block p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('admin.galleries.destroy', $gal->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus foto ini dari galeri?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Foto" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 text-center text-xs text-slate-400 italic">Belum ada foto galeri.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<!-- ================= CREATE GALLERY MODAL ================= -->
<div id="createGalleryModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Upload Foto Galeri</h3>
                    <p class="text-[11px] text-slate-300">Tambahkan dokumentasi visual ke arsip BPROTIC</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="create_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul / Keterangan Foto *</label>
                <input type="text" id="create_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Contoh: Sesi Hands-on Perakitan IoT">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="create_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori *</label>
                    <input type="text" id="create_category" name="category" list="cat-list-create" value="Kegiatan" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    <datalist id="cat-list-create">
                        <option value="Kegiatan"></option>
                        <option value="Workshop"></option>
                        <option value="Kompetisi"></option>
                        <option value="Organisasi"></option>
                        <option value="Riset"></option>
                    </datalist>
                </div>

                <div>
                    <label for="create_event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Acara</label>
                    <input type="date" id="create_event_date" name="event_date"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <div>
                <label for="create_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">File Foto *</label>
                <input type="file" id="create_image" name="image" accept="image/*" required
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
                <span class="text-[10px] text-slate-400 mt-1 block">Format: JPG, PNG, WEBP. Maks 2MB.</span>
            </div>

            <div>
                <label for="create_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap (Opsional)</label>
                <textarea id="create_description" name="description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Cerita singkat mengenai foto ini..."></textarea>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Upload Foto
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT GALLERY MODAL ================= -->
<div id="editGalleryModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Edit Data Foto Galeri</h3>
                    <p class="text-[11px] text-slate-300" id="edit_modal_subtitle">Perbarui informasi foto</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form id="editGalleryForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul / Keterangan Foto *</label>
                <input type="text" id="edit_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="edit_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori *</label>
                    <input type="text" id="edit_category" name="category" list="cat-list-edit" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    <datalist id="cat-list-edit">
                        <option value="Kegiatan"></option>
                        <option value="Workshop"></option>
                        <option value="Kompetisi"></option>
                        <option value="Organisasi"></option>
                        <option value="Riset"></option>
                    </datalist>
                </div>

                <div>
                    <label for="edit_event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Acara</label>
                    <input type="date" id="edit_event_date" name="event_date"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <!-- Current Image Preview & Replacement -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Saat Ini</label>
                <div id="edit_image_preview_box" class="mb-2 hidden">
                    <div class="w-36 h-24 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-900">
                        <img id="edit_image_preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
                <label for="edit_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Foto (Opsional)</label>
                <input type="file" id="edit_image" name="image" accept="image/*"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
                <span class="text-[10px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengubah file foto.</span>
            </div>

            <div>
                <label for="edit_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap (Opsional)</label>
                <textarea id="edit_description" name="description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"></textarea>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Perbarui Foto
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const createModal = document.getElementById('createGalleryModal');
    const editModal = document.getElementById('editGalleryModal');
    const editForm = document.getElementById('editGalleryForm');

    function openCreateModal() {
        createModal.classList.remove('hidden');
        document.getElementById('create_title').focus();
    }

    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    function openEditModal(gal, imageUrl) {
        editForm.action = `/admin/galeri/${gal.id}`;
        document.getElementById('edit_modal_subtitle').textContent = `Foto: ${gal.title}`;
        document.getElementById('edit_title').value = gal.title || '';
        document.getElementById('edit_category').value = gal.category || '';
        
        let dateVal = '';
        if (gal.event_date) {
            dateVal = gal.event_date.substring(0, 10);
        }
        document.getElementById('edit_event_date').value = dateVal;
        document.getElementById('edit_description').value = gal.description || '';
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
