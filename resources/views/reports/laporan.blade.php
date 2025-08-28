@extends('layouts.app')

@section('title', 'Laporan Admin')

@section('content')
<div class="p-6">
    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6">Laporan Admin</h1>

    <!-- Transaksi Stok -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-3">Transaksi Stok</h2>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Produk</th>
                        <th class="border px-4 py-2">Tipe</th>
                        <th class="border px-4 py-2">Qty</th>
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Catatan</th>
                        <th class="border px-4 py-2">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                    <tr>
                        <td class="border px-4 py-2">{{ $t->product->name }}</td>
                        <td class="border px-4 py-2">
                            <span class="{{ $t->type=='in' ? 'text-green-600 font-semibold' : 'text-red-600 font-semibold' }}">
                                {{ $t->type=='in'?'Masuk':'Keluar' }}
                            </span>
                        </td>
                        <td class="border px-4 py-2">{{ $t->quantity }}</td>
                        <td class="border px-4 py-2">{{ $t->user->name }}</td>
                        <td class="border px-4 py-2">{{ $t->note ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $t->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3 text-gray-500">Belum ada data transaksi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Stock Opname -->
    <div class="mb-8">
        <h2 class="text-xl font-semibold mb-3">Stock Opname</h2>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">Produk</th>
                        <th class="border px-4 py-2">Stok Sistem</th>
                        <th class="border px-4 py-2">Stok Fisik</th>
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($opnames as $o)
                    <tr>
                        <td class="border px-4 py-2">{{ $o->product->name }}</td>
                        <td class="border px-4 py-2">{{ $o->stock_system }}</td>
                        <td class="border px-4 py-2">{{ $o->stock_physical }}</td>
                        <td class="border px-4 py-2">{{ $o->user->name }}</td>
                        <td class="border px-4 py-2">{{ $o->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-3 text-gray-500">Belum ada data opname</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Aktivitas Pengguna -->
    <div>
        <h2 class="text-xl font-semibold mb-3">Aktivitas Pengguna</h2>
        <div class="overflow-x-auto bg-white shadow rounded-lg">
            <table class="table-auto w-full">
                <thead class="bg-gray-100 text-left">
                    <tr>
                        <th class="border px-4 py-2">User</th>
                        <th class="border px-4 py-2">Aksi</th>
                        <th class="border px-4 py-2">Detail</th>
                        <th class="border px-4 py-2">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $a)
                    <tr>
                        <td class="border px-4 py-2">{{ $a->user->name }}</td>
                        <td class="border px-4 py-2">{{ $a->action }}</td>
                        <td class="border px-4 py-2">{{ $a->details }}</td>
                        <td class="border px-4 py-2">{{ $a->created_at->format('d M Y H:i') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-3 text-gray-500">Belum ada aktivitas</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
