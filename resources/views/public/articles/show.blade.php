@extends('layouts.public')

@section('title', $article->title)
@section('meta_description', $article->excerpt ?? Str::limit(strip_tags($article->content), 150))

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-4 relative z-10">
            <a href="{{ route('public.articles.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-400 hover:underline">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                <span>Kembali ke Semua Artikel</span>
            </a>
            <div class="inline-block px-3 py-1 rounded bg-[#13334C] text-amber-400 text-xs font-bold uppercase tracking-wider border border-amber-400/30">
                {{ $article->category }}
            </div>
            <h1 class="text-2xl sm:text-4xl font-extrabold tracking-tight leading-tight max-w-4xl">{{ $article->title }}</h1>
            
            <div class="flex flex-wrap items-center gap-4 text-xs text-slate-300 pt-2">
                <span>Ditulis oleh: <strong class="text-white">{{ optional($article->author)->name ?? 'Admin BPROTIC' }}</strong></span>
                <span>•</span>
                <span>Dipublikasikan: <strong class="text-white">{{ optional($article->published_at)->translatedFormat('d F Y') ?? $article->created_at->translatedFormat('d F Y') }}</strong></span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <article class="lg:col-span-8 bg-white p-6 sm:p-10 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
                @if($article->image)
                    <div class="rounded-xl overflow-hidden aspect-video bg-slate-900 border border-slate-200">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    </div>
                @endif

                @if($article->excerpt)
                    <div class="bg-amber-50/70 border-l-4 border-amber-500 p-4 rounded-r-xl text-slate-800 text-sm italic font-medium leading-relaxed">
                        {{ $article->excerpt }}
                    </div>
                @endif

                <div class="prose max-w-none text-slate-800 text-sm sm:text-base leading-relaxed space-y-4">
                    {!! nl2br(e($article->content)) !!}
                </div>
            </article>

            <!-- Sidebar Related Articles -->
            <aside class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-[#0F2537]">Artikel Terkait</h3>
                    <div class="space-y-4">
                        @forelse($relatedArticles as $rel)
                            <a href="{{ route('public.articles.show', $rel->slug) }}" class="block group">
                                <span class="text-[10px] font-bold uppercase text-amber-600">
                                    {{ $rel->category }}
                                </span>
                                <h4 class="text-xs font-bold text-[#0F2537] group-hover:text-amber-600 transition-colors line-clamp-2 mt-0.5">
                                    {{ $rel->title }}
                                </h4>
                            </a>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada artikel lainnya.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection
