<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'HOT NEWS') }}</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        .ticker-wrap {
            width: 100%;
            overflow: hidden;
            background-color: #c8e63a;
            padding: 4px 0;
        }
        .ticker {
            display: inline-block;
            white-space: nowrap;
            animation: ticker 30s linear infinite;
        }
        @keyframes ticker {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .line-clamp-4 {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;  
            overflow: hidden;
        }
        .text-outline {
            color: transparent;
            -webkit-text-stroke: 1px rgba(255, 255, 255, 0.1);
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-white font-sans text-gray-900 overflow-x-hidden" x-data="{ showSearch: false, showMenu: false }" x-cloak>
    <!-- Navbar -->
    <nav class="bg-white relative z-50">
        <div class="max-w-7xl mx-auto px-4 pt-4 md:pt-6">
            <div class="flex justify-between items-center h-16 relative">
                <!-- Left Nav: Search & Hamburger -->
                <div class="flex items-center space-x-4 md:space-x-6">
                    <button @click="showSearch = true" class="text-gray-900 hover:text-brand transition">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </button>
                    <div class="h-5 md:h-6 w-px bg-gray-200"></div>
                    <button @click="showMenu = true" class="text-gray-900 hover:text-brand transition">
                        <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
                
                <!-- Center Logo -->
                <div class="absolute left-1/2 transform -translate-x-1/2">
                    <a href="/" class="flex items-center space-x-2 md:space-x-3">
                        <div class="bg-gray-100 p-1.5 md:p-2 rounded hidden md:block">
                            <svg class="w-6 h-6 md:w-10 md:h-10 text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <rect x="3" y="4" width="18" height="16" rx="1"></rect>
                                <path d="M7 8h10M7 12h10M7 16h5"></path>
                                <path d="M14 15l1-1 4 4-1 1z" fill="currentColor"></path>
                            </svg>
                        </div>
                        <span class="text-xl sm:text-2xl md:text-3xl font-bold font-serif tracking-tight uppercase text-gray-800 whitespace-nowrap">HOT NEWS</span>
                    </a>
                </div>

                <!-- Right Nav: User -->
                <div class="flex items-center">
                    @auth
                        <a href="{{ auth()->user()->role === 'ADMIN' ? route('admin.dashboard') : route('user.dashboard') }}" class="flex items-center space-x-2 group">
                            <svg class="w-6 h-6 text-gray-900 group-hover:text-brand transition" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            <span class="hidden md:block text-sm font-bold text-gray-900 group-hover:text-brand transition max-w-[120px] truncate">{{ auth()->user()->name }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center space-x-2 group">
                            <svg class="w-6 h-6 text-gray-900 group-hover:text-brand transition" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            <span class="hidden md:block text-sm font-bold text-gray-900 group-hover:text-brand transition">Sign In</span>
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Secondary Nav -->
            <div class="mt-4 md:mt-8 border-b border-gray-50 pb-4 md:pb-6 text-left">
                <!-- Scrollable container on mobile, wrapped flex on desktop -->
                <div class="flex items-center justify-start overflow-x-auto hide-scrollbar md:flex-wrap space-x-6 md:space-x-12 text-[13px] font-medium text-gray-400 pb-2 md:pb-0 scroll-smooth px-2 md:px-0">
                    <a href="/" class="hover:text-gray-900 transition whitespace-nowrap flex-shrink-0 {{ request()->is('/') ? 'text-gray-900 font-bold' : '' }}">Beranda</a>
                    @foreach($globalCategories as $category)
                        <a href="{{ route('category.show', $category->name) }}" class="hover:text-gray-900 transition whitespace-nowrap flex-shrink-0 {{ request()->is('kategori/'.$category->name) ? 'text-gray-900 font-bold' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20">
        <!-- Mosaic Section -->
        <div class="relative h-[300px] overflow-hidden">
            <!-- Mosaic Background -->
            <div class="absolute inset-0 grid grid-cols-4 grid-rows-2">
                @for($i=0; $i<8; $i++)
                    <div class="overflow-hidden border border-white/5">
                        <img src="https://picsum.photos/seed/foot{{$i}}/400/300" class="w-full h-full object-cover grayscale opacity-60">
                    </div>
                @endfor
            </div>
            <!-- Overlay -->
            <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center text-center px-4">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="bg-white/20 p-2 rounded backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="16" rx="1"></rect>
                            <path d="M7 8h10M7 12h10M7 16h5"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold font-serif uppercase text-white tracking-widest">HOT NEWS</span>
                </div>
                <p class="text-white text-lg max-w-lg leading-relaxed antialiased">
                    Portal berita yang selalu up to date setiap berita yang terbaru
                </p>
            </div>
        </div>

        <!-- Bottom Section (Teal) -->
        <div class="bg-brand-teal h-[400px] relative flex flex-col items-center justify-center overflow-hidden">
            <!-- Large Outline Text Background -->
            <div class="absolute bottom-[-50px] left-0 right-0 text-center select-none pointer-events-none">
                <span class="text-[250px] font-bold font-serif uppercase text-outline">HOT NEWS</span>
            </div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col items-center">
                <div class="flex items-center space-x-4 mb-2">
                    <div class="bg-white p-2 rounded">
                        <svg class="w-10 h-10 text-brand-teal" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="16" rx="1"></rect>
                            <path d="M7 8h10M7 12h10M7 16h5"></path>
                        </svg>
                    </div>
                    <span class="text-3xl font-bold font-serif uppercase text-white tracking-widest">HOT NEWS</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Overlays Moved to Bottom for Z-Index Priority -->
    <!-- Search Overlay -->
    <div x-show="showSearch" 
         x-transition:enter="transition opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-black/95 z-[1000] flex items-center justify-center p-6 backdrop-blur-sm"
         x-cloak
    >
        <div @click.away="showSearch = false" class="w-full max-w-4xl relative">
            <button @click="showSearch = false" class="absolute -top-20 right-0 text-white/50 hover:text-white transition">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
            
            <form action="{{ route('search') }}" method="GET" class="relative group">
                <input type="text" name="q" placeholder="Cari berita..." 
                       class="w-full bg-transparent border-b-2 border-white/30 text-white text-4xl md:text-6xl font-bold py-6 focus:border-brand focus:ring-0 transition-colors placeholder:text-white/10 outline-none !text-white" 
                       style="color: white !important; -webkit-text-fill-color: white !important;"
                       autofocus>
                <button type="submit" class="absolute right-0 bottom-6 text-white hover:text-brand transition">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </form>
            <p class="text-white/40 mt-6 text-lg font-medium tracking-wide items-center flex">
                <span class="w-8 h-[1px] bg-white/20 mr-4"></span>
                Tekan Enter untuk mencari
            </p>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="showMenu" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="-translate-x-full" 
         x-transition:enter-end="translate-x-0" 
         x-transition:leave="transition ease-in duration-300" 
         x-transition:leave-start="translate-x-0" 
         x-transition:leave-end="-translate-x-full" 
         class="fixed inset-y-0 left-0 w-80 bg-white z-[1001] shadow-2xl p-10 flex flex-col"
         x-cloak
    >
        <button @click="showMenu = false" class="self-end text-gray-400 hover:text-black mb-12 transition">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
        
        <div class="space-y-8">
            <div class="flex items-center space-x-3 mb-12">
                <div class="bg-gray-100 p-2 rounded">
                    <svg class="w-8 h-8 text-gray-800" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="16" rx="1"></rect>
                        <path d="M7 8h10M7 12h10M7 16h5"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold font-serif tracking-tight uppercase">HOT NEWS</span>
            </div>

            <nav class="flex flex-col space-y-6 text-xl font-bold">
                <a href="/" class="hover:text-brand transition">Beranda</a>
                @foreach($globalCategories as $category)
                    <a href="{{ route('category.show', $category->name) }}" class="hover:text-brand transition">{{ $category->name }}</a>
                @endforeach
            </nav>

            <hr class="border-gray-100 my-8">

            @auth
                <div class="flex flex-col space-y-4">
                    <a href="{{ auth()->user()->role === 'ADMIN' ? route('admin.dashboard') : route('user.dashboard') }}" class="flex items-center space-x-2 text-gray-600 hover:text-black transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        <span>Dashboard</span>
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold hover:underline transition">Log Out</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="bg-brand text-black font-bold py-3 text-center rounded-[20px] hover:brightness-95 transition">Masuk / Daftar</a>
            @endauth
        </div>
    </div>
</body>
</html>
