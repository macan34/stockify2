@extends('layouts.app')

@section('title', 'Manajemen User')

@push('styles')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 2rem 0;
    }
    .header-gradient {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        padding: 2.5rem 0;
        margin-bottom: 2rem;
        border-radius: 0 0 15px 15px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .card-custom {
        border-radius: 12px;
        border: none;
        box-shadow: 0 5px 25px rgba(0,0,0,0.06);
        overflow: hidden;
        background-color: white;
    }
    .card-header-custom {
        background-color: #f1f5fd;
        border-bottom: 1px solid #e3e9f7;
        font-weight: 600;
        font-size: 1.2rem;
        padding: 1.25rem 1.5rem;
    }
    .card-body-custom {
        padding: 1.5rem;
    }
    .table thead th {
        background-color: #1e3a8a;
        color: white;
        font-weight: 600;
        padding: 1rem;
        font-size: 1.05rem;
        border-bottom: none;
    }
    .table tbody td {
        padding: 1rem;
        vertical-align: middle;
        font-size: 1.05rem;
        color: #343a40;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(37, 117, 252, 0.05);
    }
    .btn-action {
        padding: 0.45rem 0.85rem;
        font-size: 0.9rem;
        border-radius: 6px;
        margin: 0 4px;
        white-space: nowrap;
    }
    .btn-add {
        border-radius: 8px;
        padding: 0.5rem 1.5rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(255,255,255,0.3);
        font-size: 1rem;
        transition: background-color 0.3s ease;
    }
    .btn-add:hover {
        background-color: #e6e6e6;
    }
    .role-badge {
        padding: 0.4rem 0.9rem;
        border-radius: 25px;
        font-weight: 500;
        font-size: 0.85rem;
        text-transform: capitalize;
    }
    .empty-state {
        text-align: center;
        padding: 3rem 2rem;
        color: #6c757d;
    }
    .empty-state i {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #ced4da;
    }
</style>
@endpush


@section('content')
<div class="header-gradient">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="fw-bold mb-0" style="font-size: 2.1rem;">
                    <i class="fas fa-users me-2"></i>Manajemen User
                </h1>
                <p class="mb-0 mt-1 opacity-75" style="font-size: 1.1rem;">Kelola pengguna sistem</p>
            </div>
            <a href="{{ route('users.create') }}" class="btn btn-light btn-add">
                <i class="fas fa-user-plus me-2"></i>Tambah User
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="card-custom">
        <div class="card-header-custom d-flex justify-content-between align-items-center">
            <span><i class="fas fa-list me-2"></i>Daftar User</span>
            <span class="badge bg-primary">{{ $users->count() }} User</span>
        </div>
        <div class="card-body-custom">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th width="180" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    
                                    <div class="fw-semibold">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role)
                                    <span class="role-badge bg-{{ $user->role->name == 'admin' ? 'danger' : 'primary' }} text-white">
                                        <i class="fas fa-{{ $user->role->name == 'admin' ? 'shield-alt' : 'user' }} me-1"></i>
                                        {{ $user->role->name }}
                                    </span>
                                @else
                                    <span class="role-badge bg-secondary text-white">
                                        <i class="fas fa-question me-1"></i>
                                        Tidak ada role
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-action">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-action ms-2" onclick="return confirm('Hapus user?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                        @if($users->count() == 0)
                        <tr>
                            <td colspan="4">
                                <div class="empty-state">
                                    <i class="fas fa-users-slash"></i>
                                    <h5 class="mt-2">Belum ada user</h5>
                                    <p>Silakan tambahkan user pertama Anda</p>
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
