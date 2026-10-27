@extends('layouts.public')
@section('title', 'Produk BPROTIC')
@section('meta_description', 'Katalog produk, jasa, dan produk digital BPROTIC.')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="max-w-2xl mb-12"><p class="text-sm uppercase tracking-[.2em] text-amber-700 font-bold">Kewirausahaan BPROTIC</p><h1 class="mt-2 text-4xl font-extrabold text-[#0F2537]">Produk dan Layanan</h1><p class="mt-3 text-slate-600">Jelajahi produk, jasa, dan karya digital dari BPROTIC. Hubungi kami melalui WhatsApp untuk bertanya atau memesan.</p></div>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($products as $product)
        @php
            $statuses = ['available'=>'Tersedia','sold_out'=>'Habis','preorder'=>'Pre-order'];
            $question = match ($product->availability) {
                'preorder' => "Halo, saya tertarik pre-order {$product->name} (Rp ".number_format($product->price,0,',','.')."). Apakah pre-order masih dibuka dan bagaimana proses pemesanannya?",
                'sold_out' => "Halo, saya tertarik dengan {$product->name}. Saat ini tertulis habis. Kapan produk ini tersedia kembali?",
                default => match ($product->type) {
                    'service' => "Halo, saya tertarik dengan jasa {$product->name} (Rp ".number_format($product->price,0,',','.')."). Bisa dijelaskan detail layanan dan jadwal yang tersedia?",
                    'digital' => "Halo, saya tertarik dengan produk digital {$product->name} (Rp ".number_format($product->price,0,',','.')."). Bagaimana cara mendapatkan produk ini?",
                    default => "Halo, saya ingin memesan {$product->name} (Rp ".number_format($product->price,0,',','.')."). Apakah masih tersedia dan bagaimana cara pemesanannya?",
                },
            };
            $phone = preg_replace('/\D+/', '', $whatsapp ?? '');
            if (str_starts_with($phone, '0')) $phone = '62'.substr($phone, 1);
            $waUrl = 'https://wa.me/'.$phone.'?text='.rawurlencode($question);
        @endphp
        <article class="overflow-hidden rounded-2xl bg-white border border-amber-200/70 shadow-sm flex flex-col">
            @if($product->image)<img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">@else<div class="h-56 bg-gradient-to-br from-[#0F2537] to-[#1d4866] flex items-center justify-center text-amber-300 text-5xl">✦</div>@endif
            <div class="p-5 flex flex-col flex-1"><div class="flex justify-end"><span class="text-xs font-semibold {{ $product->availability==='sold_out' ? 'text-red-600' : 'text-emerald-700' }}">{{ $statuses[$product->availability] }}</span></div><h2 class="text-xl font-bold text-[#0F2537] mt-2">{{ $product->name }}</h2><p class="text-2xl font-extrabold text-[#0F2537] mt-2">Rp {{ number_format($product->price,0,',','.') }}</p><p class="text-sm text-slate-600 mt-3 whitespace-pre-line flex-1">{{ $product->description }}</p>
            @if($product->availability==='preorder')<p class="text-xs text-slate-500 mt-3">@if($product->preorder_ends_at)Pre-order sampai {{ $product->preorder_ends_at->translatedFormat('d F Y') }}. @endif{{ $product->production_estimate ? 'Estimasi: '.$product->production_estimate : '' }}</p>@endif
            @if($phone)<a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="mt-5 text-center rounded-xl px-4 py-3 bg-[#128C7E] hover:bg-[#0f766e] text-white font-bold text-sm">Tanya / Pesan via WhatsApp</a>@else<p class="mt-5 text-sm text-amber-800 bg-amber-50 rounded-lg p-3">Nomor WhatsApp pemesanan belum diatur.</p>@endif
            </div>
        </article>
    @empty<div class="sm:col-span-2 lg:col-span-3 text-center py-16 bg-white rounded-2xl border border-slate-200"><h2 class="text-xl font-bold">Belum ada produk</h2><p class="mt-2 text-slate-500">Produk BPROTIC akan ditampilkan di sini.</p></div>@endforelse
    </div>
    <div class="mt-8">{{ $products->links() }}</div>
</section>
@endsection
