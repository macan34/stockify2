<!-- Sidebar Staff -->
@php
    $themes = [
        'light' => [
            'sidebar'  => 'bg-white text-gray-800 border-gray-100',
            'header'   => 'border-gray-100',   // 👈 ditambah
            'logo_bg'  => 'bg-gradient-to-r from-blue-600 to-blue-500',
            'title'    => 'bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent',
            'link'     => 'text-gray-500 hover:bg-blue-50 hover:text-blue-600',
            'active'   => 'text-gray-800 bg-blue-50 border-l-4 border-blue-600',
            'subtitle' => 'text-gray-500',
            'icon'     => 'text-blue-600', // 👈 biar icon bisa dipakai
        ],
        'dark' => [
            'sidebar'  => 'bg-gray-900 text-gray-100 border-gray-800',
            'header'   => 'border-gray-800',
            'logo_bg'  => 'bg-gray-700',
            'title'    => 'text-white',
            'link'     => 'text-gray-300 hover:bg-gray-800 hover:text-white',
            'active'   => 'text-white bg-gray-800 border-l-4 border-blue-500',
            'subtitle' => 'text-gray-400',
            'icon'     => 'text-white',
        ],
        'blue' => [
            'sidebar'  => 'bg-blue-950 text-white border-blue-800',
            'header'   => 'border-blue-800',
            'logo_bg'  => 'bg-blue-700',
            'title'    => 'text-white',
            'link'     => 'text-blue-200 hover:bg-blue-800 hover:text-white',
            'active'   => 'text-white bg-blue-800 border-l-4 border-white',
            'subtitle' => 'text-blue-300',
            'icon'     => 'text-blue-300',
        ],
        'green' => [
            'sidebar'  => 'bg-green-950 text-white border-green-800',
            'header'   => 'border-green-800',
            'logo_bg'  => 'bg-green-700',
            'title'    => 'text-white',
            'link'     => 'text-green-200 hover:bg-green-800 hover:text-white',
            'active'   => 'text-white bg-green-800 border-l-4 border-white',
            'subtitle' => 'text-green-300',
            'icon'     => 'text-green-300',
        ],
    ];

    $theme = $themes[$appSettings['theme'] ?? 'light'];
@endphp

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
                <p class="text-sm {{ $theme['subtitle'] }}">staff Gudang</p>
            </div>
        </div>
    </div>
    
    <nav class="mt-6">
        <a href="{{ route('staff.dashboard') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('staff.dashboard') ? $theme['active'] : $theme['link'] }}">
            <div class="nav-icon">
                <i class="fas fa-th-large"></i>
            </div>
            <span class="ml-3 font-medium">Dashboard</span>
        </a>

        <a href="{{ route('staff.stock_opname') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('staff.stock_opname') ? $theme['active'] : $theme['link'] }}">
            <div class="nav-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <span class="ml-3">Stock Opname</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-4 px-6">
            @csrf
            <button type="submit" 
                class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                <div class="nav-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </nav>
</aside>
