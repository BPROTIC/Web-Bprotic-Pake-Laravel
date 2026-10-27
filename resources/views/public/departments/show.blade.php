@extends('layouts.public')

@section('title', $department->name . ' - UKM BPROTIC UBP Karawang')
@section('meta_description', Str::limit($department->short_description ?? $department->description, 160))

@section('content')
    <!-- Department Hero Header -->
    <section class="bg-gradient-to-b from-[#0F2537] to-[#13334C] text-white py-14 sm:py-20 border-b-4 border-[#C5A059] relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-amber-300/80 mb-6 font-medium" aria-label="Breadcrumb">
                <a href="{{ route('public.home') }}" class="hover:text-amber-200 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('public.departments.index') }}" class="hover:text-amber-200 transition-colors">Departemen</a>
                <span>/</span>
                <span class="text-white font-semibold">{{ $department->name }}</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-8">
                <div class="max-w-3xl space-y-4">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/20 text-amber-300 text-xs font-bold uppercase tracking-wider border border-amber-400/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                        @if($department->slug === 'software-development')
                            Departemen Resmi BPROTIC • Periode Aktif 2026–2027
                        @else
                            Departemen Resmi BPROTIC
                        @endif
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black tracking-tight text-white">
                        {{ $department->name }}
                    </h1>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        {{ $department->short_description }}
                    </p>
                </div>

                <!-- Back button & Icon Display -->
                <div class="flex flex-col sm:flex-row lg:flex-col items-start lg:items-end gap-3 shrink-0">
                    <div class="w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm border border-amber-400/30 text-amber-400 flex items-center justify-center shadow-2xl">
                        @if($department->slug === 'software-development')
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                        @elseif($department->slug === 'iot')
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                        @else
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        @endif
                    </div>
                    <a href="{{ route('public.departments.index') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold border border-white/20 transition-all">
                        <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Semua Departemen</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="py-16 sm:py-20 bg-[#FAF6ED]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">

            <!-- Deskripsi Lengkap & Tujuan Pembelajaran Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <!-- Deskripsi & Gambaran Umum -->
                <div class="lg:col-span-7 bg-white rounded-2xl p-8 border border-amber-200/80 shadow-sm space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Gambaran Umum</span>
                        <h2 class="text-2xl font-extrabold text-[#0F2537] mt-1">Tentang Departemen</h2>
                    </div>

                    <div class="prose prose-slate max-w-none text-slate-700 text-sm sm:text-base leading-relaxed space-y-4">
                        <p>{{ $department->description }}</p>
                    </div>

                    <!-- Banner / Image jika ada -->
                    @if($department->image)
                        <div class="rounded-xl overflow-hidden border border-slate-200 mt-6 shadow-sm">
                            <img src="{{ asset('storage/' . $department->image) }}" alt="{{ $department->name }}" class="w-full h-64 object-cover">
                        </div>
                    @endif
                </div>

                <!-- Tujuan & Fokus Pembelajaran -->
                <div class="lg:col-span-5 bg-white rounded-2xl p-8 border border-amber-200/80 shadow-sm space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Kurikulum & Riset</span>
                        <h2 class="text-2xl font-extrabold text-[#0F2537] mt-1">Fokus Pembelajaran</h2>
                    </div>

                    @if($department->slug === 'iot')
                        <!-- Khusus IoT: 5 Fokus Pembelajaran Resmi -->
                        <div class="space-y-3.5">
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[#0F2537]">Mikrokontroler dan embedded systems</h4>
                                    <p class="text-[11px] text-slate-600 mt-0.5">Pemrograman mikrokontroler (Arduino, ESP32, STM32) dan arsitektur embedded.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[#0F2537]">Sensor dan aktuator</h4>
                                    <p class="text-[11px] text-slate-600 mt-0.5">Pengolahan sinyal analog/digital dari sensor suhu, ultrasonik, gyroscope, dan aktuator motorik.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[#0F2537]">Komunikasi perangkat dan protokol IoT</h4>
                                    <p class="text-[11px] text-slate-600 mt-0.5">Penerapan standar telemetri protokol MQTT, HTTP/REST, WebSocket, dan LoRaWAN.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">4</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[#0F2537]">Monitoring perangkat dan pengiriman data</h4>
                                    <p class="text-[11px] text-slate-600 mt-0.5">Desain dashboard telemetri real-time, cloud broker, dan manajemen aliran data edge-to-cloud.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3.5 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">5</span>
                                <div>
                                    <h4 class="text-xs font-bold text-[#0F2537]">Prototyping dan otomasi berbasis IoT</h4>
                                    <p class="text-[11px] text-slate-600 mt-0.5">Perakitan purwarupa hardware, smart home, smart agriculture, dan otomatisasi industri.</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Departemen Lain: Menggunakan item dari learning_focus -->
                        @if(count($department->learning_focus_list) > 0)
                            <div class="space-y-3">
                                @foreach($department->learning_focus_list as $index => $focus)
                                    <div class="flex items-start gap-3 p-3 rounded-xl bg-[#FAF6ED] border border-amber-200/60">
                                        <span class="w-6 h-6 rounded-lg bg-[#0F2537] text-amber-400 text-xs font-bold flex items-center justify-center shrink-0 mt-0.5">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-xs sm:text-sm font-medium text-slate-800 leading-snug">
                                            {{ $focus }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-xs text-slate-500 italic">Fokus pembelajaran disusun sesuai kurikulum riset terpadu.</p>
                        @endif
                    @endif
                </div>
            </div>

            <!-- Periode 2026-2027: Visi, Misi & Target Capaian (Khusus Software Development) -->
            @if($department->slug === 'software-development')
                <div class="bg-white rounded-2xl p-8 border-2 border-amber-300/80 shadow-md space-y-8 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-gradient-to-br from-amber-200/20 to-transparent rounded-bl-full pointer-events-none"></div>

                    <!-- Header Visi Misi -->
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 border-b border-amber-100 pb-5">
                        <div>
                            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-100 text-amber-900 text-[11px] font-bold uppercase tracking-wider mb-1">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-600"></span>
                                Dokumen Resmi Departemen • Periode 2026–2027
                            </div>
                            <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537]">
                                Visi, Misi & Sasaran Strategis
                            </h2>
                        </div>
                        <span class="text-xs font-semibold text-slate-500 bg-slate-100 px-3 py-1.5 rounded-xl shrink-0">
                            Aktif: 2026 / 2027
                        </span>
                    </div>

                    <!-- Visi Highlight Box -->
                    <div class="p-6 rounded-2xl bg-gradient-to-r from-[#0F2537] to-[#163B59] text-white border-l-4 border-[#C5A059] shadow-inner space-y-2">
                        <span class="text-[11px] font-bold uppercase tracking-widest text-amber-400 block">Visi Departemen</span>
                        <blockquote class="text-base sm:text-lg font-medium italic text-slate-100 leading-relaxed">
                            &ldquo;Menjadi wadah pengembangan talenta mahasiswa dalam bidang software development yang mampu menghasilkan karya nyata, adaptif terhadap perkembangan teknologi, dan siap bersaing di dunia industri.&rdquo;
                        </blockquote>
                    </div>

                    <!-- Grid Misi & Target Capaian -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                        <!-- 5 Misi -->
                        <div class="bg-[#FAF6ED] rounded-2xl p-6 border border-amber-200/80 space-y-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-[#0F2537] text-amber-400 flex items-center justify-center text-xs font-bold">M</span>
                                    <h3 class="text-base font-extrabold text-[#0F2537]">5 Misi Departemen</h3>
                                </div>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">1</span>
                                        <span>Menyelenggarakan pembelajaran terstruktur berbasis praktik (<em>hands-on learning</em>).</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">2</span>
                                        <span>Mengembangkan kemampuan anggota melalui project nyata berbasis studi kasus industri.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">3</span>
                                        <span>Mendorong setiap anggota memiliki portofolio digital sebagai bukti kompetensi riil.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">4</span>
                                        <span>Menyelenggarakan kegiatan publik seperti workshop sebagai sarana berbagi ilmu.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <span class="w-5 h-5 rounded-full bg-amber-200 text-amber-900 text-[11px] font-bold flex items-center justify-center shrink-0 mt-0.5">5</span>
                                        <span>Membangun lingkungan belajar yang kolaboratif dan adaptif terhadap perkembangan teknologi terkini.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- 5 Target & Sasaran Capaian -->
                        <div class="bg-[#FAF6ED] rounded-2xl p-6 border border-amber-200/80 space-y-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="w-7 h-7 rounded-lg bg-[#C5A059] text-white flex items-center justify-center text-xs font-bold">T</span>
                                    <h3 class="text-base font-extrabold text-[#0F2537]">5 Target Capaian Anggota</h3>
                                </div>
                                <ul class="space-y-3">
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Setiap anggota mampu membuat <strong>minimal satu aplikasi siap guna</strong> (web atau mobile).</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Setiap anggota memiliki <strong>portofolio digital publik</strong> (GitHub repository aktif).</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span><strong>Terlaksananya Tech Expo</strong> sebagai panggung pameran output akhir karya riset anggota.</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Terbentuknya <strong>ekosistem silabus berjenjang terpadu</strong> per divisi (Web & Mobile).</span>
                                    </li>
                                    <li class="flex items-start gap-3 text-xs sm:text-sm text-slate-700 leading-snug">
                                        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        <span>Anggota memahami <strong>siklus pengembangan software end-to-end</strong>: riset, arsitektur, koding, hingga deployment.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 4 Program Kerja Aktif (Periode 2026-2027) -->
                <div class="space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Agenda Kerja Resmi</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537] mt-1">4 Program Kerja Unggulan (2026–2027)</h2>
                        <p class="text-slate-600 text-sm mt-1">Rangkaian program terencana untuk mengakselerasi keterampilan rekayasa perangkat lunak seluruh anggota.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Proker 1 -->
                        <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-sm hover:border-amber-400 hover:shadow-md transition-all flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-sm">
                                    01
                                </div>
                                <h3 class="text-base font-bold text-[#0F2537]">Silabus Pembelajaran Terstruktur</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Pelatihan intensif 10 pertemuan terarah per divisi (Web & Mobile) mencakup teori esensial, praktik modul hands-on, dan evaluasi berkelanjutan.
                                </p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-amber-700">
                                <span>10 Pertemuan Intensif</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>

                        <!-- Proker 2 -->
                        <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-sm hover:border-amber-400 hover:shadow-md transition-all flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-sm">
                                    02
                                </div>
                                <h3 class="text-base font-bold text-[#0F2537]">Mini Project Divisi</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Pengerjaan project studi kasus riil di pertengahan kurikulum untuk menguji pemahaman teknis anggota sebelum melangkah ke integrasi sistem.
                                </p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-amber-700">
                                <span>Project Studi Kasus</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>

                        <!-- Proker 3 -->
                        <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-sm hover:border-amber-400 hover:shadow-md transition-all flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-sm">
                                    03
                                </div>
                                <h3 class="text-base font-bold text-[#0F2537]">Tech Talk & Sharing Session</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Diskusi santai berkala bersama praktisi industri, bedah teknologi modern, tips arsitektur software, serta wawasan pengembangan karier IT.
                                </p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-amber-700">
                                <span>Wawasan Industri & Karier</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>

                        <!-- Proker 4 -->
                        <div class="bg-white rounded-2xl p-6 border border-amber-200/80 shadow-sm hover:border-amber-400 hover:shadow-md transition-all flex flex-col justify-between">
                            <div class="space-y-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-sm">
                                    04
                                </div>
                                <h3 class="text-base font-bold text-[#0F2537]">Kolaborasi Antar Divisi</h3>
                                <p class="text-xs text-slate-600 leading-relaxed">
                                    Simulasi tim profesional: Divisi Web merancang RESTful API backend, dan Divisi Mobile mengonsumsinya menjadi aplikasi mobile terintegrasi untuk Expo.
                                </p>
                            </div>
                            <div class="pt-4 mt-4 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-amber-700">
                                <span>Integrasi Web & Mobile</span>
                                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Industrial Team Pipeline Diagram (Web x Mobile) -->
                <div class="bg-white rounded-2xl p-8 border border-amber-200/80 shadow-sm space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Simulasi Alur Industri</span>
                            <h3 class="text-xl sm:text-2xl font-extrabold text-[#0F2537] mt-1">Kolaborasi Terpadu: Web & Mobile Engineering</h3>
                        </div>
                        <span class="text-xs font-bold text-amber-800 bg-amber-100 px-3 py-1 rounded-full border border-amber-300 shrink-0">
                            End-to-End Synergy
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 relative">
                        <div class="p-5 rounded-xl bg-[#FAF6ED] border border-amber-200 flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Tahap 1: Backend & DB</span>
                            <h4 class="text-xs font-bold text-[#0F2537]">Divisi Web Development</h4>
                            <p class="text-[11px] text-slate-600">Merancang skema MySQL, logic Eloquent, dan admin web controller.</p>
                        </div>
                        <div class="p-5 rounded-xl bg-[#FAF6ED] border border-amber-200 flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Tahap 2: RESTful API</span>
                            <h4 class="text-xs font-bold text-[#0F2537]">API Contract & Postman</h4>
                            <p class="text-[11px] text-slate-600">Standarisasi response JSON & dokumentasi endpoint API teruji.</p>
                        </div>
                        <div class="p-5 rounded-xl bg-[#FAF6ED] border border-amber-200 flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700">Tahap 3: Client App</span>
                            <h4 class="text-xs font-bold text-[#0F2537]">Divisi Mobile Development</h4>
                            <p class="text-[11px] text-slate-600">Mengonsumsi REST API, implementasi UI interaktif TypeScript & local storage.</p>
                        </div>
                        <div class="p-5 rounded-xl bg-[#0F2537] text-white flex flex-col justify-between space-y-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-amber-400">Tahap 4: Output Riil</span>
                            <h4 class="text-xs font-bold text-white">GitHub & BPROTIC Expo</h4>
                            <p class="text-[11px] text-slate-300">Portofolio terverifikasi dan aplikasi Android APK yang dapat dicoba publik.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Bidang Keahlian Section -->
            @if($department->slug !== 'iot' && $department->activeFields->count() > 0)
                <div class="space-y-8">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Struktur Peminatan</span>
                        <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537] mt-1">Bidang Keahlian di Bawah {{ $department->name }}</h2>
                        <p class="text-slate-600 text-sm mt-1">Anggota dapat memfokuskan portofolio ke salah satu atau kedua bidang berikut.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 {{ $department->activeFields->count() >= 3 ? 'lg:grid-cols-3' : '' }} gap-6">
                        @foreach($department->activeFields as $field)
                            <div class="bg-white rounded-2xl p-7 border-2 border-amber-200/80 hover:border-amber-400 hover:shadow-lg transition-all duration-300 flex flex-col justify-between group">
                                <div class="space-y-4">
                                    <div class="w-12 h-12 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-sm shadow-md group-hover:scale-110 transition-transform">
                                        @if($field->slug === 'web-development')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/></svg>
                                        @elseif($field->slug === 'mobile-development')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                        @elseif($field->slug === 'data')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                                        @elseif($field->slug === 'machine-learning')
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                        @else
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-[#0F2537]">
                                        {{ $field->name }}
                                    </h3>
                                    <p class="text-slate-600 text-xs sm:text-sm leading-relaxed">
                                        {{ $field->description }}
                                    </p>
                                </div>
                                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                                    <span class="text-[11px] font-semibold text-amber-700">Sub-bidang Terpadu</span>
                                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Teknologi & Tools yang Dipelajari -->
            @if(count($department->technology_list) > 0)
                <div class="bg-white rounded-2xl p-8 border border-amber-200/80 shadow-sm space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Teknologi & Stack</span>
                        <h2 class="text-2xl font-extrabold text-[#0F2537] mt-1">Tools & Bahasa Pemrograman yang Dipelajari</h2>
                        <p class="text-slate-600 text-xs sm:text-sm mt-1">Standar teknologi industri modern yang menjadi materi pelatihan departemen ini.</p>
                    </div>

                    <div class="flex flex-wrap gap-2.5">
                        @foreach($department->technology_list as $tech)
                            <div class="inline-flex items-center gap-2 px-3.5 py-2 rounded-xl bg-[#FAF6ED] border border-amber-200 text-xs font-bold text-[#0F2537] hover:border-amber-400 hover:bg-amber-100/50 transition-colors">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                <span>{{ $tech }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Kegiatan atau Proyek Terkait -->
            @if(isset($latestActivities) && $latestActivities->count() > 0)
                <div class="space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-end gap-2">
                        <div>
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Agenda & Aktivitas</span>
                            <h2 class="text-2xl font-extrabold text-[#0F2537] mt-1">Kegiatan Terkait di UKM BPROTIC</h2>
                        </div>
                        <a href="{{ route('public.activities.index') }}" class="text-xs font-bold text-amber-700 hover:underline">
                            Lihat Semua Kegiatan →
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($latestActivities as $act)
                            <div class="bg-white rounded-2xl overflow-hidden border border-slate-200 shadow-sm hover:shadow-md transition-all flex flex-col justify-between">
                                <div class="p-6 space-y-3">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                        {{ $act->event_date ? $act->event_date->isoFormat('D MMMM Y') : 'Agenda Terbuka' }}
                                    </span>
                                    <h3 class="text-sm font-bold text-[#0F2537]">
                                        <a href="{{ route('public.activities.show', $act->slug) }}" class="hover:text-amber-600 transition-colors">
                                            {{ $act->title }}
                                        </a>
                                    </h3>
                                    <p class="text-slate-600 text-xs line-clamp-2">
                                        {{ $act->excerpt ?? Str::limit(strip_tags($act->description), 100) }}
                                    </p>
                                </div>
                                <div class="px-6 pb-5">
                                    <a href="{{ route('public.activities.show', $act->slug) }}" class="text-xs font-bold text-[#0F2537] hover:underline flex items-center gap-1">
                                        <span>Detail Kegiatan</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Other Departments Navigation -->
            <div class="pt-8 border-t border-amber-200/80">
                <span class="text-xs font-bold uppercase tracking-widest text-slate-500 block mb-4">Departemen Lainnya di BPROTIC:</span>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($otherDepartments as $other)
                        <a href="{{ route('public.departments.show', $other->slug) }}" class="flex items-center justify-between p-4 rounded-xl bg-white border border-amber-200/70 hover:border-amber-400 hover:shadow-sm transition-all group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-xs shrink-0">
                                    @if($other->slug === 'software-development')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/></svg>
                                    @elseif($other->slug === 'iot')
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-[#0F2537] group-hover:text-amber-700 transition-colors block">
                                        {{ $other->name }}
                                    </span>
                                    <span class="text-[11px] text-slate-500 line-clamp-1">
                                        {{ $other->short_description }}
                                    </span>
                                </div>
                            </div>
                            <svg class="w-4 h-4 text-amber-600 group-hover:translate-x-1 transition-transform shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Footer Return CTA -->
            <div class="text-center pt-8">
                <a href="{{ route('public.departments.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all shadow">
                    <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Semua Departemen</span>
                </a>
            </div>

        </div>
    </section>
@endsection
