@extends('layouts.public')

@section('title', $page->title)

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">{{ $page->title }}</h1>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <article class="bg-white p-8 sm:p-12 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
            @if($page->image)
                <div class="rounded-xl overflow-hidden aspect-video bg-slate-900 border border-slate-200">
                    <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->title }}" class="w-full h-full object-cover">
                </div>
            @endif

            <div class="prose max-w-none text-slate-800 text-sm sm:text-base leading-relaxed space-y-4">
                {!! nl2br(e($page->content)) !!}
            </div>
        </article>
    </div>
@endsection
