<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\GetOverviewDataController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\CreateTaskController;
use App\Http\Controllers\Task\DeleteTaskController;
use App\Http\Controllers\Task\GetAllTaskController;
use App\Http\Controllers\Task\UpdateTaskController;
use App\Http\Controllers\User\GetAuthenticatedUserController;

Route::post('/login', LoginController::class);

Route::get('/user', GetAuthenticatedUserController::class)
    ->middleware('auth:sanctum');

Route::post('/task/create', CreateTaskController::class)
    ->middleware('auth:sanctum');

Route::get('/tasks', GetAllTaskController::class)
    ->middleware('auth:sanctum');

Route::put('/task/update/{id}', UpdateTaskController::class)
    ->middleware('auth:sanctum');

Route::delete('/task/delete/{id}', DeleteTaskController::class)
    ->middleware('auth:sanctum');

Route::get('/dashboard/overview', GetOverviewDataController::class)
    ->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    $users = User::all();
    return response()->json($users);
})->middleware('auth:sanctum');