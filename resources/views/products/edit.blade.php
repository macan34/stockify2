@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="mb-8 fade-in">
        <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
            <i class="fas fa-edit mr-2" style="color:var(--primary-color)"></i> Edit Produk
        </h1>
        <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
            Perbarui informasi produk yang sudah ada dalam inventori.
        </p>
    </div>

    <!-- Form Container -->
    <div class="modern-card p-8 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <form action="{{ route('products.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nama Produk -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                    <i class="fas fa-tag mr-2" style="color:var(--primary-color)"></i>Nama Produk
                </label>
                <input type="text" name="name" id="name"
                    class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                    style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                    value="{{ old('name', $product->name) }}" 
                    placeholder="Masukkan nama produk" required>
                @error('name')
                    <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                @enderror
            </div>

            <!-- Kategori dan Supplier -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Kategori -->
                <div>
                    <label for="category_id" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-layer-group mr-2" style="color:var(--primary-color)"></i>Kategori
                    </label>
                    <select name="category_id" id="category_id" 
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}" 
                                {{ $c->id == old('category_id', $product->category_id) ? 'selected' : '' }}>
                                {{ $c->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Supplier -->
                <div>
                    <label for="supplier_id" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-truck-loading mr-2" style="color:var(--primary-color)"></i>Supplier
                    </label>
                    <select name="supplier_id" id="supplier_id" 
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)" required>
                        <option value="">-- Pilih Supplier --</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}" 
                                {{ $s->id == old('supplier_id', $product->supplier_id) ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Stok dan Harga -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- Stok -->
                <div>
                    <label for="stock" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-boxes mr-2" style="color:var(--primary-color)"></i>Stok
                    </label>
                    <input type="number" name="stock" id="stock"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                        value="{{ old('stock', $product->stock) }}" 
                        min="0" placeholder="Jumlah stok" required>
                    @error('stock')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Harga -->
                <div>
                    <label for="price" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                        <i class="fas fa-tag mr-2" style="color:var(--primary-color)"></i>Harga (Rp)
                    </label>
                    <input type="number" name="price" id="price"
                        class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                        value="{{ old('price', $product->price) }}" 
                        min="0" step="0.01" placeholder="Harga produk" required>
                    @error('price')
                        <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                    @enderror
                </div>
            </div>


                        <!-- Gambar -->
            <div class="mb-6">
                <label for="image" class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                    <i class="fas fa-image mr-2" style="color:var(--primary-color)"></i>Gambar Produk
                </label>
                
                <!-- Preview jika sudah ada gambar -->
                @if($product->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Gambar Produk" class="h-32 rounded-lg shadow">
                    </div>
                @endif

                <input type="file" name="image" id="image"
                    class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                    style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
                
                @error('image')
                    <p class="mt-2 text-sm" style="color:var(--danger-color)">{{ $message }}</p>
                @enderror
            </div>


            <!-- Tombol -->
            <div class="flex flex-col sm:flex-row gap-4 mt-10">
                <button type="submit" class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all"
                        style="background:var(--primary-color); color:white;">
                    <i class="fas fa-save mr-2"></i>Simpan Perubahan
                </button>
                <a href="{{ route('products.index') }}" class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all text-center"
                   style="background:var(--panel-color); color:var(--text-color); border: 1px solid var(--border-color)">
                    <i class="fas fa-times mr-2"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection