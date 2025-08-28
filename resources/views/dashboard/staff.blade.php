@extends('layouts.app')

@section('title', 'Dashboard Staff')

@php
    $themes = [
        'light' => [
            'card'     => 'bg-white text-gray-800 border border-gray-100',
            'panel'    => 'bg-white text-gray-800 border border-gray-100',
            'subtitle' => 'text-gray-500',
            'divider'  => 'divide-gray-200',
            'heading'  => 'text-gray-800',
        ],
        'dark' => [
            'card'     => 'bg-gray-800 text-gray-100 border border-gray-700',
            'panel'    => 'bg-gray-800 text-gray-100 border border-gray-700',
            'subtitle' => 'text-gray-400',
            'divider'  => 'divide-gray-700',
            'heading'  => 'text-white',
        ],
        'blue' => [
            'card'     => 'bg-blue-900 text-white border border-blue-700',
            'panel'    => 'bg-blue-900 text-white border border-blue-700',
            'subtitle' => 'text-blue-200',
            'divider'  => 'divide-blue-700',
            'heading'  => 'text-white',
        ],
        'green' => [
            'card'     => 'bg-green-900 text-white border border-green-700',
            'panel'    => 'bg-green-900 text-white border border-green-700',
            'subtitle' => 'text-green-200',
            'divider'  => 'divide-green-700',
            'heading'  => 'text-white',
        ],
    ];
    $theme = $themes[$appSettings['theme'] ?? 'light'];
@endphp

@section('content')
<!-- Header -->
<div class="mb-8">
    <h1 class="text-2xl md:text-3xl font-bold {{ $theme['heading'] }}">Dashboard Staff Gudang</h1>
    <p class="{{ $theme['subtitle'] }}">Selamat datang, {{ Auth::user()->name }}! Berikut tugas dan aktivitas gudang hari ini.</p>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-8">
    <div class="stat-card rounded-xl p-5 {{ $theme['card'] }}">
        <div class="flex items-center">
            <div class="p-3 bg-blue-500/20 rounded-xl mr-4 shadow-inner">
                <i class="fas fa-arrow-down text-blue-400 text-xl"></i>
            </div>
            <div>
                <p class="{{ $theme['subtitle'] }} text-sm"> tugas check Barang Masuk Hari Ini</p>
                <p class="text-2xl font-bold">{{ $summary['incoming_count'] ?? '0' }}</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card rounded-xl p-5 {{ $theme['card'] }}">
        <div class="flex items-center">
            <div class="p-3 bg-green-500/20 rounded-xl mr-4 shadow-inner">
                <i class="fas fa-arrow-up text-green-400 text-xl"></i>
            </div>
            <div>
                <p class="{{ $theme['subtitle'] }} text-sm">tugas check Barang Keluar Hari Ini</p>
                <p class="text-2xl font-bold">{{ $summary['outgoing_count'] ?? '0' }}</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card rounded-xl p-5 {{ $theme['card'] }}">
        <div class="flex items-center">
            <div class="p-3 bg-red-500/20 rounded-xl mr-4 shadow-inner">
                <i class="fas fa-exclamation-triangle text-red-400 text-xl"></i>
            </div>
            <div>
                <p class="{{ $theme['subtitle'] }} text-sm">Stok Menipis</p>
                <p class="text-2xl font-bold text-red-500">{{ $summary['low_stock'] ?? '0' }}</p>
            </div>
        </div>
    </div>
{{-- 
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-8">
    <div class="stat-card rounded-xl p-5 {{ $theme['card'] }}">
        <div class="flex items-center">
            <div class="p-3 bg-green-500/20 rounded-xl mr-4 shadow-inner">
                <i class="fas fa-check text-green-400 text-xl"></i>
            </div>
            <div>
                <p class="{{ $theme['subtitle'] }} text-sm">Barang Disetujui</p>
                <p class="text-2xl font-bold text-green-500">{{ $summary['approved_count'] ?? '0' }}</p>
            </div>
        </div>
    </div>
    
    <div class="stat-card rounded-xl p-5 {{ $theme['card'] }}">
        <div class="flex items-center">
            <div class="p-3 bg-red-500/20 rounded-xl mr-4 shadow-inner">
                <i class="fas fa-times text-red-400 text-xl"></i>
            </div>
            <div>
                <p class="{{ $theme['subtitle'] }} text-sm">Barang Ditolak</p>
                <p class="text-2xl font-bold text-red-500">{{ $summary['rejected_count'] ?? '0' }}</p>
            </div>
        </div>
    </div>
</div> --}}
</div>

