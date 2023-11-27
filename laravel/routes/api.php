<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

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

Route::post('/signin', [AuthController::class, 'signin']);

Route::prefix('/task')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::post('/new', [TaskController::class, 'store']);
    Route::get('/createdby/{userID}', [TaskController::class, 'showByUserId']);
    Route::put('{id}', [TaskController::class, 'update']);
    Route::patch('/change/{id}', [TaskController::class, 'changeFinished']);
    Route::delete('{id}', [TaskController::class, 'destroy']);
});

Route::post('/user', [UserController::class, 'store']);


Route::get('/tasks', [TaskController::class, 'index']);

