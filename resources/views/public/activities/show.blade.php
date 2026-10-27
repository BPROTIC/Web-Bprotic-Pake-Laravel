@extends('layouts.public')

@section('title', $activity->title)
@section('meta_description', $activity->excerpt ?? Str::limit(strip_tags($activity->description), 150))

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 relative z-10">
            <a href="{{ route('public.activities.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-400 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <span>Kembali ke Semua Kegiatan</span>
            </a>
            <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight max-w-4xl">{{ $activity->title }}</h1>
            
            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-300 pt-2">
                @if($activity->event_date)
                    <div class="flex items-center gap-1.5 bg-[#13334C] px-3 py-1.5 rounded-lg border border-slate-700">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $activity->event_date->translatedFormat('l, d F Y') }}</span>
                    </div>
                @endif
                @if($activity->location)
                    <div class="flex items-center gap-1.5 bg-[#13334C] px-3 py-1.5 rounded-lg border border-slate-700">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>{{ $activity->location }}</span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <article class="lg:col-span-8 bg-white p-6 sm:p-10 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
                @if($activity->image)
                    <div class="rounded-xl overflow-hidden aspect-video bg-slate-900 border border-slate-200">
                        <img src="{{ asset('storage/' . $activity->image) }}" alt="{{ $activity->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                @if($activity->excerpt)
                    <div class="bg-amber-50/70 border-l-4 border-amber-500 p-4 rounded-r-xl text-slate-800 text-sm italic font-medium leading-relaxed">
                        {{ $activity->excerpt }}
                    </div>
                @endif

                <div class="prose max-w-none text-slate-800 text-sm sm:text-base leading-relaxed space-y-4">
                    {!! nl2br(e($activity->description)) !!}
                </div>
            </article>

            <!-- Sidebar Related Activities -->
            <aside class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-[#0F2537]">Kegiatan Lainnya</h3>
                    <div class="space-y-4">
                        @forelse($relatedActivities as $rel)
                            <a href="{{ route('public.activities.show', $rel->slug) }}" class="block group">
                                <span class="text-[11px] text-amber-700 font-semibold">
                                    {{ optional($rel->event_date)->translatedFormat('d M Y') }}
                                </span>
                                <h4 class="text-xs font-bold text-[#0F2537] group-hover:text-amber-600 transition-colors line-clamp-2 mt-0.5">
                                    {{ $rel->title }}
                                </h4>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada kegiatan lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
