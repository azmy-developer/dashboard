<?php


use App\Http\Controllers\Dashboard\Core\DepartmentController;
use App\Http\Controllers\Dashboard\Core\EmployeeController;
use App\Http\Controllers\Dashboard\Core\TaskController;
use Illuminate\Support\Facades\Route;



    Route::resource('employee', EmployeeController::class);
    Route::get('employee/change_status', [EmployeeController::class,'change_status'])->name('employee.change_status');
    Route::resource('department', DepartmentController::class);

    Route::get('/task', [TaskController::class,'index'])->name('task.index')->middleware('permission:show_tasks');
    Route::get('task/create', [TaskController::class,'create'])->name('task.create')->middleware('permission:create_tasks');
    Route::post('/task', [TaskController::class,'store'])->name('task.store')->middleware('permission:create_tasks');
    Route::get('task/{id}/edit', [TaskController::class,'edit'])->name('task.edit')->middleware('permission:edit_tasks');
    Route::match(['put', 'patch'],'task/{id}', [TaskController::class,'update'])->name('task.update')->middleware('permission:edit_tasks');
    Route::delete('task/{id}/delete', [TaskController::class,'destroy'])->name('task.destroy')->middleware('permission:delete_tasks');
    Route::get('task/change_status', [TaskController::class,'change_status'])->name('task.change_status');



