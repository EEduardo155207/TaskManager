<?php

use App\Http\Controllers\TaskController;
use App\http\Controller\AuthController;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Rotas de Autenticação - Registro e logins de usuarios.
Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rotas protegidas com Autenticação
Route::middleware(['auth:sanctum'])->group(function()
{
    Route::get('/task', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{id}', [TaskController::class, 'show']);
    Route::put('/tasks/{id}', [TaskController::class, 'update']);
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
});

