@extends('layouts.admin')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
    <div>
        <h1 class="text-3xl font-bold font-serif leading-tight">Manage Articles</h1>
        <p class="text-gray-400 font-medium flex items-center mt-1">
            <i data-lucide="file-text" class="w-4 h-4 mr-2 text-brand"></i>
            Total {{ $articles->total() }} articles published or drafted
        </p>
    </div>
    <a href="{{ route('admin.artikel.create') }}" class="inline-flex items-center space-x-2 bg-brand py-3 px-6 rounded-2xl text-black font-bold border border-[#b0cc34] hover:bg-[#b0cc34] transition">
        <i data-lucide="plus" class="w-5 h-5"></i>
        <span>Create New Article</span>
    </a>
</div>

<!-- Filters -->
<div class="bg-white p-6 rounded-2xl border border-gray-200 mb-8">
    <form action="{{ route('admin.artikel.index') }}" method="GET" class="flex flex-wrap items-center gap-6">
        <div class="flex items-center space-x-4">
            <label class="text-sm font-bold text-gray-500 uppercase tracking-widest">Filter by:</label>
            <select name="status" class="bg-gray-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-brand/20 py-2.5 px-4 pr-10 min-w-[140px]">
                <option value="">All Status</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
            </select>
            
            <select name="id_kategori" class="bg-gray-50 border-none rounded-xl text-sm font-bold focus:ring-2 focus:ring-brand/20 py-2.5 px-4 pr-10 min-w-[160px]">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                <option value="{{ $category->id_kategori }}" {{ request('id_kategori') == $category->id_kategori ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit" class="bg-[#004743] text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:brightness-110 transition">
            Apply Filter
        </button>
        
        @if(request()->hasAny(['status', 'id_kategori']))
            <a href="{{ route('admin.artikel.index') }}" class="text-sm font-bold text-red-500 hover:underline px-4 italic">Reset</a>
        @endif
    </form>
</div>

<!-- Article Table -->
<div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-gray-50/50 border-b border-gray-100">
                <th class="py-6 px-8 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Thumbnail</th>
                <th class="py-6 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Title & Category</th>
                <th class="py-6 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Status</th>
                <th class="py-6 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Views</th>
                <th class="py-6 px-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Date</th>
                <th class="py-6 px-8 text-right text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-50">
            @forelse($articles as $article)
            <tr class="hover:bg-gray-50/50 transition duration-300">
                <td class="py-4 px-8">
                    <div class="w-20 h-14 rounded-xl overflow-hidden border border-gray-100">
                        @if($article->image)
                            <img src="{{ $article->image }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                <i data-lucide="image" class="w-6 h-6 text-gray-300"></i>
                            </div>
                        @endif
                    </div>
                </td>
                <td class="py-4 px-4 max-w-sm">
                    <div class="font-bold text-gray-900 group cursor-default">
                        {{ $article->title }}
                    </div>
                    <div class="mt-1">
                        <span class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold bg-brand/10 text-[#004743] uppercase tracking-wider">
                            {{ $article->category->name }}
                        </span>
                    </div>
                </td>
                <td class="py-4 px-4">
                    @if($article->status === 'published')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-green-500/10 text-green-600 border border-green-500/10">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500 mr-2"></span>
                            Published
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-400 border border-gray-200">
                            <span class="w-1.5 h-1.5 rounded-full bg-gray-300 mr-2"></span>
                            Draft
                        </span>
                    @endif
                </td>
                <td class="py-4 px-4">
                    <div class="flex items-center text-gray-500 font-bold text-sm">
                        <i data-lucide="eye" class="w-4 h-4 mr-2"></i>
                        {{ number_format($article->views) }}
                    </div>
                </td>
                <td class="py-4 px-4">
                    <div class="text-sm font-bold text-gray-600 italic">
                        {{ $article->created_at->format('M d, Y') }}
                    </div>
                </td>
                <td class="py-4 px-8 text-right">
                    <div class="flex items-center justify-end space-x-3">
                        <a href="{{ route('article.show', $article->slug) }}" target="_blank" class="p-2 hover:bg-gray-100 rounded-xl transition text-gray-400 hover:text-brand" title="View Article">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </a>
                        <a href="{{ route('admin.artikel.edit', $article->id_article) }}" class="p-2 hover:bg-gray-100 rounded-xl transition text-gray-400 hover:text-blue-500" title="Edit Article">
                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                        </a>
                        <form action="{{ route('admin.artikel.destroy', $article->id_article) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 hover:bg-gray-100 rounded-xl transition text-gray-400 hover:text-red-500" title="Delete Article">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="py-20 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="inbox" class="w-16 h-16 text-gray-200 mb-4 font-thin"></i>
                        <p class="text-gray-400 font-bold text-lg italic">Belum ada artikel ditemukan</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="p-8 border-t border-gray-50">
        {{ $articles->links() }}
    </div>
</div>
@endsection
