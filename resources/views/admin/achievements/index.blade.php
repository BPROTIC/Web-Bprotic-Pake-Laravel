@extends('layouts.admin')

@section('title', 'Manajemen Prestasi')
@section('page_title', 'Manajemen Prestasi')
@section('breadcrumb', 'Daftar pencapaian dan kejuaraan anggota BPROTIC')

@section('content')
<div class="space-y-6">
    <!-- Action & Filter Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <form action="{{ route('admin.achievements.index') }}" method="GET" class="flex items-center gap-2 w-full md:w-auto">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari prestasi / nama mahasiswa..."
                class="px-3.5 py-2 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none w-full sm:w-64">
            <button type="submit" class="px-4 py-2 rounded-xl bg-[#0F2537] text-white text-xs font-semibold hover:bg-[#13334C] transition-colors cursor-pointer">
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.achievements.index') }}" class="px-3 py-2 rounded-xl border border-slate-300 text-xs text-slate-600 hover:bg-slate-50">Reset</a>
            @endif
        </form>

        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-sm cursor-pointer shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Prestasi</span>
        </button>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Nama Prestasi</th>
                        <th class="py-3.5 px-4">Tingkat / Kategori</th>
                        <th class="py-3.5 px-4">Penerima / Tim</th>
                        <th class="py-3.5 px-4">Tahun / Tanggal</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($achievements as $ach)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 text-center font-medium text-slate-400">
                                {{ $loop->iteration + ($achievements->currentPage() - 1) * $achievements->perPage() }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                <div class="flex items-center gap-2">
                                    @if($ach->image)
                                        <div class="w-8 h-8 rounded-lg overflow-hidden shrink-0 border border-slate-200 bg-slate-100">
                                            @if(file_exists(public_path($ach->image)))
                                                <img src="{{ asset($ach->image) }}" alt="" class="w-full h-full object-cover">
                                            @else
                                                <img src="{{ asset('storage/' . $ach->image) }}" alt="" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                    @endif
                                    <span>{{ $ach->title }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-amber-700">
                                <span class="px-2 py-0.5 rounded bg-amber-50 border border-amber-200 text-[10px]">
                                    {{ $ach->category ?? 'Nasional' }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                {{ $ach->recipient ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-500">
                                {{ optional($ach->event_date)->translatedFormat('d M Y') ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($ach->is_published)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Publik</span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">Draf</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button type="button" 
                                    onclick='openEditModal(@json($ach), "{{ $ach->image ? (file_exists(public_path($ach->image)) ? asset($ach->image) : asset("storage/" . $ach->image)) : "" }}")'
                                    title="Edit Prestasi" 
                                    class="inline-block p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('admin.achievements.destroy', $ach->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus prestasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-xs text-slate-400 italic">Belum ada data prestasi.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($achievements->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $achievements->links() }}</div>
        @endif
    </div>
</div>

<!-- ================= CREATE ACHIEVEMENT MODAL ================= -->
<div id="createAchievementModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Tambah Prestasi Baru</h3>
                    <p class="text-[11px] text-slate-300">Catat juara kompetisi atau penghargaan anggota</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
            @csrf

            <div>
                <label for="create_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Prestasi / Juara *</label>
                <input type="text" id="create_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Contoh: Juara 1 Hackathon IoT Jawa Barat 2026">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="create_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tingkat / Kategori</label>
                    <input type="text" id="create_category" name="category" value="Nasional"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="Nasional / Regional / Kampus">
                </div>

                <div>
                    <label for="create_event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal / Tahun Diraih</label>
                    <input type="date" id="create_event_date" name="event_date"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <div>
                <label for="create_recipient" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Mahasiswa / Tim</label>
                <input type="text" id="create_recipient" name="recipient"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Contoh: Tim BPRO-Cyber (Farras dkk)">
            </div>

            <div>
                <label for="create_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Piagam / Dokumentasi</label>
                <input type="file" id="create_image" name="image" accept="image/*"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
            </div>

            <div>
                <label for="create_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi / Detail Karya</label>
                <textarea id="create_description" name="description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Jelaskan kompetisi dan karya inovasi yang diajukan..."></textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" checked
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Tampilkan di halaman publik</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Simpan Prestasi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT ACHIEVEMENT MODAL ================= -->
<div id="editAchievementModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-xl w-full max-h-[90vh] flex flex-col overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between shrink-0">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Edit Data Prestasi</h3>
                    <p class="text-[11px] text-slate-300" id="edit_modal_subtitle">Perbarui informasi penghargaan</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form id="editAchievementForm" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 overflow-y-auto flex-1">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Prestasi / Juara *</label>
                <input type="text" id="edit_title" name="title" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="edit_category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tingkat / Kategori</label>
                    <input type="text" id="edit_category" name="category"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <div>
                    <label for="edit_event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal / Tahun Diraih</label>
                    <input type="date" id="edit_event_date" name="event_date"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <div>
                <label for="edit_recipient" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Mahasiswa / Tim</label>
                <input type="text" id="edit_recipient" name="recipient"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <!-- Current Image Preview & Replacement -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Piagam Saat Ini</label>
                <div id="edit_image_preview_box" class="mb-2 hidden">
                    <div class="w-36 h-24 rounded-xl overflow-hidden border border-slate-200 shadow-xs bg-slate-100">
                        <img id="edit_image_preview" src="" alt="Preview" class="w-full h-full object-cover">
                    </div>
                </div>
                <label for="edit_image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Ganti Foto (Opsional)</label>
                <input type="file" id="edit_image" name="image" accept="image/*"
                    class="w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-3.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
                <span class="text-[10px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengubah file foto.</span>
            </div>

            <div>
                <label for="edit_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi / Detail Karya</label>
                <textarea id="edit_description" name="description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"></textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" id="edit_is_published" name="is_published" value="1"
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Tampilkan di halaman publik</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5 shrink-0">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Perbarui Prestasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const createModal = document.getElementById('createAchievementModal');
    const editModal = document.getElementById('editAchievementModal');
    const editForm = document.getElementById('editAchievementForm');

    function openCreateModal() {
        createModal.classList.remove('hidden');
        document.getElementById('create_title').focus();
    }

    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    function openEditModal(ach, imageUrl) {
        editForm.action = `/admin/prestasi/${ach.id}`;
        document.getElementById('edit_modal_subtitle').textContent = `Prestasi: ${ach.title}`;
        document.getElementById('edit_title').value = ach.title || '';
        document.getElementById('edit_category').value = ach.category || '';
        document.getElementById('edit_recipient').value = ach.recipient || '';
        
        let dateVal = '';
        if (ach.event_date) {
            dateVal = ach.event_date.substring(0, 10);
        }
        document.getElementById('edit_event_date').value = dateVal;
        document.getElementById('edit_description').value = ach.description || '';
        document.getElementById('edit_is_published').checked = !!ach.is_published;
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
