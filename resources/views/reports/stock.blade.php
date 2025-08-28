@extends('layouts.app')

@section('title', 'Laporan Stok Barang')

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .header-gradient {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 15px 15px;
    }
    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }
    .card-header-custom {
        background-color: #f1f5fd;
        border-bottom: 1px solid #e3e9f7;
        font-weight: 600;
        font-size: 1.25rem;
        padding: 1.25rem 1.5rem;
    }
    .card-body-custom {
        padding: 1.5rem;
    }
    .table thead th {
        background-color: #1e40af;
        color: white;
        font-weight: 600;
        padding: 1rem;
        font-size: 1.05rem;
    }
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        font-size: 1.05rem;
    }
    .stock-info {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        font-weight: 600;
    }
    .stock-icon {
        font-size: 1.1rem;
    }
</style>
@endpush

@section('content')
    <div class="header-gradient text-center">
        <h1 class="fw-bold mb-0" style="font-size: 2.1rem;">
            <i class="fas fa-boxes me-2"></i>Laporan Stok Barang
        </h1>
        <p class="mb-0 mt-1 opacity-75" style="font-size: 1.1rem;">Data stok produk terkini</p>
    </div>

    <div class="container">
        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fas fa-cubes me-2"></i>Data Stok Produk</span>
                <span class="badge bg-primary">{{ $products->count() }} Produk</span>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                            <tr>
                                <td>
                                    <span class="product-name">
                                        <i class="fas fa-box me-2"></i>{{ $product->name }}
                                    </span>
                                </td>
                                <td>
                                    <span>
                                        <i class="fas fa-tag me-2"></i>{{ $product->category->name ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="stock-info">
                                        @if($product->stock > 30)
                                            <i class="fas fa-check-circle stock-icon"></i>
                                        @elseif($product->stock > 0)
                                            <i class="fas fa-exclamation-triangle stock-icon"></i>
                                        @else
                                            <i class="fas fa-times-circle stock-icon"></i>
                                        @endif
                                        <span>{{ $product->stock }}</span>
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="fas fa-box-open fa-2x mb-2"></i>
                                    <div>Tidak ada data produk</div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
