<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AppUserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');


Route::get('/forum/{forum}', [ForumController::class, 'show'])->name('forums.show');

Route::get('/post/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/comment', [CommentController::class, 'store'])->middleware('auth')->name('comment');

Route::get('/user/{appUser}', [AppUserController::class, 'show'])->name('appUser.show');
Route::get('/user/{appUser}/comments', [AppUserController::class, 'show'])->name('appUser.show.comments');
Route::get('/user/{appUser}/posts', [AppUserController::class, 'show'])->name('appUser.show.posts');


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
