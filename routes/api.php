<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'API Laravel 11']);
});

// Rotas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [PasswordResetController::class, 'forgotPassword']);
Route::post('/reset-password', [PasswordResetController::class, 'resetPassword']);

// Rotas protegidas por autenticação
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    // Rotas de usuários
    Route::apiResource('users', UserController::class);

    // Rotas de perfis
    Route::apiResource('profiles', ProfileController::class);

    // Rotas de permissões
    Route::apiResource('permissions', PermissionController::class);
});

// Rotas relacionadas a recuperação de senha
Route::post('/password-recovery', [PasswordResetController::class, 'forgotPassword']);
Route::post('/password-reset', [PasswordResetController::class, 'resetPassword']);
