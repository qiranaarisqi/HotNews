@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-12 pb-20">
    <div class="mb-12">
        <h1 class="text-3xl font-bold font-serif mb-2">{{ $title }}</h1>
        <div class="w-16 h-1 bg-brand"></div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($articles as $news)
        <div class="group cursor-pointer">
            <div class="aspect-[4/3] rounded-sm overflow-hidden mb-4">
                <img src="{{ $news->image }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
            </div>
            <div class="flex items-center space-x-3 text-[10px] font-bold text-gray-400 uppercase mb-2">
                <span class="px-2 py-0.5 bg-gray-100 text-gray-600 rounded-full group-hover:bg-brand group-hover:text-black transition">
                    {{ $news->category->name }}
                </span>
                <span>{{ $news->created_at->format('M d, Y') }}</span>
            </div>
            <h3 class="text-lg font-bold font-serif leading-snug group-hover:text-gray-700 transition">
                <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
            </h3>
        </div>
        @endforeach
    </div>

    <div class="mt-16">
        {{ $articles->links() }}
    </div>
</div>
@endsection
