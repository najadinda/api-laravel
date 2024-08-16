<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/logout', [AuthenticationController::class, 'logout']);
    Route::get('/user', [AuthenticationController::class, 'user']);

    Route::post('/posts', [PostController::class, 'store']);
    Route::patch('/posts/{id}', [PostController::class, 'update'])->middleware('owner-post');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('owner-post'); 

    Route::post('/komen', [CommentController::class, 'store']);
    Route::patch('/komen/{id}', [CommentController::class, 'update'])->middleware('owner-comment');
    Route::delete('/komen/{id}', [CommentController::class, 'destroy'])->middleware('owner-comment'); 
});

Route::get('/posts', [PostController::class, 'index']); 
Route::get('/posts/{id}', [PostController::class, 'show']); 

Route::post('/login', [AuthenticationController::class, 'login']);