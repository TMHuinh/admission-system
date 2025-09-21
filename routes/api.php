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
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ReminderController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/applications', [ApplicationController::class, 'index']);
Route::post('/applications', [ApplicationController::class, 'store']);
Route::put('/applications/{application_id}', [ApplicationController::class, 'update']);
Route::delete('/applications/{application_id}', [ApplicationController::class, 'destroy']);

Route::post('/register', [RegistrationController::class, 'store']);

Route::post('/applications/{application_id}/status', [StatusController::class, 'update']);

Route::post('/applications/{application_id}/reminder', [ReminderController::class, 'send']);
