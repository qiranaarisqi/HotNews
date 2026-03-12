<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join Hot News - Registration</title>
    
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
            background-color: #C8E63A;
            background-image: 
                linear-gradient(rgba(0, 71, 67, 0.05) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 71, 67, 0.05) 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-900 min-h-screen">

    <div class="min-h-screen flex flex-col lg:flex-row-reverse">
        <!-- Left Side: Solid Branding & Visuals -->
        <div class="hidden lg:flex lg:w-1/2 bg-brand items-center justify-center p-20 text-[#004743] relative">
            <div class="relative z-10 max-w-xl">
                <a href="/" class="inline-flex items-center space-x-3 mb-12 group transition duration-300">
                    <div class="bg-[#004743] p-2.5 rounded-xl border border-white/10">
                        <i data-lucide="newspaper" class="w-8 h-8 text-white"></i>
                    </div>
                    <span class="text-3xl font-bold font-serif uppercase tracking-[0.2em]">HOT NEWS</span>
                </a>
                
                <h1 class="text-7xl font-bold font-serif leading-[1.05] tracking-tight mb-8">
                    Your Voice <br> Is <span class="underline decoration-4 underline-offset-8">Necessary</span>.
                </h1>
                
                <p class="text-[#004743]/60 text-xl font-medium leading-relaxed mb-12">
                    Create an account today and become part of our growing community. Discuss, share, and stay informed with the most accurate news.
                </p>

                <div class="grid grid-cols-2 gap-8">
                    <div class="p-8 bg-[#004743]/5 rounded-[32px] border border-[#004743]/10">
                        <i data-lucide="feather" class="w-8 h-8 mb-4"></i>
                        <span class="block text-xl font-bold">Contribute</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest opacity-40">Share your thoughts</span>
                    </div>
                    <div class="p-8 bg-[#004743]/5 rounded-[32px] border border-[#004743]/10">
                        <i data-lucide="shield-check" class="w-8 h-8 mb-4"></i>
                        <span class="block text-xl font-bold">Secure</span>
                        <span class="text-[10px] font-bold uppercase tracking-widest opacity-40">Privacy First</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Flat Register Form -->
        <div class="flex-grow lg:w-1/2 flex items-center justify-center p-8 md:p-16 lg:p-24 bg-white border-r border-gray-100">
            <div class="w-full max-w-md">
                <!-- Mobile Header -->
                <div class="lg:hidden flex items-center space-x-3 mb-12">
                    <div class="bg-[#004743] p-1.5 rounded-lg">
                        <i data-lucide="newspaper" class="w-6 h-6 text-brand"></i>
                    </div>
                    <span class="text-xl font-bold font-serif uppercase tracking-widest">HOT NEWS</span>
                </div>

                <div class="mb-12">
                    <h2 class="text-3xl font-bold mb-2">Create an account</h2>
                    <p class="text-gray-400 font-medium">Join our professional editorial network today.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    
                    <!-- Name -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Full Name</label>
                        <div class="relative group">
                            <i data-lucide="user" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300 group-focus-within:text-[#004743] transition"></i>
                            <input 
                                type="text" 
                                name="name" 
                                value="{{ old('name') }}" 
                                required 
                                autofocus 
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:border-[#004743] focus:ring-0 transition outline-none text-gray-900 font-bold"
                                placeholder="Tuliskan nama lengkap Anda"
                            >
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

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
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:border-[#004743] focus:ring-0 transition outline-none text-gray-900 font-bold"
                                placeholder="nama@email.com"
                            >
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Password</label>
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

                    <!-- Password Confirmation -->
                    <div class="space-y-1.5">
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-1">Confirm Password</label>
                        <div class="relative group">
                            <i data-lucide="shield-check" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-300 group-focus-within:text-[#004743] transition"></i>
                            <input 
                                type="password" 
                                name="password_confirmation" 
                                required 
                                class="w-full bg-gray-50 border border-gray-200 rounded-2xl py-4 pl-12 pr-4 focus:bg-white focus:border-[#004743] focus:ring-0 transition outline-none text-gray-900 font-bold"
                                placeholder="••••••••"
                            >
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#004743] text-white font-extrabold py-5 rounded-2xl transition flex items-center justify-center space-x-3 mt-4 hover:brightness-110 active:scale-[0.98]">
                        <span>Register Now</span>
                        <i data-lucide="arrow-right" class="w-5 h-5 text-brand"></i>
                    </button>
                </form>

                <div class="mt-12 pt-12 border-t border-gray-100 text-center">
                    <p class="text-gray-400 font-bold text-sm tracking-tight">
                        Already have an account? 
                        <a href="{{ route('login') }}" class="ml-1 text-[#004743] font-black hover:underline underline-offset-4">Sign in instead</a>
                    </p>
                </div>

                <p class="text-center text-gray-200 text-[9px] font-black uppercase tracking-[0.4em] mt-16 italic">
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
