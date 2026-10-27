@extends('layouts.public')

@section('title', 'Gabung Bersama Kami')
@section('meta_description', 'Formulir pendaftaran anggota baru dan kontak langsung pengurus UKM BPROTIC Universitas Buana Perjuangan Karawang via WhatsApp.')

@section('content')
    <!-- Galaxy Interactive Hero Banner -->
    <div class="bg-[#0F2537] text-white py-14 sm:py-16 border-b-4 border-amber-500 relative overflow-hidden" data-galaxy="true">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-3 relative z-10">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-500/20 text-amber-300 border border-amber-400/40 text-[11px] font-bold uppercase tracking-widest">
                <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                Pendaftaran & Kolaborasi Riset
            </span>
            <h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-white">
                Gabung Bersama <span class="text-amber-400">BPROTIC</span>
            </h1>
            <p class="text-slate-300 text-xs sm:text-sm max-w-2xl mx-auto leading-relaxed">
                Salurkan minat dan kembangkan potensimu di bidang <strong>Software Development</strong>, <strong>Internet of Things & Robotika</strong>, atau <strong>Data Science</strong>. Kirimkan data Anda untuk langsung terhubung ke WhatsApp pengurus kami.
            </p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <!-- Left: Registration & Contact Form -->
            <div class="lg:col-span-7 bg-white p-6 sm:p-10 rounded-3xl border border-slate-200/80 shadow-xl space-y-6">
                <div>
                    <div class="flex items-center gap-2 mb-1">
                        <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                        <h2 class="text-xl sm:text-2xl font-black text-[#0F2537]">Formulir Gabung & Hubungi Pengurus</h2>
                    </div>
                    <p class="text-xs text-slate-500 leading-relaxed">
                        Lengkapi formulir berikut. Data Anda akan langsung dirangkum dan <strong>diarahkan otomatis ke WhatsApp resmi pengurus (+62 815-8568-9636)</strong>.
                    </p>
                </div>

                <form id="contactWaForm" action="{{ route('public.contact.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Nama Lengkap <span class="text-rose-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50"
                            placeholder="Contoh: Muhammad Farras Subahan">
                        @error('name') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Program Studi / Angkatan -->
                        <div>
                            <label for="institution" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Program Studi / Angkatan
                            </label>
                            <input type="text" id="institution" name="institution"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50"
                                placeholder="Contoh: IF 2024 / UBP Karawang">
                        </div>

                        <!-- Pilihan Departemen / Minat -->
                        <div>
                            <label for="department_interest" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Minat Departemen <span class="text-rose-500">*</span>
                            </label>
                            <select id="department_interest" name="department_interest" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50">
                                <option value="Software Development (Web & Mobile)">Software Development (Web & Mobile)</option>
                                <option value="Internet of Things (IoT) & Robotics">Internet of Things (IoT) & Robotika</option>
                                <option value="Data Science & Artificial Intelligence">Data Science & AI</option>
                                <option value="Kerjasama / Partnership Workshop">Kerjasama / Partnership / Workshop</option>
                                <option value="Pertanyaan Umum / Info Pendaftaran">Pertanyaan Umum / Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Alamat Email -->
                        <div>
                            <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50"
                                placeholder="nama@email.com">
                            @error('email') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Nomor WhatsApp Pengirim -->
                        <div>
                            <label for="phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                Nomor WhatsApp Anda
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50"
                                placeholder="08xxxxxxxxxx">
                            @error('phone') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Subjek / Perihal Hidden or Optional -->
                    <input type="hidden" id="subject" name="subject" value="Pendaftaran & Gabung Bersama BPROTIC">

                    <!-- Isi Pesan / Motivasi -->
                    <div>
                        <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                            Pesan / Motivasi Bergabung <span class="text-rose-500">*</span>
                        </label>
                        <textarea id="message" name="message" rows="4" required
                            class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm bg-slate-50/50"
                            placeholder="Tuliskan alasan atau motivasi Anda ingin bergabung dengan UKM BPROTIC, atau hal yang ingin Anda tanyakan...">{{ old('message') }}</textarea>
                        @error('message') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" id="btnSubmitWa"
                            class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-700 hover:from-emerald-500 hover:to-teal-600 text-white font-black text-sm uppercase tracking-wider transition-all shadow-lg hover:shadow-emerald-500/30 flex items-center justify-center gap-3 active:scale-[0.99] cursor-pointer">
                            <!-- WhatsApp Icon -->
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.155.57 4.178 1.564 5.926l-1.664 6.074 6.236-1.636c1.691.921 3.633 1.436 5.864 1.436 6.627 0 12-5.373 12-12s-5.373-12-12-12zm0 21.6c-1.894 0-3.659-.533-5.163-1.455l-.37-.225-3.693.969.986-3.599-.247-.393c-1.028-1.635-1.573-3.528-1.573-5.503 0-5.293 4.307-9.6 9.6-9.6s9.6 4.307 9.6 9.6-4.307 9.6-9.6 9.6z"/>
                            </svg>
                            <span>Kirim & Hubungi via WhatsApp</span>
                        </button>
                    </div>

                    <p class="text-[11px] text-center text-slate-400">
                        Nomor WhatsApp Resmi Pengurus: <strong class="text-emerald-700">0815-8568-9636</strong>
                    </p>
                </form>
            </div>

            <!-- Right: Info Details & Fast WhatsApp CTA -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Direct WhatsApp Card -->
                <div class="bg-gradient-to-br from-[#0F2537] to-[#13334C] text-white p-7 sm:p-8 rounded-3xl border border-amber-500/30 shadow-xl relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="relative z-10 space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center border border-emerald-500/30 shadow-inner">
                            <svg class="w-7 h-7 fill-current" viewBox="0 0 24 24">
                                <path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86.174.086.275.072.376-.043.101-.116.433-.506.549-.68.116-.173.231-.145.39-.086s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.423-14.416c-6.627 0-12 5.373-12 12 0 2.155.57 4.178 1.564 5.926l-1.664 6.074 6.236-1.636c1.691.921 3.633 1.436 5.864 1.436 6.627 0 12-5.373 12-12s-5.373-12-12-12zm0 21.6c-1.894 0-3.659-.533-5.163-1.455l-.37-.225-3.693.969.986-3.599-.247-.393c-1.028-1.635-1.573-3.528-1.573-5.503 0-5.293 4.307-9.6 9.6-9.6s9.6 4.307 9.6 9.6-4.307 9.6-9.6 9.6z"/>
                            </svg>
                        </div>
                        <div>
                            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest block">Direct WhatsApp Chat</span>
                            <h3 class="text-xl font-extrabold text-white">0815-8568-9636</h3>
                            <p class="text-xs text-slate-300 mt-1">
                                Butuh informasi cepat? Anda dapat langsung membuka percakapan WhatsApp dengan pengurus sekarang.
                            </p>
                        </div>
                        <a href="https://wa.me/6281585689636?text={{ rawurlencode("Halo Pengurus UKM BPROTIC, perkenalkan saya ingin berkonsultasi mengenai pendaftaran anggota baru dan kegiatan riset teknologi di BPROTIC UBP Karawang. Terima kasih.") }}"
                            target="_blank"
                            class="inline-flex items-center justify-center gap-2 w-full py-3 rounded-xl bg-emerald-500 hover:bg-emerald-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-md">
                            <span>Chat WhatsApp Langsung</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Benefits Card -->
                <div class="bg-white p-7 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-[#0F2537] flex items-center gap-2">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Keuntungan Bergabung di BPROTIC
                    </h3>
                    <ul class="space-y-3 text-xs text-slate-600">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                            <span><strong>Riset Nyata:</strong> Praktik langsung pemrograman web/mobile, mikrokontroler IoT, sensor, dan machine learning.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                            <span><strong>Dukungan Lomba:</strong> Dibimbing dan difasilitasi mengikuti kompetisi nasional seperti KRI, Gemastik, dan Hackathon.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 mt-1.5 flex-shrink-0"></span>
                            <span><strong>Komunitas & Jaringan:</strong> Berkolaborasi dengan sesama penggiat teknologi kampus dan jaringan alumni industri.</span>
                        </li>
                    </ul>
                </div>

                <!-- Secretariat Card -->
                <div class="bg-white p-7 sm:p-8 rounded-3xl border border-slate-200/80 shadow-sm space-y-4">
                    <h3 class="text-base font-bold text-[#0F2537]">Informasi Sekretariat</h3>
                    <div class="space-y-3.5 text-xs text-slate-600">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <span class="font-bold text-slate-800 block">Alamat Kampus:</span>
                                Gedung Ormawa Kampus UBP Karawang, Jl. HS. Ronggowaluyo, Telukjambe Timur, Karawang.
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 rounded-lg bg-amber-500/10 text-amber-600 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <span class="font-bold text-slate-800 block">Email Resmi:</span>
                                <a href="mailto:{{ \App\Models\Setting::get('site_email', 'ukm.bprotic@ubpkarawang.ac.id') }}" class="text-amber-700 hover:underline">
                                    {{ \App\Models\Setting::get('site_email', 'ukm.bprotic@ubpkarawang.ac.id') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('contactWaForm');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('name').value.trim();
            const institution = document.getElementById('institution').value.trim();
            const dept = document.getElementById('department_interest').value;
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();

            if (!name || !email || !message) {
                alert('Silakan lengkapi nama, email, dan pesan terlebih dahulu.');
                return;
            }

            // Construct Clean, Elegant & Professional WhatsApp Message
            let waText = `*FORMULIR PENDAFTARAN & KONTAK CALON ANGGOTA*\n`;
            waText += `*UKM BPROTIC — UNIVERSITAS BUANA PERJUANGAN KARAWANG*\n`;
            waText += `──────────────────────────────\n\n`;
            waText += `Kepada Yth. Pengurus UKM BPROTIC,\n\n`;
            waText += `Perkenalkan, saya bermaksud untuk mengajukan pendaftaran dan bergabung dengan UKM BPROTIC melalui website resmi. Berikut adalah rincian data diri saya:\n\n`;
            waText += `• *Nama Lengkap:* ${name}\n`;
            if (institution) {
                waText += `• *Program Studi / Angkatan:* ${institution}\n`;
            }
            waText += `• *Pilihan Departemen:* ${dept}\n`;
            waText += `• *Alamat Email:* ${email}\n`;
            if (phone) {
                waText += `• *Nomor WhatsApp:* ${phone}\n`;
            }
            waText += `\n*Pesan & Motivasi Bergabung:*\n`;
            waText += `"${message}"\n\n`;
            waText += `──────────────────────────────\n`;
            waText += `Mohon informasi dan arahan mengenai tahapan selanjutnya. Terima kasih banyak atas perhatian dan waktu Kakak Pengurus.\n\n`;
            waText += `Hormat saya,\n`;
            waText += `*${name}*`;

            const targetPhone = '6281585689636';
            const waUrl = 'https://wa.me/' + targetPhone + '?text=' + encodeURIComponent(waText);

            // Submit in background to save record in database/admin panel
            try {
                const formData = new FormData(form);
                formData.set('subject', `[Pendaftaran BPROTIC] ${dept}`);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                }).catch(() => {});
            } catch (err) {}

            // Immediately redirect to WhatsApp
            window.location.href = waUrl;
        });
    });
</script>
@endpush
