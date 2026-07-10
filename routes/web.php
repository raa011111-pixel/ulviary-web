<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/article/{slug}', [PublicController::class, 'show'])->name('public.articles.show');
Route::post('/article/{article}/comment', [PublicController::class, 'storeComment'])->name('public.comments.store');

// Dashboard (Protected by Auth)
Route::get('/dashboard', function () {
    $user = auth()->user();
    $totalArticles = $user->articles()->count();
    $publishedArticles = $user->articles()->where('status', 'published')->count();
    $draftArticles = $user->articles()->where('status', 'draft')->count();
    $totalCategories = $user->categories()->count();
    $totalComments = \App\Models\Comment::whereHas('article', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })->count();

    return view('dashboard', compact(
        'totalArticles',
        'publishedArticles',
        'draftArticles',
        'totalCategories',
        'totalComments'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

// Private Resource Routes (Protected by Auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('articles', ArticleController::class);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Branding Settings Routes
    Route::get('/settings/branding', [\App\Http\Controllers\BrandingController::class, 'edit'])->name('settings.branding.edit');
    Route::put('/settings/branding', [\App\Http\Controllers\BrandingController::class, 'update'])->name('settings.branding.update');

    // User Management Routes (Kelola Pengguna)
    Route::resource('users', \App\Http\Controllers\UserController::class)->only(['index', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
