<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\MovieController;

Route::get('/', function () {
    return view('home');
});


/* Rotas de Filmes */
Route::get('/filmes', [MovieController::class, 'index'])->name('movies.index');
Route::get('/filmes/create', [MovieController::class, 'create'])->name('movies.create');
Route::post('/filmes', [MovieController::class, 'store'])->name('movies.store');
Route::get('/filmes/{movie}', [MovieController::class, 'show'])->name('movies.show');
Route::get('/filmes/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
Route::put('/filmes/{movie}', [MovieController::class, 'update'])->name('movies.update');
Route::delete('/filmes/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

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
