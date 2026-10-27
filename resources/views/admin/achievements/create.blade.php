@extends('layouts.admin')

@section('title', 'Tambah Prestasi')
@section('page_title', 'Tambah Prestasi Baru')
@section('breadcrumb')
    <a href="{{ route('admin.achievements.index') }}" class="hover:underline">Manajemen Prestasi</a> &rarr; <span>Tambah Baru</span>
@endsection

@section('content')
<div class="max-w-3xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Formulir Catatan Prestasi</h2>
            <p class="text-xs text-slate-500">Catat juara kompetisi atau penghargaan anggota BPROTIC</p>
        </div>
        <a href="{{ route('admin.achievements.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.achievements.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Prestasi / Juara *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Contoh: Juara 1 Hackathon IoT Jawa Barat 2026">
            @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tingkat / Kategori</label>
                <input type="text" id="category" name="category" value="{{ old('category', 'Nasional') }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Nasional / Regional / Kampus">
            </div>

            <div>
                <label for="event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal / Tahun Diraih</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>
        </div>

        <div>
            <label for="recipient" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Mahasiswa / Nama Tim</label>
            <input type="text" id="recipient" name="recipient" value="{{ old('recipient') }}"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Contoh: Tim BPRO-Cyber (Farras dkk)">
        </div>

        <div>
            <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi / Keterangan Karya</label>
            <textarea id="description" name="description" rows="4"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Jelaskan kompetisi dan karya inovasi yang diajukan...">{{ old('description') }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Dokumentasi / Piagam</label>
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C]">
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                <span class="text-xs font-semibold text-slate-700">Tampilkan di halaman publik</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.achievements.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Simpan</button>
        </div>
    </form>
</div>
@endsection
