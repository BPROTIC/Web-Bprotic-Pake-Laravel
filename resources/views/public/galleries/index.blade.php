@extends('layouts.public')

@section('title', 'Galeri Dokumentasi')
@section('meta_description', 'Dokumentasi foto kegiatan riset, workshop, kompetisi, dan kebersamaan UKM BPROTIC UBP Karawang.')

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Arsip Visual</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Galeri Dokumentasi</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Momen dan jejak rekam kebersamaan serta riset teknologi di UKM BPROTIC.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <!-- Category Filter Pills -->
        @if($categories->count() > 0)
            <div class="flex flex-wrap items-center justify-center gap-2">
                <a href="{{ route('public.galleries.index') }}"
                    class="px-4 py-1.5 rounded-full text-xs font-bold transition-all {{ empty($category) ? 'bg-[#0F2537] text-amber-300' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                    Semua Foto
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.galleries.index', ['category' => $cat]) }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-all {{ $category === $cat ? 'bg-[#0F2537] text-amber-300' : 'bg-white text-slate-700 hover:bg-slate-100 border border-slate-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        @endif

        <!-- Grid Galleries -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($galleries as $gal)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all group">
                    <div class="aspect-video bg-slate-900 relative overflow-hidden flex items-center justify-center">
                        @if($gal->image)
                            @if(file_exists(public_path($gal->image)))
                                <img src="{{ asset($gal->image) }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <img src="{{ asset('storage/' . $gal->image) }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @endif
                        @else
                            <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-md border border-amber-300 flex items-center justify-center">
                                <img src="{{ asset('asetss/logo bprotic.png') }}" alt="{{ $gal->title }}" class="w-full h-full object-contain">
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 bg-[#0F2537]/80 backdrop-blur-sm text-amber-300 text-[10px] font-bold px-2 py-0.5 rounded">
                            {{ $gal->category }}
                        </span>
                    </div>
                    <div class="p-5 space-y-1">
                        @if($gal->event_date)
                            <div class="text-[10px] text-slate-400">
                                {{ $gal->event_date->translatedFormat('d F Y') }}
                            </div>
                        @endif
                        <h2 class="text-sm font-bold text-[#0F2537]">{{ $gal->title }}</h2>
                        @if($gal->description)
                            <p class="text-xs text-slate-600 line-clamp-2">{{ $gal->description }}</p>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm italic">Belum ada foto yang dipublikasikan.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $galleries->links() }}
        </div>
    </div>
@endsection
