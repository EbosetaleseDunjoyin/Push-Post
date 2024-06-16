<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PageController::class, "index"])->name("home");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->resource("posts",PostController::class);
Route::get("post/{post}",[PostController::class, "show"])->name("post.show");


Route::middleware('auth')->resource("posts.comments", CommentController::class)->shallow();


// Route::middleware('auth')->prefix("posts")->group(function () {
//     //Post Routes
//     Route::get('/', [PostController::class, 'index'])->name('posts.index');
//     Route::get('/create', [PostController::class, 'create'])->name('posts.create');
//     Route::post('/store', [PostController::class, 'store'])->name('posts.store');
//     Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
//     Route::patch('/{post}/update', [PostController::class, 'update'])->name('posts.update');
//     Route::delete('/{post}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
// });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
