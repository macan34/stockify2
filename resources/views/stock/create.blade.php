@extends('layouts.app')

@section('title', 'Tambah Transaksi Stok')

@section('content')
<div class="container py-6">
    <div class="mb-6 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="fw-bold mb-1" style="font-size: 2rem;">
                <i class="fas fa-plus-circle me-2 text-primary"></i>Tambah Transaksi Stok
            </h1>
            <p class="text-muted mb-0">Tambah transaksi masuk atau keluar stok</p>
        </div>
        <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>Kembali
        </a>
    </div>

    <div class="card shadow-sm rounded-3">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="fas fa-exclamation-circle me-1"></i>Terjadi Kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('stocks.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Produk</label>
                    <select name="product_id" class="form-select" required>
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jenis Transaksi</label>
                    <select name="type" class="form-select" required>
                        <option value="masuk">Stok Masuk</option>
                        <option value="keluar">Stok Keluar</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="quantity" class="form-control" min="1" required placeholder="Masukkan jumlah">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i>Simpan
                    </button>
                    <a href="{{ route('stocks.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times me-1"></i>Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
