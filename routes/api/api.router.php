<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Checkout\CheckoutController;
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


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {
    require __DIR__ . '/core.router.php';
    require __DIR__ . '/auth.router.php';

});

