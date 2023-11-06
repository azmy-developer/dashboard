<?php


use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Core\PersonalInfoController;

Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/deleteAccount', [AuthController::class, 'deleteAccount']);



