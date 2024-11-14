<?php

use App\Http\Controllers\ForumController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/forums', [ForumController::class, 'index'])->name('forums.index');

Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forums.show');