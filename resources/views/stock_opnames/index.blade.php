<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Opname</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4">Stock Opname</h1>

@if(session('success'))
    <div class="bg-green-100 text-green-800 p-2 mb-4 rounded">{{ session('success') }}</div>
@endif

<a href="{{ route('stock-opnames.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Stock Opname</a>

<table class="table-auto w-full bg-white shadow rounded">
    <thead>
        <tr class="bg-gray-200">
            <th class="border px-4 py-2">Produk</th>
            <th class="border px-4 py-2">Stok Sistem</th>
            <th class="border px-4 py-2">Stok Aktual</th>
            <th class="border px-4 py-2">Selisih</th>
            <th class="border px-4 py-2">User</th>
            <th class="border px-4 py-2">Catatan</th>
            <th class="border px-4 py-2">Waktu</th>
            <th class="border px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($opnames as $o)
        <tr>
            <td class="border px-4 py-2">{{ $o->product->name }}</td>
            <td class="border px-4 py-2">{{ $o->system_stock }}</td>
            <td class="border px-4 py-2">{{ $o->actual_stock }}</td>
            <td class="border px-4 py-2">{{ $o->difference }}</td>
            <td class="border px-4 py-2">{{ $o->user->name }}</td>
            <td class="border px-4 py-2">{{ $o->note }}</td>
            <td class="border px-4 py-2">{{ $o->created_at }}</td>
            <td class="border px-4 py-2">
                <form action="{{ route('stock-opnames.destroy', $o->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Hapus stock opname?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
