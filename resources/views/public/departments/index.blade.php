@extends('layouts.public')

@section('title', 'Departemen & Bidang Keahlian - BPROTIC UBP Karawang')
@section('meta_description', 'Struktur 3 Departemen Utama UKM BPROTIC: Software Development, Internet of Things (IoT), dan Data Science beserta bidang keahlian di dalamnya.')

@section('content')
    <!-- Page Header & Academic Breadcrumbs -->
    <section class="bg-gradient-to-b from-[#0F2537] to-[#13334C] text-white py-14 sm:py-20 border-b-4 border-[#C5A059] relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="flex items-center gap-2 text-xs text-amber-300/80 mb-4 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('public.home') }}" class="hover:text-amber-200 transition-colors">Beranda</a>
                <span>/</span>
                <span class="text-white font-semibold">Departemen & Bidang Keahlian</span>
            </nav>
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider mb-3 border border-amber-400/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                    Struktur Organisasi BPROTIC
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
                    Departemen & Bidang Keahlian
                </h1>
                <p class="mt-4 text-slate-300 text-sm sm:text-base leading-relaxed">
                    UKM BPROTIC memiliki 3 departemen utama yang berfokus pada penguasaan teknologi terdepan. Temukan bidang riset yang sesuai dengan minat dan kembangkan potensimu secara terarah bersama mentor berpengalaman.
                </p>
            </div>
        </div>
    </section>

    <!-- Main Departments Section -->
    <section class="py-16 sm:py-20 bg-[#FAF6ED]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-700">3 Pilar Riset Teknologi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537] mt-1">Departemen Utama BPROTIC</h2>
                <p class="text-slate-600 text-sm mt-2">
                    Setiap departemen memiliki kurikulum pembelajaran, proyek kolaboratif, dan ekosistem riset terstruktur.
                </p>
            </div>

            <!-- 3 Main Department Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($departments as $department)
                    <div class="bg-white rounded-2xl p-8 border border-amber-200/80 hover:border-amber-400 hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-300/15 to-transparent rounded-bl-full pointer-events-none"></div>

                        <div class="space-y-6">
                            <!-- Header Icon & Number -->
                            <div class="flex items-center justify-between">
                                <div class="w-16 h-16 rounded-2xl bg-[#0F2537] text-amber-400 flex items-center justify-center shadow-lg group-hover:scale-105 transition-transform">
                                    @if($department->slug === 'software-development')
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    @elseif($department->slug === 'iot')
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                    @else
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    @endif
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                                    Departemen 0{{ $loop->iteration }}
                                </span>
                            </div>

                            <!-- Title & Description -->
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors">
                                    {{ $department->name }}
                                </h3>
                                <p class="text-slate-600 text-xs sm:text-sm mt-3 leading-relaxed">
                                    {{ $department->short_description ?? $department->description }}
                                </p>
                            </div>

                            <!-- Bidang di dalamnya atau Fokus Pembelajaran -->
                            <div class="pt-4 border-t border-slate-100">
                                @if($department->slug === 'iot')
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-2.5 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        <span>Fokus Pembelajaran IoT:</span>
                                    </h4>
                                    <ul class="space-y-2 text-xs text-slate-700">
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                            <span>Mikrokontroler dan embedded systems.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                            <span>Sensor dan aktuator.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                            <span>Komunikasi perangkat dan protokol IoT.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                            <span>Monitoring perangkat dan pengiriman data.</span>
                                        </li>
                                        <li class="flex items-start gap-2">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 shrink-0"></span>
                                            <span>Prototyping dan otomasi berbasis IoT.</span>
                                        </li>
                                    </ul>
                                @else
                                    <h4 class="text-xs font-bold uppercase tracking-wider text-slate-700 mb-3 flex items-center gap-1.5">
                                        <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                                        <span>Bidang Keahlian:</span>
                                    </h4>
                                    <div class="space-y-2.5">
                                        @foreach($department->activeFields as $field)
                                            <div class="p-3 rounded-xl bg-[#FAF6ED] border border-amber-200/70">
                                                <div class="flex items-center gap-2">
                                                    <span class="w-2 h-2 rounded-full bg-amber-600 shrink-0"></span>
                                                    <span class="text-xs font-bold text-[#0F2537]">{{ $field->name }}</span>
                                                </div>
                                                @if($field->description)
                                                    <p class="text-[11px] text-slate-600 mt-1 leading-relaxed pl-4">
                                                        {{ $field->description }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Teknologi yang dipelajari -->
                            @if(count($department->technology_list) > 0)
                                <div class="pt-3">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Teknologi Utama:</span>
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach(array_slice($department->technology_list, 0, 5) as $tech)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-slate-100 text-slate-700 border border-slate-200">
                                                {{ $tech }}
                                            </span>
                                        @endforeach
                                        @if(count($department->technology_list) > 5)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-medium bg-amber-50 text-amber-700">
                                                +{{ count($department->technology_list) - 5 }} lainnya
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Card Footer -->
                        <div class="pt-6 mt-6 border-t border-slate-100">
                            <a href="{{ route('public.departments.show', $department->slug) }}" class="w-full inline-flex items-center justify-between px-5 py-3 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all duration-200 group/btn shadow-sm">
                                <span>Jelajahi Departemen</span>
                                <svg class="w-4 h-4 text-amber-400 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-16 bg-white rounded-2xl border border-dashed border-slate-300">
                        <p class="text-slate-500 font-medium">Belum ada departemen yang dipublikasikan saat ini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Academic Call To Action -->
    <section class="py-16 bg-white border-t border-slate-200">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Bergabung Bersama Kami</span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537]">Bingung Memilih Departemen yang Tepat?</h2>
            <p class="text-slate-600 text-sm max-w-2xl mx-auto leading-relaxed">
                Setiap calon anggota BPROTIC berhak mengikuti sesi pengenalan dan workshop dasar dari ketiga departemen sebelum menetapkan peminatan riset utama. Hubungi pengurus kami untuk konsultasi.
            </p>
            <div class="pt-2 flex flex-wrap justify-center gap-4">
                <a href="{{ route('public.contact') }}" class="px-6 py-3 rounded-xl bg-[#0F2537] text-white hover:bg-slate-800 text-xs font-bold transition-colors shadow">
                    Konsultasi Peminatan
                </a>
                <a href="{{ route('public.about') }}" class="px-6 py-3 rounded-xl bg-[#FAF6ED] text-[#0F2537] border border-amber-300 hover:bg-amber-100 text-xs font-bold transition-colors">
                    Pelajari Profil BPROTIC
                </a>
            </div>
        </div>
    </section>
@endsection
