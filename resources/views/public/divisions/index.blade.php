@extends('layouts.public')

@section('title', 'Divisi & Peminatan')
@section('meta_description', 'Daftar divisi riset dan kelompok peminatan teknologi di UKM BPROTIC UBP Karawang.')

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Peminatan Riset</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Divisi UKM BPROTIC</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Pilih fokus minat teknologi Anda dan kembangkan potensi bersama rekan-rekan mahasiswa.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse($divisions as $div)
                <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="w-12 h-12 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                            </div>
                            <span class="text-xs font-semibold px-2.5 py-1 rounded bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Aktif
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors">
                            {{ $div->name }}
                        </h2>
                        <p class="text-slate-600 text-sm leading-relaxed">
                            {{ $div->description ?? $div->short_description }}
                        </p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 mt-6">
                        <a href="{{ route('public.divisions.show', $div->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:underline">
                            <span>Pelajari Kurikulum & Kegiatan Divisi</span>
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-sm text-slate-500 italic col-span-2 text-center py-12">Belum ada divisi yang dipublikasikan.</p>
            @endforelse
        </div>
    </div>
@endsection
