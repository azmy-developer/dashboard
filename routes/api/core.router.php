<?php

use App\Http\Controllers\Api\Core\ContactUsController;
use App\Http\Controllers\Api\Core\HomeController;
use App\Http\Controllers\Api\Core\ServiceController;


Route::resource('task', \App\Http\Controllers\Api\Core\TaskController::class);
Route::resource('department', \App\Http\Controllers\Api\Core\DepartmentController::class);
