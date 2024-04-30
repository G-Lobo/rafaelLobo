<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;

Route::get('/', function () {
    return view('home');
});


/* Blog Posts */
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/create', [BlogPostController::class, 'create'])->name('blog.create');
Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
Route::get('/blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');
Route::get('/blog/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
Route::delete('/blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.destroy');


/* Rotas Breeze */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
