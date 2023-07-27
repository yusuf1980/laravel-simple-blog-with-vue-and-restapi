<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;
// use App\Http\Controllers\Admin\PostController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);
Route::get('posts/comments/{id}', [PostController::class, 'comments']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refreshToken']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::resource('admin/posts', App\Http\Controllers\Admin\PostController::class);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::resource('admin/comments', CommentController::class);
    Route::post('like/', [PostController::class, 'like']);
    Route::post('unlike/', [PostController::class, 'unlike']);
    Route::get('post/like/{id}', [PostController::class, 'getLike']);
});

