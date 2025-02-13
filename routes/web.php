<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ADMPannelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\FilmAreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;

/* Rota da Home */
Route::get('/', HomeController::class)->name('home');

/* Rotas de Filmes */
Route::get('/filmes', [MovieController::class, 'index'])->name('movies.index');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/filmes/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/filmes', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/filmes/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/filmes/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/filmes/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');
});

Route::get('/filmes/{movie}', [MovieController::class, 'show'])->name('movies.show');

/* Rotas de area de atuaçao no filme */
Route::middleware('auth','verified')->group(function () {
    Route::get('/area/create ', [FilmAreaController::class, 'create'])->name('area.create');
    Route::post('/area', [FilmAreaController::class, 'store'])->name('area.store');
    Route::get('area/{filmArea}/edit',[FilmAreaController::class, 'edit'])->name('area.edit');
    Route::put('area/{filmArea}',[FilmAreaController::class, 'update'])->name('area.update');
    Route::delete('/area/{filmArea}', [FilmAreaController::class, 'destroy'])->name('area.destroy');
});

/* Blog Posts */
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/blog/create', [BlogPostController::class, 'create'])->name('blog.create');
    Route::post('/blog', [BlogPostController::class, 'store'])->name('blog.store');
    Route::get('/blog/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{blogPost}', [BlogPostController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{blogPost}', [BlogPostController::class, 'destroy'])->name('blog.destroy');
});

Route::get('/blog/{blogPost}', [BlogPostController::class, 'show'])->name('blog.show');


/* Rotas About */
Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/about/create', [AboutController::class, 'create'])->name('about.create');
    Route::post('/about', [AboutController::class, 'store'])->name('about.store');
    Route::get('/about/{about}/edit', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/{about}', [AboutController::class, 'update'])->name('about.update');
    Route::delete('/about/{about}', [AboutController::class, 'destroy'])->name('about.delete');
});



/* Rota do painel de administrador */

Route::middleware('auth', 'verified')->group(function() {
    Route::get('/adm', ADMPannelController::class)->name('adm.pannel');
});


/* Rotas Breeze */
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
