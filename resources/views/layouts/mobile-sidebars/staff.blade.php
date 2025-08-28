<!-- Mobile Sidebar Structure for Staff -->
<div id="mobile-sidebar" class="fixed inset-0 z-50 bg-gray-800 bg-opacity-50 hidden">
    <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-lg transform transition-transform -translate-x-full" id="sidebar-content">
        <div class="p-6 border-b border-gray-100">
            <div class="极 items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-lg flex items-center justify-center shadow-md">
                        <i class="fas fa-boxes text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-blue-600 to-blue-500 bg-clip-text text-transparent">Stockify</h1>
                        <p class="text-gray-500 text-sm">Staff Gudang</p>
                    </div>
                </div>
                <button id="close-sidebar" class="p-1 rounded-md text-gray-500 hover:bg-gray-100">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <nav class="mt-6">
            <a href="{{ route('staff.dashboard') }}" class="sidebar-link active flex items-center px-6 py-3 text-gray-700">
                <div class="nav-icon">
                    <i class="fas fa-th-large text-blue-600"></i>
                </div>
                <span class="ml-3 font-medium">Dashboard</span>
            </a>
            <a href="{{ route('staff.stock_opname') }}" class="flex items-center px-6 py-3 text-gray-500 hover:bg-blue-50 hover:text-blue-600">
                <div class="nav-icon">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <span class="ml-3">Stock Opname</span>
            </a>
            
            <form method="POST极 action="{{ route('logout') }}" class="mt-4 px-6">
                @csrf
                <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md">
                    <div class="nav-icon">
                        <i class="fas fa-sign-out-alt"></i>
                    </div>
                    <span class="ml-3">Logout</span>
                </button>
            </form>
        </nav>
    </div>
</div>