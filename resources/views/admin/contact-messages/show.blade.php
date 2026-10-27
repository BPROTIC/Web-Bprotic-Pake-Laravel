@extends('layouts.admin')

@section('title', 'Rincian Pesan Kontak')
@section('page_title', 'Rincian Pesan')
@section('breadcrumb')
    <a href="{{ route('admin.contact-messages.index') }}" class="hover:underline">Pesan Kontak</a> &rarr; <span>Detail</span>
@endsection

@section('content')
<div class="max-w-3xl bg-white p-6 sm:p-8 rounded-2xl border border-slate-200/80 shadow-sm space-y-6">
    <div class="border-b border-slate-100 pb-4 flex items-center justify-between">
        <div>
            <h2 class="text-base font-bold text-[#0F2537]">Pesan dari: {{ $contactMessage->name }}</h2>
            <p class="text-xs text-slate-500">Diterima pada {{ $contactMessage->created_at->translatedFormat('l, d F Y - H:i WIB') }}</p>
        </div>
        <a href="{{ route('admin.contact-messages.index') }}" class="text-xs text-slate-600 hover:text-slate-900 border border-slate-300 px-3 py-1.5 rounded-lg">&larr; Kembali</a>
    </div>

    <!-- Sender Detail Card -->
    <div class="bg-slate-50 p-4 rounded-xl border border-slate-200/70 grid grid-cols-1 sm:grid-cols-3 gap-4 text-xs">
        <div>
            <span class="text-slate-400 block font-semibold">Nama Pengirim:</span>
            <span class="font-bold text-slate-900 text-sm">{{ $contactMessage->name }}</span>
        </div>
        <div>
            <span class="text-slate-400 block font-semibold">Email:</span>
            <a href="mailto:{{ $contactMessage->email }}" class="text-blue-600 font-semibold hover:underline">
                {{ $contactMessage->email }}
            </a>
        </div>
        <div>
            <span class="text-slate-400 block font-semibold">WhatsApp:</span>
            @if($contactMessage->phone)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contactMessage->phone) }}" target="_blank" class="text-emerald-600 font-semibold hover:underline">
                    {{ $contactMessage->phone }}
                </a>
            @else
                <span class="text-slate-500">-</span>
            @endif
        </div>
    </div>

    <!-- Subject & Message -->
    <div class="space-y-2">
        <h3 class="text-sm font-bold text-slate-800">
            Perihal: {{ $contactMessage->subject ?? '(Tidak ada subjek)' }}
        </h3>
        <div class="bg-white p-6 rounded-xl border border-slate-200 text-sm text-slate-800 leading-relaxed whitespace-pre-line">
            {{ $contactMessage->message }}
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
        <form action="{{ route('admin.contact-messages.destroy', $contactMessage->id) }}" method="POST" onsubmit="return confirmDelete('Hapus pesan ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-xl border border-rose-200 text-rose-600 hover:bg-rose-50 text-xs font-bold transition-all">
                Hapus Pesan
            </button>
        </form>

        <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ rawurlencode($contactMessage->subject ?? 'Pesan BPROTIC') }}"
            class="px-5 py-2.5 rounded-xl bg-[#0F2537] hover:bg-[#13334C] text-white text-xs font-bold uppercase tracking-wider shadow-md">
            Balas via Email &rarr;
        </a>
    </div>
</div>
@endsection
