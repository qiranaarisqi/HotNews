@extends('layouts.admin')

@section('content')
<div class="mb-12">
    <h1 class="text-3xl font-bold font-serif leading-tight">Overview Dashboard</h1>
    <p class="text-gray-400 font-medium italic">Monitor performa konten dan interaksi pengguna Anda</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <!-- Total Articles -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="file-text" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="bg-brand/10 w-12 h-12 rounded-2xl flex items-center justify-center text-[#004743] mb-6">
                <i data-lucide="file-text" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 italic">Total Artikel</p>
                <div class="flex items-baseline space-x-2">
                    <span class="text-4xl font-bold leading-none tracking-tight">{{ number_format($totalArticles) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Users -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="users" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="bg-[#004743]/5 w-12 h-12 rounded-2xl flex items-center justify-center text-[#004743] mb-6">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 italic">Total Jurnalis</p>
                <div class="flex items-baseline space-x-2">
                    <span class="text-4xl font-bold leading-none tracking-tight">{{ number_format($totalUsers) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Active Comments -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="message-circle" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="bg-orange-500/10 w-12 h-12 rounded-2xl flex items-center justify-center text-orange-600 mb-6">
                <i data-lucide="message-circle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 italic">Comment Pending</p>
                <div class="flex items-baseline space-x-2">
                    <span class="text-4xl font-bold leading-none tracking-tight">{{ number_format($pendingComments) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Engagement -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="trending-up" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10 flex flex-col h-full justify-between">
            <div class="bg-blue-500/10 w-12 h-12 rounded-2xl flex items-center justify-center text-blue-600 mb-6">
                <i data-lucide="eye" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1 italic">Total Pembaca</p>
                <div class="flex items-baseline space-x-2 text-blue-600">
                    <span class="text-4xl font-bold leading-none tracking-tight">{{ number_format($totalViews) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent News Grid or Analytics could go here -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="bg-white p-8 rounded-2xl border border-gray-200">
        <h3 class="text-xl font-bold font-serif mb-6 flex items-center italic">
            <i data-lucide="zap" class="w-5 h-5 mr-3 text-brand"></i>
            Quick Actions
        </h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.artikel.create') }}" class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:border-brand hover:bg-white transition duration-300">
                <i data-lucide="pen-tool" class="w-6 h-6 text-gray-400 group-hover:text-black mb-3"></i>
                <span class="block font-bold text-xs uppercase tracking-widest text-gray-400 group-hover:text-black">Tulis Artikel</span>
            </a>
            <a href="{{ route('admin.kategori.index') }}" class="group p-5 bg-gray-50 rounded-2xl border border-gray-100 hover:border-[#004743] hover:bg-white transition duration-300">
                <i data-lucide="grid" class="w-6 h-6 text-gray-400 group-hover:text-[#004743] mb-3"></i>
                <span class="block font-bold text-xs uppercase tracking-widest text-gray-400 group-hover:text-[#004743]">Manage Kategori</span>
            </a>
        </div>
    </div>

    <div class="bg-[#004743] p-8 rounded-2xl border border-white/10 relative overflow-hidden group">
        <div class="relative z-10 flex flex-col justify-between h-full">
            <div>
                <h3 class="text-lg font-bold text-white mb-2 italic">System Health</h3>
                <p class="text-white/40 text-sm italic mb-8">Everything is running smoothly for production.</p>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2 bg-brand/10 border border-brand/20 py-1.5 px-3 rounded-lg text-brand font-bold text-[10px] uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand"></span>
                    <span>ONLINE</span>
                </div>
                <span class="text-white/20 text-[9px] font-black uppercase tracking-[0.2em] italic">V 2.4</span>
            </div>
        </div>
    </div>
</div>
@endsection
