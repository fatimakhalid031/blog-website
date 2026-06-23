<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EscapeController;

// ══════════════════════════════════════════════════
//  Admin panel — separate layout, no public links
//  Included from: routes/web.php
// ══════════════════════════════════════════════════

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');

    // Blog Posts management
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::get('/posts/new', [AdminController::class, 'createPost'])->name('post-form');
    Route::post('/posts', [AdminController::class, 'storePost'])->name('post-store');
    Route::get('/posts/{blogPost}/edit', [AdminController::class, 'editPost'])->name('post-edit');
    Route::put('/posts/{blogPost}', [AdminController::class, 'updatePost'])->name('post-update');
    Route::delete('/posts/{blogPost}', [AdminController::class, 'destroyPost'])->name('post-destroy');

    // Escapes — upload/create (uses existing EscapeController)
    Route::get('/escapes/create', [EscapeController::class, 'create'])->name('escapes.create');
    Route::post('/escapes', [EscapeController::class, 'store'])->name('escapes.store');

    // Escapes — manage, edit, delete (uses AdminController)
    Route::get('/escapes', [AdminController::class, 'escapes'])->name('escapes.manage');
    Route::get('/escapes/{escape}/edit', [AdminController::class, 'editEscape'])->name('escape-edit');
    Route::put('/escapes/{escape}', [AdminController::class, 'updateEscape'])->name('escape-update');
    Route::delete('/escapes/{escape}', [AdminController::class, 'destroyEscape'])->name('escape-destroy');
});
