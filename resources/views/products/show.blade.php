<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk - Stockify</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            min-height: 100vh;
        }
        .detail-container {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border: 1px solid #e2e8f0;
        }
        .info-card {
            transition: all 0.3s ease;
            border-left: 4px solid #3b82f6;
        }
        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.1);
        }
        .table-row:hover {
            background-color: #f8fafc;
        }
        .badge-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }
        .badge-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        }
        .badge-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        }
        .btn-back {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background: linear-gradient(135deg, #4b5563 0%, #374151 100%);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="text-gray-800">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Detail Produk</h1>
                    <p class="text-gray-600">Informasi lengkap tentang produk</p>
                </div>
                <a href="{{ route('products.index') }}" class="btn-back text-white px-4 py-2 rounded-lg font-medium inline-flex items-center mt-4 sm:mt-0">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

            <!-- Product Info -->
                <div class="detail-container p-6 mb-6">
                    <div class="info-card bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg mb-6">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                            Informasi Produk
                        </h2>

                        <div class="grid grid-cols-1 gap-8">
                            {{-- Kolom Gambar Produk --}}
                            <div>
@if($product->image)
   <img src="{{ asset('storage/' . $product->image) }}" 
        alt="{{ $product->name }}" 
        class="w-full h-80 object-cover rounded-xl shadow-md" width="150">
@else
   <img src="{{ asset('images/no-image.png') }}"
        alt="No Image"
        class="w-full h-80 object-cover rounded-xl shadow-md">
@endif

                            </div>

                            {{-- Kolom Detail Produk --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Nama Produk --}}
                                <div class="col-span-2">
                                    <p class="text-lg text-gray-600">Nama Produk</p>
                                    <p class="block w-full font-bold text-2xl">{{ $product->name }}</p>
                                </div>

                                {{-- Kategori --}}
                                <div>
                                    <p class="text-lg text-gray-600">Kategori</p>
                                    <p class="block w-full font-semibold text-xl">{{ $product->category->name ?? '-' }}</p>
                                </div>

                                {{-- Supplier --}}
                                <div>
                                    <p class="text-lg text-gray-600">Supplier</p>
                                    <p class="block w-full font-semibold text-xl">{{ $product->supplier->name ?? '-' }}</p>
                                </div>

                                {{-- Harga --}}
                                <div>
                                    <p class="text-lg text-gray-600">Harga</p>
                                    <p class="block w-full font-semibold text-xl">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </p>
                                </div>

                                {{-- Stok --}}
                                <div>
                                    <p class="text-lg text-gray-600">Stok Tersedia</p>
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold text-white 
                                        {{ $product->stock > 20 ? 'badge-success' : ($product->stock > 0 ? 'badge-warning' : 'badge-danger') }}">
                                        {{ $product->stock }}
                                        <i class="fas {{ $product->stock > 20 ? 'fa-check-circle' : ($product->stock > 0 ? 'fa-exclamation-triangle' : 'fa-times-circle') }} ml-2"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



            <!-- Transaction History -->
            <div class="detail-container p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-history text-blue-500 mr-2"></i>
                    Riwayat Stok
                </h2>
                
                @if($product->transactions->isEmpty())
                    <div class="text-center py-8 bg-gray-50 rounded-lg">
                        <i class="fas fa-inbox text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Belum ada transaksi untuk produk ini</p>
                    </div>
                @else
                    <div class="overflow-x-auto rounded-lg shadow">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Petugas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($product->transactions as $t)
                                    <tr class="table-row transition-colors duration-200">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $t->created_at->format('d M Y H:i') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                                {{ $t->type == 'masuk' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                <i class="fas {{ $t->type == 'masuk' ? 'fa-arrow-down' : 'fa-arrow-up' }} mr-1"></i>
                                                {{ ucfirst($t->type) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $t->quantity }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $t->user->name ?? 'System' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>