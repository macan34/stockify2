<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Stok</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <h1 class="text-2xl font-bold mb-4">Transaksi Stok</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <a href="{{ route('stock-transactions.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Transaksi</a>

    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200">
                <th class="border px-4 py-2">Produk</th>
                <th class="border px-4 py-2">Tipe</th>
                <th class="border px-4 py-2">Qty</th>
                <th class="border px-4 py-2">User</th>
                <th class="border px-4 py-2">Catatan</th>
                <th class="border px-4 py-2">Waktu</th>
                <th class="border px-4 py-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $t)
            <tr>
                <td class="border px-4 py-2">{{ $t->product->name }}</td>
                <td class="border px-4 py-2">{{ $t->type=='in'?'Masuk':'Keluar' }}</td>
                <td class="border px-4 py-2">{{ $t->quantity }}</td>
                <td class="border px-4 py-2">{{ $t->user->name }}</td>
                <td class="border px-4 py-2">{{ $t->note }}</td>
                <td class="border px-4 py-2">{{ $t->created_at }}</td>
                <td class="border px-4 py-2">
                    <form action="{{ route('stock-transactions.destroy', $t->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Hapus transaksi?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
