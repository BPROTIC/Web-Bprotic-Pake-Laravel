@extends('layouts.public')

@section('title', 'Beranda')
@section('meta_description', \App\Models\Setting::get('site_description'))

@section('content')
    <!-- Hero Academic Banner -->
    <section class="relative bg-gradient-to-br from-[#0A1926] via-[#0F2537] to-[#13334C] text-white py-20 lg:py-28 overflow-hidden" data-galaxy="true">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#C5A059_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-400/10 border border-amber-400/30 text-amber-300 text-xs font-semibold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                        UKM Resmi Universitas Buana Perjuangan Karawang
                    </div>

                    <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight leading-tight">
                        Wadah Inovasi & Riset <span class="text-amber-400">Teknologi Masa Depan</span>
                    </h1>

                    <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                        {{ \App\Models\Setting::get('site_description', 'Unit Kegiatan Mahasiswa Buana Perjuangan University Robotics Club (BPROTIC) membina mahasiswa dalam riset rekayasa software, kecerdasan buatan, IoT, dan robotika.') }}
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                        <a href="{{ route('public.activities.index') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm tracking-wide transition-all duration-200 shadow-lg hover:shadow-amber-500/20">
                            <span>Jelajahi Kegiatan</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                        <a href="{{ route('public.about') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-semibold text-sm transition-all duration-200">
                            <span>Tentang BPROTIC</span>
                        </a>
                    </div>

                    <!-- Statistics Bar -->
                    <div class="grid grid-cols-3 gap-4 pt-8 border-t border-slate-700/60 max-w-lg mx-auto lg:mx-0">
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ \App\Models\Division::active()->count() }}</div>
                            <div class="text-xs text-slate-400">Divisi Riset</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ \App\Models\Activity::published()->count() }}+</div>
                            <div class="text-xs text-slate-400">Kegiatan Terlaksana</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl font-extrabold text-amber-400">{{ \App\Models\Achievement::published()->count() }}</div>
                            <div class="text-xs text-slate-400">Penghargaan Diraih</div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5 flex justify-center items-center">
                    <div class="relative group">
                        <!-- Ambient Warm Golden Glow behind Card -->
                        <div class="absolute -inset-2.5 rounded-[2.5rem] bg-gradient-to-tr from-amber-400/30 via-[#D4A72C]/25 to-amber-300/30 blur-2xl opacity-80 group-hover:opacity-100 transition-all duration-500"></div>

                        <!-- Clean Luminous White Card Surface -->
                        <div class="relative w-72 sm:w-80 md:w-96 aspect-square rounded-[2rem] bg-gradient-to-br from-white via-white to-amber-50/40 p-8 sm:p-10 border-2 border-[#D4A72C] ring-4 ring-amber-400/20 shadow-[0_25px_60px_-15px_rgba(0,0,0,0.5)] flex items-center justify-center transition-all duration-500 group-hover:scale-[1.02] group-hover:border-amber-400 group-hover:shadow-[0_30px_70px_-12px_rgba(212,167,44,0.35)]">
                            <!-- Subtle Tech Corner Accents -->
                            <div class="absolute top-3 left-3 w-4 h-4 border-t-2 border-l-2 border-[#D4A72C] rounded-tl pointer-events-none"></div>
                            <div class="absolute top-3 right-3 w-4 h-4 border-t-2 border-r-2 border-[#D4A72C] rounded-tr pointer-events-none"></div>
                            <div class="absolute bottom-3 left-3 w-4 h-4 border-b-2 border-l-2 border-[#D4A72C] rounded-bl pointer-events-none"></div>
                            <div class="absolute bottom-3 right-3 w-4 h-4 border-b-2 border-r-2 border-[#D4A72C] rounded-br pointer-events-none"></div>

                            <!-- Inner Subtle Framing -->
                            <div class="absolute inset-3 rounded-[1.5rem] border border-amber-100 pointer-events-none"></div>

                            <!-- The Logo: 100% Crisp, High Contrast, Fully Visible -->
                            <img src="{{ asset('asetss/logo bprotic.png') }}" 
                                 alt="Lambang Resmi BPROTIC UBP Karawang" 
                                 class="w-full h-full max-w-[270px] max-h-[270px] object-contain relative z-10 transition-transform duration-500 group-hover:scale-105 filter drop-shadow-md">
                        </div>

                        <!-- Floating Badge Top-Left: Riset & Robotika -->
                        <div class="absolute -top-3 -left-2 sm:-left-3 bg-[#0F2537] text-white px-3.5 py-1.5 rounded-full border border-amber-400/60 shadow-xl flex items-center gap-1.5 text-[11px] font-bold z-20">
                            <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                            <span>Robotics & Programming</span>
                        </div>

                        <!-- Floating Badge Bottom-Right: Institusi UBP Karawang -->
                        <div class="absolute -bottom-3 -right-2 sm:-right-3 bg-white text-[#0F2537] px-3.5 py-1.5 rounded-full border border-amber-300 shadow-xl flex items-center gap-1.5 text-[11px] font-bold z-20">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            <span>UBP Karawang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Sekilas Profil & Visi Misi -->
    <section class="py-16 bg-transparent border-b border-amber-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto text-center space-y-4">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Profil Organisasi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537]">Membentuk Talenta Digital Unggul & Berkarakter</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    UKM BPROTIC didirikan di lingkungan Universitas Buana Perjuangan Karawang untuk memberikan wadah kolaboratif bagi mahasiswa yang memiliki dedikasi tinggi pada eksplorasi logika pemrograman, rekayasa perangkat keras, dan teknologi otomasi robotik.
                </p>
            </div>
        </div>
    </section>

    <!-- Departemen & Bidang Keahlian Section -->
    <section class="py-20 bg-transparent border-b border-amber-200/50" id="departemen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-14">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/15 border border-[#D4A72C]/40 text-[#172554] text-xs font-bold uppercase tracking-wider mb-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                        Struktur Organisasi Riset
                    </div>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-[#172554] tracking-tight">Departemen & Bidang Keahlian</h2>
                    <p class="text-slate-600 text-sm sm:text-base mt-2">
                        Temukan bidang teknologi yang sesuai dengan minatmu dan kembangkan kemampuan bersama BPROTIC.
                    </p>
                </div>
                <a href="{{ route('public.departments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-amber-300 text-xs font-bold text-[#172554] hover:bg-[#172554] hover:text-white hover:border-[#172554] transition-all duration-200 shadow-sm">
                    <span>Semua Departemen</span>
                    <svg class="w-4 h-4 text-[#D4A72C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($departments as $department)
                    <div class="bg-white rounded-2xl p-7 border border-amber-200/80 hover:border-[#D4A72C] hover:shadow-xl transition-all duration-300 flex flex-col justify-between group relative overflow-hidden">
                        <div class="absolute top-0 right-0 w-28 h-28 bg-gradient-to-br from-amber-200/20 to-transparent rounded-bl-full pointer-events-none"></div>

                        <div class="space-y-5">
                            <!-- Department Icon & Badge -->
                            <div class="flex items-center justify-between">
                                <div class="w-14 h-14 rounded-2xl bg-[#172554] text-[#D4A72C] flex items-center justify-center shadow-md group-hover:scale-105 group-hover:bg-[#0F2537] transition-all">
                                    @if($department->slug === 'software-development')
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    @elseif($department->slug === 'iot')
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                    @else
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    @endif
                                </div>
                                <span class="text-[11px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 px-2.5 py-1 rounded-full border border-amber-200">
                                    Departemen #{{ $loop->iteration }}
                                </span>
                            </div>

                            <!-- Title & Description -->
                            <div>
                                <h3 class="text-xl font-bold text-[#172554] group-hover:text-amber-700 transition-colors">
                                    {{ $department->name }}
                                </h3>
                                <p class="text-slate-600 text-xs sm:text-sm mt-2 leading-relaxed">
                                    {{ $department->short_description ?? Str::limit($department->description, 130) }}
                                </p>
                            </div>

                            <!-- Bidang di dalamnya / Fokus Pembelajaran -->
                            <div class="pt-3 border-t border-slate-100">
                                @if($department->slug === 'iot')
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-2">Fokus Pembelajaran Utama:</span>
                                    <ul class="space-y-1.5 text-xs text-slate-700">
                                        <li class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                                            <span>Mikrokontroler & Embedded Systems</span>
                                        </li>
                                        <li class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                                            <span>Sensor & Aktuator Terintegrasi</span>
                                        </li>
                                        <li class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                                            <span>Komunikasi & Protokol IoT (MQTT, HTTP)</span>
                                        </li>
                                        <li class="flex items-center gap-1.5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                                            <span>Monitoring & Prototyping Otomasi</span>
                                        </li>
                                    </ul>
                                @else
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 block mb-2">Bidang Keahlian:</span>
                                    <div class="flex flex-wrap gap-2">
                                        @forelse($department->activeFields as $field)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-[#FAF6ED] border border-amber-200 text-xs font-semibold text-[#172554]">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#D4A72C]"></span>
                                                {{ $field->name }}
                                            </span>
                                        @empty
                                            <span class="text-xs text-slate-400 italic">Bidang terintegrasi</span>
                                        @endforelse
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Action -->
                        <div class="pt-6 mt-6 border-t border-slate-100">
                            <a href="{{ route('public.departments.show', $department->slug) }}" class="w-full inline-flex items-center justify-between px-4 py-2.5 rounded-xl bg-[#FAF6ED] hover:bg-[#172554] text-[#172554] hover:text-white text-xs font-bold transition-all duration-200 group/btn border border-amber-200">
                                <span>Jelajahi Departemen</span>
                                <svg class="w-4 h-4 text-[#D4A72C] group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 italic col-span-3 text-center py-8">Belum ada departemen yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Kegiatan Terbaru Section -->
    <section class="py-20 bg-transparent border-b border-amber-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Agenda & Workshop</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537] mt-1">Kegiatan Terbaru</h2>
                    <p class="text-slate-600 text-sm mt-1">Ikuti workshop, seminar, kompetisi, dan program pelatihan kami.</p>
                </div>
                <a href="{{ route('public.activities.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:text-amber-600 transition-colors">
                    <span>Semua Kegiatan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($activities as $activity)
                    <div class="bg-white rounded-2xl overflow-hidden border border-slate-200/80 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
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
                                <h3 class="text-base font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors line-clamp-2">
                                    <a href="{{ route('public.activities.show', $activity->slug) }}">{{ $activity->title }}</a>
                                </h3>
                                <p class="text-slate-600 text-xs leading-relaxed line-clamp-3">
                                    {{ $activity->excerpt ?? Str::limit(strip_tags($activity->description), 140) }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('public.activities.show', $activity->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:underline">
                                <span>Lihat Rincian Kegiatan</span>
                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 italic col-span-3 text-center py-8">Belum ada kegiatan yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Artikel Terbaru Section -->
    <section class="py-20 bg-transparent border-b border-amber-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-4 mb-12">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Publikasi & Edukasi</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537] mt-1">Artikel & Berita</h2>
                    <p class="text-slate-600 text-sm mt-1">Tulisan teknologi, tutorial pemrograman, dan wawasan sains komputer.</p>
                </div>
                <a href="{{ route('public.articles.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:text-amber-600 transition-colors">
                    <span>Semua Artikel</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <div class="bg-[#FAF6ED] rounded-2xl overflow-hidden border border-amber-200/80 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
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
                                <h3 class="text-base font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors line-clamp-2">
                                    <a href="{{ route('public.articles.show', $article->slug) }}">{{ $article->title }}</a>
                                </h3>
                                <p class="text-slate-600 text-xs leading-relaxed line-clamp-3">
                                    {{ $article->excerpt ?? Str::limit(strip_tags($article->content), 140) }}
                                </p>
                            </div>
                        </div>
                        <div class="px-6 pb-6 pt-2">
                            <a href="{{ route('public.articles.show', $article->slug) }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:underline">
                                <span>Baca Selengkapnya</span>
                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500 italic col-span-3 text-center py-8">Belum ada artikel yang dipublikasikan.</p>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Prestasi & Galeri Highlights -->
    <section class="py-20 bg-[#0F2537] text-white relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <!-- Left: Prestasi -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Prestasi Mahasiswa</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">Kebanggaan BPROTIC</h2>
                        <p class="text-slate-300 text-xs mt-1">Dedikasi dan karya anggota kami dalam berbagai kejuaraan.</p>
                    </div>

                    <div class="space-y-4">
                        @forelse($achievements as $ach)
                            <div class="bg-[#13334C] p-5 rounded-xl border border-amber-400/20 flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center flex-shrink-0">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                </div>
                                <div class="space-y-1">
                                    <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded bg-amber-400/10 text-amber-300 border border-amber-400/30">
                                        {{ $ach->category ?? 'Kompetisi' }}
                                    </span>
                                    <h4 class="text-sm font-bold text-white">{{ $ach->title }}</h4>
                                    <p class="text-xs text-slate-300">{{ $ach->recipient }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic">Belum ada prestasi yang dicatat.</p>
                        @endforelse
                    </div>

                    <div>
                        <a href="{{ route('public.achievements.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 hover:underline">
                            <span>Lihat Penghargaan Lainnya</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Right: Dokumentasi Galeri -->
                <div class="lg:col-span-6 space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Dokumentasi</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-white mt-1">Galeri Kegiatan</h2>
                        <p class="text-slate-300 text-xs mt-1">Rekam jejak visual aktivitas, riset, dan kebersamaan.</p>
                    </div>

                    <div class="grid grid-cols-3 gap-3">
                        @forelse($galleries as $gal)
                            <div class="aspect-square rounded-xl overflow-hidden bg-slate-800 border border-slate-700 relative group">
                                @if($gal->image)
                                    @if(file_exists(public_path($gal->image)))
                                        <img src="{{ asset($gal->image) }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @else
                                        <img src="{{ asset('storage/' . $gal->image) }}" alt="{{ $gal->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    @endif
                                @else
                                    <div class="w-full h-full flex items-center justify-center p-2 text-center text-[10px] text-slate-400">
                                        {{ $gal->title }}
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity p-2 flex items-end">
                                    <span class="text-[10px] text-white font-medium line-clamp-1">{{ $gal->title }}</span>
                                </div>
                            </div>
                        @empty
                            <p class="text-xs text-slate-400 italic col-span-3">Belum ada foto galeri.</p>
                        @endforelse
                    </div>

                    <div>
                        <a href="{{ route('public.galleries.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-400 hover:underline">
                            <span>Buka Semua Galeri Foto</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Banner -->
    <section class="py-16 bg-gradient-to-r from-amber-500 to-amber-600 text-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Siap Bergabung dan Berkarya Bersama BPROTIC?</h2>
            <p class="text-slate-900 text-sm max-w-xl mx-auto font-medium">
                Kembangkan potensimu dalam pemrograman, robotika, dan teknologi informasi. Terbuka bagi seluruh mahasiswa Universitas Buana Perjuangan Karawang.
            </p>
            <div class="pt-2">
                <a href="{{ route('public.contact') }}" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white font-bold text-sm transition-all shadow-md">
                    <span>Gabung Bersama Kami Sekarang</span>
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>
        </div>
    </section>
@endsection
