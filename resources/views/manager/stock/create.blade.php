@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Stock Opname</h1>

    <form action="{{ route('manager.stock-opname.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Produk</label>
            <select name="product_id" class="border px-3 py-2 w-full" required>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stok: {{ $product->stock }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-semibold">Stok Fisik</label>
            <input type="number" name="stock_physical" min="0" value="0" required class="border px-3 py-2 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    </form>
</div>
@endsection
