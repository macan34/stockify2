@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="mb-8 fade-in">
        <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
            <i class="fas fa-plus-circle mr-2" style="color:var(--primary-color)"></i> Tambah Kategori
        </h1>
        <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
            Tambahkan kategori baru untuk mengorganisir produk dalam inventori.
        </p>
    </div>

    <!-- Error -->
    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl fade-in" 
             style="background:color-mix(in srgb, var(--danger-color) 15%, transparent); color:var(--danger-color); border-left: 4px solid var(--danger-color);">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle mr-2 text-xl"></i>
                <strong class="font-semibold">Terjadi Kesalahan:</strong>
            </div>
            <ul class="ml-6 list-disc mt-2">
                @foreach ($errors->all() as $error)
                    <li class="mt-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card Form -->
    <div class="modern-card p-8 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-medium mb-3" style="color:var(--text-color)">
                    <i class="fas fa-tag mr-2" style="color:var(--primary-color)"></i>Nama Kategori
                </label>
                <input type="text" name="name" 
                       class="form-input px-4 py-3.5 w-full rounded-xl border-2 focus:outline-none focus:ring-2 focus:ring-opacity-50 transition-all"
                       style="background:var(--panel-color); border-color:var(--border-color); color:var(--text-color); focus:ring-color:var(--primary-color)"
                       value="{{ old('name') }}" 
                       placeholder="Masukkan nama kategori" required>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 mt-10">
                <button type="submit" 
                        class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all"
                        style="background:var(--primary-color); color:white;">
                    <i class="fas fa-save mr-2"></i> Simpan
                </button>
                <a href="{{ route('categories.index') }}" 
                   class="px-6 py-3.5 rounded-xl font-medium flex items-center justify-center sm:flex-1 hover-lift transition-all text-center"
                   style="background:var(--panel-color); color:var(--text-color); border: 1px solid var(--border-color)">
                    <i class="fas fa-times mr-2"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection