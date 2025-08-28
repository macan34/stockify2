@extends('layouts.app')

@section('title', 'Laporan Riwayat Transaksi')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body {
        background-color: #f8f9fa;
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
    .card-body-custom { padding: 1.5rem; }
    .filter-form {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
    }
    .form-label { font-weight: 500; margin-bottom: 0.5rem; color: #374151; }
    .form-control-custom {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        font-size: 1rem;
        width: 100%;
    }
    .btn-filter {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        color: white; border: none; border-radius: 8px;
        padding: 0.75rem 1.5rem; font-weight: 500;
        transition: all 0.2s;
    }
    .btn-filter:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3); }
    .table-custom { border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
    .table thead th {
        background-color: #1e40af; color: white; font-weight: 600;
        padding: 1rem; font-size: 1.05rem;
    }
    .table tbody td { padding: 1rem; vertical-align: middle; font-size: 1.05rem; }
    .table-hover tbody tr:hover { background-color: rgba(37, 117, 252, 0.05); }
    .product-badge { background-color: #dbeafe; color: #1d4ed8; padding: 0.5rem 0.75rem; border-radius: 20px; font-weight: 500; }
    .quantity-badge { background-color: #dcfce7; color: #166534; padding: 0.5rem 0.75rem; border-radius: 20px; font-weight: 600; }
    .empty-state { text-align: center; padding: 3rem; color: #6c757d; }
    .empty-state i { font-size: 3rem; margin-bottom: 1rem; color: #dee2e6; }
</style>
@endpush

@section('content')
    <div class="header-gradient">
        <div class="container">
            <div class="text-center">
                <h1 class="fw-bold mb-0" style="font-size: 2.1rem;">
                    <i class="fas fa-exchange-alt me-2"></i>Laporan Riwayat Transaksi
                </h1>
                <p class="mb-0 mt-1 opacity-75" style="font-size: 1.1rem;">Data lengkap transaksi stok produk</p>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="filter-form">
            <form method="GET" action="{{ route('reports.transactions') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" name="start_date" class="form-control-custom" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" name="end_date" class="form-control-custom" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn-filter w-100">
                        <i class="fas fa-filter me-2"></i>Filter Data
                    </button>
                </div>
            </form>
        </div>

        <div class="card-custom">
            <div class="card-header-custom d-flex justify-content-between align-items-center">
                <span><i class="fas fa-history me-2"></i>Data Transaksi</span>
                <span class="badge bg-primary">{{ $transactions->count() }} Transaksi</span>
            </div>
            <div class="card-body-custom">
                <div class="table-responsive">
                    <table class="table table-hover table-custom">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>User</th>
                                <th>Qty</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $tx)
                            <tr>
                                <td>
                                    <span class="product-badge">
                                        <i class="fas fa-box me-2"></i>@if($tx->product)
                                              <i class="fas fa-box me-2"></i>{{ $tx->product->name }}
                                                    @else
                                                            <span class="text-muted"><i class="fas fa-box me-2"></i>Produk tidak ditemukan</span>
                                                    @endif

                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-user me-2 text-primary"></i>{{ $tx->user->name }}
                                </td>
                                <td>
                                    <span class="quantity-badge">
                                        <i class="fas fa-hashtag me-2"></i>{{ $tx->quantity }}
                                    </span>
                                </td>
                                <td>
                                    <i class="fas fa-calendar me-2 text-muted"></i>
                                    {{ $tx->created_at->format('d-m-Y H:i') }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">
                                    <div class="empty-state">
                                        <i class="fas fa-receipt"></i>
                                        <h5 class="mt-2">Tidak ada data transaksi</h5>
                                        <p>Coba gunakan filter tanggal yang berbeda</p>
                                    </div>
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
