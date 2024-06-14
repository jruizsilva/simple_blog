<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\PostController;
use App\Livewire\Categories;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/admin', 'index')->name('admin.index');
    });
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin.categories');
    });

    Route::controller(PostController::class)->group(function () {
        Route::get('/', 'index')->name('posts.index');
        Route::get('/posts', 'index')->name('posts.index');
        Route::get('/posts/{post}', 'show')->name('posts.show');
        Route::get('/category/{category}', 'category')->name('posts.category');
        Route::get('tag/{tag}', 'tag')->name('posts.tag');
        // Route::get('/posts/create', 'create');
        // Route::post('/posts', 'store');
        // Route::get('/posts/{post}/edit', 'edit');
        // Route::put('/posts/{post}', 'update');
        // Route::delete('/posts/{post}', 'destroy');
    });
});
