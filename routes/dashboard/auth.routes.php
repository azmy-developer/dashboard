<?php

use App\Http\Controllers\Dashboard\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Dashboard\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Dashboard\Auth\NewPasswordController;
use App\Http\Controllers\Dashboard\Auth\PasswordResetLinkController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [AuthenticatedSessionController::class, 'loginForm'])
    ->middleware('guest:employee')
    ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'doLogin'])
    ->middleware('guest:employee');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest:employee')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest:employee')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest:employee')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest:employee')
    ->name('password.update');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->middleware('auth:employee')
    ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
    ->middleware('auth:employee');

Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth:employee')
    ->name('logout');
