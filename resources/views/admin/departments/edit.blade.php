@extends('layouts.admin')

@section('title', 'Edit Departemen: ' . $department->name)
@section('page_title', 'Edit Departemen')

@section('breadcrumbs')
    <span class="text-slate-400">/</span>
    <a href="{{ route('admin.departments.index') }}" class="hover:text-amber-600 transition-colors">Departemen</a>
    <span class="text-slate-400">/</span>
    <span class="text-slate-800 font-medium">{{ $department->name }}</span>
@endsection

@section('header_actions')
    <a href="{{ route('public.departments.show', $department->slug) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-300 text-slate-700 bg-white hover:bg-slate-50 text-xs font-bold transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        <span>Lihat di Website</span>
    </a>
@endsection

@section('content')
    <div class="space-y-10 max-w-5xl">

        <!-- SECTION 1: Form Edit Informasi Departemen -->
        <form action="{{ route('admin.departments.update', $department) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
                <div class="border-b border-slate-100 pb-4">
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Bagian 1</span>
                    <h3 class="text-lg font-bold text-[#0F2537] mt-0.5">Informasi Pokok Departemen</h3>
                </div>

                <!-- Nama Departemen -->
                <div>
                    <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Nama Departemen <span class="text-rose-500">*</span>
                    </label>
                    <input type="text" 
                           id="name" 
                           name="name" 
                           value="{{ old('name', $department->name) }}"
                           class="w-full px-4 py-2.5 rounded-xl border @error('name') border-rose-400 bg-rose-50/30 @else border-slate-300 @enderror focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                           required>
                    @error('name')
                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Deskripsi Singkat -->
                <div>
                    <label for="short_description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Deskripsi Singkat (Muncul pada kartu ringkasan)
                    </label>
                    <input type="text" 
                           id="short_description" 
                           name="short_description" 
                           value="{{ old('short_description', $department->short_description) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all">
                </div>

                <!-- Deskripsi Lengkap -->
                <div>
                    <label for="description" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Deskripsi Lengkap
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all leading-relaxed">{{ old('description', $department->description) }}</textarea>
                </div>

                <!-- Fokus Pembelajaran (Multiline) -->
                <div>
                    <label for="learning_focus" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Tujuan & Fokus Pembelajaran (1 poin per baris)
                    </label>
                    <textarea id="learning_focus" 
                              name="learning_focus" 
                              rows="5" 
                              class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-xs outline-none transition-all font-mono leading-relaxed">{{ old('learning_focus', $department->learning_focus) }}</textarea>
                    <span class="text-[11px] text-slate-500 mt-1 block">Tuliskan tiap poin kurikulum atau fokus riset pada baris baru (enter).</span>
                </div>

                <!-- Teknologi yang Dipelajari -->
                <div>
                    <label for="technologies" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                        Teknologi & Tools yang Dipelajari (Pisahkan dengan koma)
                    </label>
                    <input type="text" 
                           id="technologies" 
                           name="technologies" 
                           value="{{ old('technologies', $department->technologies) }}"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all">
                </div>

                <!-- Grid Urutan & Banner Foto -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-2 border-t border-slate-100">
                    <div>
                        <label for="order" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Urutan Tampilan
                        </label>
                        <input type="number" 
                               id="order" 
                               name="order" 
                               value="{{ old('order', $department->order) }}"
                               class="w-full px-4 py-2.5 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-sm outline-none transition-all"
                               min="0">
                    </div>

                    <div>
                        <label for="image" class="block text-xs font-bold uppercase tracking-wider text-slate-700 mb-1.5">
                            Banner / Dokumentasi Foto (Opsional)
                        </label>
                        @if($department->image)
                            <div class="mb-2 flex items-center gap-2">
                                <img src="{{ asset('storage/' . $department->image) }}" alt="Preview" class="w-12 h-12 object-cover rounded-lg border border-slate-200">
                                <span class="text-[11px] text-slate-500">Foto tersimpan</span>
                            </div>
                        @endif
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
                        <span class="text-xs font-bold text-slate-800">Status Aktif Departemen</span>
                        <p class="text-[11px] text-slate-500">Tampilkan departemen ini di website publik.</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $department->is_active) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-amber-500"></div>
                    </label>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.departments.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-300 hover:bg-slate-100 text-slate-700 text-xs font-bold transition-colors">
                        Kembali
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all shadow-sm">
                        Perbarui Informasi Departemen
                    </button>
                </div>
            </div>
        </form>


        <!-- SECTION 2: Manajemen Bidang Keahlian Terhubung -->
        <div id="bidang" class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-8 shadow-sm space-y-6">
            <div class="border-b border-slate-100 pb-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-600">Bagian 2</span>
                    <h3 class="text-lg font-bold text-[#0F2537] mt-0.5">Bidang Keahlian Terhubung</h3>
                    <p class="text-xs text-slate-500 mt-0.5">
                        Kelola bidang keahlian resmi yang berada di bawah naungan <strong>{{ $department->name }}</strong>. Menambah bidang di sini tidak akan menjadikannya departemen baru.
                    </p>
                </div>
            </div>

            <!-- List of existing fields -->
            @if($department->fields->count() > 0)
                <div class="space-y-3">
                    @foreach($department->fields as $field)
                        <div class="p-4 rounded-xl border border-slate-200 hover:border-amber-300 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 transition-colors">
                            <div class="space-y-1">
                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                    <h4 class="text-sm font-bold text-[#0F2537]">{{ $field->name }}</h4>
                                    <span class="text-[10px] font-mono text-slate-400">({{ $field->slug }})</span>
                                    @if($field->is_active)
                                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="text-[9px] font-bold px-2 py-0.5 rounded-full bg-slate-200 text-slate-600">Nonaktif</span>
                                    @endif
                                </div>
                                <p class="text-xs text-slate-600 max-w-2xl leading-relaxed">
                                    {{ $field->description ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>

                            <!-- Field Actions & Inline Edit Trigger -->
                            <div class="flex items-center gap-2 self-end sm:self-center shrink-0">
                                <button type="button" 
                                        onclick="toggleEditFieldForm('{{ $field->id }}')" 
                                        class="px-3 py-1.5 rounded-lg border border-slate-300 hover:bg-slate-100 text-xs font-bold text-slate-700 transition-colors">
                                    Edit Bidang
                                </button>
                                <form action="{{ route('admin.departments.fields.destroy', $field) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus bidang keahlian {{ $field->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-rose-500 hover:text-rose-700 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus Bidang">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Collapsible Edit Form for this Field -->
                        <div id="edit-field-form-{{ $field->id }}" class="hidden p-5 rounded-xl bg-amber-50/50 border border-amber-200/80 mb-4 transition-all">
                            <form action="{{ route('admin.departments.fields.update', $field) }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                    <div class="sm:col-span-8">
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Nama Bidang Keahlian</label>
                                        <input type="text" name="name" value="{{ $field->name }}" required class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs outline-none focus:border-amber-500">
                                    </div>
                                    <div class="sm:col-span-4">
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Urutan</label>
                                        <input type="number" name="order" value="{{ $field->order }}" min="0" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs outline-none focus:border-amber-500">
                                    </div>
                                    <div class="sm:col-span-12">
                                        <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Bidang</label>
                                        <textarea name="description" rows="2" class="w-full px-3 py-2 rounded-lg border border-slate-300 text-xs outline-none focus:border-amber-500">{{ $field->description }}</textarea>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between pt-2">
                                    <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-medium text-slate-700">
                                        <input type="checkbox" name="is_active" value="1" {{ $field->is_active ? 'checked' : '' }} class="rounded text-amber-500 focus:ring-amber-400">
                                        <span>Aktifkan Bidang</span>
                                    </label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" onclick="toggleEditFieldForm('{{ $field->id }}')" class="px-3 py-1.5 rounded-lg border border-slate-300 hover:bg-slate-100 text-xs font-bold text-slate-700">
                                            Tutup
                                        </button>
                                        <button type="submit" class="px-4 py-1.5 rounded-lg bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold shadow-sm">
                                            Simpan Perubahan
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 bg-slate-50 rounded-xl border border-dashed border-slate-300">
                    <p class="text-xs text-slate-500 italic">
                        @if($department->slug === 'iot')
                            Departemen IoT menggunakan struktur 5 fokus pembelajaran terpadu. Anda tetap dapat menambahkan bidang spesifik jika diperlukan.
                        @else
                            Belum ada bidang keahlian di bawah departemen ini.
                        @endif
                    </p>
                </div>
            @endif

            <!-- Form Tambah Bidang Keahlian Baru -->
            <div class="pt-4 border-t border-slate-100">
                <h4 class="text-xs font-bold uppercase tracking-wider text-slate-800 mb-3 flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Tambah Bidang Keahlian Baru di {{ $department->name }}</span>
                </h4>

                <form action="{{ route('admin.departments.fields.store', $department) }}" method="POST" class="bg-[#FAF6ED] p-5 rounded-2xl border border-amber-200/80 space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                        <div class="sm:col-span-8">
                            <label for="new_field_name" class="block text-xs font-bold text-slate-700 mb-1">
                                Nama Bidang Keahlian <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" 
                                   id="new_field_name" 
                                   name="name" 
                                   placeholder="Contoh: Web Development" 
                                   required 
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-xs outline-none bg-white">
                        </div>
                        <div class="sm:col-span-4">
                            <label for="new_field_order" class="block text-xs font-bold text-slate-700 mb-1">
                                Urutan
                            </label>
                            <input type="number" 
                                   id="new_field_order" 
                                   name="order" 
                                   value="{{ $department->fields->count() + 1 }}" 
                                   min="0" 
                                   class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-xs outline-none bg-white">
                        </div>
                        <div class="sm:col-span-12">
                            <label for="new_field_description" class="block text-xs font-bold text-slate-700 mb-1">
                                Deskripsi Bidang
                            </label>
                            <textarea id="new_field_description" 
                                      name="description" 
                                      rows="2" 
                                      placeholder="Penjelasan keahlian dan fokus materi pada bidang ini..." 
                                      class="w-full px-3.5 py-2 rounded-xl border border-slate-300 focus:border-amber-500 focus:ring-2 focus:ring-amber-200 text-xs outline-none bg-white"></textarea>
                        </div>
                    </div>

                    <div class="flex items-center justify-between pt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer text-xs font-medium text-slate-700">
                            <input type="checkbox" name="is_active" value="1" checked class="rounded text-amber-500 focus:ring-amber-400">
                            <span>Aktifkan Bidang Ini Langsung</span>
                        </label>
                        <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all shadow-sm">
                            + Tambahkan ke {{ $department->name }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>

    @push('scripts')
        <script>
            function toggleEditFieldForm(fieldId) {
                const el = document.getElementById('edit-field-form-' + fieldId);
                if (el) {
                    el.classList.toggle('hidden');
                }
            }
        </script>
    @endpush
@endsection
