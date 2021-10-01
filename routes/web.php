<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {
    return [
        'success' => true,
        'message' => 'Server is on.'
    ];
});
// Publicas
Route::post('/api/users/create', [UserController::class, 'store']);
Route::post('/api/login', [AuthController::class, 'login']);

// Rotas protegidas por token 
Route::middleware('jwt.auth')->group(function () {
    // Relacionado a Login
    Route::post('/api/me', [AuthController::class, 'me']);
    Route::post('/api/refresh', [AuthController::class, 'refresh']);
    Route::post('/api/logout', [AuthController::class, 'logout']);

    // Post
    Route::get('/api/posts', [PostController::class, 'index']);
    Route::get('/api/posts/{id}', [PostController::class, 'show']);
    Route::get('/api/posts/user/{user_id}', [PostController::class, 'postUser']);
    Route::get('/api/posts/edit/{id}', [PostController::class, 'edit']);
    Route::get('/api/posts/filter/{data}', [PostController::class, 'search']);
    Route::post('/api/posts/create', [PostController::class, 'store']);
    Route::put('/api/posts/update/{id}', [PostController::class, 'update']);
    Route::delete('/api/posts/delete/{id}', [PostController::class, 'destroy']);

    // User 
    Route::get('/api/users', [UserController::class, 'index']);
    Route::get('/api/users/{id}', [UserController::class, 'show']);
    Route::put('/api/users/{id}', [UserController::class, 'update']);
    Route::delete('/api/users/{id}', [UserController::class, 'destroy']);
});
