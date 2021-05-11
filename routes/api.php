<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TasksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/tasks', [TasksController::class, 'index']);
Route::prefix('/task')->group(function () {
    Route::post('/store', [TasksController::class, 'store']);
    Route::put('/{id}', [TasksController::class, 'update']);
    Route::delete('/{id}', [TasksController::class, 'destroy']);
});
