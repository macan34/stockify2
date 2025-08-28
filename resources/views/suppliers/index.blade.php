{{-- @extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8 fade-in">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
                <i class="fas fa-truck mr-2" style="color:var(--primary-color)"></i> Daftar Supplier
            </h1>
            <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
                Kelola data supplier yang memasok produk ke gudang Anda.
            </p>
        </div>
        <a href="{{ route('suppliers.create') }}" 
           class="px-5 py-3 rounded-xl font-medium shadow-md hover-lift transition-all duration-300"
           style="background:var(--primary-color); color:white;">
            <i class="fas fa-plus-circle mr-2"></i> Tambah Supplier
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
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Nama Supplier</th>
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Kontak</th>
                        <th class="p-4 font-semibold text-left" style="color:var(--text-color)">Alamat</th>
                        <th class="p-4 font-semibold text-center" style="color:var(--text-color)">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $s)
                    <tr class="border-t transition-colors hover:bg-gray-800/10" style="border-color:var(--border-color)">
                        <!-- Nama Supplier -->
                        <td class="p-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 shadow-md"
                                     style="background:color-mix(in srgb, var(--primary-color) 15%, transparent); color:var(--primary-color);">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div>
                                    <p class="font-medium" style="color:var(--text-color)">{{ $s->name }}</p>
                                    <p class="text-sm opacity-70" style="color:var(--text-muted)">{{ $s->company ?? '-' }}</p>
                                </div>
                            </div>
                        </td>

                        <!-- Kontak (Email & Telepon) -->
     <!-- Kontak (Email & Telepon/WA) -->
        <td class="table-cell border-t px-4 py-2">
            <div class="space-y-1">
                <!-- Email -->
                <div class="flex items-center text-gray-700">
                    <i class="fas fa-envelope mr-2 text-blue-500"></i>
                    @if($s->email)
                        <a href="mailto:{{ $s->email }}" class="hover:underline text-blue-600">
                            {{ $s->email }}
                        </a>
                    @else
                        <span>-</span>
                    @endif
                </div>

                        <!-- Alamat -->
                        <td class="p-4" style="color:var(--text-color)">
                            <div class="flex items-start">
                                <i class="fas fa-map-marker-alt mr-2 text-red-500 mt-1"></i>
                                <span>{{ $s->address ?? '-' }}</span>
                            </div>
                        </td>

                        <!-- Aksi -->
                        <td class="p-4">
                            <div class="flex gap-2 justify-center">
                                <a href="{{ route('suppliers.edit', $s->id) }}" 
                                   class="p-2.5 rounded-lg hover-lift transition-all"
                                   style="background:var(--panel-color); color:var(--warning-color);" 
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('suppliers.destroy', $s->id) }}" method="POST" 
                                      onsubmit="return confirm('Hapus supplier {{ $s->name }}?')">
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
                    
                    @if(count($suppliers) == 0)
                    <tr>
                        <td colspan="4" class="p-8 text-center" style="color:var(--text-muted)">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4"
                                     style="background:color-mix(in srgb, var(--text-muted) 10%, transparent); color:var(--text-muted);">
                                    <i class="fas fa-truck text-xl"></i>
                                </div>
                                <p class="font-medium">Belum ada supplier</p>
                                <p class="text-sm mt-1">Klik "Tambah Supplier" untuk menambahkan data pertama</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection --}}
@extends('layouts.app')

@section('title', 'Daftar Supplier')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Daftar Supplier</h1>
            <p class="text-gray-600">Informasi lengkap supplier beserta kontak dan alamat.</p>
        </div>
        <a href="{{ route('suppliers.create') }}" 
           class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i> Tambah Supplier
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Nama Supplier</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Kontak</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Alamat</th>
                    <th class="px-4 py-3 text-center text-sm font-semibold text-gray-600">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($suppliers as $s)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <!-- Nama Supplier -->
                    <td class="px-4 py-3 font-medium text-gray-800">
                        {{ $s->name }}
                    </td>

                    <!-- Kontak -->
                    <td class="px-4 py-3 text-gray-700">
                        <div class="space-y-2">
                            <!-- Email -->
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-2 text-blue-500"></i>
                                @if($s->email)
                                    <a href="mailto:{{ $s->email }}" 
                                       class="hover:underline text-blue-600"
                                       title="Kirim Email ke {{ $s->email }}">
                                        {{ $s->email }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>

                            <!-- WhatsApp -->
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-2 text-green-500"></i>
                                @if($s->phone)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $s->phone) }}" 
                                       target="_blank" 
                                       class="hover:underline text-green-600"
                                       title="Chat via WhatsApp">
                                        {{ $s->phone }}
                                    </a>
                                @else
                                    <span>-</span>
                                @endif
                            </div>
                        </div>
                    </td>

                    <!-- Alamat -->
                    <td class="px-4 py-3 text-gray-700">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt mr-2 text-red-500 mt-1"></i>
                            <span>{{ $s->address ?? '-' }}</span>
                        </div>
                    </td>

                    <!-- Aksi -->
                    <td class="p-4">
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('suppliers.edit', $s->id) }}" 
                               class="p-2.5 rounded-lg hover-lift transition-all"
                               style="background:var(--panel-color); color:var(--warning-color);" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('suppliers.destroy', $s->id) }}" method="POST" 
                                  onsubmit="return confirm('Hapus supplier {{ $s->name }}?')">
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
                
                @if(count($suppliers) == 0)
                <tr>
                    <td colspan="4" class="p-8 text-center" style="color:var(--text-muted)">
                        <div class="flex flex-col items-center justify-center">
                            <div class="w-16 h-16 rounded-full flex items-center justify-center mb-4"
                                 style="background:color-mix(in srgb, var(--text-muted) 10%, transparent); color:var(--text-muted);">
                                <i class="fas fa-truck text-xl"></i>
                            </div>
                            <p class="font-medium">Belum ada supplier</p>
                            <p class="text-sm mt-1">Klik "Tambah Supplier" untuk menambahkan data pertama</p>
                        </div>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
