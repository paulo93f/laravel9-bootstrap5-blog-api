<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/posts/', [App\Http\Controllers\PostController::class, 'getPosts'])->name('posts.posts');
Route::get('/', [App\Http\Controllers\PostController::class, 'getPosts'])->name('posts.posts');

Route::get('/posts/{id}', [App\Http\Controllers\PostController::class, 'getPost'])->name('posts.post_details');
