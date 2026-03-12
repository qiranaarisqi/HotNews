@extends('layouts.user')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-bold font-serif leading-tight">Overview Dashboard</h1>
    <p class="text-gray-400 font-medium italic mt-1">Monitor your interaction with our contents</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
    <!-- Total Comments -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="message-square" class="w-24 h-24"></i>
        </div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 border border-gray-100 group-hover:bg-brand/10 group-hover:border-brand/20 group-hover:text-brand transition-colors">
                <i data-lucide="message-square" class="w-6 h-6 text-gray-400 group-hover:text-brand transition-colors"></i>
            </div>
            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Total Comments</h3>
            <div class="text-4xl font-black text-gray-900 tracking-tight">{{ number_format($totalComments) }}</div>
        </div>
    </div>

    <!-- Approved Comments -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="check-circle" class="w-24 h-24 font-bold text-green-500"></i>
        </div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 border border-gray-100 group-hover:bg-green-500/10 group-hover:border-green-500/20 group-hover:text-green-500 transition-colors">
                <i data-lucide="check-circle" class="w-6 h-6 text-gray-400 group-hover:text-green-500 transition-colors"></i>
            </div>
            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Approved Comments</h3>
            <div class="text-4xl font-black text-gray-900 tracking-tight">{{ number_format($approvedComments) }}</div>
        </div>
    </div>

    <!-- Pending Comments -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="clock" class="w-24 h-24 font-bold text-orange-500"></i>
        </div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 border border-gray-100 group-hover:bg-orange-500/10 group-hover:border-orange-500/20 group-hover:text-orange-500 transition-colors">
                <i data-lucide="clock" class="w-6 h-6 text-gray-400 group-hover:text-orange-500 transition-colors"></i>
            </div>
            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Pending Comments</h3>
            <div class="text-4xl font-black text-gray-900 tracking-tight">{{ number_format($pendingComments) }}</div>
        </div>
    </div>

    <!-- Rejected Comments -->
    <div class="bg-white p-6 rounded-2xl border border-gray-200 relative overflow-hidden group transition-colors duration-300">
        <div class="absolute top-0 right-0 p-4 opacity-5 group-hover:opacity-10 transition-opacity">
            <i data-lucide="slash" class="w-24 h-24 font-bold text-red-500"></i>
        </div>
        <div class="relative z-10">
            <div class="w-12 h-12 bg-gray-50 rounded-xl flex items-center justify-center mb-6 border border-gray-100 group-hover:bg-red-500/10 group-hover:border-red-500/20 group-hover:text-red-500 transition-colors">
                <i data-lucide="slash" class="w-6 h-6 text-gray-400 group-hover:text-red-500 transition-colors"></i>
            </div>
            <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] mb-2">Rejected Comments</h3>
            <div class="text-4xl font-black text-gray-900 tracking-tight">{{ number_format($rejectedComments) }}</div>
        </div>
    </div>
</div>

@if($totalComments === 0)
    <div class="flex flex-col items-center justify-center py-24 bg-white rounded-2xl border border-gray-200">
        <i data-lucide="ghost" class="w-16 h-16 text-gray-200 mb-6 block"></i>
        <h4 class="text-xl font-bold font-serif mb-2">No interactions yet</h4>
        <p class="text-gray-400 italic mb-6">You haven't written any comments yet. Go read some news!</p>
        <a href="{{ route('home') }}" class="px-6 py-3 bg-[#004743] text-white font-bold rounded-xl hover:brightness-110 transition">
            Read News
        </a>
    </div>
@endif
@endsection
