@extends('layouts.app')

@section('title', 'Laporan Stok')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="flex justify-between items-center mb-8 fade-in">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
                <i class="fas fa-chart-line mr-2" style="color:var(--primary-color)"></i> Laporan Stok
            </h1>
            <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
                Pantau pergerakan stok produk dalam periode tertentu.
            </p>
        </div>
    </div>

    <!-- Filter Section -->
    <div class="modern-card p-6 rounded-2xl mb-6 fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <h2 class="text-xl font-semibold mb-4 flex items-center" style="color:var(--text-color)">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3" style="background:var(--primary-color); color:white;">
                <i class="fas fa-filter"></i>
            </div>
            Filter Laporan
        </h2>
        
        <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2" style="color:var(--text-color)">Produk</label>
                <select name="product_id" 
                        class="form-input px-4 py-2.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
                    <option value="">Semua Produk</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2" style="color:var(--text-color)">Kategori</label>
                <select name="category_id" 
                        class="form-input px-4 py-2.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                        style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium mb-2" style="color:var(--text-color)">Dari Tanggal</label>
                <input type="date" name="from" value="{{ request('from') }}" 
                       class="form-input px-4 py-2.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                       style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
            </div>

            <div>
                <label class="block text-sm font-medium mb-2" style="color:var(--text-color)">Sampai Tanggal</label>
                <input type="date" name="to" value="{{ request('to') }}" 
                       class="form-input px-4 py-2.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                       style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)">
            </div>

            <div class="md:col-span-2 lg:col-span-4 flex gap-3 mt-4">
                <button type="submit" 
                        class="px-6 py-2.5 rounded-xl font-medium hover-lift transition-all flex items-center"
                        style="background:var(--primary-color); color:white;">
                    <i class="fas fa-filter mr-2"></i> Terapkan Filter
                </button>
                
                <a href="{{ route('manager.laporan-stok.export', request()->query()) }}" 
                   class="px-6 py-2.5 rounded-xl font-medium hover-lift transition-all flex items-center"
                   style="background:var(--success-color); color:white;">
                    <i class="fas fa-file-excel mr-2"></i> Export Excel
                </a>
                
                <a href="{{ url()->current() }}" 
                   class="px-6 py-2.5 rounded-xl font-medium hover-lift transition-all flex items-center"
                   style="background:var(--panel-color); color:var(--text-color); border: 1px solid var(--border-color);">
                    <i class="fas fa-sync mr-2"></i> Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 fade-in" style="animation-delay: 0.3s;">
        <div class="modern-card p-6 rounded-2xl text-center" style="background:var(--card-bg);">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3" 
                 style="background:color-mix(in srgb, var(--primary-color) 20%, transparent); color:var(--primary-color);">
                <i class="fas fa-list-ol text-xl"></i>
            </div>
            <p class="text-sm" style="color:var(--text-muted)">Total Transaksi</p>
            <p class="text-2xl font-bold mt-1" style="color:var(--text-color)">{{ $transactions->count() }}</p>
        </div>
        
        <div class="modern-card p-6 rounded-2xl text-center" style="background:var(--card-bg);">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3" 
                 style="background:color-mix(in srgb, var(--success-color) 20%, transparent); color:var(--success-color);">
                <i class="fas fa-arrow-down text-xl"></i>
            </div>
            <p class="text-sm" style="color:var(--text-muted)">Total Barang Masuk</p>
            <p class="text-2xl font-bold mt-1" style="color:var(--success-color)">
                {{ $transactions->where('type', 'masuk')->sum('quantity') }}
            </p>
        </div>
        
        <div class="modern-card p-6 rounded-2xl text-center" style="background:var(--card-bg);">
            <div class="w-12 h-12 rounded-lg flex items-center justify-center mx-auto mb-3" 
                 style="background:color-mix(in srgb, var(--warning-color) 20%, transparent); color:var(--warning-color);">
                <i class="fas fa-arrow-up text-xl"></i>
            </div>
            <p class="text-sm" style="color:var(--text-muted)">Total Barang Keluar</p>
            <p class="text-2xl font-bold mt-1" style="color:var(--warning-color)">
                {{ $transactions->where('type', 'keluar')->sum('quantity') }}
            </p>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="modern-card p-6 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.4s;">
        <h2 class="text-xl font-semibold mb-6 flex items-center" style="color:var(--text-color)">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3" style="background:var(--primary-color); color:white;">
                <i class="fas fa-table"></i>
            </div>
            Data Transaksi
        </h2>
        
        @if($transactions->isEmpty())
            <div class="text-center py-8 rounded-xl" style="background:var(--panel-color);">
                <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                     style="background:color-mix(in srgb, var(--text-muted) 10%, transparent); color:var(--text-muted);">
                    <i class="fas fa-inbox text-xl"></i>
                </div>
                <p class="font-medium" style="color:var(--text-color)">Tidak ada data transaksi</p>
                <p class="text-sm mt-1" style="color:var(--text-muted)">Coba ubah filter untuk melihat data</p>
            </div>
        @else
            <div class="overflow-x-auto rounded-xl" style="border: 1px solid var(--border-color);">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="background:var(--panel-color);">
                            <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Tanggal</th>
                            <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Produk</th>
                            <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Kategori</th>
                            <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Tipe</th>
                            <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $t)
                        <tr class="border-t transition-colors hover:bg-gray-800/10" style="border-color:var(--border-color)">
                            <td class="p-4" style="color:var(--text-color)">
                                {{ $t->created_at->format('d-m-Y H:i') }}
                            </td>
                            <td class="p-4" style="color:var(--text-color)">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3"
                                         style="background:color-mix(in srgb, var(--primary-color) 15%, transparent); color:var(--primary-color);">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <span>{{ $t->product->name }}</span>
                                </div>
                            </td>
                            <td class="p-4" style="color:var(--text-color)">
                                <span class="px-3 py-1 rounded-full text-xs" 
                                      style="background:color-mix(in srgb, var(--primary-color) 10%, transparent); color:var(--primary-color);">
                                    {{ $t->product->category->name }}
                                </span>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1.5 rounded-full text-xs font-semibold
                                    {{ $t->type == 'masuk' ? 'bg-green-600/20 text-green-400' : 'bg-red-600/20 text-red-400' }}">
                                    <i class="fas {{ $t->type == 'masuk' ? 'fa-arrow-down' : 'fa-arrow-up' }} mr-1"></i>
                                    {{ ucfirst($t->type) }}
                                </span>
                            </td>
                            <td class="p-4 text-center font-bold" style="color:var(--text-color)">
                                {{ $t->quantity }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination (if applicable) -->
            @if($transactions->hasPages())
            <div class="mt-6 pt-4 border-t flex justify-between items-center" style="border-color:var(--border-color)">
                <div class="text-sm" style="color:var(--text-muted)">
                    Menampilkan {{ $transactions->firstItem() }} - {{ $transactions->lastItem() }} dari {{ $transactions->total() }} transaksi
                </div>
                <div class="flex gap-1">
                    @if($transactions->onFirstPage())
                    <span class="px-3 py-2 rounded-lg opacity-50" style="background:var(--panel-color); color:var(--text-color);">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    @else
                    <a href="{{ $transactions->previousPageUrl() }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
                       style="background:var(--panel-color); color:var(--text-color);">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    @endif
                    
                    @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                        @if($page == $transactions->currentPage())
                        <span class="px-3 py-2 rounded-lg font-medium" 
                              style="background:var(--primary-color); color:white;">{{ $page }}</span>
                        @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
                           style="background:var(--panel-color); color:var(--text-color);">{{ $page }}</a>
                        @endif
                    @endforeach
                    
                    @if($transactions->hasMorePages())
                    <a href="{{ $transactions->nextPageUrl() }}" class="px-3 py-2 rounded-lg hover-lift transition-all"
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