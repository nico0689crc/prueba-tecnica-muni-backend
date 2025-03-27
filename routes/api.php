<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TareaController;
use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::get('me', [AuthController::class, 'me'])->name('me');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');

        Route::middleware('can:create,App\Models\User')->group(function () {
            Route::post('register', [AuthController::class, 'register'])->name('register');
        });
    });

    Route::prefix('tareas')->group(function () {
        Route::get('', [TareaController::class, 'index'])->name('tareas.index');
        Route::get('{tarea}', [TareaController::class, 'show'])->name('tareas.show')->middleware('can:view,tarea');
        Route::post('', [TareaController::class, 'store'])->name('tareas.store')->middleware('can:create,App\Models\Tarea');
        Route::put('{tarea}', [TareaController::class, 'update'])->name('tareas.update')->middleware('can:update,tarea');
        Route::delete('{tarea}', [TareaController::class, 'destroy'])->name('tareas.destroy')->middleware('can:delete,tarea');

        Route::prefix('{tarea}/usuarios')->group(function () {
            Route::post('{user}', [TareaController::class, 'addUser'])->name('tareas.usuarios.add')->middleware('can:update,tarea');
            Route::delete('{user}', [TareaController::class, 'removeUser'])->name('tareas.usuarios.remove')->middleware('can:update,tarea');
            Route::put('{user}/estado', [TareaController::class, 'estado'])->name('tareas.usuarios.estado')->middleware('can:update,tarea');
        });
    });

    Route::prefix('usuarios')->group(function () {
        Route::get('', [UserController::class, 'index'])->name('usuarios.index');
        Route::get('{user}', [UserController::class, 'show'])->name('usuarios.show')->middleware('can:view,user');
        Route::put('{user}', [UserController::class, 'update'])->name('usuarios.update')->middleware('can:update,user');
        Route::delete('{user}', [UserController::class, 'destroy'])->name('usuarios.destroy')->middleware('can:delete,user');
        Route::post('', [UserController::class, 'store'])->name('usuarios.store')->middleware('can:create,App\Models\User');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
});
