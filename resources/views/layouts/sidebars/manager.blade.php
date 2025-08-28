@php
    $themes = [
        'light' => [
            'sidebar' => 'bg-white text-gray-800 border-r border-gray-200',
            'header'  => 'border-gray-100',
            'link'    => 'text-gray-500 hover:bg-blue-50 hover:text-blue-600',
            'active'  => 'text-blue-600 bg-blue-50',
            'icon'    => 'text-blue-600',
            'subtitle'=> 'text-gray-500'
        ],
        'dark' => [
            'sidebar' => 'bg-gray-900 text-gray-100 border-r border-gray-700',
            'header'  => 'border-gray-700',
            'link'    => 'text-gray-400 hover:bg-gray-800 hover:text-white',
            'active'  => 'text-blue-400 bg-gray-800',
            'icon'    => 'text-blue-400',
            'subtitle'=> 'text-gray-400'
        ],
        'blue' => [
            'sidebar' => 'bg-blue-900 text-white border-r border-blue-700',
            'header'  => 'border-blue-700',
            'link'    => 'text-blue-100 hover:bg-blue-800 hover:text-white',
            'active'  => 'bg-blue-800 text-white',
            'icon'    => 'text-white',
            'subtitle'=> 'text-blue-200'
        ],
        'green' => [
            'sidebar' => 'bg-green-900 text-white border-r border-green-700',
            'header'  => 'border-green-700',
            'link'    => 'text-green-100 hover:bg-green-800 hover:text-white',
            'active'  => 'bg-green-800 text-white',
            'icon'    => 'text-white',
            'subtitle'=> 'text-green-200'
        ],
    ];
    $theme = $themes[$appSettings['theme'] ?? 'light'];
@endphp

<!-- Sidebar Manager -->
<aside class="w-64 shadow-lg z-10 hidden md:block {{ $theme['sidebar'] }}">
    <div class="p-6 border-b {{ $theme['header'] }}">
        <div class="flex items-center space-x-3">
            <div class="w-12 h-12 flex items-center justify-center rounded-lg shadow-md overflow-hidden bg-white">
                @if(setting('logo'))
                    <img src="{{ app_logo() }}" alt="Logo" class="w-full h-full object-contain">
                @else
                    <i class="fas fa-boxes {{ $theme['icon'] }} text-xl"></i>
                @endif
            </div>
            <div>
                <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-400 bg-clip-text text-transparent">
                    {{ app_name() ?? 'Stockify' }}
                </h1>
                <p class="text-sm {{ $theme['subtitle'] }}">Manager Gudang</p>
            </div>
        </div>
    </div>
    
    <nav class="mt-6">
        <a href="{{ route('manager.dashboard') }}" 
           class="flex items-center px-6 py-3 rounded-lg font-medium 
                  {{ request()->routeIs('manager.dashboard') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-th-large mr-3 {{ $theme['icon'] }}"></i>
            Dashboard
        </a>

        <a href="{{ route('manager.products.index') }}" 
           class="flex items-center px-6 py-3 rounded-lg 
                  {{ request()->routeIs('manager.products.*') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-box mr-3 {{ $theme['icon'] }}"></i>
            Produk
        </a>

        <a href="{{ route('manager.stock.index') }}" 
           class="flex items-center px-6 py-3 rounded-lg 
                  {{ request()->routeIs('manager.stock.*') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-exchange-alt mr-3 {{ $theme['icon'] }}"></i>
            Stok Masuk/Keluar
        </a>

        <a href="{{ route('manager.stock-opname.index') }}" 
           class="flex items-center px-6 py-3 rounded-lg 
                  {{ request()->routeIs('manager.stock-opname.*') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-clipboard-check mr-3 {{ $theme['icon'] }}"></i>
            Stock Opname
        </a>

        <a href="{{ route('manager.suppliers.index') }}" 
           class="flex items-center px-6 py-3 rounded-lg 
                  {{ request()->routeIs('manager.suppliers.*') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-truck-loading mr-3 {{ $theme['icon'] }}"></i>
            Supplier
        </a>

        <a href="{{ route('manager.laporan.index') }}" 
           class="flex items-center px-6 py-3 rounded-lg 
                  {{ request()->routeIs('manager.laporan.*') ? $theme['active'] : $theme['link'] }}">
            <i class="fas fa-chart-bar mr-3 {{ $theme['icon'] }}"></i>
            Laporan
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-4 px-6">
            @csrf
            <button type="submit" 
                    class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </button>
        </form>
    </nav>
</aside>
