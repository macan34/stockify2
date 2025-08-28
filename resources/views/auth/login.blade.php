<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Warehouse Access Portal - Stockify</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzIiIGhlaWdodD0iMzIiIHZpZXdCb3g9IjAgMCAyNCAyNCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHBhdGggZD0iTTIwIDdMMTIgM0w0IDdNMjAgN0wxMiAxMU0yMCA3VjE3TDEyIDIxTTEyIDExTDQgN00xMiAxMVYyMU00IDdWMTdMMTIgMjEiIHN0cm9rZT0iIzIyZDNlZSIgc3Ryb2tlLXdpZHRoPSIyIiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiLz4KPHN2Zz4K">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'cyber': {
                            50: '#f0fdff',
                            100: '#ccfbff',
                            200: '#99f6ff',
                            300: '#4aeaff',
                            400: '#22d3ee',
                            500: '#06b6d4',
                            600: '#0891b2',
                            700: '#0e7490',
                            800: '#155e75',
                            900: '#164e63',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 1s ease-out',
                        'slide-in': 'slideIn 0.8s ease-out',
                        'glow-pulse': 'glowPulse 2s ease-in-out infinite',
                        'float': 'float 6s ease-in-out infinite',
                        'matrix': 'matrix 10s linear infinite',
                        'scan': 'scan 2s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(30px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        slideIn: {
                            '0%': { transform: 'translateX(-100px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        glowPulse: {
                            '0%, 100%': { 
                                boxShadow: '0 0 20px rgba(34, 211, 238, 0.3)',
                                transform: 'scale(1)'
                            },
                            '50%': { 
                                boxShadow: '0 0 40px rgba(34, 211, 238, 0.6)',
                                transform: 'scale(1.02)'
                            },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px) rotate(0deg)' },
                            '33%': { transform: 'translateY(-20px) rotate(1deg)' },
                            '66%': { transform: 'translateY(-10px) rotate(-1deg)' },
                        },
                        matrix: {
                            '0%': { transform: 'translateY(-100%)' },
                            '100%': { transform: 'translateY(100vh)' },
                        },
                        scan: {
                            '0%': { transform: 'translateX(-100%)' },
                            '100%': { transform: 'translateX(100%)' },
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Custom CSS -->
    <style>
        /* Matrix Rain Effect */
        .matrix-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -1;
        }
        
        .matrix-char {
            position: absolute;
            color: #22d3ee;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            animation: matrix 10s linear infinite;
            opacity: 0.6;
        }
        
        /* Animated gradient background */
        .bg-animated {
            background: linear-gradient(-45deg, #0f172a, #1e293b, #334155, #0f172a);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Glassmorphism */
        .glass {
            backdrop-filter: blur(20px);
            background: rgba(15, 23, 42, 0.8);
            border: 1px solid rgba(34, 211, 238, 0.2);
        }
        
        /* Input focus glow */
        .input-glow:focus {
            box-shadow: 0 0 20px rgba(34, 211, 238, 0.3);
            border-color: #22d3ee;
        }
        
        /* Button hover effect */
        .btn-cyber {
            position: relative;
            overflow: hidden;
        }
        
        .btn-cyber::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(34, 211, 238, 0.3), transparent);
            transition: left 0.5s ease;
        }
        
        .btn-cyber:hover::before {
            left: 100%;
        }
        
        /* Scanning line effect */
        .scan-line {
            position: relative;
            overflow: hidden;
        }
        
        .scan-line::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, #22d3ee, transparent);
            animation: scan 3s ease-in-out infinite;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #0f172a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(45deg, #22d3ee, #0891b2);
            border-radius: 10px;
        }
        
        /* Error message animation */
        .error-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
        
        /* Loading dots */
        .loading-dots::after {
            content: '';
            animation: dots 1.5s steps(5, end) infinite;
        }
        
        @keyframes dots {
            0%, 20% { content: '.'; }
            40% { content: '..'; }
            60% { content: '...'; }
            80%, 100% { content: ''; }
        }
    </style>
