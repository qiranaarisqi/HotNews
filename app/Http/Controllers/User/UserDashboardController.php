<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Coment;
use App\Models\Article;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalComments = Coment::where('user', $userId)->count();
        $pendingComments = Coment::where('user', $userId)->where('status', 'pending')->count();
        $approvedComments = Coment::where('user', $userId)->where('status', 'approved')->count();
        $rejectedComments = Coment::where('user', $userId)->where('status', 'rejected')->count();

        return view('user.dashboard', compact(
            'totalComments', 
            'pendingComments', 
            'approvedComments', 
            'rejectedComments'
        ));
    }

    public function comments()
    {
        $userId = Auth::id();
        $comments = Coment::with('article')
            ->where('user', $userId)
            ->latest()
            ->paginate(10);

        return view('user.comments', compact('comments'));
    }

    public function articlesCommented()
    {
        $userId = Auth::id();

        // Get unique article IDs the user commented on
        $articleIds = Coment::where('user', $userId)
            ->select('article_id')
            ->distinct()
            ->pluck('article_id');

        $articles = Article::whereIn('id_article', $articleIds)
            ->withCount(['comments as user_comments_count' => function($query) use ($userId) {
                $query->where('user', $userId);
            }])
            ->latest()
            ->paginate(10);

        return view('user.articles', compact('articles'));
    }
}
