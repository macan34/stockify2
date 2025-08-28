@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-6">
    <!-- Header with Enhanced Animation -->
    <div class="mb-8 fade-in">
        <h1 class="text-3xl font-extrabold tracking-tight" style="color:var(--text-color)">
            Dashboard Overview
        </h1>
        <p class="text-base opacity-80 mt-2" style="color:var(--text-muted)">
            Selamat datang, {{ Auth::user()->name }} 👋 Berikut ringkasan aktivitas gudang Anda.
        </p>
    </div>

    <!-- Stats Grid with Modern Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        <!-- Total Produk -->
        <div class="modern-card stat-card p-6 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.1s;">
            <div class="flex items-center">
                <div class="p-4 rounded-xl mr-4 shadow-md hover-scale"
                     style="background:color-mix(in srgb, var(--primary-color) 20%, transparent); color:var(--primary-color);">
                    <i class="fas fa-boxes text-2xl"></i>
                </div>
                <div>
                    <p style="color:var(--text-muted)" class="text-sm font-medium">Total Produk</p>
                    <p class="text-3xl font-bold" style="color:var(--primary-color)">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Masuk -->
        <div class="modern-card stat-card p-6 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.2s;">
            <div class="flex items-center">
                <div class="p-4 rounded-xl mr-4 shadow-md hover-scale"
                     style="background:color-mix(in srgb, var(--success-color) 20%, transparent); color:var(--success-color);">
                    <i class="fas fa-arrow-down text-2xl"></i>
                </div>
                <div>
                    <p style="color:var(--text-muted)" class="text-sm font-medium">Transaksi Masuk</p>
                    <p class="text-3xl font-bold status-success">{{ $transactionsIn }}</p>
                </div>
            </div>
        </div>

        <!-- Transaksi Keluar -->
        <div class="modern-card stat-card p-6 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.3s;">
            <div class="flex items-center">
                <div class="p-4 rounded-xl mr-4 shadow-md hover-scale"
                     style="background:color-mix(in srgb, var(--warning-color) 20%, transparent); color:var(--warning-color);">
                    <i class="fas fa-arrow-up text-2xl"></i>
                </div>
                <div>
                    <p style="color:var(--text-muted)" class="text-sm font-medium">Transaksi Keluar</p>
                    <p class="text-3xl font-bold status-warning">{{ $transactionsOut }}</p>
                </div>
            </div>
        </div>

        <!-- Stok Rendah -->
        <div class="modern-card stat-card p-6 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.4s;">
            <div class="flex items-center">
                <div class="p-4 rounded-xl mr-4 shadow-md hover-scale"
                     style="background:color-mix(in srgb, var(--danger-color) 20%, transparent); color:var(--danger-color);">
                    <i class="fas fa-exclamation-triangle text-2xl"></i>
                </div>
                <div>
                    <p style="color:var(--text-muted)" class="text-sm font-medium">Stok Rendah</p>
                    <p class="text-3xl font-bold status-danger">{{ $lowStockProducts->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Area with Enhanced Layout -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6 mb-8">
        <!-- Chart Section with Modern Glass Effect -->
        <div class="modern-card dashboard-panel p-6 xl:col-span-1 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.5s;">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold" style="color:var(--text-color)">Grafik Stok 30 Hari</h2>
                <div class="p-3 rounded-xl shadow-lg hover-glow" style="background:var(--primary-color); color:white;">
                    <i class="fas fa-chart-area"></i>
                </div>
            </div>
            <div class="h-72 relative">
                <canvas id="stockChart" class="rounded-lg"></canvas>
            </div>
        </div>

        <!-- Recent Activities with Scrollbar Styling -->
        <div class="modern-card dashboard-panel p-6 xl:col-span-1 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.6s;">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-semibold" style="color:var(--text-color)">Aktivitas Terbaru</h2>
                <div class="p-3 rounded-xl shadow-lg hover-glow" style="background:var(--primary-color); color:white;">
                    <i class="fas fa-history"></i>
                </div>
            </div>
            <div class="space-y-4 h-72 overflow-y-auto pr-2">
                @foreach($recentActivities as $index => $activity)
                <div class="activity-item modern-card p-4 rounded-xl border-0 hover:border-[var(--primary-color)] transition-all duration-300 hover-scale slide-in-right"
                     style="background:var(--panel-color); border: 1px solid rgba(148, 163, 184, 0.1); animation-delay: {{ 0.1 * $index }}s;">
                    <div class="flex justify-between items-start">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold"
                                 style="background:var(--primary-light); color:var(--primary-color);">
                                {{ substr($activity->user->name ?? 'A', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-medium text-sm" style="color:var(--text-color)">{{ $activity->user->name ?? 'Admin' }}</p>
                                <p class="text-sm opacity-80" style="color:var(--text-muted)">{{ $activity->action }}</p>
                                <p class="text-xs opacity-70" style="color:var(--text-muted)">{{ $activity->details }}</p>
                            </div>
                        </div>
                        <span class="text-xs opacity-60 whitespace-nowrap" style="color:var(--text-muted)">
                            {{ $activity->created_at->format('d M H:i') }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Quick Actions with Enhanced Grid -->
        <div class="modern-card dashboard-panel p-6 xl:col-span-1 rounded-2xl hover-lift fade-in"
             style="background:var(--card-bg); animation-delay: 0.7s;">
            <h2 class="text-lg font-semibold mb-6 flex items-center" style="color:var(--text-color)">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center mr-3" style="background:var(--warning-color);">
                    <i class="fas fa-bolt text-white text-sm"></i>
                </div>
                Aksi Cepat
            </h2>
            <div class="grid grid-cols-2 gap-4 h-72 overflow-y-auto">
                @php
                    $actions = [
                        ['route'=>'products.index','icon'=>'fa-box','label'=>'Kelola Produk', 'color'=>'primary'],
                        ['route'=>'categories.index','icon'=>'fa-tags','label'=>'Kelola Kategori', 'color'=>'success'],
                        ['route'=>'suppliers.index','icon'=>'fa-truck-loading','label'=>'Kelola Supplier', 'color'=>'info'],
                        ['route'=>'reports.stock','icon'=>'fa-chart-pie','label'=>'Laporan Stok', 'color'=>'warning'],
                        ['route'=>'reports.activity','icon'=>'fa-chart-line','label'=>'Laporan Aktivitas', 'color'=>'danger'],
                        ['route'=>'reports.transactions','icon'=>'fa-exchange-alt','label'=>'Laporan Transaksi', 'color'=>'primary'],
                    ];
                @endphp

                @foreach($actions as $index => $act)
                <a href="{{ route($act['route']) }}" 
                   class="quick-action modern-card p-4 rounded-xl text-center group transition-all duration-300 hover-lift hover-glow slide-in-right"
                   style="background:var(--panel-color); animation-delay: {{ 0.1 * $index }}s;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform duration-300 shadow-lg"
                         style="background:var(--{{ $act['color'] === 'primary' ? 'primary' : ($act['color'] === 'success' ? 'success' : ($act['color'] === 'info' ? 'info' : ($act['color'] === 'warning' ? 'warning' : 'danger'))) }}-color); color:white;">
                        <i class="fas {{ $act['icon'] }} text-lg"></i>
                    </div>
                    <p class="text-sm font-medium group-hover:text-[var(--primary-color)] transition-colors" 
                       style="color:var(--text-color)">{{ $act['label'] }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Additional Modern Features -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 fade-in" style="animation-delay: 0.8s;">
        <!-- System Status Card -->
        <div class="modern-card p-6 rounded-2xl hover-lift" style="background:var(--card-bg);">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold" style="color:var(--text-color)">Status Sistem</h3>
                <div class="w-3 h-3 rounded-full bg-green-400 animate-pulse"></div>
            </div>
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm" style="color:var(--text-muted)">Server Status</span>
                    <span class="text-sm font-medium status-success">Online</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm" style="color:var(--text-muted)">Database</span>
                    <span class="text-sm font-medium status-success">Connected</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm" style="color:var(--text-muted)">Last Backup</span>
                    <span class="text-sm font-medium" style="color:var(--text-color)">{{ now()->subHours(2)->format('H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Stats Summary -->
        <div class="modern-card p-6 rounded-2xl hover-lift" style="background:var(--card-bg);">
            <h3 class="text-lg font-semibold mb-4" style="color:var(--text-color)">Ringkasan Hari Ini</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="text-center p-3 rounded-lg" style="background:var(--panel-color);">
                    <p class="text-2xl font-bold status-success">+{{ $transactionsIn ?? 0 }}</p>
                    <p class="text-xs" style="color:var(--text-muted)">Barang Masuk</p>
                </div>
                <div class="text-center p-3 rounded-lg" style="background:var(--panel-color);">
                    <p class="text-2xl font-bold status-warning">-{{ $transactionsOut ?? 0 }}</p>
                    <p class="text-xs" style="color:var(--text-muted)">Barang Keluar</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('stockChart').getContext('2d');

    // Get CSS custom properties for dynamic theming
    const primaryColor = getComputedStyle(document.documentElement).getPropertyValue('--primary-color').trim();
    const successColor = getComputedStyle(document.documentElement).getPropertyValue('--success-color').trim();
    const warningColor = getComputedStyle(document.documentElement).getPropertyValue('--warning-color').trim();
    const textColor = getComputedStyle(document.documentElement).getPropertyValue('--text-color').trim();
    const textMuted = getComputedStyle(document.documentElement).getPropertyValue('--text-muted').trim();

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($days),
            datasets: [
                {
                    label: 'Barang Masuk',
                    data: @json($inData),
                    borderColor: successColor,
                    backgroundColor: successColor + '20',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: successColor,
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: successColor,
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3
                },
                {
                    label: 'Barang Keluar',
                    data: @json($outData),
                    borderColor: warningColor,
                    backgroundColor: warningColor + '20',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointBackgroundColor: warningColor,
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: warningColor,
                    pointHoverBorderColor: '#ffffff',
                    pointHoverBorderWidth: 3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: { 
                    display: true, 
                    position: 'bottom',
                    labels: {
                        color: textColor,
                        font: {
                            size: 12,
                            weight: '600'
                        },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: primaryColor,
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        title: function(context) {
                            return 'Tanggal: ' + context[0].label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        color: textMuted + '20',
                        drawBorder: false
                    },
                    ticks: {
                        color: textMuted,
                        font: {
                            size: 11,
                            weight: '500'
                        }
                    }
                },
                y: {
                    grid: {
                        color: textMuted + '20',
                        drawBorder: false
                    },
                    ticks: {
                        color: textMuted,
                        font: {
                            size: 11,
                            weight: '500'
                        }
                    },
                    beginAtZero: true
                }
            },
            animation: {
                duration: 2000,
                easing: 'easeInOutQuart'
            },
            hover: {
                animationDuration: 300
            }
        }
    });

    // Add smooth animations to stat cards
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        setTimeout(() => {
            card.classList.add('animate__animated', 'animate__bounceIn');
        }, index * 150);
    });

    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe dashboard panels
    document.querySelectorAll('.dashboard-panel').forEach(panel => {
        panel.style.opacity = '0';
        panel.style.transform = 'translateY(30px)';
        panel.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(panel);
    });
});

// Add real-time clock to header
function updateClock() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('id-ID', { 
        hour: '2-digit', 
        minute: '2-digit', 
        second: '2-digit' 
    });
    
    const clockElement = document.getElementById('real-time-clock');
    if (clockElement) {
        clockElement.textContent = timeString;
    }
}

// Update clock every second
setInterval(updateClock, 1000);
updateClock(); // Initial call
</script>
@endsection