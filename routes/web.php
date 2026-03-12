<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ArticleController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/artikel/{slug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/kategori/{name}', [ArticleController::class, 'category'])->name('category.show');
Route::get('/tag/{name}', [ArticleController::class, 'tag'])->name('tag.show');
Route::get('/search', [ArticleController::class, 'search'])->name('search');

// User Dashboard
Route::middleware(['auth', 'user'])->prefix('dashboard')->name('user.')->group(function () {
    Route::get('/', [\App\Http\Controllers\User\UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/comments', [\App\Http\Controllers\User\UserDashboardController::class, 'comments'])->name('comments.index');
    Route::get('/articles-commented', [\App\Http\Controllers\User\UserDashboardController::class, 'articlesCommented'])->name('articles.index');
    Route::get('/profile', [\App\Http\Controllers\User\UserProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [\App\Http\Controllers\User\UserProfileController::class, 'update'])->name('profile.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/komentar', [ArticleController::class, 'comment'])->name('comment.submit');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Panel
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('artikel', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('kategori', \App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('tags', \App\Http\Controllers\Admin\TagController::class);
    Route::resource('komentar', \App\Http\Controllers\Admin\CommentController::class);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

require __DIR__.'/auth.php';
