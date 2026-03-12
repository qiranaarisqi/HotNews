@extends('layouts.user')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h1 class="text-3xl font-bold font-serif leading-tight">My Comments</h1>
        <p class="text-gray-400 font-medium italic mt-1">Track your discussion history</p>
    </div>
</div>

<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-[0.2em]">
                <th class="px-8 py-6">Target Article</th>
                <th class="px-6 py-6">Comment Content</th>
                <th class="px-6 py-6 text-center">Status</th>
                <th class="px-8 py-6 text-right">Date</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($comments as $comment)
            <tr class="hover:bg-gray-50/50 transition duration-300">
                <td class="px-8 py-6 whitespace-normal max-w-xs">
                    <a href="{{ route('article.show', $comment->article->slug) }}" target="_blank" class="font-bold text-gray-900 hover:text-brand transition flex items-start space-x-2">
                        <span>{{ $comment->article->title }}</span>
                        <i data-lucide="external-link" class="w-3 h-3 flex-shrink-0 mt-1"></i>
                    </a>
                </td>
                <td class="px-6 py-6 max-w-sm">
                    <p class="text-sm text-gray-600 font-medium italic leading-relaxed">"{{ $comment->content }}"</p>
                </td>
                <td class="px-6 py-6 text-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                        {{ $comment->status == 'approved' ? 'bg-green-100 text-green-700' : '' }}
                        {{ $comment->status == 'pending' ? 'bg-orange-100 text-orange-700' : '' }}
                        {{ $comment->status == 'rejected' ? 'bg-red-100 text-red-700' : '' }}">
                        {{ $comment->status }}
                    </span>
                </td>
                <td class="px-8 py-6 text-right">
                    <div class="text-sm font-bold text-gray-600 italic">
                        {{ \Carbon\Carbon::parse($comment->created_at)->format('M d, Y') }}
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="py-24 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="message-square" class="w-16 h-16 text-gray-200 mb-6 block"></i>
                        <h4 class="text-xl font-bold font-serif mb-2">No Comments Found</h4>
                        <p class="text-gray-400 italic">You haven't written any comments yet.</p>
                        <a href="{{ route('home') }}" class="mt-6 px-6 py-3 bg-[#004743] hover:brightness-110 text-white font-bold rounded-xl transition inline-block">
                            Browse Articles
                        </a>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($comments->hasPages())
    <div class="px-8 py-6 border-t border-gray-50">
        {{ $comments->links() }}
    </div>
    @endif
</div>
@endsection
