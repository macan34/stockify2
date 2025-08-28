@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="mb-8 fade-in">
        <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
            <i class="fas fa-box-open mr-2" style="color:var(--primary-color)"></i> Tambah Produk Baru
        </h1>
        <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
            Isi detail produk untuk menambahkannya ke inventori gudang Anda.
        </p>
    </div>

<!-- Form Card -->
<div class="modern-card p-8 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">

    <!-- ✅ Flash Message -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl border text-sm font-medium flex items-center gap-2"
             style="background: #d4edda; border-color: #c3e6cb; color: #155724;">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

            <!-- Gambar Produk -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                    <i class="fas fa-image mr-2" style="color:var(--primary-color)"></i>Gambar Produk
                </label>
                <input type="file" name="image" id="image"
                    class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all cursor-pointer"
                    style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color)">
                @error('image')
                    <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nama Produk -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                    <i class="fas fa-tag mr-2" style="color:var(--primary-color)"></i>Nama Produk
                </label>
                <input type="text" name="name" id="name"
                    class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                    style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                    value="{{ old('name') }}" 
                    placeholder="Masukkan nama produk" required>
                @error('name')
                    <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori & Supplier -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="category_id" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-layer-group mr-2" style="color:var(--primary-color)"></i>Kategori
                    </label>
                    <select name="category_id" id="category_id"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" {{ old('category_id') == $c->id ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="supplier_id" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-truck mr-2" style="color:var(--primary-color)"></i>Supplier
                    </label>
                    <select name="supplier_id" id="supplier_id"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                {{ $supplier->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Stok & Harga -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="stock" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-boxes-stacked mr-2" style="color:var(--primary-color)"></i>Stok
                    </label>
                    <input type="number" name="stock" id="stock"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                        value="{{ old('stock', 0) }}" min="0" placeholder="Jumlah stok" required>
                    @error('stock')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-money-bill-wave mr-2" style="color:var(--primary-color)"></i>Harga (Rp)
                    </label>
                    <input type="number" name="price" id="price"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                        value="{{ old('price', 0) }}" min="0" step="0.01" placeholder="Harga produk" required>
                    @error('price')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex flex-col sm:flex-row gap-4 mt-10">
                <button type="submit"
                    class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all"
                    style="background:var(--primary-color); color:white;">
                    <i class="fas fa-plus-circle mr-2"></i> Tambah Produk
                </button>
                <a href="{{ route('products.index') }}"
                    class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all text-center"
                    style="background:var(--panel-color); color:var(--text-color); border: 1px solid var(--border-color)">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
