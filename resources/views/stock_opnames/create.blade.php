<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Stock Opname</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">

<h1 class="text-2xl font-bold mb-4">Tambah Stock Opname</h1>

@if ($errors->any())
    <div class="bg-red-100 text-red-800 p-2 mb-4 rounded">
        <ul>
            @foreach ($errors->all() as $error)
                <li>- {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('stock-opnames.store') }}" method="POST" class="bg-white p-4 shadow rounded">
    @csrf

    <div class="mb-2">
        <label class="block mb-1">Produk</label>
        <select name="product_id" class="border px-2 py-1 w-full" required>
            @foreach($products as $p)
                <option value="{{ $p->id }}">{{ $p->name }} (Stok: {{ $p->stock }})</option>
            @endforeach
        </select>
    </div>

    <div class="mb-2">
        <label class="block mb-1">Stok Aktual</label>
        <input type="number" name="actual_stock" class="border px-2 py-1 w-full" value="0" min="0" required>
    </div>

    <div class="mb-2">
        <label class="block mb-1">Catatan</label>
        <textarea name="note" class="border px-2 py-1 w-full"></textarea>
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
    <a href="{{ route('stock-opnames.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</a>
</form>

</body>
</html>
