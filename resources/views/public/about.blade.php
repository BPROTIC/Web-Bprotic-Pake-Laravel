@extends('layouts.public')

@section('title', 'Tentang Kami')
@section('meta_description',
    'Profil lengkap, sejarah, dan divisi riset UKM BPROTIC Universitas Buana Perjuangan
    Karawang.')

@section('content')
    <!-- Page Header Banner -->
    <div class="bg-[#0F2537] text-white py-14 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-2 relative z-10">
            <span class="text-xs font-bold uppercase tracking-widest text-amber-400">Profil Organisasi</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Tentang UKM BPROTIC</h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-xl mx-auto">
                Mengenal lebih dekat visi, sejarah, dan nilai-nilai yang dibangun di Universitas Buana Perjuangan Karawang.
            </p>
        </div>
    </div>

    <!-- Main Content Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-16">
        <!-- Visi & Misi Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#0F2537]">Visi BPROTIC</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    {{-- Menjadi unit kegiatan mahasiswa unggulan yang kompetitif, inovatif, dan beretika dalam bidang rekayasa perangkat lunak, sains komputasi, dan robotika guna mengharumkan nama Universitas Buana Perjuangan Karawang di tingkat nasional dan global. --}}
                    Menjadi UKM teknologi yang inovatif, kolaboratif, dan unggul dalam menciptakan produk digital serta
                    berprestasi di tingkat nasional maupun internasional.
                </p>
            </div>

            <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm space-y-4">
                <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#0F2537]">Misi BPROTIC</h2>
                <ul class="text-slate-600 text-sm space-y-2 list-disc list-inside leading-relaxed">
                    <li>OpenSourceLearning: Wadah belajar terbuka untuk seluruh jurusan.</li>
                    <li>Project-Based: Mengembangkan skill melalui proyek nyata.</li>
                    <li>Produk Inovatif: Melahirkan karya teknologi tiap semester.</li>
                    <li>Prestasi Lomba: Aktif berkompetisi internal & eksternal.</li>
                </ul>
            </div>
        </div>

        <!-- Sejarah & Transformasi BPROTIC (Timeline & Rekam Jejak) -->
        <div class="space-y-10">
            <div class="text-center space-y-2 max-w-3xl mx-auto">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Rekam Jejak & Dedikasi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537]">Sejarah & Transformasi BPROTIC</h2>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Perjalanan dedikasi mahasiswa Universitas Buana Perjuangan Karawang dalam mendemokratisasi riset robotika, membangun budaya riset mandiri, hingga melahirkan inovasi teknologi terpadu.
                </p>
            </div>

            <!-- Ringkasan Profil & Visi Awal -->
            <div class="bg-gradient-to-br from-[#0F2537] to-[#13334C] text-white rounded-2xl p-6 sm:p-8 border border-amber-500/30 shadow-md relative overflow-hidden" data-galaxy="true">
                <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-amber-400/10 rounded-full blur-2xl pointer-events-none"></div>
                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div class="space-y-2 max-w-2xl">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/20 text-amber-300 text-xs font-semibold">
                            <span>Berdiri Sejak 2016</span>
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span>Pusat Riset Mahasiswa UBP Karawang</span>
                        </div>
                        <p class="text-slate-200 text-sm sm:text-base leading-relaxed">
                            Unit Kegiatan Mahasiswa <strong>Buana Perjuangan University Robotics Club (UKM BPROTIC)</strong> didirikan sebagai wadah riset terapan, inovasi rekayasa perangkat lunak, dan teknologi otomasi bagi mahasiswa Universitas Buana Perjuangan Karawang guna mencetak talenta unggul yang berintegritas dan mampu bersaing di kancah nasional maupun global.
                        </p>
                    </div>
                    <div class="grid grid-cols-2 gap-3 shrink-0 w-full md:w-auto">
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3.5 text-center border border-white/10">
                            <div class="text-2xl font-extrabold text-amber-400">2016</div>
                            <div class="text-[11px] text-slate-300">Tahun Berdiri</div>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm rounded-xl p-3.5 text-center border border-white/10">
                            <div class="text-2xl font-extrabold text-amber-400">4 Fase</div>
                            <div class="text-[11px] text-slate-300">Evolusi Riset</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Timeline Milestones -->
            <div class="relative border-l-2 border-amber-300/60 ml-4 sm:ml-8 pl-6 sm:pl-10 space-y-10">
                <!-- Fase 1: 2016 -->
                <div class="relative group">
                    <!-- Marker Node -->
                    <div class="absolute -left-[35px] sm:-left-[51px] top-1.5 w-6 h-6 rounded-full bg-[#0F2537] border-4 border-amber-400 shadow-md group-hover:scale-110 transition-transform"></div>
                    
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-md bg-amber-500 text-slate-950 font-bold text-xs tracking-wider uppercase">
                                    2016
                                </span>
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    Fase 01 • Perintisan & Fondasi
                                </span>
                            </div>
                            <span class="text-xs text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full font-medium">Awal Pendirian</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-[#0F2537]">
                            1. Latar Belakang & Awal Pendirian di Kota Industri
                        </h3>

                        <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-3">
                            <p>
                                Universitas Buana Perjuangan (UBP) Karawang resmi mendapatkan izin operasional pada akhir tahun 2014 dan mulai aktif menyelenggarakan perkuliahan pada tahun 2015. Berdiri di tengah kota industri terbesar di Indonesia, kebutuhan mahasiswa akan ruang riset dan laboratorium teknologi terapan sangatlah mendesak.
                            </p>
                            <p>
                                Menangkap peluang tersebut, sekelompok mahasiswa perintis dari program studi di bawah Fakultas Teknik dan Ilmu Komputer—khususnya <strong>Teknik Informatika</strong> dan <strong>Sistem Informasi</strong>—mengambil inisiatif mendirikan klub robotika kampus bernama resmi <strong>Buana Perjuangan University Robotics Club (BPROTIC)</strong> pada tahun 2016.
                            </p>
                            <div class="p-3.5 rounded-xl bg-amber-50/80 border-l-4 border-amber-500 text-slate-800 text-xs sm:text-sm leading-relaxed">
                                <strong>Misi Awal BPROTIC:</strong> Menghilangkan stigma bahwa merakit robot itu rumit dan berbiaya mahal, serta membuka ruang kolaborasi inklusif bagi mahasiswa di Karawang untuk memiliki wadah kompetisi dan berdaya saing di kancah teknologi nasional.
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Teknik Informatika & SI</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">UBP Karawang 2015</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Demokratisasi Robotika</span>
                        </div>
                    </div>
                </div>

                <!-- Fase 2: 2017 -->
                <div class="relative group">
                    <!-- Marker Node -->
                    <div class="absolute -left-[35px] sm:-left-[51px] top-1.5 w-6 h-6 rounded-full bg-[#0F2537] border-4 border-amber-400 shadow-md group-hover:scale-110 transition-transform"></div>
                    
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-md bg-amber-500 text-slate-950 font-bold text-xs tracking-wider uppercase">
                                    2017
                                </span>
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    Fase 02 • Budaya Riset & Laboratorium
                                </span>
                            </div>
                            <span class="text-xs text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full font-medium">Kultur Organisasi</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-[#0F2537]">
                            2. Budaya "Sabtu Ngoprek" & Markas Riset Laboratorium Lantai 2
                        </h3>

                        <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-3">
                            <p>
                                Pada masa-masa awal berdirinya, tantangan terbesar BPROTIC adalah keterbatasan fasilitas alat serta komponen elektronika. Namun, keterbatasan tersebut disiasati dengan membangun kultur internal yang solid, mandiri, dan suportif.
                            </p>
                            <p>
                                Anggota BPROTIC menjadikan ruang <strong>laboratorium di Lantai 2 Kampus UBP Karawang</strong> sebagai markas riset dan bengkel perakitan utama. Sejak tahun 2017, lahirlah agenda rutin legendaris setiap akhir pekan yang dinamai <strong>"Sabtu Ngoprek"</strong>.
                            </p>
                            <p>
                                Mulai pukul 08.30 pagi hingga menjelang petang, para anggota berkumpul di laboratorium untuk membedah mikrokontroler, melatih presisi keterampilan menyolder sirkuit, hingga mempelajari pemrograman sensor dasar secara intensif dan saling berbagi wawasan.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Lab Lantai 2 Kampus</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Sabtu Ngoprek (08.30 - Sore)</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Mikrokontroler & Soldering</span>
                        </div>
                    </div>
                </div>

                <!-- Fase 3: 2018 -->
                <div class="relative group">
                    <!-- Marker Node -->
                    <div class="absolute -left-[35px] sm:-left-[51px] top-1.5 w-6 h-6 rounded-full bg-[#0F2537] border-4 border-amber-400 shadow-md group-hover:scale-110 transition-transform"></div>
                    
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-md bg-amber-500 text-slate-950 font-bold text-xs tracking-wider uppercase">
                                    2018
                                </span>
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    Fase 03 • Eksplorasi & Otomatisasi
                                </span>
                            </div>
                            <span class="text-xs text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full font-medium">Evolusi Riset Terapan</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-[#0F2537]">
                            3. Eksplorasi Sensor Aplikatif & Otomatisasi Cerdas
                        </h3>

                        <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-3">
                            <p>
                                Seiring kematangan organisasi, materi riset di BPROTIC tidak lagi sekadar merakit robot <em>Line Follower</em> dasar. Memasuki akhir tahun 2018, BPROTIC mulai memfokuskan eksplorasi pada sensor-sensor yang aplikatif untuk kebutuhan industri modern maupun sistem otomasi kehidupan sehari-hari:
                            </p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-1">
                                <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200/80 space-y-1">
                                    <div class="font-bold text-xs text-[#0F2537] flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Ultrasonic Sensor
                                    </div>
                                    <p class="text-slate-600 text-xs leading-relaxed">
                                        Pengukuran jarak objek presisi sebagai fondasi navigasi robot penghindar rintangan (<em>obstacle avoidance</em>).
                                    </p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200/80 space-y-1">
                                    <div class="font-bold text-xs text-[#0F2537] flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        Raindrops Detector
                                    </div>
                                    <p class="text-slate-600 text-xs leading-relaxed">
                                        Sensor pendeteksi hujan untuk pengembangan prototipe sistem proteksi hunian pintar (<em>smart home</em>).
                                    </p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-3.5 border border-slate-200/80 space-y-1">
                                    <div class="font-bold text-xs text-[#0F2537] flex items-center gap-1.5">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                        7-Segment & Arduino
                                    </div>
                                    <p class="text-slate-600 text-xs leading-relaxed">
                                        Eksperimen antarmuka penampil angka digital untuk instrumen dan sistem perhitungan otomatis.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Ultrasonic Obstacle Avoidance</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Raindrops Detector (Smart Home)</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">7-Segment Display & Arduino</span>
                        </div>
                    </div>
                </div>

                <!-- Fase 4: 2022 - Sekarang -->
                <div class="relative group">
                    <!-- Marker Node -->
                    <div class="absolute -left-[35px] sm:-left-[51px] top-1.5 w-6 h-6 rounded-full bg-[#0F2537] border-4 border-amber-400 shadow-md group-hover:scale-110 transition-transform"></div>
                    
                    <div class="bg-white rounded-2xl p-6 sm:p-8 border border-slate-200/80 shadow-sm hover:border-amber-300 hover:shadow-md transition-all space-y-4">
                        <div class="flex flex-wrap items-center justify-between gap-2 border-b border-slate-100 pb-3">
                            <div class="flex items-center gap-2">
                                <span class="px-2.5 py-1 rounded-md bg-amber-500 text-slate-950 font-bold text-xs tracking-wider uppercase">
                                    2022 - Sekarang
                                </span>
                                <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">
                                    Fase 04 • Transformasi Multidisiplin
                                </span>
                            </div>
                            <span class="text-xs text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-full font-medium">Era Modern & KRI</span>
                        </div>

                        <h3 class="text-lg sm:text-xl font-bold text-[#0F2537]">
                            4. Transformasi Multidisiplin & Masa Depan BPROTIC Menuju Kontes Robot Indonesia (KRI)
                        </h3>

                        <div class="text-slate-700 text-sm sm:text-base leading-relaxed space-y-3">
                            <p>
                                Dengan pemekaran fakultas di UBP Karawang pada tahun 2022—seperti berdirinya <strong>Fakultas Ilmu Komputer</strong> serta hadirnya program studi <strong>Teknik Mesin</strong>—BPROTIC bertransformasi menjadi unit kegiatan mahasiswa riset yang sangat dinamis dan multidisipliner.
                            </p>
                            <p>
                                Keanggotaan BPROTIC kini menjadi wadah kolaborasi lintas disiplin ilmu yang komplementer: mahasiswa <strong>Teknik Mesin</strong> merancang struktur kerangka mekanis presisi (<em>hardware engineering</em>), sementara mahasiswa <strong>Teknik Informatika</strong> dan <strong>Sistem Informasi</strong> menyuntikkan algoritma sistem cerdas, arsitektur software, serta kecerdasan buatan (<em>software & AI</em>).
                            </p>
                            <p>
                                Kini, BPROTIC terus konsisten menjadi inkubator regenerasi bagi mahasiswa UBP Karawang dalam menguasai keahlian <em>Embedded Systems</em>, <em>Internet of Things (IoT)</em>, <em>Full-Stack Software Development</em>, hingga persiapan berkesinambungan menuju ajang kompetisi robotika tertinggi tanah air: <strong>Kontes Robot Indonesia (KRI)</strong>.
                            </p>
                        </div>

                        <div class="flex flex-wrap gap-2 pt-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Fakultas Ilmu Komputer & Teknik Mesin</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Sinergi Hardware & Software/AI</span>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[11px] font-medium bg-slate-100 text-slate-700">Persiapan Kontes Robot Indonesia (KRI)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Departemen Utama BPROTIC -->
        <div class="space-y-8">
            <div class="text-center space-y-2">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-600">Struktur Riset & Inovasi</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-[#0F2537]">3 Departemen Utama BPROTIC</h2>
                <p class="text-slate-600 text-sm max-w-xl mx-auto">Mewadahi eksplorasi minat, peningkatan keterampilan
                    teknologi, dan inkubasi proyek anggota.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($departments as $dept)
                    <div
                        class="bg-white p-7 rounded-2xl border border-amber-200 shadow-sm space-y-4 flex flex-col justify-between hover:border-amber-400 hover:shadow-md transition-all">
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-10 h-10 rounded-xl bg-[#0F2537] text-amber-400 flex items-center justify-center font-bold text-xs shadow">
                                    0{{ $loop->iteration }}
                                </div>
                                <h3 class="text-base font-bold text-[#0F2537]">{{ $dept->name }}</h3>
                            </div>
                            <p class="text-slate-600 text-xs leading-relaxed">
                                {{ $dept->short_description ?? Str::limit($dept->description, 120) }}
                            </p>
                        </div>
                        <div class="pt-3 border-t border-slate-100">
                            <a href="{{ route('public.departments.show', $dept->slug) }}"
                                class="inline-flex items-center gap-1.5 text-xs font-bold text-[#0F2537] hover:text-amber-600 transition-colors">
                                <span>Lihat Departemen & Riset</span>
                                <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
