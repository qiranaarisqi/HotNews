<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Kategori;
use App\Models\Tag;
use App\Models\Coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->where('status', 'published')->firstOrFail();
        
        // --- REALISTIC METRICS SYSTEM ---
        // 1. Abaikan view dari ADMIN (agar data tidak bias oleh tim internal)
        // 2. Gunakan session untuk mencegah double-count saat refresh halaman
        $viewedKey = 'viewed_article_' . $article->id_article;
        
        if (!(Auth::check() && Auth::user()->role === 'ADMIN')) {
            if (!session()->has($viewedKey)) {
                $article->increment('views');
                session()->put($viewedKey, true);
            }
        }
        
        $related = Article::where('id_kategori', $article->id_kategori)
            ->where('id_article', '!=', $article->id_article)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();
            
        return view('article.show', compact('article', 'related'));
    }

    public function category($name)
    {
        $category = Kategori::where('name', $name)->firstOrFail();
        $articles = Article::where('id_kategori', $category->id_kategori)
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('article.index', [
            'articles' => $articles,
            'title' => 'Kategori: ' . $category->name
        ]);
    }

    public function tag($name)
    {
        $tag = Tag::where('name', $name)->firstOrFail();
        $articles = $tag->articles()
            ->where('status', 'published')
            ->latest()
            ->paginate(12);
            
        return view('article.index', [
            'articles' => $articles,
            'title' => 'Tag: ' . $tag->name
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('q');
        $articles = Article::where('status', 'published')
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%$query%")
                  ->orWhere('content', 'LIKE', "%$query%");
            })
            ->latest()
            ->paginate(12);
            
        return view('article.index', [
            'articles' => $articles,
            'title' => 'Hasil Pencarian: ' . $query
        ]);
    }

    public function comment(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:article,id_article',
            'content' => 'required',
        ]);

        Coment::create([
            'article_id' => $request->input('article_id'),
            'user' => Auth::id(),
            'content' => $request->input('content'),
            'status' => 'pending',
            'created_at' => now(),
        ]);

        return back()->with('success', 'Komentar Anda sedang menunggu moderasi.');
    }
}
