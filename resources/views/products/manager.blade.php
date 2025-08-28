@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

<table class="table-auto w-full border">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Nama Produk</th>
            <th class="px-4 py-2">Stok</th>
            <th class="px-4 py-2">Harga</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr class="border-b">
            <td class="px-4 py-2">{{ $product->name }}</td>
            <td class="px-4 py-2">{{ $product->stock }}</td>
            <td class="px-4 py-2">{{ $product->price }}</td>
            <td class="px-4 py-2">
                <a href="{{ route('manager.products.show', $product->id) }}" class="text-blue-500">Detail</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
