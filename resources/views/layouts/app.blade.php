{{-- <!DOCTYPE html>
<html lang="id" class="{{ $appSettings['theme'] ?? 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', app_title()) - {{ app_name() }}</title>
    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Dynamic theme styles -->
    <style>
        /* 🎨 Theme Variables */
     :root {
  --bg-color: #f9fafb;   /* background umum */
  --panel-color: #ffffff;
  --card-bg: #ffffff;    /* untuk card/dashboard panel */
  --text-color: #111827;
  --primary-color: #2563eb;

  --success-color: #16a34a;
  --warning-color: #fb923c;
  --danger-color: #ef4444;
}

/* Dark Theme */
.theme-dark {
  --bg-color: #111827;
  --panel-color: #1f2937;
  --card-bg: #1f2937;
  --text-color: #f9fafb;
  --primary-color: #2563eb;

  --success-color: #22c55e;
  --warning-color: #facc15;
  --danger-color: #f87171;
}

/* Green Theme */
.theme-green {
  --bg-color: #ecfdf5;
  --panel-color: #f0fdf4;
  --card-bg: #d1fae5;
  --text-color: #064e3b;
  --primary-color: #16a34a;

  --success-color: #15803d;
  --warning-color: #ca8a04;
  --danger-color: #dc2626;
}

/* Blue Theme */
.theme-blue {
  --bg-color: #eff6ff;
  --panel-color: #ffffff;
  --card-bg: #dbeafe;
  --text-color: #1e3a8a;
  --primary-color: #2563eb;

  --success-color: #15803d;
  --warning-color: #ea580c;
  --danger-color: #dc2626;
}


        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            min-height: 100vh;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, rgba(59, 130, 246, 0.1) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-right: 3px solid var(--primary-color);
            color: var(--primary-color);
        }

.stat-card, .dashboard-panel, .quick-action {
    background: var(--card-bg);
    color: var(--text-color);
    border: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}
        
        .stat-card:hover, .dashboard-panel:hover, .quick-action:hover {
            transform: translateY(-5px);
            border-color: var(--primary-color);
            box-shadow: 0 16px 25px -5px rgba(59, 130, 246, 0.2);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1d4ed8 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.3);
        }
    </style>
    
    @yield('styles')
</head>
<body class="text-gray-800 {{ $appSettings['theme'] === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-white text-gray-800' }}">
    <div class="flex min-h-screen">
        <!-- Sidebar (akan diisi berdasarkan role) -->
        @includeWhen(Auth::check(), 'layouts.sidebars.' . Auth::user()->role->name)

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- Mobile Header -->
            <header class="bg-white shadow-sm p-4 flex justify-between items-center md:hidden">
                <button id="mobile-menu-button" class="p-2 rounded-md text-gray-600">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="flex items-center space-x-3">
                    <div class="text-right">
                        <p class="text-sm text-gray-500">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                        <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-blue-500 rounded-full flex items-center justify-center text-white text-sm font-medium shadow-md">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Structure (akan diisi berdasarkan role) -->
    @includeWhen(Auth::check(), 'layouts.mobile-sidebars.' . Auth::user()->role->name)

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mobile menu functionality
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            document.getElementById('mobile-sidebar').classList.remove('hidden');
            setTimeout(() => {
                document.getElementById('sidebar-content').classList.remove('-translate-x-full');
            }, 50);
        });

        document.getElementById('close-sidebar')?.addEventListener('click', function() {
            document.getElementById('sidebar-content').classList.add('-translate-x-full');
            setTimeout(() => {
                document.getElementById('mobile-sidebar').classList.add('hidden');
            }, 300);
        });
    </script>
    
    @yield('scripts')
