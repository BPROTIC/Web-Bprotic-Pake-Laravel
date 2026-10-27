@extends('layouts.admin')

@section('title', 'Katalog Produk & Inovasi')
@section('page_title', 'Katalog Produk & Inovasi')
@section('breadcrumb', 'Kelola produk fisik, jasa teknologi, dan produk digital BPROTIC')

@section('content')
<div class="space-y-6">
    <!-- Top Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Daftar Produk & Merchandise</h2>
            <p class="text-xs text-slate-500">Kelola katalog inventaris produk, merchandise, dan jasa teknologi BPROTIC.</p>
        </div>

        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-sm cursor-pointer shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Produk Baru</span>
        </button>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-16 text-center" data-no-sort="true">Foto</th>
                        <th class="py-3.5 px-4">Nama Produk</th>
                        <th class="py-3.5 px-4">Jenis</th>
                        <th class="py-3.5 px-4">Harga</th>
                        <th class="py-3.5 px-4">Ketersediaan</th>
                        <th class="py-3.5 px-4 text-center">Status</th>
                        <th class="py-3.5 px-4 text-right" data-no-sort="true">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($products as $product)
                        @php
                            $imgUrl = $product->image ? (file_exists(public_path($product->image)) ? asset($product->image) : asset('storage/' . $product->image)) : '';
                        @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3 px-4 text-center">
                                @if($imgUrl)
                                    <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="w-12 h-10 object-cover rounded-lg border border-slate-200 mx-auto shadow-xs">
                                @else
                                    <div class="w-12 h-10 rounded-lg bg-slate-100 border border-slate-200 text-[10px] text-slate-400 flex items-center justify-center mx-auto">No img</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900 max-w-xs">
                                <div>{{ $product->name }}</div>
                                <div class="text-[11px] text-slate-400 font-normal truncate">{{ $product->description }}</div>
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold bg-slate-100 text-slate-700">
                                    {{ ['physical' => 'Barang Fisik', 'service' => 'Jasa / Riset', 'digital' => 'Digital'][$product->type] ?? $product->type }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-800">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="py-3.5 px-4">
                                @if($product->availability === 'available')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Tersedia</span>
                                @elseif($product->availability === 'preorder')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Pre-Order</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Habis</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-center">
                                @if($product->is_published)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Terbit</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-200 text-slate-700">Draft</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button type="button" 
                                    onclick='openEditModal(@json($product), "{{ $imgUrl }}")'
                                    title="Edit Produk" 
                                    class="inline-block p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Produk" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-xs text-slate-400 italic">Belum ada produk terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ================= CREATE PRODUCT MODAL ================= -->
<div id="createProductModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative my-8">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-[#0F2537]">Tambah Produk Baru</h3>
                <p class="text-xs text-slate-500">Tambahkan barang fisik, merchandise, atau produk inovasi ke katalog.</p>
            </div>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 mt-5">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Produk *</label>
                <input type="text" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]" placeholder="Misal: PDH BPROTIC 2026">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jenis Produk *</label>
                    <select name="type" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                        <option value="physical">Barang Fisik</option>
                        <option value="service">Jasa / Riset</option>
                        <option value="digital">Produk Digital</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ketersediaan *</label>
                    <select name="availability" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                        <option value="available">Tersedia</option>
                        <option value="preorder">Pre-Order</option>
                        <option value="sold_out">Habis</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Harga (Rp) *</label>
                    <input type="number" name="price" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]" placeholder="130000">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Batas Akhir Pre-Order (Opsional)</label>
                    <input type="date" name="preorder_ends_at" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Estimasi Produksi (Opsional)</label>
                    <input type="text" name="production_estimate" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]" placeholder="Misal: 2-3 Minggu">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Foto Produk (Max 2MB)</label>
                <input type="file" name="image" accept="image/*" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-[#0F2537]">
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Produk *</label>
                <textarea name="description" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]" placeholder="Rincian ukuran, bahan, atau spesifikasi produk..."></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" id="create_is_published" name="is_published" value="1" checked class="w-4 h-4 rounded text-amber-500 focus:ring-[#0F2537]">
                <label for="create_is_published" class="text-xs font-semibold text-slate-700">Publikasikan produk ini di website</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-sm">Simpan Produk</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT PRODUCT MODAL ================= -->
