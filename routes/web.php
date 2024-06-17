<?php

use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/admin/categories', 'index')->name('admin.categories');
    });
    Route::controller(TagController::class)->group(function () {
        Route::get('/admin/tags', 'index')->name('admin.tags');
    });
    Route::controller(AdminPostController::class)->group(function () {
        Route::get('/admin/posts', 'index')->name('admin.posts');
    });
    Route::controller(AdminUserController::class)->group(function () {
        Route::get('/admin/users', 'index')->name('admin.users');
    });
});

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('posts.index');
    Route::get('/posts', 'index')->name('posts.index');
    Route::get('/posts/{post}', 'show')->name('posts.show');
    Route::get('/category/{category}', 'category')->name('posts.category');
    Route::get('/tag/{tag}', 'tag')->name('posts.tag');
});
