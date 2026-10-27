<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Beranda') - {{ \App\Models\Setting::get('site_name', 'UKM BPROTIC UBP Karawang') }}</title>
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('site_description', 'Unit Kegiatan Mahasiswa Buana Perjuangan University Robotics Club Universitas Buana Perjuangan Karawang'))">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asetss/logo bprotic.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind & App Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
            background-color: #FAF6ED;
            color: #0A1926;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col selection:bg-amber-400 selection:text-slate-900 relative">

    <!-- Interactive Background Galaxy Canvas -->
    <canvas id="galaxy-layout-canvas" class="fixed inset-0 w-full h-full pointer-events-none z-0"></canvas>

    <!-- Top Academic Bar -->
    <div class="bg-[#0A1926] text-amber-100/80 text-xs py-2 px-4 border-b border-amber-600/30 relative z-20">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Universitas Buana Perjuangan Karawang</span>
                </span>
                <span class="hidden md:inline-block text-slate-600">•</span>
                <span class="hidden md:flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>{{ \App\Models\Setting::get('site_email', 'ukm.bprotic@ubpkarawang.ac.id') }}</span>
                </span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('public.contact') }}" class="hover:text-amber-400 transition-colors">Gabung Bersama Kami</a>
                <span>•</span>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-amber-400 font-semibold hover:underline flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-amber-300 transition-colors flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                        Login Pengurus
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main Public Header & Navbar -->
    <header class="bg-[#0F2537] text-white shadow-lg sticky top-0 z-50 border-b border-amber-500/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Brand / Logo -->
                <a href="{{ route('public.home') }}" class="flex items-center gap-3 group shrink-0">
                    <div class="w-11 h-11 rounded-xl bg-white p-1 shadow-md border border-amber-300/80 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                        <img src="{{ asset('asetss/logo bprotic.png') }}" alt="Logo BPROTIC" class="w-full h-full object-contain">
                    </div>
                    <div>
                        <div class="font-extrabold text-lg sm:text-xl tracking-tight text-white flex items-center gap-1.5">
                            BPROTIC <span class="text-amber-400 text-sm font-semibold tracking-wider uppercase">UBP</span>
                        </div>
                        <div class="text-[11px] text-amber-200/80 tracking-wide hidden sm:block">
                            Buana Perjuangan University Robotics Club
                        </div>
                    </div>
                </a>

                <!-- Desktop Navigation Menu -->
                <nav class="hidden lg:flex flex-1 justify-end items-center gap-1 xl:gap-2 font-medium text-sm whitespace-nowrap">
                    <!-- 1. Beranda -->
                    <a href="{{ route('public.home') }}"
                        class="px-3 py-2 rounded-xl transition-all {{ request()->routeIs('public.home') ? 'bg-[#13334C] text-amber-400 font-bold shadow-sm' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                        Beranda
                    </a>

                    <!-- 2. Dropdown: Profil -->
                    @php
                        $isProfileActive = request()->routeIs('public.about') || 
                                           request()->routeIs('public.departments.*') || 
                                           request()->routeIs('public.divisions.*') || 
                                           request()->routeIs('public.achievements.*');
                    @endphp
                    <div class="relative group">
                        <button type="button"
                            class="px-3 py-2 rounded-xl transition-all inline-flex items-center gap-1.5 {{ $isProfileActive ? 'bg-[#13334C] text-amber-400 font-bold shadow-sm' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            <span>Profil</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Panel -->
                        <div class="absolute left-0 top-full pt-2 w-72 invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 z-50">
                            <div class="bg-[#0A1926]/95 backdrop-blur-md border border-amber-500/20 rounded-2xl shadow-2xl p-2 space-y-1">
                                <a href="{{ route('public.about') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ request()->routeIs('public.about') ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Tentang Kami</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Sejarah, visi, misi, dan struktur BPROTIC</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.departments.index') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ (request()->routeIs('public.departments.*') || request()->routeIs('public.divisions.*')) ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Departemen Riset</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Software Dev, IoT, dan Data Science</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.achievements.index') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ request()->routeIs('public.achievements.*') ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Prestasi Mahasiswa</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Rekam jejak juara dan penghargaan</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Dropdown: Aktivitas & Karya -->
                    @php
                        $isActivityActive = request()->routeIs('public.products.*') || 
                                            request()->routeIs('public.activities.*') || 
                                            request()->routeIs('public.galleries.*');
                    @endphp
                    <div class="relative group">
                        <button type="button"
                            class="px-3 py-2 rounded-xl transition-all inline-flex items-center gap-1.5 {{ $isActivityActive ? 'bg-[#13334C] text-amber-400 font-bold shadow-sm' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                            <span>Aktivitas & Karya</span>
                            <svg class="w-4 h-4 text-slate-400 group-hover:text-amber-400 group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown Panel -->
                        <div class="absolute left-0 top-full pt-2 w-72 invisible opacity-0 translate-y-2 group-hover:visible group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-200 z-50">
                            <div class="bg-[#0A1926]/95 backdrop-blur-md border border-amber-500/20 rounded-2xl shadow-2xl p-2 space-y-1">
                                <a href="{{ route('public.products.index') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ request()->routeIs('public.products.*') ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Produk Inovasi</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Karya software & prototipe robotika</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.activities.index') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ request()->routeIs('public.activities.*') ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Agenda Kegiatan</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Workshop, bootcamp, dan seminar</div>
                                    </div>
                                </a>

                                <a href="{{ route('public.galleries.index') }}" class="flex items-start gap-3 p-2.5 rounded-xl hover:bg-[#13334C] transition-all group/item {{ request()->routeIs('public.galleries.*') ? 'bg-[#13334C]/60' : '' }}">
                                    <div class="w-8 h-8 rounded-lg bg-amber-400/10 text-amber-400 flex items-center justify-center shrink-0 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <div>
                                        <div class="text-xs font-bold text-white group-hover/item:text-amber-400 transition-colors">Dokumentasi Galeri</div>
                                        <div class="text-[11px] text-slate-400 leading-tight mt-0.5">Dokumentasi foto kegiatan & riset</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- 4. Artikel -->
                    <a href="{{ route('public.articles.index') }}"
                        class="px-3 py-2 rounded-xl transition-all {{ request()->routeIs('public.articles.*') ? 'bg-[#13334C] text-amber-400 font-bold shadow-sm' : 'text-slate-200 hover:text-white hover:bg-white/5' }}">
                        Artikel
                    </a>

                    <!-- 5. CTA Button: Gabung Bersama Kami -->
                    <div class="pl-2 xl:pl-3">
                        <a href="{{ route('public.contact') }}"
                            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 font-extrabold rounded-xl text-xs uppercase tracking-wider transition-all duration-200 shadow-md hover:shadow-amber-500/25 active:scale-95 {{ request()->routeIs('public.contact') ? 'ring-2 ring-amber-300' : '' }}">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            <span>Gabung Bersama Kami</span>
                        </a>
                    </div>
                </nav>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center">
                    <button type="button" id="mobile-menu-btn" class="p-2 rounded-md text-amber-300 hover:text-white hover:bg-[#13334C] focus:outline-none" aria-label="Toggle navigation">
                        <svg class="h-6 w-6" id="menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg class="h-6 w-6 hidden" id="close-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden lg:hidden bg-[#0A1926] border-t border-slate-700/60 px-4 pt-4 pb-6 space-y-4 max-h-[85vh] overflow-y-auto">
            <!-- 1. Beranda -->
            <a href="{{ route('public.home') }}" class="block px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('public.home') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-200 hover:bg-white/5' }}">
                Beranda
            </a>

            <!-- 2. Profil Group -->
            <div class="space-y-1">
                <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-amber-400/80">Profil UKM</div>
                <div class="pl-2 space-y-1">
                    <a href="{{ route('public.about') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('public.about') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Tentang Kami
                    </a>
                    <a href="{{ route('public.departments.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ (request()->routeIs('public.departments.*') || request()->routeIs('public.divisions.*')) ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Departemen Riset
                    </a>
                    <a href="{{ route('public.achievements.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('public.achievements.*') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Prestasi Mahasiswa
                    </a>
                </div>
            </div>

            <!-- 3. Aktivitas & Karya Group -->
            <div class="space-y-1">
                <div class="px-3 text-[11px] font-bold uppercase tracking-wider text-amber-400/80">Aktivitas & Karya</div>
                <div class="pl-2 space-y-1">
                    <a href="{{ route('public.products.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('public.products.*') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Produk Inovasi
                    </a>
                    <a href="{{ route('public.activities.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('public.activities.*') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Agenda Kegiatan
                    </a>
                    <a href="{{ route('public.galleries.index') }}" class="block px-3 py-2 rounded-lg text-xs font-medium {{ request()->routeIs('public.galleries.*') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-300 hover:bg-white/5' }}">
                        • Dokumentasi Galeri
                    </a>
                </div>
            </div>

            <!-- 4. Artikel -->
            <a href="{{ route('public.articles.index') }}" class="block px-3 py-2.5 rounded-xl text-sm font-semibold {{ request()->routeIs('public.articles.*') ? 'bg-[#13334C] text-amber-400 font-bold' : 'text-slate-200 hover:bg-white/5' }}">
                Artikel
            </a>

            <!-- 5. CTA Button -->
            <div class="pt-2">
                <a href="{{ route('public.contact') }}" class="flex items-center justify-center gap-2 w-full text-center py-3 rounded-xl bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-300 hover:to-amber-400 text-slate-950 font-extrabold text-sm shadow-md">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                    <span>Gabung Bersama Kami</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow relative z-10">
        <!-- Flash Alert Messages for Public (e.g. after sending contact message) -->
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <div>
                        <p class="font-semibold text-emerald-900 text-sm">Berhasil!</p>
                        <p class="text-emerald-700 text-sm mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
                <div class="bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-rose-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div>
                        <p class="font-semibold text-rose-900 text-sm">Terjadi Kesalahan</p>
                        <p class="text-rose-700 text-sm mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Public Academic Footer -->
    <footer class="bg-[#0A1926] text-white pt-16 pb-8 border-t-4 border-[#C5A059] relative z-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-slate-800">
                <!-- Col 1: About BPROTIC -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-white p-1 shadow-md border border-amber-300/80 flex items-center justify-center shrink-0">
                            <img src="{{ asset('asetss/logo bprotic.png') }}" alt="Logo BPROTIC" class="w-full h-full object-contain">
                        </div>
                        <div>
                            <div class="font-bold text-lg text-white">UKM BPROTIC</div>
                            <div class="text-xs text-amber-400">UBP Karawang</div>
                        </div>
                    </div>
                    <p class="text-slate-300 text-xs leading-relaxed">
                        {{ \App\Models\Setting::get('site_description', 'Unit Kegiatan Mahasiswa riset teknologi pemrograman dan robotika di Universitas Buana Perjuangan Karawang.') }}
                    </p>
                    <div class="flex items-center gap-2 pt-2">
                        <a href="{{ \App\Models\Setting::get('social_instagram', '#') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-[#13334C] text-amber-300 hover:bg-amber-400 hover:text-slate-900 flex items-center justify-center transition-all" aria-label="Instagram">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        <a href="{{ \App\Models\Setting::get('social_youtube', '#') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-[#13334C] text-amber-300 hover:bg-amber-400 hover:text-slate-900 flex items-center justify-center transition-all" aria-label="YouTube">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        <a href="{{ \App\Models\Setting::get('social_linkedin', '#') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-[#13334C] text-amber-300 hover:bg-amber-400 hover:text-slate-900 flex items-center justify-center transition-all" aria-label="LinkedIn">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                        <a href="{{ \App\Models\Setting::get('social_github', '#') }}" target="_blank" rel="noopener" class="w-8 h-8 rounded-full bg-[#13334C] text-amber-300 hover:bg-amber-400 hover:text-slate-900 flex items-center justify-center transition-all" aria-label="GitHub">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Col 2: Navigation Links -->
                <div>
                    <h3 class="text-sm font-bold text-amber-400 tracking-wider uppercase mb-4">Navigasi Utama</h3>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="{{ route('public.home') }}" class="hover:text-amber-400 transition-colors">Beranda</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-amber-400 transition-colors">Tentang Kami & Sejarah</a></li>
                        <li><a href="{{ route('public.divisions.index') }}" class="hover:text-amber-400 transition-colors">Divisi & Peminatan</a></li>
                        <li><a href="{{ route('public.activities.index') }}" class="hover:text-amber-400 transition-colors">Agenda & Kegiatan</a></li>
                        <li><a href="{{ route('public.articles.index') }}" class="hover:text-amber-400 transition-colors">Artikel & Publikasi</a></li>
                        <li><a href="{{ route('public.achievements.index') }}" class="hover:text-amber-400 transition-colors">Prestasi Mahasiswa</a></li>
                        <li><a href="{{ route('public.galleries.index') }}" class="hover:text-amber-400 transition-colors">Dokumentasi Galeri</a></li>
                        <li><a href="{{ route('public.contact') }}" class="hover:text-amber-400 transition-colors font-semibold text-amber-300">Gabung Bersama Kami</a></li>
                    </ul>
                </div>

                <!-- Col 3: 3 Departemen Riset BPROTIC -->
                <div>
                    <h3 class="text-sm font-bold text-amber-400 tracking-wider uppercase mb-4">Departemen Riset</h3>
                    <ul class="space-y-2 text-xs text-slate-300">
                        @foreach(\App\Models\Department::active()->take(3)->get() as $dept)
                            <li>
                                <a href="{{ route('public.departments.show', $dept->slug) }}" class="hover:text-amber-400 transition-colors flex items-center gap-1.5">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    <span>{{ $dept->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Col 4: Contact & Secretariat -->
                <div>
                    <h3 class="text-sm font-bold text-amber-400 tracking-wider uppercase mb-4">Sekretariat</h3>
                    <div class="space-y-2.5 text-xs text-slate-300">
                        <p class="leading-relaxed">
                            {{ \App\Models\Setting::get('site_address', 'Gedung Ormawa Kampus UBP Karawang, Jl. HS. Ronggowaluyo, Telukjambe Timur, Karawang') }}
                        </p>
                        <p class="pt-1">
                            <span class="text-slate-400">Email:</span><br>
                            <span class="text-amber-300 font-medium">{{ \App\Models\Setting::get('site_email', 'ukm.bprotic@ubpkarawang.ac.id') }}</span>
                        </p>
                        <p>
                            <span class="text-slate-400">Kontak:</span><br>
                            <span class="text-amber-300 font-medium">{{ \App\Models\Setting::get('site_phone', '+62 812-3456-7890') }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-400 gap-3">
                <div>
                    &copy; {{ date('Y') }} <strong>UKM BPROTIC</strong> — Universitas Buana Perjuangan Karawang. All rights reserved.
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}" class="hover:text-amber-300 transition-colors">Portal Pengurus</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Interactive Scripts -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            if (btn && menu) {
                btn.addEventListener('click', () => {
                    const isOpen = !menu.classList.contains('hidden');
                    if (isOpen) {
                        menu.classList.add('hidden');
                        menuIcon.classList.remove('hidden');
                        closeIcon.classList.add('hidden');
                    } else {
                        menu.classList.remove('hidden');
                        menuIcon.classList.add('hidden');
                        closeIcon.classList.remove('hidden');
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
