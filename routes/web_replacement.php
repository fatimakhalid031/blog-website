<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\EscapeController;

// ── Public routes ──

Route::get('/', [BlogPostController::class, 'index'])->name('home');
Route::get('/entries', [BlogPostController::class, 'entries'])->name('entries');
Route::get('/blogger', [BlogPostController::class, 'blogger'])->name('blogger');
Route::get('/about', [BlogPostController::class, 'about'])->name('about');
Route::get('/blog/{slug}', [BlogPostController::class, 'show'])->name('blog.show');

Route::get('/escapes', [EscapeController::class, 'index'])->name('escapes.index');
Route::get('/escapes/{escape}', [EscapeController::class, 'show'])->name('escapes.show');
Route::get('/escapes/{escape}/status', [EscapeController::class, 'status'])->name('escapes.status');

// Auth
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ══════════════════════════════════════════════════
//  Admin panel — loaded from routes/admin.php
// ══════════════════════════════════════════════════
require __DIR__.'/admin.php';

// ══════════════════════════════════════════════════
//  Manager routes (manager role required)
// ══════════════════════════════════════════════════
Route::middleware(['auth', 'role:manager'])->prefix('manager')->name('manager.')->group(function () {
    Route::get('/', [App\Http\Controllers\ManagerController::class, 'dashboard'])->name('dashboard');

    // Blog Posts
    Route::get('/posts', [App\Http\Controllers\ManagerController::class, 'posts'])->name('posts');
    Route::get('/posts/new', [App\Http\Controllers\ManagerController::class, 'createPost'])->name('post-form');
    Route::post('/posts', [App\Http\Controllers\ManagerController::class, 'storePost'])->name('post-store');
    Route::get('/posts/{blogPost}/edit', [App\Http\Controllers\ManagerController::class, 'editPost'])->name('post-edit');
    Route::put('/posts/{blogPost}', [App\Http\Controllers\ManagerController::class, 'updatePost'])->name('post-update');

    // Escapes (list and edit only — upload uses admin route, no delete)
    Route::get('/escapes', [App\Http\Controllers\ManagerController::class, 'escapes'])->name('escapes');
    Route::get('/escapes/{escape}/edit', [App\Http\Controllers\ManagerController::class, 'editEscape'])->name('escape-edit');
    Route::put('/escapes/{escape}', [App\Http\Controllers\ManagerController::class, 'updateEscape'])->name('escape-update');
});
