@extends('layouts.admin')

@section('title', 'Pengaturan Website')
@section('page_title', 'Pengaturan Website')
@section('breadcrumb', 'Konfigurasi identitas organisasi, kontak, dan tautan media sosial')

@section('content')
<div class="max-w-4xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4">
        <h2 class="text-base font-bold text-[#0F2537]">Konfigurasi Identitas BPROTIC</h2>
        <p class="text-xs text-slate-500">Nilai-nilai ini akan otomatis ditampilkan di header, hero banner, dan footer website publik.</p>
    </div>

    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="space-y-4">
            <h3 class="text-xs font-bold text-amber-700 uppercase tracking-wider">Identitas Utama</h3>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="site_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Organisasi / Situs</label>
                    <input type="text" id="site_name" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? '') }}" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <div>
                    <label for="site_tagline" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Tagline Resmi</label>
                    <input type="text" id="site_tagline" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <div>
                <label for="site_description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Singkat Organisasi</label>
                <textarea id="site_description" name="site_description" rows="3"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-xs font-bold text-amber-700 uppercase tracking-wider">Pemesanan Produk</h3>
            <div>
                <label for="commerce_whatsapp" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor WhatsApp Pengurus (format internasional, contoh 62812...)</label>
                <input type="text" id="commerce_whatsapp" name="commerce_whatsapp" value="{{ old('commerce_whatsapp', $settings['commerce_whatsapp'] ?? '') }}" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none" placeholder="62812...">
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-xs font-bold text-amber-700 uppercase tracking-wider">Kontak & Sekretariat</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="site_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Email Resmi</label>
                    <input type="email" id="site_email" name="site_email" value="{{ old('site_email', $settings['site_email'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <div>
                    <label for="site_phone" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nomor Telepon / WhatsApp</label>
                    <input type="text" id="site_phone" name="site_phone" value="{{ old('site_phone', $settings['site_phone'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>

            <div>
                <label for="site_address" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Sekretariat Lengkap</label>
                <textarea id="site_address" name="site_address" rows="2"
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">{{ old('site_address', $settings['site_address'] ?? '') }}</textarea>
            </div>
        </div>

        <div class="space-y-4 pt-4 border-t border-slate-100">
            <h3 class="text-xs font-bold text-amber-700 uppercase tracking-wider">Tautan Media Sosial</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="social_instagram" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL Instagram</label>
                    <input type="url" id="social_instagram" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="https://instagram.com/...">
                </div>

                <div>
                    <label for="social_youtube" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL YouTube</label>
                    <input type="url" id="social_youtube" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="https://youtube.com/...">
                </div>

                <div>
                    <label for="social_linkedin" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL LinkedIn</label>
                    <input type="url" id="social_linkedin" name="social_linkedin" value="{{ old('social_linkedin', $settings['social_linkedin'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>

                <div>
                    <label for="social_github" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">URL GitHub</label>
                    <input type="url" id="social_github" name="social_github" value="{{ old('social_github', $settings['social_github'] ?? '') }}"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end">
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">
                Simpan Perubahan Pengaturan
            </button>
        </div>
    </form>
</div>
@endsection
