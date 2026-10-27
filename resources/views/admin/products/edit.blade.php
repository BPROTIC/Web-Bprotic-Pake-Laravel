@extends('layouts.admin')
@section('title', 'Ubah Produk')
@section('page_title', 'Ubah Produk')
@section('breadcrumb', 'Katalog Produk / Ubah')
@section('content')
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 space-y-6">@csrf @method('PUT') @include('admin.products.form')<div class="flex justify-end gap-3"><a href="{{ route('admin.products.index') }}" class="px-4 py-2">Batal</a><button class="px-5 py-2.5 rounded-xl bg-[#0F2537] text-white font-bold">Simpan Perubahan</button></div></form>
@endsection
