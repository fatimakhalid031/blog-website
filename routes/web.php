<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogPostController;

// Public routes
Route::get('/', [BlogPostController::class, 'index'])->name('home');
Route::get('/about', [BlogPostController::class, 'about'])->name('about');
Route::get('/blog/{slug}', [BlogPostController::class, 'show'])->name('blog.show');

// Admin routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [BlogPostController::class, 'adminIndex'])->name('index');
    Route::get('/create', [BlogPostController::class, 'create'])->name('create');
    Route::post('/', [BlogPostController::class, 'store'])->name('store');
    Route::get('/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('edit');
    Route::put('/{blogPost}', [BlogPostController::class, 'update'])->name('update');
    Route::delete('/{blogPost}', [BlogPostController::class, 'destroy'])->name('destroy');
});
