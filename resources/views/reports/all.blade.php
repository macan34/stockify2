@extends('layouts.app')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">📊 Laporan Lengkap</h2>

    <!-- 📦 Laporan Stok -->
    <div class="mb-10">
        <form method="GET" action="{{ route('manager.laporan.index') }}#stok" class="mb-4 flex space-x-2">
             <input type="hidden" name="section" value="stok">
            <select name="stock_category" class="border p-2 rounded">
                <option value="">-- Semua Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('stock_category') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            <input type="text" name="stock_search" placeholder="Cari produk..." value="{{ request('stock_search') }}" class="border p-2 rounded">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>

        <h3 id="stok" class="text-xl font-semibold mb-3">📦 Stok Barang</h3>
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Produk</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Stok</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                <tr>
                    <td class="border p-2">{{ $p->name }}</td>
                    <td class="border p-2">{{ $p->category->name ?? '-' }}</td>
                    <td class="border p-2">{{ $p->stock }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 📑 Laporan Transaksi -->
    <div class="mb-10">
        <form method="GET" action="{{ route('manager.laporan.index') }}#transaksi" class="mb-4 flex space-x-2">
             <input type="hidden" name="section" value="transaksi">
            <input type="date" name="trans_start" value="{{ request('trans_start') }}" class="border p-2 rounded">
            <input type="date" name="trans_end" value="{{ request('trans_end') }}" class="border p-2 rounded">
            <input type="text" name="trans_search" placeholder="Cari produk..." value="{{ request('trans_search') }}" class="border p-2 rounded">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>

        <h3 id="transaksi" class="text-xl font-semibold mb-3">📑 Barang Masuk & Keluar</h3>
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">Produk</th>
                    <th class="border p-2">Tipe</th>
                    <th class="border p-2">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr>
                    <td class="border p-2">{{ $t->created_at->format('d-m-Y') }}</td>
                    <td class="border p-2">{{ $t->product->name ?? '-' }}</td>
                    <td class="border p-2 {{ $t->type == 'masuk' ? 'text-green-600' : 'text-red-600' }}">
                        {{ ucfirst($t->type) }}
                    </td>
                    <td class="border p-2">{{ $t->quantity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- 📝 Laporan Aktivitas -->
    <div>
        <form method="GET" action="{{ route('manager.laporan.index') }}#aktivitas" class="mb-4 flex space-x-2">
            <input type="hidden" name="section" value="aktivitas">
            <select name="activity_user" class="border p-2 rounded">
                <option value="">-- Semua User --</option>
                @foreach($activities->pluck('user')->unique('id') as $u)
                    @if($u)
                        <option value="{{ $u->id }}" {{ request('activity_user') == $u->id ? 'selected' : '' }}>
                            {{ $u->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            <input type="date" name="activity_start" value="{{ request('activity_start') }}" class="border p-2 rounded">
            <input type="date" name="activity_end" value="{{ request('activity_end') }}" class="border p-2 rounded">
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Filter</button>
        </form>

        <h3 id="aktivitas" class="text-xl font-semibold mb-3">📝 Aktivitas Pengguna</h3>
        <table class="w-full border">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Tanggal</th>
                    <th class="border p-2">User</th>
                    <th class="border p-2">Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $a)
                <tr>
                    <td class="border p-2">{{ $a->created_at->format('d-m-Y H:i') }}</td>
                    <td class="border p-2">{{ $a->user->name ?? '-' }}</td>
                    <td class="border p-2">{{ $a->activity }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{-- @if($section)
<script>
    window.onload = function() {
        document.getElementById("{{ $section }}")?.scrollIntoView({ behavior: "smooth" });
    };
</script> --}}
@endsection
