@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Detail Produk</h1>

    <div class="bg-white shadow rounded p-4 mb-4">
        <p><strong>Nama Produk:</strong> {{ $product->name }}</p>
        <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
        <p><strong>Stok Saat Ini:</strong> {{ $product->stock }}</p>
        <p><strong>Harga:</strong> {{ $product->price }}</p>
        <p><strong>Deskripsi:</strong> {{ $product->description ?? '-' }}</p>
    </div>

    <a href="{{ route('manager.products.index') }}" class="bg-gray-400 text-white px-4 py-2 rounded">Kembali</a>

</div>
@endsection
