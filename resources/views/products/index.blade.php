@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="flex justify-between items-center mb-8 fade-in">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
                <i class="fas fa-box mr-2" style="color:var(--primary-color)"></i> Daftar Produk
            </h1>
            <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
                Kelola semua produk dalam inventori gudang Anda.
            </p>
        </div>
        <a href="{{ route('products.create') }}"
           class="px-5 py-3 rounded-xl font-medium shadow-md hover-lift transition-all duration-300"
           style="background:var(--primary-color); color:white;">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>

    <!-- Products Table with Modern Card -->
    <div class="modern-card p-6 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <!-- Table Container -->
        <div class="overflow-x-auto rounded-xl" style="border: 1px solid var(--border-color);">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background:var(--panel-color);">
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">ID</th>
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Nama</th>
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Kategori</th>
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Supplier</th>
                        <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Stok</th>
                        <th class="p-4 font-semibold text-right" style="color:var(--text-color)">Harga</th>
                        <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $p)
                    <tr class="border-t transition-colors hover:bg-gray-800/10" style="border-color:var(--border-color)">
                        <td class="p-4 font-semibold" style="color:var(--text-muted)">#{{ $p->id }}</td>
                        <td class="p-4" style="color:var(--text-color)">{{ $p->name }}</td>
                        <td class="p-4" style="color:var(--text-color)">
                            <span class="px-3 py-1 rounded-full text-xs" 
                                  style="background:color-mix(in srgb, var(--primary-color) 10%, transparent); color:var(--primary-color);">
                                {{ $p->category->name ?? '-' }}
                            </span>
                        </td>
                        <td class="p-4" style="color:var(--text-color)">{{ $p->supplier->name ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                {{ $p->stock > 10 ? 'bg-green-600/20 text-green-400' :
                                   ($p->stock > 0 ? 'bg-yellow-600/20 text-yellow-400' : 'bg-red-600/20 text-red-400') }}">
                                {{ $p->stock }}
                            </span>
                        </td>
                        <td class="p-4 text-right font-bold" style="color:var(--primary-color)">
                            Rp {{ number_format($p->price, 0, ',', '.') }}
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('products.show', $p->id) }}" 
                                   class="p-2.5 rounded-lg hover-lift transition-all"
                                   style="background:var(--panel-color); color:var(--info-color);" 
                                   title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('products.edit', $p->id) }}" 
                                   class="p-2.5 rounded-lg hover-lift transition-all"
                                   style="background:var(--panel-color); color:var(--warning-color);" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('products.destroy', $p->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus produk {{ $p->name }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2.5 rounded-lg hover-lift transition-all"
                                            style="background:var(--panel-color); color:var(--danger-color);" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center" style="color:var(--text-muted)">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4"
                                     style="background:color-mix(in srgb, var(--text-muted) 10%, transparent); color:var(--text-muted);">
                                    <i class="fas fa-inbox text-xl"></i>
                                </div>
                                <p class="font-medium">Belum ada produk</p>
                                <p class="text-sm mt-1">Klik "Tambah Produk" untuk menambahkan produk pertama</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-6 pt-4 border-t flex justify-between items-center" style="border-color:var(--border-color)">
            <div class="text-sm" style="color:var(--text-muted)">
                Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} dari {{ $products->total() }} produk
            </div>
            <div class="flex gap-1">
                @if($products->onFirstPage())
                <span class="px-3 py-2 rounded-lg opacity-50" style="background:var(--panel-color); color:var(--text-color);">
                    <i class="fas fa-chevron-left"></i>
                </span>
                @else
                <a href="{{ $products->previousPageUrl() }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
                   style="background:var(--panel-color); color:var(--text-color);">
                    <i class="fas fa-chevron-left"></i>
                </a>
                @endif
                
                @foreach($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    @if($page == $products->currentPage())
                    <span class="px-3 py-2 rounded-lg font-medium" 
                          style="background:var(--primary-color); color:white;">{{ $page }}</span>
                    @else
                    <a href="{{ $url }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
                       style="background:var(--panel-color); color:var(--text-color);">{{ $page }}</a>
                    @endif
                @endforeach
                
                @if($products->hasMorePages())
                <a href="{{ $products->nextPageUrl() }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
                   style="background:var(--panel-color); color:var(--text-color);">
                    <i class="fas fa-chevron-right"></i>
                </a>
                @else
                <span class="px-3 py-2 rounded-lg opacity-50" style="background:var(--panel-color); color:var(--text-color);">
                    <i class="fas fa-chevron-right"></i>
                </span>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add animations to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(20px)';
        row.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        setTimeout(() => {
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, 100 + (index * 50));
    });
});
</script>
@endsection