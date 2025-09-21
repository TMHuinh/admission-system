<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ReminderController;

Route::apiResource('applications', ApplicationController::class);

Route::post('/register', [RegistrationController::class, 'store']);

Route::post('/applications/{id}/status', [StatusController::class, 'update']);

Route::post('/applications/{id}/reminder', [ReminderController::class, 'send']);
