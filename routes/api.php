<?php

use App\Http\Controllers\Auth\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\CreateTaskController;


Route::post('/login', LoginController::class);
Route::post('/task/create', CreateTaskController::class);

Route::get('/users', function (Request $request) {
    $users = User::all();
    return response()->json($users);
})->middleware('auth:sanctum');
