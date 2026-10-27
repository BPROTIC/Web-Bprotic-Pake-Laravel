@extends('layouts.admin')

@section('title', 'Buat Halaman')
@section('page_title', 'Buat Halaman Baru')
@section('breadcrumb')
    <a href="{{ route('admin.pages.index') }}" class="hover:underline">Manajemen Halaman</a> &rarr; <span>Buat Baru</span>
@endsection

@section('content')
<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Formulir Halaman Khusus</h2>
            <p class="text-xs text-slate-500">Buat halaman informasi dengan konten terstruktur</p>
        </div>
        <a href="{{ route('admin.pages.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.pages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Judul Halaman *</label>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Contoh: Kebijakan Privasi & Etika Riset">
            @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Gambar Header (Opsional)</label>
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C]">
        </div>

        <div>
            <label for="content" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Konten Halaman *</label>
            <textarea id="content" name="content" rows="12" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Tuliskan teks isi halaman...">{{ old('content') }}</textarea>
            @error('content') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', true) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                <span class="text-xs font-semibold text-slate-700">Publikasikan halaman</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.pages.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Simpan Halaman</button>
        </div>
    </form>
</div>
@endsection
