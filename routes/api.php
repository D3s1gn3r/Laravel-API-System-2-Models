<?php

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
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


Route::post('/user/token/create', [UserController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
        'user' => UserController::class,
        'vehicle' => VehicleController::class,
    ]);

    Route::get('/user/tokens/logout', [UserController::class, 'logout']);
});
