<?php

use App\Http\Controllers\Api\Core\DepartmentController;
use App\Http\Controllers\Api\Core\TaskController;
use Illuminate\Support\Facades\Route;


Route::resource('task', TaskController::class);
Route::resource('department', DepartmentController::class);
