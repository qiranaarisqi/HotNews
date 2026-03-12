<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - {{ config('app.name', 'HOT NEWS') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,400;9..40,500;9..40,700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        .bg-pattern {
            background-color: #004743;
            background-image: 
                linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900 min-h-screen">

    <div class="min-h-screen flex flex-col lg:flex-row">
        <!-- Left Side: Solid Branding & Visuals -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#004743] items-center justify-center p-20 text-white relative">
            <div class="relative z-10 max-w-xl">
                <a href="/" class="inline-flex items-center space-x-3 mb-12 group transition duration-300">
                    <div class="bg-brand p-2.5 rounded-xl border border-white/10">
                        <i data-lucide="newspaper" class="w-8 h-8 text-[#004743]"></i>
                    </div>
                    <span class="text-3xl font-bold font-serif uppercase tracking-[0.2em]">HOT NEWS</span>
                </a>
                
                <h1 class="text-7xl font-bold font-serif leading-[1.05] tracking-tight mb-8">
                    Read the world <br> with <span class="text-brand">precision</span>.
                </h1>
                
                <p class="text-white/60 text-xl font-medium leading-relaxed mb-12">
                    Join our exclusive circle of readers and journalists. Access the latest breaking stories from around the globe.
                </p>

                <div class="flex items-center space-x-12">
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold text-brand">500k+</span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/30 font-serif">Active Readers</span>
                    </div>
                    <div class="w-[1px] h-12 bg-white/10"></div>
                    <div class="flex flex-col">
                        <span class="text-3xl font-bold text-white">24/7</span>
                        <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-white/30 font-serif">Real-Time News</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Flat Login Form -->
        <div class="flex-grow lg:w-1/2 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white border-l border-gray-100">
            <div class="w-full max-w-md">
                <!-- Mobile Header -->
                <div class="lg:hidden flex items-center space-x-3 mb-12">
                    <div class="bg-[#004743] p-1.5 rounded-lg">
                        <i data-lucide="newspaper" class="w-6 h-6 text-brand"></i>
                    </div>
                    <span class="text-xl font-bold font-serif uppercase tracking-widest">HOT NEWS</span>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-2">Login to your account</h2>
                    <p class="text-gray-400 font-medium">Professional portal for journalists and readers.</p>
                </div>

                <!-- Session Status -->
                @if(session('status'))
                    <div class="mb-8 p-4 bg-gray-50 border border-gray-200 rounded-2xl text-gray-900 text-sm font-bold flex items-center space-x-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-[#004743]"></i>
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf
                    
                    <!-- Email -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Email Address</label>
                        <div class="relative group">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300 group-focus-within:text-[#004743] transition"></i>
                            <input 
                                type="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                required 
                                autofocus 
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:border-[#004743] focus:ring-0 transition outline-none text-gray-900 font-bold"
                                placeholder="name@email.com"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <div class="flex justify-between items-center px-1">
                            <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-[10px] font-bold text-gray-400 hover:text-[#004743] transition uppercase tracking-widest underline decoration-gray-200 underline-offset-4">Forgot Password?</a>
                            @endif
                        </div>
                        <div class="relative group">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300 group-focus-within:text-[#004743] transition"></i>
                            <input 
                                type="password" 
                                name="password" 
                                required 
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:border-[#004743] focus:ring-0 transition outline-none text-gray-900 font-bold"
                                placeholder="••••••••"
                            >
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between py-2 px-1">
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="remember" class="w-5 h-5 rounded-lg border-gray-300 text-[#004743] focus:ring-0 transition cursor-pointer">
                            <span class="text-sm font-bold text-gray-400 group-hover:text-gray-600 transition">Keep me signed in</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-[#004743] text-white font-extrabold py-5 rounded-2xl transition flex items-center justify-center space-x-3 mt-4 hover:brightness-110 active:scale-[0.98]">
                        <span>Secure Login</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 text-brand"></i>
                    </button>
                </form>

                <div class="mt-12 pt-12 border-t border-gray-100 text-center">
                    <p class="text-gray-400 font-bold text-sm tracking-tight">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="ml-1 text-[#004743] font-black hover:underline underline-offset-4">Create New Account</a>
                    </p>
                </div>

                <p class="text-center text-gray-200 text-[9px] font-black uppercase tracking-[0.4em] mt-24 italic">
                    &copy; {{ date('Y') }} Hot News Portal. Flat Edition.
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
