<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $heroes = Article::where('status', 'published')->latest()->take(5)->get();
        
        $heroIds = $heroes->pluck('id_article')->toArray();
        
        $breakingNews = Article::where('status', 'published')
            ->whereNotIn('id_article', $heroIds)
            ->latest()
            ->take(3)
            ->get();
            
        $excludeIds = array_merge($heroIds, $breakingNews->pluck('id_article')->toArray());
            
        $latestNewsGrid = Article::where('status', 'published')
            ->whereNotIn('id_article', $excludeIds)
            ->latest()
            ->take(4)
            ->get();
            
        $excludeIds = array_merge($excludeIds, $latestNewsGrid->pluck('id_article')->toArray());
        
        $latestNewsList = Article::where('status', 'published')
            ->whereNotIn('id_article', $excludeIds)
            ->latest()
            ->take(3)
            ->get();

        return view('welcome', compact('heroes', 'breakingNews', 'latestNewsGrid', 'latestNewsList'));
    }
}
