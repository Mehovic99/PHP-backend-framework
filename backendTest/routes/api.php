<?php

use App\Models\Post;
use App\Http\Controllers\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', [PostsController::class, 'index'])->middleware('auth:sanctum');

Route::post('/posts', [PostsController::class, 'store'])->middleware('auth:sanctum');

Route::put('/posts/{post}', [PostsController::class, 'update'])->middleware('auth:sanctum');

Route::delete('/posts/{post}', [PostsController::class, 'remove'])->middleware('auth:sanctum');