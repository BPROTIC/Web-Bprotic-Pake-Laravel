<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Dashboard') - BPROTIC Hub</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('asetss/logo bprotic.png') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind & App Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', ui-sans-serif, system-ui, sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body class="h-full flex overflow-hidden bg-slate-100 text-slate-800">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebar-backdrop" class="fixed inset-0 bg-slate-900/60 z-40 hidden lg:hidden transition-opacity"></div>

    <!-- Admin Sidebar -->
    <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0F2537] text-white flex flex-col transition-transform duration-300 transform -translate-x-full lg:translate-x-0 lg:static lg:inset-auto lg:z-auto shadow-2xl">
        <!-- Sidebar Brand Header -->
        <div class="h-18 px-5 py-4 border-b border-slate-700/60 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-white p-1 shadow-sm border border-amber-300/80 flex items-center justify-center shrink-0">
                    <img src="{{ asset('asetss/logo bprotic.png') }}" alt="Logo BPROTIC" class="w-full h-full object-contain">
                </div>
                <div>
                    <span class="font-extrabold text-white text-base tracking-tight">BPROTIC</span>
                    <span class="text-amber-400 font-bold text-xs ml-1 px-1.5 py-0.5 rounded bg-amber-400/10 border border-amber-400/20">ADMIN</span>
                    <div class="text-[10px] text-slate-400">Content Management</div>
                </div>
            </a>
            <button id="close-sidebar-btn" class="lg:hidden text-slate-400 hover:text-white p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Sidebar Navigation Menu -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 text-sm font-medium">
            <!-- 1. Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                <span>Dashboard</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Manajemen Konten
            </div>

            <!-- 2. Kegiatan -->
            <a href="{{ route('admin.activities.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.activities.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Manajemen Kegiatan</span>
            </a>

            <!-- 3. Artikel -->
            <a href="{{ route('admin.articles.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                <span>Manajemen Artikel</span>
            </a>

            <!-- 4. Prestasi -->
            <a href="{{ route('admin.achievements.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.achievements.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                <span>Manajemen Prestasi</span>
            </a>

            <!-- 5. Galeri -->
            <a href="{{ route('admin.galleries.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.galleries.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Manajemen Galeri</span>
            </a>

            <!-- 6. Departemen -->
            <a href="{{ route('admin.departments.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ (request()->routeIs('admin.departments.*') || request()->routeIs('admin.divisions.*')) ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>Manajemen Departemen</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <span class="text-amber-400 text-lg">▣</span><span>Katalog Produk</span>
            </a>

            <!-- 7. Halaman -->
            <a href="{{ route('admin.pages.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Manajemen Halaman</span>
            </a>

            <div class="pt-3 pb-1 px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400">
                Interaksi & Konfigurasi
            </div>

            <!-- 8. Pesan Kontak -->
            <a href="{{ route('admin.contact-messages.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.contact-messages.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span>Pesan Kontak</span>
                </div>
                @php
                    $unreadMessages = \App\Models\ContactMessage::unread()->count();
                @endphp
                @if($unreadMessages > 0)
                    <span class="bg-amber-500 text-slate-900 text-xs font-bold px-2 py-0.5 rounded-full">
                        {{ $unreadMessages }}
                    </span>
                @endif
            </a>

            <!-- 9. Pengaturan Website -->
            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                <span>Pengaturan Website</span>
            </a>

            <!-- 10. Manajemen Pengguna -->
            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#13334C] text-amber-400 font-semibold shadow-sm' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                <span>Manajemen Pengguna</span>
            </a>
        </nav>

        <!-- Sidebar Footer Action (View Public Site & Logout) -->
        <div class="p-3 border-t border-slate-700/60 bg-[#0A1926]/50 space-y-2">
            <a href="{{ route('public.home') }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-2 px-3 rounded-lg bg-[#13334C] text-slate-200 hover:text-white hover:bg-slate-700/50 text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                <span>Lihat Website Publik</span>
            </a>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 px-3 rounded-lg border border-red-500/30 text-red-300 hover:bg-red-500/10 text-xs font-semibold transition-all">
                    <svg class="w-4 h-4 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Container: Topbar + Scrollable Content -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Topbar -->
        <header class="bg-white border-b border-slate-200 h-16 flex items-center justify-between px-4 sm:px-6 z-30">
            <div class="flex items-center gap-3">
                <button type="button" id="open-sidebar-btn" class="lg:hidden p-2 rounded-md text-slate-600 hover:text-slate-900 hover:bg-slate-100 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <div>
                    <h1 class="text-base sm:text-lg font-bold text-slate-900 leading-tight">
                        @yield('page_title', 'Dashboard')
                    </h1>
                    <div class="text-xs text-slate-500 hidden sm:block">
                        @yield('breadcrumb', 'Panel Administrasi BPROTIC')
                    </div>
                </div>
            </div>

            <!-- User Info Badge in Topbar -->
            <div class="flex items-center gap-3">
                <div class="text-right hidden sm:block">
                    <div class="text-xs font-bold text-slate-800">{{ auth()->user()->name ?? 'Administrator' }}</div>
                    <div class="text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">
                        {{ auth()->user()->role ?? 'Admin' }} (Online)
                    </div>
                </div>
                <div class="w-9 h-9 rounded-full bg-[#0F2537] text-amber-300 font-bold flex items-center justify-center border-2 border-amber-400 text-sm shadow-sm">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
            </div>
        </header>

        <!-- Main Body Content Area with Scroll -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            <!-- Global Flash Messages -->
            @if(session('success'))
                <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-emerald-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-emerald-900">Sukses!</h4>
                        <p class="text-sm text-emerald-700 mt-0.5">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-rose-50 border-l-4 border-rose-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-rose-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-rose-900">Perhatian / Gagal!</h4>
                        <p class="text-sm text-rose-700 mt-0.5">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg shadow-sm flex items-start gap-3">
                    <svg class="w-5 h-5 text-amber-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <div class="flex-1">
                        <h4 class="text-sm font-bold text-amber-900">Harap periksa kembali input Anda:</h4>
                        <ul class="list-disc list-inside text-xs text-amber-800 mt-1 space-y-0.5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Script Sidebar Toggle & Delete Confirmation -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openBtn = document.getElementById('open-sidebar-btn');
            const closeBtn = document.getElementById('close-sidebar-btn');
            const sidebar = document.getElementById('admin-sidebar');
            const backdrop = document.getElementById('sidebar-backdrop');

            function toggleSidebar(open) {
                if (open) {
                    sidebar.classList.remove('-translate-x-full');
                    backdrop.classList.remove('hidden');
                } else {
                    sidebar.classList.add('-translate-x-full');
                    backdrop.classList.add('hidden');
                }
            }

            if (openBtn) openBtn.addEventListener('click', () => toggleSidebar(true));
            if (closeBtn) closeBtn.addEventListener('click', () => toggleSidebar(false));
            if (backdrop) backdrop.addEventListener('click', () => toggleSidebar(false));
        });

        // Global Delete confirmation function
        function confirmDelete(message = 'Apakah Anda yakin ingin menghapus data ini?') {
            return confirm(message);
        }
    </script>
    @stack('scripts')
</body>
</html>