<!-- Stock Opname Button -->
<div class="mb-8">
    <a href="{{ route('staff.stock_opname') }}" 
       class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium inline-flex items-center space-x-2 shadow-md hover:bg-blue-700 transition-colors">
        <i class="fas fa-clipboard-check"></i>
        <span>Mulai Stock Opname</span>
    </a>
</div>

<!-- Main Content Area -->
<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
    <!-- Tugas Barang Masuk -->
    <div class="dashboard-panel p-6 rounded-xl {{ $theme['panel'] }}">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold {{ $theme['heading'] }}">Tugas Barang Masuk</h2>
            <div class="p-2 bg-blue-500/20 rounded-lg shadow-inner">
                <i class="fas fa-arrow-down text-blue-400"></i>
            </div>
        </div>
        <div class="overflow-y-auto max-h-72">
            @if(isset($incomingTasks) && $incomingTasks->count() > 0)
                <ul class="divide-y {{ $theme['divider'] }}">
                    @foreach($incomingTasks as $task)
                        <li class="task-item py-4 px-3 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <p class="font-medium">{{ $task->product->name ?? 'Produk' }}</p>
                                    <p class="text-sm {{ $theme['subtitle'] }}">Jumlah: {{ $task->quantity ?? '0' }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('staff.incoming.confirm', $task->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-sm hover:bg-blue-600 transition-colors">
                                        Konfirmasi
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="{{ $theme['subtitle'] }} text-center py-8">Tidak ada tugas barang masuk</p>
            @endif
        </div>
    </div>

    <!-- Tugas Barang Keluar -->
    <div class="dashboard-panel p-6 rounded-xl {{ $theme['panel'] }}">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold {{ $theme['heading'] }}">Tugas Barang Keluar</h2>
            <div class="p-2 bg-green-500/20 rounded-lg shadow-inner">
                <i class="fas fa-arrow-up text-green-400"></i>
            </div>
        </div>
        <div class="overflow-y-auto max-h-72">
            @if(isset($outgoingTasks) && $outgoingTasks->count() > 0)
                <ul class="divide-y {{ $theme['divider'] }}">
                    @foreach($outgoingTasks as $task)
                        <li class="task-item py-4 px-3 rounded-lg">
                            <div class="flex justify-between items-center">
                                <div class="flex-1">
                                    <p class="font-medium">{{ $task->product->name ?? 'Produk' }}</p>
                                    <p class="text-sm {{ $theme['subtitle'] }}">Jumlah: {{ $task->quantity ?? '0' }}</p>
                                </div>
                                <div>
                                    <a href="{{ route('staff.outgoing.confirm', $task->id) }}" class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600 transition-colors">
                                        Konfirmasi
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="{{ $theme['subtitle'] }} text-center py-8">Tidak ada tugas barang keluar</p>
            @endif
        </div>
    </div>
</div>

<!-- Quick Actions -->
{{-- <div class="rounded-xl p-6 {{ $theme['card'] }}">
    <h2 class="text-lg font-semibold mb-6 flex items-center {{ $theme['heading'] }}">
        <i class="fas fa-bolt text-yellow-500 mr-2"></i>
        Aksi Cepat
    </h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('staff.stock_opname') }}" class="quick-action p-4 rounded-lg text-center group">
            <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-yellow-500/30 shadow-inner">
                <i class="fas fa-clipboard-check text-yellow-400 text-xl"></i>
            </div>
            <p class="text-sm font-medium {{ $theme['heading'] }}">Stock Opname</p>
        </a>
        <a href="#" class="quick-action p-4 rounded-lg text-center group">
            <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center mx-auto mb-2 group-hover:bg-purple-500/30 shadow-inner">
                <i class="fas fa-history text-purple-400 text-xl"></i>
            </div>
            <p class="text-sm font-medium {{ $theme['heading'] }}">Riwayat</p>
        </a>
    </div>
</div> --}}
@endsection
