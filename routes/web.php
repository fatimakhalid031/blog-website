<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;

// Landing page
Route::get('/', [BlogPostController::class, 'index'])->name('home');

// Blog entries (separate page)
Route::get('/entries', [BlogPostController::class, 'entries'])->name('entries');

// Blogger page
Route::get('/blogger', [BlogPostController::class, 'blogger'])->name('blogger');

// About
Route::get('/about', [BlogPostController::class, 'about'])->name('about');
Route::get('/blog/{slug}', [BlogPostController::class, 'show'])->name('blog.show');

// Auth routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin routes (requires authentication)
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [BlogPostController::class, 'adminIndex'])->name('index');
    Route::get('/create', [BlogPostController::class, 'create'])->name('create');
    Route::post('/', [BlogPostController::class, 'store'])->name('store');
    Route::get('/{blogPost}/edit', [BlogPostController::class, 'edit'])->name('edit');
    Route::put('/{blogPost}', [BlogPostController::class, 'update'])->name('update');
    Route::delete('/{blogPost}', [BlogPostController::class, 'destroy'])->name('destroy');
});

// Escapes
Route::get('/escapes', [App\Http\Controllers\EscapeController::class, 'index'])->name('escapes.index');
Route::get('/escapes/{escape}', [App\Http\Controllers\EscapeController::class, 'show'])->name('escapes.show');

// Admin: Escapes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/escapes/create', [App\Http\Controllers\EscapeController::class, 'create'])->name('escapes.create');
    Route::post('/escapes', [App\Http\Controllers\EscapeController::class, 'store'])->name('escapes.store');
    Route::delete('/escapes/{escape}', [App\Http\Controllers\EscapeController::class, 'destroy'])->name('escapes.destroy');
});
