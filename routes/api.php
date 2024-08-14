<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthenticationController;

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
    Route::patch('/posts{id}', [PostController::class, 'update']); 
});

Route::get('/posts', [PostController::class, 'index']); 
Route::get('/posts/{id}', [PostController::class, 'show']); 

Route::post('/login', [AuthenticationController::class, 'login']);