</body>
</html> --}}
<!DOCTYPE html>
<html lang="id" class="{{ $appSettings['theme'] ?? 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', app_title()) - {{ app_name() }}</title>
    <link rel="icon" href="{{ app_favicon() }}" type="image/x-icon">
    
    <!-- Stylesheets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    
    <!-- Modern Theme Styles with Smooth Animations -->
    <style>
        /* 🎨 Modern Theme Variables */
        :root {
            /* Light Theme - Clean White Dominance */
            --bg-color: #fafbff;
            --bg-gradient: linear-gradient(135deg, #fafbff 0%, #f1f5f9 100%);
            --panel-color: #ffffff;
            --card-bg: #ffffff;
            --text-color: #1e293b;
            --text-muted: #64748b;
            --primary-color: #3b82f6;
            --primary-hover: #2563eb;
            --primary-light: rgba(59, 130, 246, 0.1);
            
            /* Status Colors */
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --danger-color: #ef4444;
            --info-color: #06b6d4;
            
            /* Shadows & Effects */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-glow: 0 0 20px rgba(59, 130, 246, 0.3);
            
            /* Border Radius */
            --radius-sm: 0.5rem;
            --radius-md: 0.75rem;
            --radius-lg: 1rem;
            --radius-xl: 1.5rem;
        }

        /* Dark Theme */
        .theme-dark {
            --bg-color: #0f172a;
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            --panel-color: #1e293b;
            --card-bg: #1e293b;
            --text-color: #f1f5f9;
            --text-muted: #94a3b8;
            --primary-color: #3b82f6;
            --primary-hover: #60a5fa;
            --primary-light: rgba(59, 130, 246, 0.2);
            
            --success-color: #22c55e;
            --warning-color: #fbbf24;
            --danger-color: #f87171;
            --info-color: #38bdf8;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
            --shadow-glow: 0 0 20px rgba(59, 130, 246, 0.4);
        }

        /* Green Theme */
        .theme-green {
            --bg-color: #f0fdf4;
            --bg-gradient: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            --panel-color: #ffffff;
            --card-bg: #f7fee7;
            --text-color: #14532d;
            --text-muted: #4ade80;
            --primary-color: #22c55e;
            --primary-hover: #16a34a;
            --primary-light: rgba(34, 197, 94, 0.1);
            
            --success-color: #15803d;
            --warning-color: #ca8a04;
            --danger-color: #dc2626;
            --info-color: #0891b2;
        }

        /* Blue Theme */
        .theme-blue {
            --bg-color: #f0f9ff;
            --bg-gradient: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 100%);
            --panel-color: #ffffff;
            --card-bg: #e0f2fe;
            --text-color: #0c4a6e;
            --text-muted: #0369a1;
            --primary-color: #0ea5e9;
            --primary-hover: #0284c7;
            --primary-light: rgba(14, 165, 233, 0.1);
            
            --success-color: #15803d;
            --warning-color: #ea580c;
            --danger-color: #dc2626;
            --info-color: #0891b2;
        }

        /* 🎯 Base Styles with Modern Touch */
        * {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--bg-gradient);
            color: var(--text-color);
            min-height: 100vh;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* 🚀 Animation Classes for Smooth Transitions */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        .slide-in-right {
            animation: slideInRight 0.4s ease-out;
        }

        .slide-in-left {
            animation: slideInLeft 0.4s ease-out;
        }

        .bounce-in {
            animation: bounceIn 0.6s ease-out;
        }

        .scale-in {
            animation: scaleIn 0.3s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slideInLeft {
            from { opacity: 0; transform: translateX(-30px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes bounceIn {
            0% { opacity: 0; transform: scale(0.3); }
            50% { opacity: 1; transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes scaleIn {
            from { opacity: 0; transform: scale(0.8); }
            to { opacity: 1; transform: scale(1); }
        }

        /* 💫 Hover Effects for Interactive Elements */
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .hover-lift:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-xl);
        }

        .hover-glow:hover {
            box-shadow: var(--shadow-glow);
            transform: translateY(-2px);
        }

        .hover-scale:hover {
            transform: scale(1.05);
        }

        .hover-rotate:hover {
            transform: rotate(5deg);
        }

        /* 🎨 Modern Card Styles */
        .modern-card {
            background: var(--card-bg);
            border: 1px solid rgba(148, 163, 184, 0.1);
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            backdrop-filter: blur(10px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .modern-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--primary-color), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modern-card:hover::before {
            opacity: 1;
        }

        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: var(--primary-color);
        }

        /* 🎯 Sidebar Modern Styles */
        .sidebar-link {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: var(--radius-md);
            position: relative;
            overflow: hidden;
        }

        .sidebar-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
        }

        .sidebar-link:hover::before {
            left: 100%;
        }

        .sidebar-link:hover {
            background: var(--primary-light);
            transform: translateX(5px);
            color: var(--primary-color);
        }

        .sidebar-link.active {
            background: linear-gradient(90deg, var(--primary-light) 0%, rgba(59, 130, 246, 0.05) 100%);
            border-right: 3px solid var(--primary-color);
            color: var(--primary-color);
            font-weight: 600;
        }

        /* 📱 Mobile Header with Modern Touch */
        .mobile-header {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(148, 163, 184, 0.1);
            transition: all 0.3s ease;
        }

        .theme-dark .mobile-header {
            background: rgba(30, 41, 59, 0.9);
        }

        /* 🎨 Button Animations */
        .btn-modern {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-hover) 100%);
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-weight: 600;
            padding: 12px 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-md);
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-modern:hover::before {
            left: 100%;
        }

        .btn-modern:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-xl);
            background: linear-gradient(135deg, var(--primary-hover) 0%, var(--primary-color) 100%);
        }

        .btn-modern:active {
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
        }

        /* 🎭 Avatar with Modern Effects */
        .modern-avatar {
            position: relative;
            transition: all 0.3s ease;
        }

        .modern-avatar::before {
            content: '';
            position: absolute;
            inset: -3px;
            background: linear-gradient(45deg, var(--primary-color), var(--success-color), var(--warning-color), var(--primary-color));
            border-radius: 50%;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: -1;
            animation: rotate 3s linear infinite;
        }

        .modern-avatar:hover::before {
            opacity: 1;
        }

        @keyframes rotate {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /* 🌟 Glassmorphism Effect */
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .theme-dark .glass-effect {
            background: rgba(30, 41, 59, 0.3);
            border: 1px solid rgba(148, 163, 184, 0.1);
        }

        /* 📊 Status Colors with Modern Touch */
        .status-success { color: var(--success-color); }
        .status-warning { color: var(--warning-color); }
        .status-danger { color: var(--danger-color); }
        .status-info { color: var(--info-color); }

        /* 🎨 Loading Animation */
        .loading-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* 📱 Responsive Animations */
        @media (max-width: 768px) {
            .hover-lift:hover {
                transform: translateY(-4px);
            }
            
            .sidebar-link:hover {
                transform: translateX(3px);
            }
        }

        /* 🎯 Focus States for Accessibility */
        *:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* 🌈 Smooth Theme Transition */
        html, body, .modern-card, .sidebar-link, .btn-modern {
            transition: background-color 0.5s ease, color 0.5s ease, border-color 0.5s ease;
        }

        /* 🎪 Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-hover);
        }
    </style>
    
    @yield('styles')
</head>
<body class="text-gray-800 {{ $appSettings['theme'] === 'dark' ? 'bg-gray-900 text-gray-100' : 'bg-white text-gray-800' }}">
    <!-- 🎯 Main Container with Fade In Animation -->
    <div class="flex min-h-screen fade-in">
        <!-- Sidebar (akan diisi berdasarkan role) -->
        @includeWhen(Auth::check(), 'layouts.sidebars.' . Auth::user()->role->name)

        <!-- Main Content -->
        <div class="flex-1 overflow-auto">
            <!-- 📱 Mobile Header with Modern Glass Effect -->
            <header class="mobile-header glass-effect p-4 flex justify-between items-center md:hidden sticky top-0 z-40 slide-in-right">
                <!-- Mobile Menu Button with Hover Effect -->
                <button id="mobile-menu-button" class="p-3 rounded-xl text-gray-600 hover-scale hover:bg-white/20 transition-all duration-300">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                
                <!-- User Info with Modern Avatar -->
                <div class="flex items-center space-x-3 slide-in-left">
                    <div class="text-right">
                        <p class="text-sm text-gray-500 font-medium">{{ \Carbon\Carbon::now()->format('d F Y') }}</p>
                        <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                    <div class="modern-avatar w-10 h-10 bg-gradient-to-r from-blue-600 to-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold shadow-lg hover-glow">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                </div>
            </header>

            <!-- 📄 Content Area with Enhanced Animation -->
            <main class="p-6 scale-in">
                <!-- Content will be rendered with smooth transitions -->
                <div class="content-wrapper">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Sidebar Structure (akan diisi berdasarkan role) -->
    @includeWhen(Auth::check(), 'layouts.mobile-sidebars.' . Auth::user()->role->name)

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- 🎯 Enhanced JavaScript for Modern Interactions -->
    <script>
        // 📱 Mobile menu functionality with smooth animations
        document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
            const sidebar = document.getElementById('mobile-sidebar');
            const sidebarContent = document.getElementById('sidebar-content');
            
            // Add bounce effect to button
            this.classList.add('animate__animated', 'animate__pulse');
            setTimeout(() => {
                this.classList.remove('animate__animated', 'animate__pulse');
            }, 600);
            
            sidebar?.classList.remove('hidden');
            setTimeout(() => {
                sidebarContent?.classList.remove('-translate-x-full');
                sidebarContent?.classList.add('animate__animated', 'animate__slideInLeft');
            }, 50);
        });

        document.getElementById('close-sidebar')?.addEventListener('click', function() {
            const sidebar = document.getElementById('mobile-sidebar');
            const sidebarContent = document.getElementById('sidebar-content');
            
            sidebarContent?.classList.add('-translate-x-full');
            sidebarContent?.classList.remove('animate__slideInLeft');
            sidebarContent?.classList.add('animate__slideOutLeft');
            
            setTimeout(() => {
                sidebar?.classList.add('hidden');
                sidebarContent?.classList.remove('animate__animated', 'animate__slideOutLeft');
            }, 300);
        });

        // 🎨 Add hover effects to cards and interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Add modern card class to existing cards
            const cards = document.querySelectorAll('.stat-card, .dashboard-panel, .quick-action');
            cards.forEach(card => {
                card.classList.add('modern-card', 'hover-lift');
            });

            // Add modern button class to primary buttons
            const buttons = document.querySelectorAll('.btn-primary');
            buttons.forEach(btn => {
                btn.classList.add('btn-modern');
            });

            // Add smooth scroll behavior
            document.documentElement.style.scrollBehavior = 'smooth';
        });

        // 🌟 Intersection Observer for scroll animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, observerOptions);

        // Observe elements for scroll animations
        document.addEventListener('DOMContentLoaded', function() {
            const elementsToAnimate = document.querySelectorAll('.modern-card, .stat-card, .dashboard-panel');
            elementsToAnimate.forEach(el => observer.observe(el));
        });

        // 🎯 Smooth theme transition
        function toggleTheme(theme) {
            document.documentElement.classList.add('theme-transitioning');
            document.documentElement.className = theme;
            
            setTimeout(() => {
                document.documentElement.classList.remove('theme-transitioning');
            }, 500);
        }

        // 💫 Page transition effect
        window.addEventListener('beforeunload', function() {
            document.body.classList.add('animate__animated', 'animate__fadeOut');
        });

        // 🎪 Add ripple effect to buttons
        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;
            
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
            circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
            circle.classList.add('ripple');
            
            const ripple = button.getElementsByClassName('ripple')[0];
            if (ripple) {
                ripple.remove();
            }
            
            button.appendChild(circle);
        }

        // Apply ripple effect to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn-modern, .btn-primary');
            buttons.forEach(btn => {
                btn.addEventListener('click', createRipple);
                btn.style.position = 'relative';
                btn.style.overflow = 'hidden';
            });
        });

        // 🌈 CSS for ripple effect
        const rippleCSS = `
            .ripple {
                position: absolute;
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                background-color: rgba(255, 255, 255, 0.3);
            }
            
            @keyframes ripple {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }
        `;
        
        const style = document.createElement('style');
        style.textContent = rippleCSS;
        document.head.appendChild(style);
    </script>
    
    @yield('scripts')
</body>
</html>