{{-- @extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-500">Selamat datang di sistem Stockify</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm text-gray-500">Total Produk</h2>
            <p class="text-2xl font-bold text-gray-800">{{ $totalProducts ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm text-gray-500">Transaksi Masuk</h2>
            <p class="text-2xl font-bold text-green-600">{{ $transactionsIn ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm text-gray-500">Transaksi Keluar</h2>
            <p class="text-2xl font-bold text-red-600">{{ $transactionsOut ?? 0 }}</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-sm text-gray-500">Stok Rendah</h2>
            <p class="text-2xl font-bold text-yellow-600">{{ isset($lowStockProducts) ? $lowStockProducts->count() : 0 }}</p>

        </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Grafik Barang Masuk -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4">Barang Masuk</h2>
            <canvas id="chartIn"></canvas>
        </div>

        <!-- Grafik Barang Keluar -->
        <div class="bg-white p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4">Barang Keluar</h2>
            <canvas id="chartOut"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
   <div class="dashboard-panel p-6 xl:col-span-1">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-semibold text-gray-800">Aktivitas Terbaru</h2>
        <div class="p-2 bg-blue-100 rounded-lg shadow-inner">
            <i class="fas fa-history text-blue-600"></i>
        </div>
    </div>
    <div class="space-y-4 h-72 overflow-y-auto pr-2">
        @foreach($recentActivities as $activity)
        <div class="activity-item p-4 rounded-lg border border-gray-100">
            <div class="flex justify-between items-start">
                <div>
                    <p class="font-medium text-gray-800">{{ $activity->user->name ?? 'Admin' }}</p>
                    <p class="text-sm text-gray-600">{{ $activity->action }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $activity->details }}</p>
                </div>
                <span class="text-xs text-gray-400 whitespace-nowrap">{{ $activity->created_at->format('d M H:i') }}</span>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxIn = document.getElementById('chartIn').getContext('2d');
    new Chart(ctxIn, {
        type: 'line',
        data: {
            labels: @json($days ?? []),
            datasets: [{
                label: 'Barang Masuk',
                data: @json($inData ?? []),
                borderColor: 'rgb(37, 99, 235)',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });

    const ctxOut = document.getElementById('chartOut').getContext('2d');
    new Chart(ctxOut, {
        type: 'line',
        data: {
            labels: @json($days ?? []),
            datasets: [{
                label: 'Barang Keluar',
                data: @json($outData ?? []),
                borderColor: 'rgb(220, 38, 38)',
                backgroundColor: 'rgba(220, 38, 38, 0.2)',
                fill: true,
                tension: 0.3
            }]
        }
    });
</script>
@endsection --}}
@extends('layouts.app')

@section('content')
@php
    $themes = [
        'light' => [
            'card' => 'bg-white text-gray-800 border border-gray-200',
            'title' => 'text-gray-800',
            'subtitle' => 'text-gray-500',
        ],
        'dark' => [
            'card' => 'bg-gray-800 text-gray-100 border border-gray-700',
            'title' => 'text-white',
            'subtitle' => 'text-gray-400',
        ],
        'blue' => [
            'card' => 'bg-blue-900 text-white border border-blue-700',
            'title' => 'text-white',
            'subtitle' => 'text-blue-200',
        ],
        'green' => [
            'card' => 'bg-green-900 text-white border border-green-700',
            'title' => 'text-white',
            'subtitle' => 'text-green-200',
        ],
    ];
    $t = $themes[$appSettings['theme'] ?? 'light'];
@endphp

<div class="p-6 space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-extrabold {{ $t['title'] }}">Dashboard manager</h1>
        <p class="{{ $t['subtitle'] }}">Selamat datang di sistem Stockify</p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-sm {{ $t['subtitle'] }}">Total Produk</h2>
            <p class="text-2xl font-bold">{{ $totalProducts ?? 0 }}</p>
        </div>
        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-sm {{ $t['subtitle'] }}">Transaksi Masuk</h2>
            <p class="text-2xl font-bold text-green-400">{{ $transactionsIn ?? 0 }}</p>
        </div>
        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-sm {{ $t['subtitle'] }}">Transaksi Keluar</h2>
            <p class="text-2xl font-bold text-red-400">{{ $transactionsOut ?? 0 }}</p>
        </div>
        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-sm {{ $t['subtitle'] }}">Stok Rendah</h2>
            <p class="text-2xl font-bold text-yellow-400">
                {{ isset($lowStockProducts) ? $lowStockProducts->count() : 0 }}
            </p>
        </div>
    </div>

    <!-- Grafik -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4 {{ $t['title'] }}">Barang Masuk</h2>
            <canvas id="chartIn"></canvas>
        </div>

        <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
            <h2 class="text-lg font-bold mb-4 {{ $t['title'] }}">Barang Keluar</h2>
            <canvas id="chartOut"></canvas>
        </div>
    </div>

    <!-- Aktivitas Terbaru -->
    <div class="{{ $t['card'] }} p-6 rounded-2xl shadow">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold {{ $t['title'] }}">Aktivitas Terbaru</h2>
            <div class="p-2 rounded-lg shadow-inner bg-opacity-20" style="background: var(--primary-color)">
                <i class="fas fa-history text-white"></i>
            </div>
        </div>
        <div class="space-y-4 h-72 overflow-y-auto pr-2">
            @foreach($recentActivities as $activity)
            <div class="p-4 rounded-lg border border-opacity-20">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-medium">{{ $activity->user->name ?? 'Admin' }}</p>
                        <p class="text-sm opacity-80">{{ $activity->action }}</p>
                        <p class="text-xs opacity-60 mt-1">{{ $activity->details }}</p>
                    </div>
                    <span class="text-xs opacity-50 whitespace-nowrap">{{ $activity->created_at->format('d M H:i') }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctxIn = document.getElementById('chartIn').getContext('2d');
    new Chart(ctxIn, {
        type: 'line',
        data: {
            labels: @json($days ?? []),
            datasets: [{
                label: 'Barang Masuk',
                data: @json($inData ?? []),
                borderColor: 'rgb(37, 99, 235)',
                backgroundColor: 'rgba(37, 99, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '{{ $appSettings["theme"] === "dark" ? "#fff" : "#000" }}' } } },
            scales: {
                x: { ticks: { color: '{{ $appSettings["theme"] === "dark" ? "#ccc" : "#555" }}' } },
                y: { ticks: { color: '{{ $appSettings["theme"] === "dark" ? "#ccc" : "#555" }}' } }
            }
        }
    });

    const ctxOut = document.getElementById('chartOut').getContext('2d');
    new Chart(ctxOut, {
        type: 'line',
        data: {
            labels: @json($days ?? []),
            datasets: [{
                label: 'Barang Keluar',
                data: @json($outData ?? []),
                borderColor: 'rgb(220, 38, 38)',
                backgroundColor: 'rgba(220, 38, 38, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            plugins: { legend: { labels: { color: '{{ $appSettings["theme"] === "dark" ? "#fff" : "#000" }}' } } },
            scales: {
                x: { ticks: { color: '{{ $appSettings["theme"] === "dark" ? "#ccc" : "#555" }}' } },
                y: { ticks: { color: '{{ $appSettings["theme"] === "dark" ? "#ccc" : "#555" }}' } }
            }
        }
    });
</script>
@endsection
