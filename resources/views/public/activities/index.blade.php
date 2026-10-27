@extends('layouts.public')

@section('title', 'Agenda & Kegiatan')
@section('meta_description', 'Daftar workshop, seminar, tech camp, dan kompetisi UKM BPROTIC Universitas Buana Perjuangan Karawang.')

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Jadwal & Agenda</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Kegiatan BPROTIC</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Temukan berbagai workshop, bootcamp, sertifikasi, dan kompetisi sains teknologi.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm">
            <form action="{{ route('public.activities.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari kegiatan, topik, atau lokasi..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2537]">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider transition-all">
                    Cari Kegiatan
                </button>
                @if($search)
                    <a href="{{ route('public.activities.index') }}" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-600 hover:bg-slate-50 text-xs font-semibold text-center flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Grid Activities -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($activities as $activity)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="aspect-video bg-gradient-to-br from-[#0F2537] to-[#13334C] relative overflow-hidden flex items-center justify-center text-white">
                            @if($activity->image)
                                <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-md border border-amber-300 flex items-center justify-center">
                                    <img src="{{ asset('asetss/logo bprotic.png') }}" alt="{{ $activity->title }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                            @if($activity->event_date)
                                <div class="absolute top-3 left-3 bg-amber-500 text-slate-950 text-[11px] font-bold px-2.5 py-1 rounded-md shadow">
                                    {{ $activity->event_date->translatedFormat('d M Y') }}
                                </div>
                            @endif
                        </div>
                        <div class="p-6 space-y-3">
                            @if($activity->location)
                                <div class="flex items-center gap-1.5 text-xs text-slate-500">
                                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    <span>{{ $activity->location }}</span>
                                </div>
                            @endif
                            <h2 class="text-base font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors line-clamp-2">
                                <a href="{{ route('public.activities.show', $activity->slug) }}">{{ $activity->title }}</a>
                            </h2>
                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-3">
                                {{ $activity->excerpt ?? Str::limit(strip_tags($activity->description), 140) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('public.activities.show', $activity->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:underline">
                            <span>Lihat Detail Kegiatan</span>
                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm italic">Tidak ada kegiatan yang ditemukan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div>
            {{ $activities->links() }}
        </div>
    </div>
@endsection
