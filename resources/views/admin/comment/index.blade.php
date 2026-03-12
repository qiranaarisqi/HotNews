@extends('layouts.admin')

@section('content')
<div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
    <div>
        <h1 class="text-3xl font-bold font-serif leading-tight">Comments & Interactions</h1>
        <p class="text-gray-400 font-medium italic mt-1">Manage discussion and moderation</p>
    </div>
    <form action="{{ route('admin.komentar.index') }}" method="GET">
        <select name="status" class="bg-white border border-gray-200 rounded-xl text-sm font-bold focus:ring-0 py-2.5 px-6 pr-12" onchange="this.form.submit()">
            <option value="">All Comments</option>
            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Moderation</option>
            <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
        </select>
    </form>
</div>

<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-[0.2em]">
                <th class="px-8 py-6">User</th>
                <th class="px-6 py-6">Comment</th>
                <th class="px-6 py-6">Target Article</th>
                <th class="px-6 py-6 text-center">Status</th>
                <th class="px-8 py-6 text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($comments as $comment)
            <tr class="hover:bg-gray-50/50 transition duration-300">
                <td class="px-8 py-6 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-brand/10 flex items-center justify-center text-[#004743] font-black">
                            {{ substr($comment->author ? $comment->author->name : 'G', 0, 1) }}
                        </div>
                        <span class="font-bold text-gray-900">{{ $comment->author ? $comment->author->name : 'Pengguna Tidak Dikenal' }}</span>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <div class="max-w-md">
                        <p class="text-sm text-gray-600 font-medium italic leading-relaxed">"{{ $comment->content }}"</p>
                        <span class="text-[10px] text-gray-400 font-bold block mt-2 uppercase tracking-tighter">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </td>
                <td class="px-6 py-6">
                    <a href="{{ route('article.show', $comment->article->slug) }}" target="_blank" class="inline-flex items-center text-xs font-bold text-gray-400 hover:text-brand transition space-x-2">
                        <i data-lucide="external-link" class="w-3 h-3"></i>
                        <span>{{ Str::limit($comment->article->title, 25) }}</span>
                    </a>
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
                    <div class="flex items-center justify-end space-x-2">
                        @if($comment->status != 'approved')
                        <form action="{{ route('admin.komentar.update', $comment->id_coment) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="p-2 bg-green-500/10 text-green-600 rounded-xl hover:bg-green-500 hover:text-white transition" title="Approve">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                            </button>
                        </form>
                        @endif
                        @if($comment->status != 'rejected')
                        <form action="{{ route('admin.komentar.update', $comment->id_coment) }}" method="POST">
                            @csrf @method('PUT')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="p-2 bg-red-500/10 text-red-600 rounded-xl hover:bg-red-500 hover:text-white transition" title="Reject">
                                <i data-lucide="slash" class="w-5 h-5"></i>
                            </button>
                        </form>
                        @endif
                        <form action="{{ route('admin.komentar.destroy', $comment->id_coment) }}" method="POST" onsubmit="return confirm('Hapus komentar selamanya?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="p-2 text-gray-300 hover:text-red-500 transition" title="Delete">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="py-20 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="message-square" class="w-16 h-16 text-gray-100 mb-4"></i>
                        <p class="text-gray-400 font-bold italic">No comments found here.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    @if($comments->hasPages())
    <div class="px-8 py-6 border-t border-gray-50">
        {{ $comments->appends(request()->query())->links() }}
    </div>
    @endif
</div>
@endsection
