<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PostController;


Route::prefix("v1")->group(function () {
    //Auth Routes
    Route::prefix("auth")->group(function(){
        Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
        Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
    });

    Route::get('/posts', [PostController::class, 'listPosts'])->name('api.posts.list');
    Route::get('/posts/{post}', [PostController::class, 'getPost'])->name('api.posts.show');
    
    Route::middleware('auth:sanctum')->group(function () {
        //Post Routes
        // Route::get('/user/{user}/posts', [PostController::class, 'usersPost'])->name('api.posts.usersPost');
        Route::post('/posts/store', [PostController::class, 'store'])->name('api.posts.store');
        Route::post('/posts/{post}/comments/store', [CommentController::class, 'store'])->name('api.posts.coments.store');
        
    });
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
