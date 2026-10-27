@extends('layouts.public')

@section('title', 'Artikel & Publikasi')
@section('meta_description', 'Kumpulan artikel teknologi, sains komputer, tutorial pemrograman, dan inovasi riset UKM BPROTIC.')

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Wawasan & Edukasi</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Artikel & Tulisan BPROTIC</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Eksplorasi wawasan teknologi terkini, tutorial komputasi, dan dokumentasi riset mahasiswa.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-8">
        <!-- Search and Category Filters -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
            <form action="{{ route('public.articles.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul atau topik artikel..."
                        class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm focus:outline-none focus:ring-2 focus:ring-[#0F2537]">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider transition-all">
                    Cari Artikel
                </button>
            </form>

            <!-- Category Pills -->
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-slate-100">
                <span class="text-xs font-bold text-slate-500 mr-1">Kategori:</span>
                <a href="{{ route('public.articles.index', array_filter(['search' => $search])) }}"
                    class="px-3 py-1 rounded-lg text-xs font-semibold transition-all {{ empty($category) ? 'bg-[#0F2537] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('public.articles.index', array_filter(['category' => $cat, 'search' => $search])) }}"
                        class="px-3 py-1 rounded-lg text-xs font-semibold transition-all {{ $category === $cat ? 'bg-[#0F2537] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                        {{ $cat }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Grid Articles -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @forelse($articles as $article)
                <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition-all flex flex-col justify-between group">
                    <div>
                        <div class="aspect-video bg-gradient-to-br from-[#0F2537] to-[#13334C] relative overflow-hidden flex items-center justify-center text-white">
                            @if($article->image)
                                <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-white p-2 shadow-md border border-amber-300 flex items-center justify-center">
                                    <img src="{{ asset('asetss/logo bprotic.png') }}" alt="{{ $article->title }}" class="w-full h-full object-contain">
                                </div>
                            @endif
                            <div class="absolute top-3 left-3 bg-[#0F2537] text-amber-400 text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-md border border-amber-400/30">
                                {{ $article->category }}
                            </div>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="text-[11px] text-slate-500">
                                {{ optional($article->published_at)->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}
                            </div>
                            <h2 class="text-base font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors line-clamp-2">
                                <a href="{{ route('public.articles.show', $article->slug) }}">{{ $article->title }}</a>
                            </h2>
                            <p class="text-slate-600 text-xs leading-relaxed line-clamp-3">
                                {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 140) }}
                            </p>
                        </div>
                    </div>
                    <div class="px-6 pb-6 pt-2">
                        <a href="{{ route('public.articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:underline">
                            <span>Baca Artikel Lengkap</span>
                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200">
                    <p class="text-slate-500 text-sm italic">Belum ada artikel pada kategori ini.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $articles->links() }}
        </div>
    </div>
@endsection
