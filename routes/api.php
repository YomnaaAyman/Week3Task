<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;


//Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/user', [UserController::class, 'test']);
    Route::apiResource('posts',PostController::class);
    });
    Route::post('/posts/{post}/comments', [CommentController::class, 'store']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
//});

require __DIR__.'/auth.php';
