@extends('layouts.app')

@section('title', 'Manajemen Stok')

@section('content')
<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="fw-semibold fs-3 mb-1">
                <i class="bi bi-box-seam me-2 text-primary"></i>Manajemen Stok
            </h1>
            <p class="text-muted mb-0">Kelola transaksi masuk dan keluar stok produk</p>
        </div>
        <a href="{{ route('stocks.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi
        </a>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-1"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-1"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- Transaksi Stok -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top-4">
                    <h6 class="mb-0"><i class="bi bi-list-ul me-2"></i>Daftar Transaksi Stok</h6>
                    <span class="badge bg-primary">{{ $transactions->count() }} Transaksi</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                        <table class="table table-hover table-borderless align-middle mb-0">
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Produk</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Petugas</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($transactions as $t)
                                    <tr>
                                        <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
                                        <td class="fw-semibold">{{ $t->product->name ?? '-' }}</td>
                                        <td>
                                            <span class="badge bg-{{ $t->type == 'masuk' ? 'success-subtle text-success' : 'danger-subtle text-danger' }} px-2">
                                                <i class="bi bi-arrow-{{ $t->type == 'masuk' ? 'down' : 'up' }}-short me-1"></i>{{ ucfirst($t->type) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-{{ $t->type == 'masuk' ? 'success' : 'danger' }}">
                                                {{ $t->type == 'masuk' ? '+' : '-' }}{{ $t->quantity }}
                                            </span>
                                        </td>
                                        <td>{{ $t->user->name ?? 'System' }}</td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('stocks.edit', $t->id) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="bi bi-pencil-square me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('stocks.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash me-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5">
                                            <i class="bi bi-inbox-fill fs-2 text-muted mb-2"></i>
                                            <div class="fw-semibold text-muted">Belum ada transaksi</div>
                                            <small class="text-muted">Silakan tambahkan transaksi stok pertama Anda</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Riwayat Aktivitas -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center rounded-top-4">
                    <h6 class="mb-0"><i class="bi bi-clock-history me-2"></i>Riwayat Aktivitas</h6>
                    <span class="badge bg-info">10 Terbaru</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                        <table class="table table-hover table-sm table-borderless align-middle mb-0">
                            <thead class="table-light position-sticky top-0">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Aktivitas</th>
                                    <th>Detail</th>
                                    <th>User</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse(\App\Models\ActivityLog::latest()->take(10)->get() as $log)
                                    <tr>
                                        <td>{{ $log->created_at->format('d-m-Y H:i') }}</td>
                                        <td><span class="badge bg-secondary-subtle text-dark">{{ $log->action }}</span></td>
                                        <td>{{ $log->details }}</td>
                                        <td>{{ $log->user->name ?? 'System' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="bi bi-clipboard-x fs-2 text-muted mb-2"></i>
                                            <div class="fw-semibold text-muted">Belum ada riwayat aktivitas</div>
                                            <small class="text-muted">Riwayat aktivitas akan muncul di sini</small>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
