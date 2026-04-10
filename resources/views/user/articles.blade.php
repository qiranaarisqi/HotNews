@extends('layouts.user')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h1 class="text-3xl font-bold font-serif leading-tight">Articles I Commented</h1>
        <p class="text-gray-400 font-medium italic mt-1">Discussions you've participated in</p>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
    @forelse($articles as $article)
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden flex flex-col group hover:border-[#004743] transition duration-300">
        <!-- Thumbnail -->
        <div class="h-48 overflow-hidden relative">
            @if($article->image)
                @if(str_contains($article->image, 'http'))
                    <img src="{{ $article->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $article->title }}">
                @else
                    <img src="{{ asset($article->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $article->title }}">
                @endif
            @else
                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                    <i data-lucide="image" class="w-8 h-8 text-gray-300"></i>
                </div>
            @endif
            <!-- Category Badge -->
            <div class="absolute top-4 left-4">
                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-bold bg-white/90 text-[#004743] uppercase tracking-wider shadow-sm">
                    {{ $article->category->name }}
                </span>
            </div>
        </div>
        
        <!-- Content -->
        <div class="p-6 flex flex-col flex-grow">
            <h3 class="font-bold font-serif text-lg leading-tight mb-4 group-hover:text-[#004743] transition">
                <a href="{{ route('article.show', $article->slug) }}" class="focus:outline-none">
                    <span class="absolute inset-0" aria-hidden="true"></span>
                    {{ Str::limit($article->title, 60) }}
                </a>
            </h3>
            
            <div class="mt-auto flex items-center justify-between">
                <div class="flex items-center text-xs font-bold text-gray-400">
                    <i data-lucide="message-square" class="w-4 h-4 mr-2 text-brand"></i>
                    <span>{{ $article->user_comments_count }} comments by you</span>
                </div>
                
                <a href="{{ route('article.show', $article->slug) }}" class="inline-flex items-center justify-center bg-gray-50 hover:bg-[#004743] hover:text-white p-2 rounded-xl transition font-bold text-gray-500 z-10 relative">
                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full py-24 bg-white rounded-2xl border border-gray-200 text-center">
        <i data-lucide="book-open" class="w-16 h-16 text-gray-200 mx-auto mb-6"></i>
        <h4 class="text-xl font-bold font-serif mb-2">No Articles Found</h4>
        <p class="text-gray-400 italic mb-6">You haven't interacted with any articles yet.</p>
        <a href="{{ route('home') }}" class="px-6 py-3 bg-[#004743] hover:brightness-110 text-white font-bold rounded-xl transition inline-block">
            Start Reading
        </a>
    </div>
    @endforelse
</div>

@if($articles->hasPages())
<div class="mt-10">
    {{ $articles->links() }}
</div>
@endif
@endsection
