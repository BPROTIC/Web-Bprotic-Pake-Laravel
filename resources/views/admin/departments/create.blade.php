@extends('layouts.admin')

@section('title', 'Tambah Departemen')
@section('page_title', 'Tambah Departemen Baru')

@section('breadcrumbs')
    <span class="text-slate-400">/</span>
    <a href="{{ route('admin.departments.index') }}" class="hover:text-amber-600 transition-colors">Departemen</a>
    <span class="text-slate-400">/</span>
    <span class="text-slate-800 font-medium">Tambah</span>
@endsection

@section('content')
    <div class="max-w-4xl">
        <form action="{{ route('admin.departments.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                <!-- Nama Departemen -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Departemen <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}"
                           class="w-full px-4 py-2.5 rounded-xl border @error('name') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                           placeholder="Contoh: Software Development Department"
                           required>
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi Singkat -->
                <div>
                    <label for="short_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Deskripsi Singkat
                    </label>
                    <input type="text" 
                           id="short_description" 
                           name="short_description" 
                           value="{{ old('short_description') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                           placeholder="Ringkasan 1-2 kalimat untuk kartu beranda...">
                </div>

                <!-- Deskripsi Lengkap -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Deskripsi Lengkap
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all leading-relaxed"
                              placeholder="Penjelasan menyeluruh visi, misi, dan aktivitas departemen...">{{ old('description') }}</textarea>
                </div>

                <!-- Fokus Pembelajaran (Multiline) -->
                <div>
                    <label for="learning_focus" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tujuan & Fokus Pembelajaran (1 poin per baris)
                    </label>
                    <textarea id="learning_focus" 
                              name="learning_focus" 
                              rows="4" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all leading-relaxed font-mono text-xs"
                              placeholder="Mikrokontroler dan embedded systems&#10;Sensor dan aktuator&#10;Komunikasi perangkat dan protokol IoT&#10;Monitoring perangkat dan pengiriman data&#10;Prototyping dan otomasi berbasis IoT">{{ old('learning_focus') }}</textarea>
                    <span class="text-[11px] text-slate-500 mt-1 block">Tuliskan tiap poin fokus pembelajaran pada baris baru (enter).</span>
                </div>

                <!-- Teknologi yang Dipelajari -->
                <div>
                    <label for="technologies" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Teknologi & Stack (Pisahkan dengan koma)
                    </label>
                    <input type="text" 
                           id="technologies" 
                           name="technologies" 
                           value="{{ old('technologies') }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                           placeholder="Laravel, React, Flutter, Python, ESP32, MQTT, Docker, MySQL">
                </div>

                <!-- Grid Ikon, Urutan, dan Gambar -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-slate-100">
                    <div>
                        <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Urutan Tampilan
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', 1) }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                               min="0">
                    </div>

                    <div>
                        <label for="image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Banner / Foto Dokumentasi
                        </label>
                        <input type="file" 
                               id="image" 
                               name="image" 
                               accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full text-xs text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#FAF6ED] file:text-[#0F2537] hover:file:bg-amber-100 file:cursor-pointer">
                    </div>
                </div>

                <!-- Status Aktif Toggle -->
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <div>
                        <span class="text-xs font-bold text-slate-800">Status Publikasi Departemen</span>
                        <p class="text-[11px] text-slate-500">Tampilkan departemen ini di website publik.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.departments.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 text-xs font-bold transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all shadow-sm">
                    Simpan Departemen
                </button>
            </div>
        </form>
    </div>
@endsection
