@extends('layouts.admin')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-bold font-serif leading-tight">Categories</h1>
    <p class="text-gray-400 font-medium italic mt-1">Organisir topik berita Anda</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
    <!-- List -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50 uppercase text-[10px] font-bold text-gray-400 tracking-[0.2em]">
                        <th class="px-8 py-6">Name</th>
                        <th class="px-6 py-6">Description</th>
                        <th class="px-8 py-6 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($categories as $category)
                    <tr x-data="{ editing: false, name: '{{ $category->name }}', desc: '{{ $category->description }}' }" class="hover:bg-gray-50/50 transition truncate">
                        <td class="px-8 py-5">
                            <template x-if="!editing">
                                <span class="font-bold text-gray-900">{{ $category->name }}</span>
                            </template>
                            <template x-if="editing">
                                <input type="text" x-model="name" class="w-full bg-gray-50 border-none rounded-xl text-sm font-bold py-2 px-3 focus:ring-2 focus:ring-brand/20">
                            </template>
                        </td>
                        <td class="px-6 py-5">
                            <template x-if="!editing">
                                <span class="text-sm text-gray-400 font-medium italic">{{ Str::limit($category->description, 60) ?: 'No description' }}</span>
                            </template>
                            <template x-if="editing">
                                <input type="text" x-model="desc" class="w-full bg-gray-50 border-none rounded-xl text-sm font-medium py-2 px-3 focus:ring-2 focus:ring-brand/20">
                            </template>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <template x-if="!editing">
                                <div class="flex justify-end items-center space-x-3">
                                    <button @click="editing = true" class="p-2 hover:bg-gray-100 rounded-xl transition text-gray-400 hover:text-blue-500" title="Edit">
                                        <i data-lucide="edit-3" class="w-5 h-5"></i>
                                    </button>
                                    <form action="{{ route('admin.kategori.destroy', $category->id_kategori) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 hover:bg-gray-100 rounded-xl transition text-gray-400 hover:text-red-500" title="Delete">
                                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </template>
                            <template x-if="editing">
                                <div class="flex justify-end items-center space-x-2">
                                    <form :action="'{{ route('admin.kategori.update', ':id') }}'.replace(':id', {{ $category->id_kategori }})" method="POST">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="name" :value="name">
                                        <input type="hidden" name="description" :value="desc">
                                        <button type="submit" class="bg-[#004743] text-white px-4 py-2 rounded-xl text-xs font-bold hover:brightness-110 transition">Save</button>
                                    </form>
                                    <button @click="editing = false" class="text-gray-400 p-2 hover:text-black transition">
                                        <i data-lucide="x" class="w-4 h-4"></i>
                                    </button>
                                </div>
                            </template>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Form -->
    <div class="lg:col-span-1">
        <div class="bg-white p-6 rounded-2xl border border-gray-200 sticky top-28">
            <h3 class="text-lg font-bold mb-6 italic flex items-center">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-3 text-brand"></i>
                Add New Category
            </h3>
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-6">
                @csrf
                <div class="p-4 bg-gray-50 rounded-2xl space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Category Name</label>
                    <input type="text" name="name" required class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-sm placeholder:text-gray-300" placeholder="e.g. Politik">
                </div>
                
                <div class="p-4 bg-gray-50 rounded-2xl space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-widest">Description</label>
                    <textarea name="description" rows="4" class="w-full bg-transparent border-none p-0 focus:ring-0 font-medium text-sm placeholder:text-gray-300" placeholder="Short description..."></textarea>
                </div>

                <button type="submit" class="w-full bg-brand text-black font-extrabold py-4 px-6 rounded-2xl shadow-lg shadow-brand/10 hover:brightness-95 transition flex items-center justify-center space-x-2">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    <span>Simpan Kategori</span>
                </button>
                @if($errors->any())
                    <p class="text-red-500 text-[10px] font-bold text-center uppercase tracking-wider">{{ $errors->first() }}</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
