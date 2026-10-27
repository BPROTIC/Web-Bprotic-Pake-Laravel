@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page_title', 'Edit Kegiatan')
@section('breadcrumb')
    <a href="{{ route('admin.activities.index') }}" class="hover:underline">Manajemen Kegiatan</a> &rarr; <span>Edit</span>
@endsection

@section('content')
<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Edit Data Kegiatan: {{ $activity->title }}</h2>
            <p class="text-xs text-slate-500">Perbarui rincian kegiatan atau status publikasi</p>
        </div>
        <a href="{{ route('admin.activities.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">
            &larr; Kembali
        </a>
    </div>

    <form action="{{ route('admin.activities.update', $activity->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Judul -->
        <div>
            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Kegiatan *</label>
            <input type="text" id="title" name="title" value="{{ old('title', $activity->title) }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <!-- Tanggal Kegiatan -->
            <div>
                <label for="event_date" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tanggal Pelaksanaan</label>
                <input type="date" id="event_date" name="event_date" value="{{ old('event_date', optional($activity->event_date)->format('Y-m-d')) }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                @error('event_date') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Lokasi Kegiatan -->
            <div>
                <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Lokasi / Tempat Pelaksanaan</label>
                <input type="text" id="location" name="location" value="{{ old('location', $activity->location) }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                @error('location') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Banner / Gambar Saat Ini & Upload Baru -->
        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Gambar / Poster Kegiatan</label>
            @if($activity->image)
                <div class="mb-3 w-40 h-24 rounded-lg overflow-hidden border border-slate-200">
                    <img src="{{ asset('storage/' . $activity->image) }}" alt="Preview" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C] cursor-pointer">
            <span class="text-[11px] text-slate-400 mt-1 block">Biarkan kosong jika tidak ingin mengubah gambar poster.</span>
            @error('image') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Ringkasan Singkat -->
        <div>
            <label for="excerpt" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ringkasan Singkat (Excerpt)</label>
            <textarea id="excerpt" name="excerpt" rows="2"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('excerpt', $activity->excerpt) }}</textarea>
            @error('excerpt') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Deskripsi Lengkap -->
        <div>
            <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap *</label>
            <textarea id="description" name="description" rows="8" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('description', $activity->description) }}</textarea>
            @error('description') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Status Publikasi -->
        <div class="pt-2">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $activity->is_published) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                <span class="text-xs font-semibold text-slate-700">Publikasikan kegiatan (tampilkan kepada pengunjung website)</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.activities.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">
                Perbarui Kegiatan
            </button>
        </div>
    </form>
</div>
@endsection
