<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\GuestsMiddleware;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AuthorizedMiddleware;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\CreateArticleController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{slug}', [ArticleController::class, 'index'])->name('article');

Route::middleware([GuestsMiddleware::class])->group(function () {
    Route::get('/auth', [AuthController::class, 'index'])->name('auth');
    Route::get('/register', [RegisterController::class, 'index'])->name('register'); 
    Route::post('/auth', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware([AuthorizedMiddleware::class])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout'); 
    Route::post('/like', LikeController::class)->name('article.like');
    Route::post('/comment', CommentController::class)->name('article.comment');
});

Route::middleware([AuthorizedMiddleware::class, AdminMiddleware::class])->group(function () {
    Route::get('/create-article', [CreateArticleController::class, 'index'])->name('article.create'); 
    Route::post('/create-article', [CreateArticleController::class, 'store'])->name('article.store'); 
});