<div id="editProductModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 relative my-8">
        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div>
                <h3 class="text-base font-bold text-[#0F2537]">Edit Produk</h3>
                <p class="text-xs text-slate-500">Perbarui rincian produk, harga, ketersediaan, atau foto.</p>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-100 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <form id="editProductForm" action="#" method="POST" enctype="multipart/form-data" class="space-y-4 mt-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Produk *</label>
                <input type="text" id="edit_name" name="name" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Jenis Produk *</label>
                    <select id="edit_type" name="type" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                        <option value="physical">Barang Fisik</option>
                        <option value="service">Jasa / Riset</option>
                        <option value="digital">Produk Digital</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ketersediaan *</label>
                    <select id="edit_availability" name="availability" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                        <option value="available">Tersedia</option>
                        <option value="preorder">Pre-Order</option>
                        <option value="sold_out">Habis</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Harga (Rp) *</label>
                    <input type="number" id="edit_price" name="price" required min="0" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Batas Akhir Pre-Order</label>
                    <input type="date" id="edit_preorder_ends_at" name="preorder_ends_at" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Estimasi Produksi</label>
                    <input type="text" id="edit_production_estimate" name="production_estimate" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ganti Foto Produk (Max 2MB)</label>
                <input type="file" name="image" accept="image/*" class="w-full px-3.5 py-2 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-[#0F2537]">
                <div id="edit_image_preview_box" class="mt-2 hidden">
                    <img id="edit_image_preview" src="" alt="Preview Foto" class="w-20 h-16 object-cover rounded-lg border border-slate-200">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Deskripsi Produk *</label>
                <textarea id="edit_description" name="description" rows="3" required class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537]"></textarea>
            </div>

            <div class="flex items-center gap-2 pt-1">
                <input type="checkbox" id="edit_is_published" name="is_published" value="1" class="w-4 h-4 rounded text-amber-500 focus:ring-[#0F2537]">
                <label for="edit_is_published" class="text-xs font-semibold text-slate-700">Publikasikan produk ini di website</label>
            </div>

            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2.5 rounded-xl border border-slate-300 text-slate-700 text-xs font-bold hover:bg-slate-50">Batal</button>
                <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 text-xs font-bold uppercase tracking-wider shadow-sm">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('createProductModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeCreateModal() {
        document.getElementById('createProductModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    function openEditModal(product, imgUrl) {
        document.getElementById('editProductForm').action = "{{ url('admin/produk') }}/" + product.id;
        document.getElementById('edit_name').value = product.name || '';
        document.getElementById('edit_type').value = product.type || 'physical';
        document.getElementById('edit_availability').value = product.availability || 'available';
        document.getElementById('edit_price').value = product.price || 0;
        document.getElementById('edit_description').value = product.description || '';
        document.getElementById('edit_production_estimate').value = product.production_estimate || '';
        
        if (product.preorder_ends_at) {
            document.getElementById('edit_preorder_ends_at').value = product.preorder_ends_at.substring(0, 10);
        } else {
            document.getElementById('edit_preorder_ends_at').value = '';
        }

        document.getElementById('edit_is_published').checked = !!product.is_published;

        const previewBox = document.getElementById('edit_image_preview_box');
        const previewImg = document.getElementById('edit_image_preview');
        if (imgUrl) {
            previewImg.src = imgUrl;
            previewBox.classList.remove('hidden');
        } else {
            previewBox.classList.add('hidden');
        }

        document.getElementById('editProductModal').classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeEditModal() {
        document.getElementById('editProductModal').classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
        }
    });
</script>
@endsection
