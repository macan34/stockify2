<div id="mobile-sidebar" class="fixed inset-0 z-50 bg-gray-800 bg-opacity-50 hidden">
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform transition-transform -translate-x-full" id="sidebar-content">
        <div class="p-6 border-b border-gray-100">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-boxes text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">{{ app_name() }}</h1>
                        <p class="text-gray-500 text-sm">Admin Panel</p>
                    </div>
                </div>
                <button id="close-sidebar" class="p-1 rounded-md text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <nav class="mt-6">
            <!-- Sama dengan sidebar admin biasa -->
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <div class="nav-icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <span class="ml-3">Dashboard</span>
            </a>
            <!-- ... (salin semua menu dari sidebar admin) ... -->
            <aside class="w-64 bg-white shadow-lg z-10 hidden md:block">
    <div class="p-6 border-b border-gray-100">
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg flex items-center justify-center shadow-md">
                <i class="fas fa-boxes text-white text-lg"></i>
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">{{ app_name() }}</h1>
                <p class="text-gray-500 text-sm">Admin Panel</p>
            </div>
        </div>
    </div>
    
    <nav class="mt-6">
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-th-large"></i>
            </div>
            <span class="ml-3">Dashboard</span>
        </a>
        <a href="{{ route('products.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-box"></i>
            </div>
            <span class="ml-3">Produk</span>
        </a>
        <a href="{{ route('categories.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-tags"></i>
            </div>
            <span class="ml-3">Kategori</span>
        </a>
        <a href="{{ route('suppliers.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-truck-loading"></i>
            </div>
            <span class="ml-3">Supplier</span>
        </a>
        <a href="{{ route('stocks.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('stocks.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <span class="ml-3">Stock</span>
        </a>
        
        <!-- Reports Dropdown -->
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="w-full flex items-center justify-between px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600">
                <div class="flex items-center">
                    <div class="nav-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <span class="ml-3">Laporan</span>
                </div>
                <i class="fas fa-chevron-down text-xs transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
            </button>
            
            <div x-show="open" x-transition class="ml-8 mt-1 space-y-2">
                <a href="{{ route('reports.activity') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-blue-600 rounded-md hover:bg-blue-50">
                    <i class="fas fa-chart-line mr-2"></i>Aktivitas
                </a>
                <a href="{{ route('reports.stock') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-blue-600 rounded-md hover:bg-blue-50">
                    <i class="fas fa-boxes mr-2"></i>Stok
                </a>
                <a href="{{ route('reports.transactions') }}" class="block px-4 py-2 text-sm text-gray-500 hover:text-blue-600 rounded-md hover:bg-blue-50">
                    <i class="fas fa-exchange-alt mr-2"></i>Transaksi
                </a>
            </div>
        </div>
        
        <a href="{{ route('users.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-users-cog"></i>
            </div>
            <span class="ml-3">Kelola Akun</span>
        </a>

        <a href="{{ route('settings.index') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600 {{ request()->routeIs('settings.*') ? 'active' : '' }}">
            <div class="nav-icon">
                <i class="fas fa-gear"></i>
            </div>
            <span class="ml-3">Pengaturan</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-4 px-6">
            @csrf
            <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                <div class="nav-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </nav>
</aside>
        </nav>
    </div>
</div>