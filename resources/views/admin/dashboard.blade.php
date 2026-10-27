@extends('layouts.admin')

@section('title', 'Dashboard Administrator')
@section('page_title', 'Dashboard')
@section('breadcrumb', 'Ikhtisar statistik dan aktivitas terbaru sistem')

@section('content')
<div class="space-y-8">
    <!-- Statistic Metric Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Card 1: Kegiatan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Kegiatan</span>
                <div class="text-2xl font-extrabold text-[#0F2537]">{{ $stats['total_activities'] }}</div>
                <a href="{{ route('admin.activities.index') }}" class="text-[11px] font-semibold text-amber-600 hover:underline">Kelola Kegiatan &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Card 2: Artikel -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Artikel</span>
                <div class="text-2xl font-extrabold text-[#0F2537]">{{ $stats['total_articles'] }}</div>
                <a href="{{ route('admin.articles.index') }}" class="text-[11px] font-semibold text-amber-600 hover:underline">Kelola Artikel &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
            </div>
        </div>

        <!-- Card 3: Pesan Masuk -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pesan Baru</span>
                <div class="text-2xl font-extrabold {{ $stats['unread_messages'] > 0 ? 'text-amber-600' : 'text-[#0F2537]' }}">
                    {{ $stats['unread_messages'] }}
                </div>
                <a href="{{ route('admin.contact-messages.index') }}" class="text-[11px] font-semibold text-amber-600 hover:underline">Buka Kotak Masuk &rarr;</a>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            </div>
        </div>

        <!-- Card 4: Prestasi & Galeri -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
            <div class="space-y-1">
                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Prestasi & Foto</span>
                <div class="text-2xl font-extrabold text-[#0F2537]">{{ $stats['total_achievements'] }} / {{ $stats['total_galleries'] }}</div>
                <span class="text-[11px] text-slate-400">Prestasi / Galeri</span>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
            </div>
        </div>
    </div>

    <!-- Quick Action Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3">Pintasan Tindakan Cepat</h2>
        <div class="flex flex-wrap items-center gap-3">
            <a href="{{ route('admin.activities.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#0F2537] text-white hover:bg-[#13334C] text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Kegiatan</span>
            </a>
            <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-[#0F2537] text-white hover:bg-[#13334C] text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Tulis Artikel Baru</span>
            </a>
            <a href="{{ route('admin.achievements.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Catat Prestasi</span>
            </a>
            <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                <span>Upload Foto Galeri</span>
            </a>
            <a href="{{ route('admin.departments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 border border-amber-300 text-amber-900 hover:bg-amber-100 text-xs font-semibold transition-all">
                <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                <span>Kelola 3 Departemen</span>
            </a>
        </div>
    </div>

    <!-- Tables Grid: Recent Messages & Upcoming Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Left: Pesan Kontak Terbaru -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-[#0F2537]">Pesan Masuk Terbaru</h3>
                        <p class="text-xs text-slate-500">Pertanyaan dan formulir kontak dari pengunjung</p>
                    </div>
                    <a href="{{ route('admin.contact-messages.index') }}" class="text-xs font-semibold text-amber-600 hover:underline">
                        Lihat Semua
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($recentMessages as $msg)
                        <a href="{{ route('admin.contact-messages.show', $msg->id) }}" class="p-4 block hover:bg-slate-50 transition-colors {{ !$msg->is_read ? 'bg-amber-50/40' : '' }}">
                            <div class="flex items-center justify-between">
                                <span class="text-xs font-bold text-slate-900">{{ $msg->name }}</span>
                                <span class="text-[10px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="text-xs text-slate-600 font-medium truncate mt-0.5">{{ $msg->subject ?? '(Tanpa Subjek)' }}</div>
                            <div class="text-[11px] text-slate-400 line-clamp-1 mt-0.5">{{ $msg->message }}</div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400 italic">Belum ada pesan masuk.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Kegiatan Mendatang -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-bold text-[#0F2537]">Agenda Kegiatan</h3>
                        <p class="text-xs text-slate-500">Jadwal kegiatan atau workshop yang akan datang</p>
                    </div>
                    <a href="{{ route('admin.activities.index') }}" class="text-xs font-semibold text-amber-600 hover:underline">
                        Lihat Semua
                    </a>
                </div>
                <div class="divide-y divide-slate-100">
                    @forelse($upcomingActivities as $act)
                        <div class="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
                            <div class="space-y-0.5">
                                <span class="text-[10px] font-bold uppercase text-amber-700 bg-amber-100/70 px-2 py-0.5 rounded">
                                    {{ optional($act->event_date)->translatedFormat('d M Y') }}
                                </span>
                                <h4 class="text-xs font-bold text-slate-900">{{ $act->title }}</h4>
                                <p class="text-[11px] text-slate-500">{{ $act->location ?? 'Lokasi belum ditentukan' }}</p>
                            </div>
                            <a href="{{ route('admin.activities.edit', $act->id) }}" class="text-xs text-slate-400 hover:text-slate-800 p-2">
                                Edit
                            </a>
                        </div>
                    @empty
                        <div class="p-8 text-center text-xs text-slate-400 italic">Tidak ada agenda kegiatan mendatang.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
