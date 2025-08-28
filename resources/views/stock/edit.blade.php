@extends('layouts.app')

@section('title', 'edit Transaksi Stok')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">edit Transaksi Stok</h1>

    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="product_id" class="block font-semibold">Produk</label>
            <select name="product_id" id="product_id" class="border rounded p-2 w-full" required>
                <option value="" disabled selected>Pilih produk</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block font-semibold">Jumlah</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" min="1" class="border rounded p-2 w-full" required>
        </div>

        <div class="mb-4">
            <label for="type" class="block font-semibold">Tipe</label>
            <select name="type" id="type" class="border rounded p-2 w-full" required>
                <option value="masuk" {{ old('type') == 'masuk' ? 'selected' : '' }}>Masuk</option>
                <option value="keluar" {{ old('type') == 'keluar' ? 'selected' : '' }}>Keluar</option>
            </select>
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            <i class="fas fa-save me-1"></i>Simpan
        </button>
        <a href="{{ route('stocks.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded ml-2">
            <i class="fas fa-times me-1"></i>Batal
        </a>
    </form>
</div>
@endsection
