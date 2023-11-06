<?php


use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/deleteAccount', [AuthController::class, 'deleteAccount']);



