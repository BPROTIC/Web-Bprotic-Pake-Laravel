@extends('layouts.admin')

@section('title', 'Edit Foto Galeri')
@section('page_title', 'Edit Foto Galeri')
@section('breadcrumb')
    <a href="{{ route('admin.galleries.index') }}" class="hover:underline">Manajemen Galeri</a> &rarr; <span>Edit</span>
@endsection

@section('content')
<div class="max-w-2xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Edit Data Foto: {{ $gallery->title }}</h2>
            <p class="text-xs text-slate-500">Perbarui judul, kategori, atau ganti foto</p>
        </div>
        <a href="{{ route('admin.galleries.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul / Keterangan Foto *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="category" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kategori *</label>
                <input type="text" id="category" name="category" list="cat-list" value="{{ old('category', $gallery->category) }}" required
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
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date', optional($gallery->event_date)->format('Y-m-d')) }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>
        </div>

        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Saat Ini & Ganti</label>
            @if($gallery->image)
                <div class="mb-3 w-40 h-24 rounded-lg overflow-hidden border border-slate-200">
                    @if(file_exists(public_path($gallery->image)))
                        <img src="{{ asset($gallery->image) }}" alt="" class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="" class="w-full h-full object-cover">
                    @endif
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C]">
            <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengganti foto.</span>
            @error('image') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap (Opsional)</label>
            <textarea id="description" name="description" rows="3"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('description', $gallery->description) }}</textarea>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.galleries.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Perbarui</button>
        </div>
    </form>
</div>
@endsection
