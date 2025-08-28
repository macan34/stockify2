@extends('layouts.app')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Stock Opname</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <a href="{{ route('manager.stock-opname.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Stock Opname</a>

    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Stok Sistem</th>
                <th class="border px-4 py-2">Stok Fisik</th>
                <th class="border px-4 py-2">Stok Akhir</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach($opnames as $opname)
            <tr>
                <td class="border px-4 py-2"><td class="border px-4 py-2">
                    {{ $opname->product->name ?? 'Produk tidak ditemukan' }}
                </td>

                <td class="border px-4 py-2">{{ $opname->stock_system }}</td>
                <td class="border px-4 py-2">{{ $opname->stock_physical }}</td>
                <td class="border px-4 py-2">{{ $opname->real_stock }}</td>
                <td class="border px-4 py-2">{{ $opname->user->name }}</td>
                <td class="border px-4 py-2">{{ $opname->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
