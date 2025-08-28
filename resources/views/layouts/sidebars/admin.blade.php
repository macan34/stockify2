@php
    $themes = [
        'light' => [
            'sidebar' => 'bg-white text-gray-800 border-r border-gray-100',
            'header' => 'border-gray-100',
            'link' => 'text-gray-600 hover:bg-blue-50 hover:text-blue-700',
            'active' => 'text-blue-700 bg-gradient-to-r from-blue-50 to-blue-100 border-r-4 border-blue-500',
            'icon' => 'text-blue-600',
            'iconActive' => 'text-blue-700',
            'dropdown' => 'bg-gray-50',
            'logout' => 'text-red-600 hover:bg-red-50 hover:text-red-700',
        ],
        'dark' => [
            'sidebar' => 'bg-gray-900 text-gray-100 border-r border-gray-700',
            'header' => 'border-gray-700',
            'link' => 'text-gray-300 hover:bg-gray-800 hover:text-white',
            'active' => 'text-blue-400 bg-gradient-to-r from-gray-800 to-gray-700 border-r-4 border-blue-400',
            'icon' => 'text-gray-400',
            'iconActive' => 'text-blue-400',
            'dropdown' => 'bg-gray-800',
            'logout' => 'text-red-400 hover:bg-red-900/30 hover:text-red-300',
        ],
        'blue' => [
            'sidebar' => 'bg-blue-900 text-white border-r border-blue-700',
            'header' => 'border-blue-700',
            'link' => 'text-blue-100 hover:bg-blue-800 hover:text-white',
            'active' => 'bg-gradient-to-r from-blue-800 to-blue-700 text-white border-r-4 border-white',
            'icon' => 'text-blue-200',
            'iconActive' => 'text-white',
            'dropdown' => 'bg-blue-800',
            'logout' => 'text-red-200 hover:bg-red-800/30 hover:text-red-100',
        ],
        'green' => [
            'sidebar' => 'bg-green-900 text-white border-r border-green-700',
            'header' => 'border-green-700',
            'link' => 'text-green-100 hover:bg-green-800 hover:text-white',
            'active' => 'bg-gradient-to-r from-green-800 to-green-700 text-white border-r-4 border-white',
            'icon' => 'text-green-200',
            'iconActive' => 'text-white',
            'dropdown' => 'bg-green-800',
            'logout' => 'text-red-200 hover:bg-red-800/30 hover:text-red-100',
        ],
    ];
    $theme = $themes[$appSettings['theme'] ?? 'light'];
@endphp

