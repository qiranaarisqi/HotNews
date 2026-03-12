<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Kategori;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        if ($request->has('id_kategori')) {
            $query->where('id_kategori', $request->id_kategori);
        }

        $articles = $query->with('category')->latest()->paginate(10);
        $categories = Kategori::all();

        return view('admin.article.index', compact('articles', 'categories'));
    }

    public function create()
    {
        $categories = Kategori::all();
        $tags = Tag::all();
        return view('admin.article.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'id_kategori' => 'required|integer|exists:kategori,id_kategori',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id_tags',
        ]);

        try {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $count = 1;
            while (Article::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }

            $article = new Article();
            $article->title = $request->title;
            $article->slug = $slug;
            $article->content = $request->content;
            $article->id_kategori = $request->id_kategori;
            $article->id_user = Auth::id();
            $article->status = $request->status;
            $article->views = 0;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('articles', $filename, 'public');
                $article->image = Storage::url($path);
            }

            $article->save();
            
            if ($request->has('tags')) {
                $article->tags()->sync($request->tags);
            }

            return redirect()->route('admin.artikel.index')->with('success', 'Artikel "' . $article->title . '" berhasil diterbitkan!');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menyimpan artikel: ' . $e->getMessage());
        }
    }

    public function edit(Article $artikel)
    {
        $categories = Kategori::all();
        $tags = Tag::all();
        return view('admin.article.edit', compact('artikel', 'categories', 'tags'));
    }

    public function update(Request $request, Article $artikel)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'id_kategori' => 'required|integer|exists:kategori,id_kategori',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'status' => 'required|in:draft,published',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id_tags',
        ]);

        try {
            if ($request->title !== $artikel->title) {
                $slug = Str::slug($request->title);
                $originalSlug = $slug;
                $count = 1;
                while (Article::where('slug', $slug)->where('id_article', '!=', $artikel->id_article)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                $artikel->slug = $slug;
            }

            $artikel->title = $request->title;
            $artikel->content = $request->content;
            $artikel->id_kategori = $request->id_kategori;
            $artikel->status = $request->status;

            if ($request->hasFile('image')) {
                // Delete old image
                if ($artikel->image && !str_contains($artikel->image, 'picsum')) {
                    $oldPath = str_replace('/storage/', '', $artikel->image);
                    Storage::disk('public')->delete($oldPath);
                }
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('articles', $filename, 'public');
                $artikel->image = Storage::url($path);
            }

            $artikel->save();

            if ($request->has('tags')) {
                $artikel->tags()->sync($request->tags);
            }

            return redirect()->route('admin.artikel.index')->with('success', 'Artikel diperbarui secara sukses.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui artikel: ' . $e->getMessage());
        }
    }

    public function destroy(Article $artikel)
    {
        if ($artikel->image && !str_contains($artikel->image, 'picsum')) {
            $oldPath = str_replace('/storage/', '', $artikel->image);
            Storage::disk('public')->delete($oldPath);
        }
        $artikel->delete();
        return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
