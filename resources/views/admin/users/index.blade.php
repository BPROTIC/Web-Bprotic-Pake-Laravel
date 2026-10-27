@extends('layouts.admin')

@section('title', 'Manajemen Pengguna')
@section('page_title', 'Manajemen Administrator')
@section('breadcrumb', 'Kelola akun administrator dan staf pengurus')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex items-center justify-between">
        <div>
            <h2 class="text-sm font-bold text-[#0F2537]">Daftar Pengguna Administrator</h2>
            <p class="text-xs text-slate-500">Akun yang memiliki hak akses login ke panel admin</p>
        </div>

        <button type="button" onclick="openCreateModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition-all shadow-sm cursor-pointer">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Administrator</span>
        </button>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">#</th>
                        <th class="py-3.5 px-4">Nama Pengguna</th>
                        <th class="py-3.5 px-4">Email</th>
                        <th class="py-3.5 px-4">Hak Akses (Role)</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="py-3.5 px-4 text-center font-medium text-slate-400">
                                {{ $loop->iteration }}
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-full bg-[#0F2537] text-amber-300 font-bold flex items-center justify-center text-[11px]">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <span>{{ $user->name }}</span>
                                @if($user->id === auth()->id())
                                    <span class="text-[9px] bg-slate-200 text-slate-700 font-bold px-1.5 py-0.5 rounded">Anda</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-slate-600 font-mono text-[11px]">
                                {{ $user->email }}
                            </td>
                            <td class="py-3.5 px-4">
                                <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 font-semibold text-[10px] border border-blue-200 uppercase">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($user->is_active)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-1">
                                <button type="button" 
                                    onclick='openEditModal(@json($user))'
                                    title="Edit Pengguna" 
                                    class="inline-block p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition-colors cursor-pointer">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </button>
                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus akun administrator ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus" class="p-1.5 text-rose-600 hover:text-rose-800 hover:bg-rose-50 rounded-lg transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-slate-400 italic">Belum ada pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $users->links() }}</div>
        @endif
    </div>
</div>

<!-- ================= CREATE USER MODAL ================= -->
<div id="createUserModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Tambah Administrator Baru</h3>
                    <p class="text-[11px] text-slate-300">Buat kredensial akses panel admin</p>
                </div>
            </div>
            <button type="button" onclick="closeCreateModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-4">
            @csrf

            <div>
                <label for="create_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                <input type="text" id="create_name" name="name" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="Nama Pengurus">
            </div>

            <div>
                <label for="create_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                <input type="email" id="create_email" name="email" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                    placeholder="pengurus@bprotic.id">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="create_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi (Min 8) *</label>
                    <input type="password" id="create_password" name="password" required minlength="8"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="••••••••">
                </div>

                <div>
                    <label for="create_role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Role Akses *</label>
                    <select id="create_role" name="role" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                        <option value="admin">Admin (Penuh)</option>
                        <option value="staff" selected>Staf / Pengurus</option>
                    </select>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Akun Aktif (Dapat Login Langsung)</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Simpan Administrator
                </button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT USER MODAL ================= -->
<div id="editUserModal" class="fixed inset-0 z-50 overflow-y-auto bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 hidden">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-150">
        <!-- Modal Header -->
        <div class="px-6 py-4 bg-[#0F2537] text-white flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center font-bold">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <div>
                    <h3 class="text-sm font-bold text-white">Edit Data Administrator</h3>
                    <p class="text-[11px] text-slate-300" id="edit_modal_subtitle">Perbarui data akun</p>
                </div>
            </div>
            <button type="button" onclick="closeEditModal()" class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Modal Form -->
        <form id="editUserForm" method="POST" class="p-6 space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="edit_name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                <input type="text" id="edit_name" name="name" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <div>
                <label for="edit_email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email *</label>
                <input type="email" id="edit_email" name="email" required
                    class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="edit_password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ganti Password</label>
                    <input type="password" id="edit_password" name="password" minlength="8"
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none"
                        placeholder="Kosongkan jika tidak diganti">
                </div>

                <div>
                    <label for="edit_role" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Role Akses *</label>
                    <select id="edit_role" name="role" required
                        class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs focus:ring-2 focus:ring-[#0F2537] focus:outline-none">
                        <option value="admin">Admin (Penuh)</option>
                        <option value="staff">Staf / Pengurus</option>
                    </select>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2.5 cursor-pointer">
                    <input type="checkbox" id="edit_is_active" name="is_active" value="1"
                        class="w-4 h-4 rounded border-slate-300 text-[#0F2537] focus:ring-[#0F2537]">
                    <span class="text-xs font-semibold text-slate-700">Akun Aktif (Dapat Login)</span>
                </label>
            </div>

            <!-- Modal Footer -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-2.5">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 rounded-xl border border-slate-300 text-xs font-semibold text-slate-700 hover:bg-slate-50 transition-colors">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow transition-colors">
                    Perbarui Administrator
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const createModal = document.getElementById('createUserModal');
    const editModal = document.getElementById('editUserModal');
    const editForm = document.getElementById('editUserForm');

    function openCreateModal() {
        createModal.classList.remove('hidden');
        document.getElementById('create_name').focus();
    }

    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    function openEditModal(user) {
        editForm.action = `/admin/pengguna/${user.id}`;
        document.getElementById('edit_modal_subtitle').textContent = `Akun: ${user.name}`;
        document.getElementById('edit_name').value = user.name || '';
        document.getElementById('edit_email').value = user.email || '';
        document.getElementById('edit_password').value = '';
        document.getElementById('edit_role').value = user.role || 'staff';
        document.getElementById('edit_is_active').checked = !!user.is_active;

        editModal.classList.remove('hidden');
        document.getElementById('edit_name').focus();
    }

    function closeEditModal() {
        editModal.classList.add('hidden');
    }

    // Close modal on Escape or clicking backdrop
    window.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCreateModal();
            closeEditModal();
        }
    });

    createModal.addEventListener('click', (e) => {
        if (e.target === createModal) closeCreateModal();
    });

    editModal.addEventListener('click', (e) => {
        if (e.target === editModal) closeEditModal();
    });
</script>
@endpush
