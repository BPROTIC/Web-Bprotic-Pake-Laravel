@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')
@section('breadcrumb', 'Katalog Produk / Tambah')
@section('content')
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="max-w-4xl bg-white p-6 rounded-2xl border border-slate-200 space-y-6">@csrf @include('admin.products.form')<div class="flex justify-end gap-3"><a href="{{ route('admin.products.index') }}" class="px-4 py-2">Batal</a><button class="px-5 py-2.5 rounded-xl bg-[#0F2537] text-white font-bold">Simpan Produk</button></div></form>
@endsection
