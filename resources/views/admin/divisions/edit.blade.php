@extends('layouts.admin')

@section('title', 'Edit Divisi')
@section('page_title', 'Edit Divisi')
@section('breadcrumb')
    <a href="{{ route('admin.divisions.index') }}" class="hover:underline">Manajemen Divisi</a> &rarr; <span>Edit</span>
@endsection

@section('content')
<div class="max-w-3xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Edit Divisi: {{ $division->name }}</h2>
            <p class="text-xs text-slate-500">Perbarui nama, urutan, atau kurikulum divisi</p>
        </div>
        <a href="{{ route('admin.divisions.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.divisions.update', $division->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div class="sm:col-span-2">
                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Divisi *</label>
                <input type="text" id="name" name="name" value="{{ old('name', $division->name) }}" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                @error('name') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="order" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Urutan</label>
                <input type="number" id="order" name="order" value="{{ old('order', $division->order) }}"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>
        </div>

        <div>
            <label for="short_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ringkasan Singkat</label>
            <textarea id="short_description" name="short_description" rows="2"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('short_description', $division->short_description) }}</textarea>
        </div>

        <div>
            <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Lengkap & Kurikulum</label>
            <textarea id="description" name="description" rows="6"
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('description', $division->description) }}</textarea>
        </div>

        <div>
            <label for="image" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ikon / Gambar Divisi</label>
            @if($division->image)
                <div class="mb-3 w-32 h-20 rounded-lg overflow-hidden border border-slate-200">
                    <img src="{{ asset('storage/' . $division->image) }}" alt="" class="w-full h-full object-cover">
                </div>
            @endif
            <input type="file" id="image" name="image" accept="image/*"
                class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-[#0F2537] file:text-white hover:file:bg-[#13334C]">
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $division->is_active) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                <span class="text-xs font-semibold text-slate-700">Status Aktif (tampilkan di website publik)</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.divisions.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Perbarui Divisi</button>
        </div>
    </form>
</div>
@endsection