<!-- 🎨 Modern Sidebar Admin with Enhanced Animations -->
<aside class="w-72 shadow-2xl z-10 hidden md:block {{ $theme['sidebar'] }} transition-all duration-500 modern-sidebar">
    <!-- 🏠 Header Logo + Title with Modern Gradient -->
    <div class="flex items-center space-x-4 p-6 border-b {{ $theme['header'] }} animate__animated animate__fadeInDown">
        <!-- 🎯 Modern Logo Container with Hover Effects -->
        <div class="logo-container relative w-16 h-16 flex items-center justify-center rounded-2xl shadow-lg overflow-hidden bg-white hover:shadow-xl transition-all duration-300 hover:scale-105">
            @if(setting('logo'))
                <img src="{{ app_logo() }}" alt="Logo" class="w-full h-full object-contain transition-transform duration-300 hover:scale-110">
            @else
                <i class="fas fa-boxes text-3xl text-blue-600 transition-all duration-300 hover:text-blue-700"></i>
            @endif
            
            <!-- ✨ Animated Border Effect -->
            <div class="absolute inset-0 rounded-2xl border-2 border-transparent bg-gradient-to-r from-blue-500 via-purple-500 to-blue-500 opacity-0 hover:opacity-100 transition-opacity duration-300" style="background-size: 200% 200%; animation: gradientShift 3s ease infinite;"></div>
        </div>

        <!-- 📝 App Name with Gradient Text -->
        <div class="app-title">
            <h1 class="text-2xl font-black bg-gradient-to-r from-blue-600 via-purple-600 to-blue-500 bg-clip-text text-transparent animate-pulse">
                {{ app_name() ?? 'Stockify' }}
            </h1>
            <p class="text-sm opacity-75 font-medium tracking-wide">Admin System</p>
        </div>
    </div>

    <!-- 🧭 Enhanced Navigation with Modern Interactions -->
    <nav class="mt-8 px-4 space-y-2 animate__animated animate__fadeInUp animate__delay-1s">
        
        <!-- 📊 Dashboard Link -->
        <a href="{{ route('admin.dashboard') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('admin.dashboard') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <!-- 🌟 Hover Background Animation -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500/10 to-purple-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-th-large mr-4 text-lg transition-all duration-300 group-hover:scale-110 {{ request()->routeIs('admin.dashboard') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Dashboard</span>
            
            <!-- 💫 Active Indicator -->
            @if(request()->routeIs('admin.dashboard'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- 📦 Products Link -->
        <a href="{{ route('products.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('products.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-green-500/10 to-blue-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-box mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-12 {{ request()->routeIs('products.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Produk</span>
            
            @if(request()->routeIs('products.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- 🏷️ Categories Link -->
        <a href="{{ route('categories.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('categories.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-yellow-500/10 to-orange-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-tags mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:-rotate-12 {{ request()->routeIs('categories.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Kategori</span>
            
            @if(request()->routeIs('categories.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-yellow-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- 🚛 Suppliers Link -->
        <a href="{{ route('suppliers.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('suppliers.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-purple-500/10 to-pink-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-truck-loading mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:translate-x-1 {{ request()->routeIs('suppliers.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Supplier</span>
            
            @if(request()->routeIs('suppliers.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-purple-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- 📦 Stock Link -->
        <a href="{{ route('stocks.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('stocks.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-teal-500/10 to-cyan-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-boxes mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-6 {{ request()->routeIs('stocks.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Stok</span>
            
            @if(request()->routeIs('stocks.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-teal-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- 📊 Reports Dropdown with Enhanced Animations -->
        <div x-data="{ open: {{ request()->routeIs('reports.*') ? 'true' : 'false' }} }" class="relative dropdown-container">
            <button @click="open = !open" 
                    class="nav-link group w-full flex items-center justify-between px-4 py-3 rounded-xl text-base font-semibold transition-all duration-300 relative overflow-hidden {{ request()->routeIs('reports.*') ? $theme['active'] : $theme['link'] }}">
                
                <!-- 🌈 Animated Background -->
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 to-blue-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                
                <div class="flex items-center relative z-10">
                    <i class="fas fa-chart-bar mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-12 {{ request()->routeIs('reports.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
                    Laporan
                </div>
                
                <!-- 🔄 Rotating Chevron -->
                <i class="fas fa-chevron-down text-sm transition-all duration-300 group-hover:text-blue-500" 
                   :class="open ? 'rotate-180 text-blue-500' : ''"
                   x-transition:enter="transition-transform duration-200"
                   x-transition:leave="transition-transform duration-200"></i>
            </button>
            
            <!-- 📋 Enhanced Dropdown Menu -->
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200 transform"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                 class="ml-6 mt-2 space-y-1 {{ $theme['dropdown'] }} rounded-lg p-2 shadow-inner border-l-2 border-blue-200">
                
                <a href="{{ route('reports.activity') }}" 
                   class="dropdown-link flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:translate-x-2 {{ $theme['link'] }} {{ request()->routeIs('reports.activity') ? 'bg-blue-100 text-blue-700' : '' }}">
                    <i class="fas fa-chart-line mr-3 text-sm transition-all duration-200 hover:scale-110"></i>
                    <span>Aktivitas</span>
                </a>
                
                <a href="{{ route('reports.stock') }}" 
                   class="dropdown-link flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:translate-x-2 {{ $theme['link'] }} {{ request()->routeIs('reports.stock') ? 'bg-blue-100 text-blue-700' : '' }}">
                    <i class="fas fa-boxes mr-3 text-sm transition-all duration-200 hover:scale-110"></i>
                    <span>Stok</span>
                </a>
                
                <a href="{{ route('reports.transactions') }}" 
                   class="dropdown-link flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:translate-x-2 {{ $theme['link'] }} {{ request()->routeIs('reports.transactions') ? 'bg-blue-100 text-blue-700' : '' }}">
                    <i class="fas fa-exchange-alt mr-3 text-sm transition-all duration-200 hover:scale-110"></i>
                    <span>Transaksi</span>
                </a>
            </div>
        </div>
        
        <!-- 👥 Users Management Link -->
        <a href="{{ route('users.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('users.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-rose-500/10 to-pink-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-users-cog mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-12 {{ request()->routeIs('users.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Kelola Akun</span>
            
            @if(request()->routeIs('users.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-rose-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>

        <!-- ⚙️ Settings Link -->
        <a href="{{ route('settings.index') }}" 
           class="nav-link group flex items-center px-4 py-3 rounded-xl font-semibold text-base transition-all duration-300 relative overflow-hidden
                  {{ request()->routeIs('settings.*') ? $theme['active'] . ' sidebar-link active' : $theme['link'] . ' sidebar-link' }}">
            
            <div class="absolute inset-0 bg-gradient-to-r from-gray-500/10 to-slate-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            
            <i class="fas fa-cog mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-180 {{ request()->routeIs('settings.*') ? $theme['iconActive'] : $theme['icon'] }}"></i>
            <span class="relative z-10">Pengaturan</span>
            
            @if(request()->routeIs('settings.*'))
                <div class="ml-auto">
                    <div class="w-2 h-2 bg-gray-500 rounded-full animate-pulse"></div>
                </div>
            @endif
        </a>
    </nav>
    
    <!-- 🚪 Enhanced Logout Section -->
    <div class="absolute bottom-6 left-0 right-0 px-6 animate__animated animate__fadeInUp animate__delay-2s">
        <div class="border-t {{ $theme['header'] }} pt-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="logout-btn group flex items-center w-full px-4 py-3 text-base font-semibold rounded-xl transition-all duration-300 relative overflow-hidden {{ $theme['logout'] }}">
                    
                    <!-- 🔥 Animated Background -->
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500/10 to-pink-500/10 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
                    
                    <i class="fas fa-sign-out-alt mr-4 text-lg transition-all duration-300 group-hover:scale-110 group-hover:-rotate-12"></i>
                    <span class="relative z-10">Logout</span>
                    
                    <!-- ✨ Hover Indicator -->
                    <div class="ml-auto opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </button>
            </form>
        </div>
    </div>
</aside>

<!-- 🎨 Custom Styles for Enhanced Sidebar -->
<style>
    /* 🌈 Gradient Animation for Logo Border */
    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* 🎯 Modern Sidebar Container */
    .modern-sidebar {
        position: relative;
        backdrop-filter: blur(10px);
    }

    .modern-sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.3), transparent);
        animation: shimmer 3s ease-in-out infinite;
    }

    @keyframes shimmer {
        0%, 100% { opacity: 0; }
        50% { opacity: 1; }
    }

    /* 💫 Enhanced Navigation Link Hover Effects */
    .nav-link {
        position: relative;
        transform-origin: center;
    }

    .nav-link:hover {
        transform: translateX(8px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.15);
    }

    .nav-link.active {
        transform: translateX(4px);
        box-shadow: 0 4px 16px rgba(59, 130, 246, 0.2);
    }

    /* 🎪 Dropdown Animation Enhancement */
    .dropdown-container {
        transition: all 0.3s ease;
    }

    .dropdown-link:hover {
        background: linear-gradient(90deg, rgba(59, 130, 246, 0.1), rgba(147, 51, 234, 0.05));
    }

    /* 🚪 Logout Button Special Effects */
    .logout-btn:hover {
        transform: translateX(8px) scale(1.02);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
    }

    .logout-btn:active {
        transform: translateX(4px) scale(0.98);
    }

    /* 🌟 Active State Glow Effect */
    .sidebar-link.active::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 12px;
        padding: 1px;
        background: linear-gradient(45deg, #3b82f6, #8b5cf6, #06b6d4, #3b82f6);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask-composite: subtract;
        animation: borderGlow 2s ease-in-out infinite;
        pointer-events: none;
    }

    @keyframes borderGlow {
        0%, 100% { opacity: 0.3; }
        50% { opacity: 0.8; }
    }

    /* 📱 Responsive Adjustments */
    @media (max-width: 1024px) {
        .nav-link:hover {
            transform: translateX(4px);
        }
        
        .logout-btn:hover {
            transform: translateX(4px) scale(1.01);
        }
    }

    /* 🎨 Smooth Theme Transitions */
    .modern-sidebar,
    .nav-link,
    .dropdown-link,
    .logout-btn {
        transition: background-color 0.5s ease, color 0.5s ease, border-color 0.5s ease, box-shadow 0.3s ease, transform 0.3s ease;
    }

    /* ✨ Icon Animation Enhancement */
    .nav-link i {
        filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.1));
    }

    .nav-link:hover i {
        filter: drop-shadow(0 2px 4px rgba(59, 130, 246, 0.3));
    }
</style>