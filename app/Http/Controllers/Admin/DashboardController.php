<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;
use App\Models\Coment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArticles = Article::count();
        $totalUsers = User::count();
        $pendingComments = Coment::where('status', 'pending')->count();
        $totalViews = Article::sum('views');

        return view('admin.dashboard', compact('totalArticles', 'totalUsers', 'pendingComments', 'totalViews'));
    }
}
