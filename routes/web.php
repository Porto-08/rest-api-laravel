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

// Post
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);
Route::get('/posts/edit/{id}', [PostController::class, 'edit']);
Route::get('/posts/filter/{data}', [PostController::class, 'search']);

Route::post('/posts/create', [PostController::class, 'store'])->middleware('token');
Route::put('/posts/update/{id}', [PostController::class, 'update']);
Route::delete('/posts/delete/{id}', [PostController::class, 'destroy']);

// User 
Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::delete('/users/{id}', [UserController::class, 'destroy']);


// login file

/**Rota para o Login */
Route::post('auth/login', [AuthController::class, 'login']);
 
Route::middleware(['apiJWT'])->group(function () {
    /** Informações do usuário logado */
    Route::get('auth/me', [AuthController::class, 'me']); 
    /** Encerra o acesso */
    Route::get('auth/logout', [AuthController::class, 'logout']); 
    /** Atualiza o token */
    Route::get('auth/refresh', [AuthController::class, 'refresh']); 
    /** Listagem dos usuarios cadastrados, este rota serve de teste para verificar a proteção feita pelo jwt */
    Route::get('/users', [UserController::class, 'index']); 
    /*Daqui para baixo você pode ir adiciondo todas as rotas que deverão estar protegidas em sua API*/
});