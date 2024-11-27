<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');

Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forums.show');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
