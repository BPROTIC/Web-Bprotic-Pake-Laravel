@extends('layouts.admin')

@section('title', 'Upload Foto Galeri')
@section('page_title', 'Upload Foto Galeri')
@section('breadcrumb')
    <a href="{{ route('admin.galleries.index') }}" class="hover:underline">Manajemen Galeri</a> &rarr; <span>Upload Foto</span>
@endsection

@section('content')
<div class="max-w-2xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Upload Foto Kegiatan</h2>
            <p class="text-xs text-slate-500">Tambahkan dokumentasi visual ke arsip BPROTIC</p>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul / Keterangan Foto *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Contoh: Sesi Hands-on Perakitan IoT">
            @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori *</label>
                <input type="text" id="category" name="category" list="cat-list" value="{{ old('category', 'Kegiatan') }}" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                <datalist id="cat-list">
                    <option value="Kegiatan"></option>
                    <option value="Workshop"></option>
                    <option value="Kompetisi"></option>
                    <option value="Organisasi"></option>
                    <option value="Riset"></option>
                </datalist>
            </div>

            <div>
                <label for="event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Acara</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date') }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>
        </div>

        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">File Foto *</label>
            <input type="file" id="image" name="image" accept="image/*" required
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C]">
            <span class="text-[11px] text-slate-400 mt-1 block">Format: JPG, PNG, WEBP. Maksimal 2MB.</span>
            @error('image') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap (Opsional)</label>
            <textarea id="description" name="description" rows="3"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Cerita singkat mengenai foto ini...">{{ old('description') }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.galleries.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Upload</button>
        </div>
    </form>
</div>
@endsection
