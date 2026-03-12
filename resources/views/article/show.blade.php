@extends('layouts.main')

@section('content')
<div class="max-w-7xl mx-auto px-4 mt-12 flex flex-col md:flex-row gap-12">
    <!-- Main Content -->
    <div class="w-full md:w-2/3">
        <nav class="flex text-xs font-bold uppercase tracking-widest text-gray-400 mb-6">
            <a href="/" class="hover:text-brand">Home</a>
            <span class="mx-2">/</span>
            <a href="{{ route('category.show', $article->category->name) }}" class="hover:text-brand">{{ $article->category->name }}</a>
        </nav>

        <h1 class="text-4xl md:text-5xl font-bold font-serif leading-tight mb-6">
            {{ $article->title }}
        </h1>

        <div class="flex items-center space-x-4 mb-8 pb-8 border-b border-gray-100 text-sm text-gray-500">
            <div class="flex items-center">
                <span class="font-bold text-gray-900 mr-2">{{ $article->user->name }}</span>
                <span class="mx-2">&bull;</span>
                <span>{{ $article->created_at->format('M d, Y') }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                <span>{{ $article->views }} views</span>
            </div>
        </div>

        <div class="aspect-video rounded-sm overflow-hidden mb-8">
            <img src="{{ $article->image }}" class="w-full h-full object-cover">
        </div>

        <div class="prose max-w-none text-gray-800 leading-relaxed font-sans first-letter:text-5xl first-letter:font-serif first-letter:font-bold first-letter:float-left first-letter:mr-3">
            {!! nl2br(e($article->content)) !!}
        </div>

        <div class="mt-12 pt-8 border-t border-gray-100">
            <h4 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Tags:</h4>
            <div class="flex flex-wrap gap-2">
                @foreach($article->tags as $tag)
                    <a href="{{ route('tag.show', $tag->name) }}" class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-bold rounded-full hover:bg-brand hover:text-black transition">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Comments Section -->
        <div class="mt-20">
            <h3 class="text-2xl font-bold font-serif mb-8">Komentar ({{ $article->comments()->where('status', 'approved')->count() }})</h3>
            
            <div class="space-y-8 mb-12">
                @foreach($article->comments()->where('status', 'approved')->get() as $comment)
                <div class="flex space-x-4">
                    <div class="flex-shrink-0 w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center font-bold text-gray-500">
                        {{ substr($comment->author ? $comment->author->name : 'G', 0, 1) }}
                    </div>
                    <div>
                        <div class="flex items-center space-x-2 mb-1">
                            <span class="font-bold text-sm">{{ $comment->author ? $comment->author->name : 'Guest' }}</span>
                            <span class="text-gray-400 text-xs">&bull; {{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-sm text-gray-700">{{ $comment->content }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            @auth
                <div class="bg-gray-50 p-8 rounded-sm">
                    <h4 class="font-bold mb-4">Berikan Komentar</h4>
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif
                    <form action="{{ route('comment.submit') }}" method="POST">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id_article }}">
                        <textarea name="content" rows="4" class="w-full border-gray-200 rounded-sm focus:ring-brand focus:border-brand mb-4" placeholder="Tulis komentar Anda..."></textarea>
                        <button type="submit" class="bg-brand text-black font-bold px-6 py-2 rounded-sm transition hover:bg-opacity-90">
                            Kirim Komentar
                        </button>
                    </form>
                </div>
            @else
                <div class="bg-gray-50 p-8 text-center rounded-sm">
                    <p class="text-gray-600 mb-4">Anda harus login untuk dapat memberikan komentar.</p>
                    <a href="{{ route('login') }}" class="inline-block bg-brand text-black font-bold px-8 py-2 rounded-sm transition hover:bg-opacity-90">
                        Login untuk Berkomentar
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <!-- Sidebar / Related Articles -->
    <div class="w-full md:w-1/3">
        <h3 class="text-xl font-bold font-serif mb-6 pb-2 border-b-2 border-brand inline-block">Berita Terkait</h3>
        <div class="space-y-8">
            @foreach($related as $news)
            <div class="group">
                <div class="aspect-video rounded-sm overflow-hidden mb-4">
                    <img src="{{ $news->image }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                </div>
                <h4 class="font-bold font-serif leading-tight hover:text-gray-700">
                    <a href="{{ route('article.show', $news->slug) }}">{{ $news->title }}</a>
                </h4>
                <span class="text-[10px] text-gray-400 uppercase mt-2 block">{{ $news->created_at->format('M d, Y') }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
