<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - {{ config('app.name', 'HOT NEWS') }}</title>
    
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
        .sidebar-link.active {
            background-color: #c8e63a;
            color: #000;
        }
    </style>
</head>
<body class="bg-[#f8f9fa] font-sans text-gray-900 overflow-x-hidden">

    <div class="flex min-h-screen" x-data="{ sidebarOpen: true }">
        <!-- Sidebar -->
        <aside 
            :class="sidebarOpen ? 'w-72' : 'w-20'" 
            class="bg-[#004743] text-white transition-all duration-300 flex flex-col fixed inset-y-0 z-50 border-r border-[#004743]"
        >
            <!-- Logo area -->
            <div class="px-8 flex items-center h-20 border-b border-white/5">
            <a href="/" class="flex items-center space-x-3 group">
                <div class="bg-brand p-1.5 rounded-lg">
                    <i data-lucide="newspaper" class="w-5 h-5 text-[#004743]"></i>
                </div>
                <span class="text-xl font-bold font-serif uppercase tracking-widest text-white">HOT NEWS</span>
            </a>
        </div>     <!-- Nav links -->
            <nav class="flex-grow p-4 space-y-2 mt-4 overflow-y-auto">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.dashboard') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Dashboard</span>
                </a>

                <div x-show="sidebarOpen" class="px-4 py-2 mt-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">Content Management</div>

                <a href="{{ route('admin.artikel.index') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.artikel.*') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="file-text" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Articles</span>
                </a>
                
                <a href="{{ route('admin.kategori.index') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.kategori.*') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="grid" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Categories</span>
                </a>

                <a href="{{ route('admin.tags.index') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.tags.*') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="tag" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Tags</span>
                </a>

                <div x-show="sidebarOpen" class="px-4 py-2 mt-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">Interactions</div>

                <a href="{{ route('admin.komentar.index') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.komentar.*') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="message-square" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Comments</span>
                </a>

                <div x-show="sidebarOpen" class="px-4 py-2 mt-4 text-[10px] font-bold text-white/40 uppercase tracking-widest">Users & Settings</div>

                <a href="{{ route('admin.users.index') }}" class="sidebar-link flex items-center p-3 rounded-xl transition group {{ request()->routeIs('admin.users.*') ? 'active' : 'hover:bg-white/5' }}">
                    <i data-lucide="users" class="w-5 h-5 flex-shrink-0"></i>
                    <span x-show="sidebarOpen" class="ml-4 font-medium transition-opacity">Users</span>
                </a>
            </nav>

            <!-- Bottom Section -->
            <div class="p-4 border-t border-white/10">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center w-full p-3 text-white/60 hover:text-white transition group hover:bg-red-500/10 rounded-xl">
                        <i data-lucide="log-out" class="w-5 h-5 text-red-400"></i>
                        <span x-show="sidebarOpen" class="ml-4 font-medium">Log out</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main 
            :class="sidebarOpen ? 'ml-72' : 'ml-20'" 
            class="flex-grow transition-all duration-300 min-h-screen flex flex-col"
        >
            <!-- Top Header -->
            <header class="h-20 bg-white border-b border-gray-100 flex items-center justify-between px-8 sticky top-0 z-40">
                <div class="flex items-center space-x-6">
                    <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-gray-100 rounded-lg transition">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                    <div class="hidden md:flex flex-col">
                        <h2 class="text-sm font-bold text-gray-400 uppercase tracking-wider">Dashboard</h2>
                        <span class="text-lg font-bold">Welcome back, {{ Auth::user()->name }} 👋</span>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center space-x-2 text-sm font-bold bg-brand py-2 px-4 rounded-full text-black border border-brand hover:bg-[#b0cc34] transition">
                        <i data-lucide="external-link" class="w-4 h-4"></i>
                        <span>View Website</span>
                    </a>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8 flex-grow">
                @yield('content')
            </div>

            <!-- Footer -->
            <footer class="p-8 bg-white border-t border-gray-50 text-center text-sm text-gray-400 font-medium">
                &copy; {{ date('Y') }} HOT NEWS Admin Panel. Built for Excellence.
            </footer>
        </main>
    </div>

    <!-- Toast Notifications Component -->
    <div 
        x-data="{ 
            messages: [], 
            remove(id) { this.messages = this.messages.filter(m => m.id !== id) },
            add(msg, type = 'success') {
                const id = Date.now();
                this.messages.push({ id, msg, type });
                setTimeout(() => this.remove(id), 5000);
            }
        }"
        @notify.window="add($event.detail.message, $event.detail.type)"
        class="fixed top-8 right-8 z-[100] space-y-4"
    >
        <template x-for="message in messages" :key="message.id">
            <div 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="translate-x-full opacity-0"
                x-transition:enter-end="translate-x-0 opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="translate-x-0 opacity-100"
                x-transition:leave-end="translate-x-full opacity-0"
                :class="message.type === 'success' ? 'bg-[#004743] text-white' : 'bg-red-600 text-white'"
                class="min-w-[300px] flex items-center justify-between p-4 rounded-2xl border border-white/10"
            >
                <div class="flex items-center space-x-4">
                    <i data-lucide="check-circle" x-show="message.type === 'success'" class="w-6 h-6"></i>
                    <i data-lucide="alert-circle" x-show="message.type === 'error'" class="w-6 h-6"></i>
                    <span class="font-bold text-sm" x-text="message.msg"></span>
                </div>
                <button @click="remove(message.id)" class="ml-4 text-white/50 hover:text-white">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
        </template>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Handle Laravel Flash Messages
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('success') }}", type: 'success' } }));
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ session('error') }}", type: 'error' } }));
            });
        @endif

        @if($errors->any())
            document.addEventListener('DOMContentLoaded', () => {
                window.dispatchEvent(new CustomEvent('notify', { detail: { message: "{{ $errors->first() }}", type: 'error' } }));
            });
        @endif
    </script>
</body>
</html>
