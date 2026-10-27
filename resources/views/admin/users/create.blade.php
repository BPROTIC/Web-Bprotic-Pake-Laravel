@extends('layouts.admin')

@section('title', 'Tambah Administrator')
@section('page_title', 'Tambah Administrator Baru')
@section('breadcrumb')
    <a href="{{ route('admin.users.index') }}" class="hover:underline">Manajemen Pengguna</a> &rarr; <span>Tambah Baru</span>
@endsection

@section('content')
<div class="max-w-2xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Formulir Akun Administrator</h2>
            <p class="text-xs text-slate-500">Berikan akses pengelolaan dashboard BPROTIC</p>
        </div>
        <a href="{{ route('admin.users.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="Nama Pengurus">
            @error('name') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email Login *</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                placeholder="pengurus@bprotic.id">
            @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi (Min. 8 Karakter) *</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="••••••••">
                @error('password') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Hak Akses (Role) *</label>
                <select id="role" name="role" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin (Penuh)</option>
                    <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staf / Pengurus</option>
                </select>
            </div>
        </div>

        <div class="pt-2">
            <label class="flex items-center gap-2.5 cursor-pointer">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                    class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                <span class="text-xs font-semibold text-slate-700">Akun Aktif (Dapat Login)</span>
            </label>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('admin.users.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50">Batal</a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">Simpan Administrator</button>
        </div>
    </form>
</div>
@endsection
