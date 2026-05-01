<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::get('/', function () {
    return redirect()->route('login.view');
});

Route::get('/admin', function () {
    return redirect()->route('login.view');
});

Route::group(['prefix' => 'admin'], function () {
    Route::view('/login', 'admin.auth.login')->name('login.view');
    Route::view('/register', 'admin.auth.register')->name('register.view');
    Route::view('/forgot-password', 'admin.auth.forgot-password')->name('admin.forgot-password');
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ── Authenticated routes (all logged-in users) ─────────────────────────────
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Posts — accessible to all authenticated users (Admin + Editor)
    Route::resource('/posts', PostController::class);
    Route::post('/posts/bulk-action', [PostController::class, 'bulkAction'])->name('posts.bulk-action');
    Route::post('/posts/{id}/quick-update', [PostController::class, 'quickUpdate'])->name('posts.quick-update');
    Route::post('/posts/{id}/toggle-status', [PostController::class, 'toggleStatus'])
        ->name('posts.toggle-status');

    // Categories — read-only for Editors; toggle & destroy restricted to Admin
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    // Sub-Categories — read-only list + AJAX for Posts create/edit
    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::get('/subcategories/by-category', [SubCategoryController::class, 'getByCategory'])->name('subcategories.by_category');
    Route::get('/subcategories/create', [SubCategoryController::class, 'create'])->name('subcategories.create');
    Route::get('/subcategories/{subcategory}/edit', [SubCategoryController::class, 'edit'])->name('subcategories.edit');
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::put('/subcategories/{subcategory}', [SubCategoryController::class, 'update'])->name('subcategories.update');

    // Tags — read-only list for Editors
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::get('/tags/{tag}/edit', [TagController::class, 'edit'])->name('tags.edit');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');

    // Filemanager — available to all admins
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        Lfm::routes();
    });
});

// ── Admin-only routes ───────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Users — full CRUD only for Admin
    Route::resource('/users', UserController::class);
    Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])
        ->name('users.toggle-status');

    // Destroy & toggle status for content models
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::post('/categories/bulk-action', [CategoryController::class, 'bulkAction'])->name('categories.bulk-action');
    Route::post('/categories/{id}/quick-update', [CategoryController::class, 'quickUpdate'])->name('categories.quick-update');
    Route::post('/categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('categories.toggle-status');

    Route::delete('/subcategories/{subcategory}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::post('/subcategories/{id}/toggle-status', [SubCategoryController::class, 'toggleStatus'])
        ->name('subcategories.toggle-status');

    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
    Route::post('/tags/{id}/toggle-status', [TagController::class, 'toggleStatus'])
        ->name('tags.toggle-status');
});
