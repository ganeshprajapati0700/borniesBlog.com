<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $posts = Post::with('user')->latest()->get();

    return view('welcome', compact('posts'));
});

Route::group(['prefix' => 'admin'], function () {
    Route::view('/login', 'admin.auth.login')->name('login.view');
    Route::view('/register', 'admin.auth.register')->name('register.view');
    // route for post
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('register', [AuthController::class, 'register'])->name('admin.register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/posts', PostController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/subcategories', SubCategoryController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/tags', TagController::class);
});
