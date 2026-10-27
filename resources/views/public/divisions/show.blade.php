@extends('layouts.public')

@section('title', $division->name)
@section('meta_description', $division->short_description ?? 'Detail divisi ' . $division->name)

@section('content')
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-3">
                <a href="{{ route('public.divisions.index') }}" class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-400 hover:underline">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span>Kembali ke Semua Divisi</span>
                </a>
                <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">{{ $division->name }}</h1>
                <p class="text-slate-300 text-sm max-w-2xl">
                    {{ $division->short_description }}
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 bg-white p-8 sm:p-12 rounded-2xl border border-slate-200 shadow-sm space-y-6">
                <h2 class="text-xl font-bold text-[#0F2537]">Tentang & Ruang Lingkup Divisi</h2>
                <div class="prose max-w-none text-slate-700 text-sm sm:text-base leading-relaxed">
                    {!! nl2br(e($division->description ?? $division->short_description)) !!}
                </div>

                <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-xs text-slate-500">
                        Tertarik dengan riset divisi ini? Hubungi pengurus kami untuk jadwal onboarding.
                    </div>
                    <a href="{{ route('public.contact') }}" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold text-xs uppercase tracking-wider transition-all">
                        Tanya Divisi
                    </a>
                </div>
            </div>

            <!-- Other Divisions Sidebar -->
            <div class="lg:col-span-4 space-y-6">
                <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-[#0F2537]">Divisi Riset Lainnya</h3>
                    <div class="space-y-2">
                        @foreach($otherDivisions as $other)
                            <a href="{{ route('public.divisions.show', $other->slug) }}" class="block p-3 rounded-xl bg-slate-50 hover:bg-[#FAF6ED] border border-slate-200/60 hover:border-amber-300 transition-all text-xs font-semibold text-slate-800">
                                {{ $other->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
