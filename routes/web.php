<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingController;
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

    // Content Management (accessible to all authenticated users: Admin + Editor)
    // Note: PostPolicy and controller checks handle granular permissions.
    Route::resource('posts', PostController::class);
    Route::post('posts/bulk-action', [PostController::class, 'bulkAction'])->name('posts.bulk-action');
    Route::post('posts/{id}/quick-update', [PostController::class, 'quickUpdate'])->name('posts.quick-update');
    Route::post('posts/{id}/toggle-status', [PostController::class, 'toggleStatus'])->name('posts.toggle-status');

    Route::resource('categories', CategoryController::class)->except(['destroy']);
    Route::get('subcategories/by-category', [SubCategoryController::class, 'getByCategory'])->name('subcategories.by_category');
    Route::resource('subcategories', SubCategoryController::class)->except(['destroy']);
    Route::resource('tags', TagController::class)->except(['destroy']);

    // Filemanager — available to all admins
    Route::group(['prefix' => 'laravel-filemanager'], function () {
        Lfm::routes();
    });
});

// ── Admin-only routes ───────────────────────────────────────────────────────
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    // Users — full CRUD only for Admin
    Route::resource('users', UserController::class);
    Route::post('users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');

    // Admin-only actions for content models (Destroy & AJAX Toggles)
    Route::resource('categories', CategoryController::class)->only(['destroy']);
    Route::post('categories/bulk-action', [CategoryController::class, 'bulkAction'])->name('categories.bulk-action');
    Route::post('categories/{id}/quick-update', [CategoryController::class, 'quickUpdate'])->name('categories.quick-update');
    Route::post('categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    Route::resource('subcategories', SubCategoryController::class)->only(['destroy']);
    Route::post('subcategories/{id}/toggle-status', [SubCategoryController::class, 'toggleStatus'])->name('subcategories.toggle-status');

    Route::resource('tags', TagController::class)->only(['destroy']);
    Route::post('tags/{id}/toggle-status', [TagController::class, 'toggleStatus'])->name('tags.toggle-status');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');

    // Activity Logs
    Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
});
