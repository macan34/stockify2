@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="text-2xl font-bold mb-4">Daftar Produk</h1>

    <form action="{{ route('manager.products.index') }}" method="GET" class="mb-4">
    <select name="category_id" onchange="this.form.submit()" class="border rounded p-2">
        <option value="">Semua Kategori</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</form>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Nama</th>
                <th class="border px-4 py-2">Kategori</th>
                <th class="border px-4 py-2">Stok</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="border px-4 py-2">{{ $product->name }}</td>
                <td class="border px-4 py-2">{{ $product->category->name ?? '-' }}</td>
                <td class="border px-4 py-2">{{ $product->stock }}</td>
                <td class="border px-4 py-2 flex gap-2">
                    <!-- Lihat Detail -->
                    <a href="{{ route('manager.products.show', $product->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Detail</a>

                    <!-- Form Keluar Stok -->
                    <form action="{{ route('manager.stock-opname.out') }}" method="POST" class="flex gap-2">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="type" value="keluar">
                        <input type="number" name="quantity" min="1" max="{{ $product->stock }}" placeholder="Qty keluar" required class="border px-2 py-1 w-20">
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Keluar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection
