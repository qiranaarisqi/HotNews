@extends('layouts.admin')

@section('content')
<!-- Quill Editor Styles -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="mb-10 flex items-center justify-between">
    <div>
        <h1 class="text-3xl font-bold font-serif leading-tight">Create New Article</h1>
        <p class="text-gray-400 font-medium mt-1 italic">Draft your next big story</p>
    </div>
    <a href="{{ route('admin.artikel.index') }}" class="text-sm font-bold text-gray-400 hover:text-black transition flex items-center italic">
        <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
        Kembali ke Daftar
    </a>
</div>

<form action="{{ route('admin.artikel.store') }}" method="POST" enctype="multipart/form-data" id="articleForm" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    @csrf
    
    <!-- Left Column: Main Info -->
    <div class="lg:col-span-2 space-y-8">
        <div class="bg-white p-10 rounded-[40px] border border-gray-100 shadow-sm space-y-8">
            <div class="space-y-2">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Article Title</label>
                <input type="text" name="title" value="{{ old('title') }}" required 
                       class="w-full bg-gray-50 border-none rounded-2xl py-4 px-6 focus:ring-4 focus:ring-brand/10 transition text-lg font-bold placeholder:text-gray-300" 
                       placeholder="Enter a catchy headline...">
                @error('title') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="space-y-2">
                <label class="block text-[11px] font-bold text-gray-400 uppercase tracking-widest ml-1">Content Body</label>
                <div id="toolbar" class="border-none bg-gray-50 rounded-t-2xl px-4 py-2"></div>
                <div id="editor" class="h-[600px] bg-gray-50 border-none rounded-b-2xl px-6 py-4 text-lg leading-relaxed">
                    {!! old('content') !!}
                </div>
                <input type="hidden" name="content" id="contentInput">
                @error('content') <p class="text-red-500 text-xs font-bold mt-1 text-right">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>

    <!-- Right Column: Settings & Meta -->
    <div class="space-y-8">
        <!-- Publishing Settings -->
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-lg font-bold flex items-center italic">
                <i data-lucide="settings" class="w-5 h-5 mr-3 text-brand"></i>
                Publishing
            </h3>
            
            <div class="space-y-4">
                <div class="p-4 bg-gray-50 rounded-2xl space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Status</label>
                    <select name="status" class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-sm">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="p-4 bg-gray-50 rounded-2xl space-y-2">
                    <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-[0.1em]">Category</label>
                    <select name="id_kategori" required class="w-full bg-transparent border-none p-0 focus:ring-0 font-bold text-sm">
                        @foreach($categories as $category)
                        <option value="{{ $category->id_kategori }}" {{ old('id_kategori') == $category->id_kategori ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button type="submit" class="w-full bg-brand py-4 px-6 rounded-2xl text-black font-extrabold hover:brightness-105 transition shadow-lg shadow-brand/20 flex items-center justify-center space-x-3">
                <i data-lucide="send" class="w-5 h-5"></i>
                <span>Simpan & Terbitkan</span>
            </button>
        </div>

        <!-- Media -->
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-lg font-bold flex items-center italic">
                <i data-lucide="image" class="w-5 h-5 mr-3 text-brand"></i>
                Cover Image
            </h3>
            
            <div class="relative group">
                <div class="aspect-video bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 flex flex-col items-center justify-center overflow-hidden transition group-hover:border-brand/40">
                    <img id="preview" class="hidden w-full h-full object-cover">
                    <div id="placeholder" class="flex flex-col items-center">
                        <i data-lucide="upload-cloud" class="w-10 h-10 text-gray-300 mb-2"></i>
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-tighter">Click to upload</span>
                    </div>
                </div>
                <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer" onchange="previewImage(this)">
            </div>
            @error('image') <p class="text-red-500 text-xs font-bold mt-1 text-center">{{ $message }}</p> @enderror
        </div>

        <!-- Tags -->
        <div class="bg-white p-8 rounded-[40px] border border-gray-100 shadow-sm space-y-6">
            <h3 class="text-lg font-bold flex items-center italic">
                <i data-lucide="hash" class="w-5 h-5 mr-3 text-brand"></i>
                Relevant Tags
            </h3>
            
            <div class="flex flex-wrap gap-2">
                @foreach($tags as $tag)
                <label class="cursor-pointer">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id_tags }}" class="hidden peer" {{ is_array(old('tags')) && in_array($tag->id_tags, old('tags')) ? 'checked' : '' }}>
                    <span class="px-4 py-2 rounded-xl border border-gray-100 bg-gray-50 text-xs font-bold text-gray-400 peer-checked:bg-brand peer-checked:text-black peer-checked:border-brand transition">
                        {{ $tag->name }}
                    </span>
                </label>
                @endforeach
            </div>
        </div>
    </div>
</form>

<!-- Scripts -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script>
    const quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    document.getElementById('articleForm').onsubmit = function() {
        document.getElementById('contentInput').value = quill.root.innerHTML;
    };

    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview').src = e.target.result;
                document.getElementById('preview').classList.remove('hidden');
                document.getElementById('placeholder').classList.add('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection
