@extends('layouts.admin')

@section('title', 'Pesan Kontak Masuk')
@section('page_title', 'Kotak Pesan Pengunjung')
@section('breadcrumb', 'Pesan dan pertanyaan yang dikirim melalui formulir kontak publik')

@section('content')
<div class="space-y-6">
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.contact-messages.index') }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ empty($status) ? 'bg-[#0F2537] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Semua Pesan
            </a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'unread']) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'unread' ? 'bg-[#0F2537] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Belum Dibaca ({{ $unreadCount }})
            </a>
            <a href="{{ route('admin.contact-messages.index', ['status' => 'read']) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all {{ $status === 'read' ? 'bg-[#0F2537] text-white' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                Sudah Dibaca
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="admin-datatable w-full text-left text-xs text-slate-700">
                <thead class="bg-slate-50 text-[11px] font-bold uppercase tracking-wider text-slate-500 border-b border-slate-200">
                    <tr>
                        <th class="py-3.5 px-4 w-12 text-center">Status</th>
                        <th class="py-3.5 px-4">Pengirim</th>
                        <th class="py-3.5 px-4">Kontak</th>
                        <th class="py-3.5 px-4">Subjek & Pesan</th>
                        <th class="py-3.5 px-4">Waktu</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($messages as $msg)
                        <tr class="hover:bg-slate-50/80 transition-colors {{ !$msg->is_read ? 'bg-amber-50/30' : '' }}">
                            <td class="py-3.5 px-4 text-center">
                                @if(!$msg->is_read)
                                    <span class="w-2.5 h-2.5 rounded-full bg-amber-500 inline-block" title="Belum dibaca"></span>
                                @else
                                    <span class="w-2.5 h-2.5 rounded-full bg-slate-300 inline-block" title="Sudah dibaca"></span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 font-bold text-slate-900">
                                {{ $msg->name }}
                            </td>
                            <td class="py-3.5 px-4 text-slate-600">
                                <div>{{ $msg->email }}</div>
                                @if($msg->phone)
                                    <div class="text-[10px] text-slate-400">{{ $msg->phone }}</div>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 max-w-sm">
                                <div class="font-semibold text-slate-800">{{ $msg->subject ?? '(Tanpa Subjek)' }}</div>
                                <div class="text-slate-500 text-[11px] truncate">{{ $msg->message }}</div>
                            </td>
                            <td class="py-3.5 px-4 text-slate-500 text-[11px]">
                                {{ $msg->created_at->translatedFormat('d M Y, H:i') }}
                            </td>
                            <td class="py-3.5 px-4 text-right space-x-2">
                                <button type="button"
                                    onclick="openViewModal(@json($msg), '{{ $msg->created_at->translatedFormat('l, d F Y - H:i WIB') }}')"
                                    class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                    Baca Pesan
                                </button>
                                <form action="{{ route('admin.contact-messages.destroy', $msg->id) }}" method="POST" class="inline-block" onsubmit="return confirmDelete('Hapus pesan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs font-semibold px-2.5 py-1 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition-colors">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-slate-400 italic">Tidak ada pesan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($messages->hasPages())
            <div class="p-4 border-t border-slate-100">{{ $messages->links() }}</div>
        @endif
    </div>
</div>

<!-- Quick View Message Modal -->
<div id="viewMessageModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="min-h-screen px-4 text-center flex items-center justify-center">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeViewModal()"></div>

        <!-- Modal Dialog -->
        <div class="inline-block w-full max-w-2xl p-6 sm:p-7 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl relative z-10 border border-slate-100">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-bold text-slate-900" id="viewSenderName">Rincian Pesan</h3>
                        <p class="text-xs text-slate-400" id="viewCreatedAt">-</p>
                    </div>
                </div>
                <button type="button" onclick="closeViewModal()" class="text-slate-400 hover:text-slate-600 p-2 rounded-xl hover:bg-slate-100 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div class="mt-5 space-y-4">
                <!-- Metadata card -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 p-4 rounded-2xl bg-slate-50 border border-slate-100 text-xs">
                    <div>
                        <span class="text-slate-400 block font-semibold text-[11px] uppercase tracking-wider mb-0.5">Email Pengirim</span>
                        <a id="viewEmailLink" href="#" class="text-blue-600 font-semibold hover:underline break-all">-</a>
                    </div>
                    <div>
                        <span class="text-slate-400 block font-semibold text-[11px] uppercase tracking-wider mb-0.5">Nomor WhatsApp / Telp</span>
                        <a id="viewPhoneLink" href="#" target="_blank" class="text-emerald-600 font-semibold hover:underline">-</a>
                    </div>
                </div>

                <!-- Subject -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Perihal / Subjek</label>
                    <div id="viewSubject" class="px-4 py-2.5 rounded-xl bg-slate-50 border border-slate-200/80 text-xs font-semibold text-slate-800">
                        -
                    </div>
                </div>

                <!-- Full Message Body -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Isi Pesan Lengkap</label>
                    <div id="viewBody" class="p-4 rounded-2xl bg-white border border-slate-200/90 text-xs text-slate-800 leading-relaxed whitespace-pre-wrap max-h-60 overflow-y-auto select-text shadow-inner">
                        -
                    </div>
                </div>
            </div>

            <!-- Footer Action Buttons -->
            <div class="mt-6 pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                <form id="viewDeleteForm" action="#" method="POST" onsubmit="return confirmDelete('Hapus pesan ini secara permanen?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full sm:w-auto px-4 py-2 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-bold transition-all">
                        Hapus Pesan
                    </button>
                </form>

                <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                    <button type="button" onclick="closeViewModal()" class="px-4 py-2 rounded-xl text-xs font-bold text-slate-600 hover:bg-slate-100 transition-all">
                        Tutup
                    </button>
                    <a id="viewReplyBtn" href="#" class="px-4 py-2 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold transition-all shadow-md flex items-center gap-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>
                        <span>Balas Email</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function openViewModal(msg, formattedDate) {
        document.getElementById('viewSenderName').textContent = 'Pesan dari: ' + (msg.name || 'Pengunjung');
        document.getElementById('viewCreatedAt').textContent = 'Diterima pada ' + (formattedDate || msg.created_at || '-');
        
        const emailLink = document.getElementById('viewEmailLink');
        emailLink.textContent = msg.email || '-';
        emailLink.href = msg.email ? ('mailto:' + msg.email) : '#';

        const phoneLink = document.getElementById('viewPhoneLink');
        if (msg.phone) {
            const cleanPhone = msg.phone.replace(/[^0-9]/g, '');
            phoneLink.textContent = msg.phone;
            phoneLink.href = 'https://wa.me/' + cleanPhone;
            phoneLink.classList.remove('hidden');
        } else {
            phoneLink.textContent = 'Tidak dicantumkan';
            phoneLink.removeAttribute('href');
        }

        document.getElementById('viewSubject').textContent = msg.subject || '(Tanpa Subjek)';
        document.getElementById('viewBody').textContent = msg.message || '-';

        // Action routes
        document.getElementById('viewDeleteForm').action = "{{ url('admin/pesan') }}/" + msg.id;
        
        const subjectEncoded = encodeURIComponent('Re: ' + (msg.subject || 'Pesan BPROTIC Hub'));
        document.getElementById('viewReplyBtn').href = 'mailto:' + (msg.email || '') + '?subject=' + subjectEncoded;

        const modal = document.getElementById('viewMessageModal');
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    }

    function closeViewModal() {
        const modal = document.getElementById('viewMessageModal');
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeViewModal();
        }
    });
</script>
@endsection
