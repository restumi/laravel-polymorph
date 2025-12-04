<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::resource('posts', PostController::class);
// ========== POSTS / BLOG ==========
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

// ========== VIDEO ==========
Route::resource('videos', VideoController::class);

// ========== COMMENT ==========
Route::post('/comment/{post}/post', [CommentController::class, 'storePostComment'])->name('posts.comments.store');
Route::post('comment/{video}/video', [CommentController::class, 'storeVideosComment'])->name('videos.comments.store');