</head>
<body class="bg-animated min-h-screen overflow-hidden">
    <!-- Matrix Rain Background -->
    <div class="matrix-bg" id="matrix-container"></div>
    
    <!-- Main Container -->
    <div class="min-h-screen flex items-center justify-center px-4 py-12 relative">
        <!-- Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Floating geometric shapes -->
            <div class="absolute top-1/4 left-1/4 w-32 h-32 border border-cyan-500/20 rotate-45 animate-float"></div>
            <div class="absolute top-3/4 right-1/4 w-24 h-24 border border-blue-500/20 rotate-12 animate-float" style="animation-delay: 2s;"></div>
            <div class="absolute top-1/2 left-1/12 w-16 h-16 border border-cyan-400/30 rotate-45 animate-float" style="animation-delay: 4s;"></div>
        </div>
        
        <div class="w-full max-w-md relative z-10">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in">
                <!-- Logo -->
                <div class="inline-flex items-center justify-center w-24 h-24 bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl shadow-2xl mb-6 animate-glow-pulse">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl font-bold bg-gradient-to-r from-cyan-400 via-blue-400 to-cyan-300 bg-clip-text text-transparent mb-2">
                    STOCKIFY
                </h1>
                <p class="text-slate-400 text-lg font-mono">WAREHOUSE ACCESS PORTAL</p>
                <div class="w-32 h-0.5 bg-gradient-to-r from-transparent via-cyan-400 to-transparent mx-auto mt-4"></div>
            </div>
            
            <!-- Login Form -->
            <div class="glass rounded-2xl p-8 shadow-2xl animate-slide-in scan-line">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl">
                        <p class="text-green-400 text-sm font-medium">{{ session('status') }}</p>
                    </div>
                @endif
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
                    @csrf
                    
                    <!-- Email Field -->
                    <div class="space-y-2">
                        <label for="email" class="block text-cyan-400 text-sm font-semibold uppercase tracking-wider">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                            </svg>
                            Email Access
                        </label>
                        <div class="relative">
                            <input 
                                id="email" 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}"
                                required 
                                autofocus 
                                autocomplete="username"
                                class="w-full px-4 py-4 bg-slate-800/50 border-2 border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none input-glow transition-all duration-300 font-mono"
                                placeholder="operator@stockify.com"
                            />
                            <div class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('email')
                            <p class="text-red-400 text-sm mt-2 flex items-center error-shake">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="block text-cyan-400 text-sm font-semibold uppercase tracking-wider">
                            <svg class="inline w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            Security Key
                        </label>
                        <div class="relative">
                            <input 
                                id="password" 
                                type="password" 
                                name="password" 
                                required 
                                autocomplete="current-password"
                                class="w-full px-4 py-4 bg-slate-800/50 border-2 border-slate-600/50 rounded-xl text-white placeholder-slate-400 focus:outline-none input-glow transition-all duration-300 font-mono"
                                placeholder="••••••••••••"
                            />
                            <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                <svg id="eye-icon" class="w-5 h-5 text-slate-400 hover:text-cyan-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-400 text-sm mt-2 flex items-center error-shake">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center group cursor-pointer">
                            <div class="relative">
                                <input 
                                    id="remember_me" 
                                    type="checkbox" 
                                    name="remember"
                                    class="sr-only"
                                />
                                <div class="w-5 h-5 border-2 border-slate-600 rounded bg-slate-800/50 group-hover:border-cyan-400 transition-colors duration-300"></div>
                                <svg class="absolute inset-0 w-5 h-5 text-cyan-400 opacity-0 transition-opacity duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="ml-3 text-slate-300 text-sm font-mono group-hover:text-cyan-400 transition-colors">
                                Remember Security Access
                            </span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-cyan-400 hover:text-cyan-300 text-sm font-mono underline-offset-4 hover:underline transition-colors">
                                Reset Access Key
                            </a>
                        @endif
                    </div>
                    
                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold py-4 px-6 rounded-xl shadow-2xl transform hover:scale-105 transition-all duration-300 btn-cyber relative overflow-hidden group"
                        id="loginBtn"
                    >
                        <span class="relative z-10 flex items-center justify-center font-mono uppercase tracking-wider">
                            <svg class="w-5 h-5 mr-3 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                            </svg>
                            <span id="loginText">Initiate Access Protocol</span>
                        </span>
                    </button>
                </form>
                
                <!-- Footer Info -->
                <div class="mt-8 pt-6 border-t border-slate-700/50">
                    <div class="flex items-center justify-between text-xs text-slate-400 font-mono">
                        <div class="flex items-center space-x-2">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span>SYSTEM ONLINE</span>
                        </div>
                        <span>v2.1.0</span>
                    </div>
                </div>
            </div>
            
            <!-- Additional Info -->
            <div class="text-center mt-6 text-slate-500 text-sm font-mono">
                <p>© {{ date('Y') }} Stockify Warehouse Control</p>
                <p class="mt-1">Industrial Grade Security Protocol</p>
            </div>
        </div>
    </div>
    
    <!-- JavaScript -->
    <script>
        // Matrix Rain Effect
        function createMatrixRain() {
            const container = document.getElementById('matrix-container');
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*()';
            
            for (let i = 0; i < 50; i++) {
                const char = document.createElement('div');
                char.className = 'matrix-char';
                char.textContent = chars[Math.floor(Math.random() * chars.length)];
                char.style.left = Math.random() * 100 + '%';
                char.style.animationDelay = Math.random() * 10 + 's';
                char.style.animationDuration = (Math.random() * 5 + 5) + 's';
                container.appendChild(char);
            }
        }
        
        // Password toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eye-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m-3.122-3.122L12 12m6.878 6.878L21 21"></path>';
            } else {
                passwordInput.type = 'password';
                eyeIcon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>';
            }
        }
        
        // Remember me checkbox
        document.getElementById('remember_me').addEventListener('change', function() {
            const checkbox = this;
            const checkmark = checkbox.nextElementSibling.querySelector('svg');
            
            if (checkbox.checked) {
                checkmark.style.opacity = '1';
                checkbox.nextElementSibling.style.backgroundColor = 'rgba(34, 211, 238, 0.2)';
            } else {
                checkmark.style.opacity = '0';
                checkbox.nextElementSibling.style.backgroundColor = 'rgba(30, 41, 59, 0.5)';
            }
        });
        
        // Form submission with loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const btn = document.getElementById('loginBtn');
            const text = document.getElementById('loginText');
            
            btn.disabled = true;
            btn.classList.add('opacity-75');
            text.textContent = 'Authenticating';
            text.classList.add('loading-dots');
            
            // Add scanning effect
            btn.classList.add('animate-pulse');
        });
        
        // Input focus effects
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('animate-glow-pulse');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('animate-glow-pulse');
            });
        });
        
        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            // Ctrl + Enter to submit
            if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                document.getElementById('loginForm').submit();
            }
        });
        
        // Initialize effects
        window.addEventListener('load', function() {
            createMatrixRain();
            
            // Add entrance animations
            const elements = document.querySelectorAll('.animate-fade-in, .animate-slide-in');
            elements.forEach((el, index) => {
                el.style.animationDelay = (index * 0.2) + 's';
            });
        });
        
        // Add typing effect to placeholder
        function typingEffect(element, text, speed = 100) {
            let i = 0;
            element.placeholder = '';
            
            function type() {
                if (i < text.length) {
                    element.placeholder += text.charAt(i);
                    i++;
                    setTimeout(type, speed);
                }
            }
            
            type();
        }
        
        // Initialize typing effects
        setTimeout(() => {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            
            typingEffect(emailInput, 'operator@stockify.com', 50);
            setTimeout(() => {
                typingEffect(passwordInput, '••••••••••••', 30);
            }, 1500);
        }, 2000);
    </script>
</body>
</html>