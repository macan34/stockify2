@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="flex justify-between items-center mb-8 fade-in">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
                <i class="fas fa-tags mr-2" style="color:var(--primary-color)"></i> Daftar Kategori
            </h1>
            <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
                Kelola semua kategori produk dalam inventori gudang Anda.
            </p>
        </div>
        <a href="{{ route('categories.create') }}" 
           class="px-5 py-3 rounded-xl font-medium shadow-md hover-lift transition-all duration-300"
           style="background:var(--primary-color); color:white;">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Kategori
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="mb-6 p-4 rounded-xl flex items-center fade-in" 
             style="background:color-mix(in srgb, var(--success-color) 15%, transparent); color:var(--success-color); border-left: 4px solid var(--success-color);">
            <i class="fas fa-check-circle mr-3 text-xl"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- Card Table -->
    <div class="modern-card p-6 rounded-2xl fade-in" style="background:var(--card-bg); animation-delay: 0.2s;">
        <div class="overflow-x-auto rounded-xl" style="border: 1px solid var(--border-color);">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background:var(--panel-color);">
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Nama Kategori</th>
                        <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $c)
                    <tr class="border-t transition-colors hover:bg-gray-800/10" style="border-color:var(--border-color)">
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 shadow-md"
                                     style="background:color-mix(in srgb, var(--primary-color) 15%, transparent); color:var(--primary-color);">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div>
                                    <p class="font-medium" style="color:var(--text-color)">{{ $c->name }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('categories.edit', $c->id) }}" 
                                   class="p-2.5 rounded-lg hover-lift transition-all"
                                   style="background:var(--panel-color); color:var(--warning-color);" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $c->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus kategori {{ $c->name }}?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2.5 rounded-lg hover-lift transition-all"
                                            style="background:var(--panel-color); color:var(--danger-color);" 
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    
                    @if(count($categories) == 0)
                    <tr>
                        <td colspan="2" class="p-8 text-center" style="color:var(--text-muted)">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4"
                                     style="background:color-mix(in srgb, var(--text-muted) 10%, transparent); color:var(--text-muted);">
                                    <i class="fas fa-tags text-xl"></i>
                                </div>
                                <p class="font-medium">Belum ada kategori</p>
                                <p class="text-sm mt-1">Klik "Tambah Kategori" untuk menambahkan kategori pertama</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
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