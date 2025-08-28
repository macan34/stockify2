@extends('layouts.app')

@section('title', 'Laporan Aktivitas Pengguna')

@section('content')
<div class="container py-6">

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold mb-1" style="font-size: 2rem;">
            <i class="fas fa-chart-line me-2 text-primary"></i>Laporan Aktivitas Pengguna
        </h1>
        <p class="text-muted mb-0">Monitor aktivitas pengguna dalam sistem</p>
    </div>

    <!-- Filter Form -->
    <div class="card shadow-sm mb-4 p-4">
        <form method="GET" action="{{ route('reports.activity') }}" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Tanggal Mulai</label>
                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="fas fa-filter me-2"></i>Filter Data
                </button>
            </div>
        </form>
    </div>

    <!-- Data Aktivitas -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-light">
            <span><i class="fas fa-list me-2"></i>Data Aktivitas Pengguna</span>
            <span class="badge bg-primary">{{ $activities->count() }} Aktivitas</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive" style="max-height: 500px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="table-light position-sticky top-0">
                        <tr>
                            <th>User</th>
                            <th>Aktivitas</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($activities as $log)
                        <tr>
                            <td>
                                <span class="badge bg-info text-white">
                                    <i class="fas fa-user me-2"></i>{{ $log->user->name ?? 'System' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-secondary text-white">
                                    <i class="fas fa-tasks me-2"></i>{{ $log->activity }}
                                </span>
                            </td>
                            <td>
                                <i class="fas fa-calendar me-2 text-muted"></i>
                                {{ $log->created_at->format('d-m-Y H:i') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center py-5 text-muted">
                                <i class="fas fa-clipboard-list fa-2x mb-2"></i>
                                <div class="fw-bold">Tidak ada data aktivitas</div>
                                <small>Coba gunakan filter tanggal yang berbeda</small>
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
