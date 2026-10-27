@extends('layouts.public')

@section('title', 'Prestasi Mahasiswa')
@section('meta_description', 'Rekam jejak kejuaraan dan pencapaian mahasiswa UKM BPROTIC Universitas Buana Perjuangan Karawang.')

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Hall of Fame</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Prestasi & Penghargaan</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Bukti nyata dedikasi dan kerja keras talenta muda BPROTIC dalam kompetisi teknologi.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($achievements as $ach)
                <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between space-y-4">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-[11px] font-bold uppercase px-2.5 py-1 rounded bg-amber-400/15 text-amber-800 border border-amber-300">
                                {{ $ach->category ?? 'Kompetisi' }}
                            </span>
                            @if($ach->event_date)
                                <span class="text-xs text-slate-500 font-medium">
                                    {{ $ach->event_date->translatedFormat('Y') }}
                                </span>
                            @endif
                        </div>
                        <h2 class="text-base font-bold text-[#0F2537]">{{ $ach->title }}</h2>
                        <div class="text-xs text-amber-700 font-semibold flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>{{ $ach->recipient }}</span>
                        </div>
                        @if($ach->description)
                            <p class="text-slate-600 text-xs leading-relaxed">
                                {{ $ach->description }}
                            </p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm italic">Belum ada data prestasi yang dicatat.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $achievements->links() }}
        </div>
    </div>
@endsection
