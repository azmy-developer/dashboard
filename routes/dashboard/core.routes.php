<?php


use Illuminate\Support\Facades\Route;

route_group('core', function () {

    Route::resource('employee', EmployeeController::class);
    Route::get('employee/change_status', [\App\Http\Controllers\Dashboard\Core\EmployeeController::class,'change_status'])->name('employee.change_status');
    Route::resource('department', \App\Http\Controllers\Dashboard\Core\DepartmentController::class);

    Route::get('/task', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'index'])->name('task.index')->middleware('permission:show_tasks');
    Route::get('task/create', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'create'])->name('task.create')->middleware('permission:create_tasks');
    Route::post('/task', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'store'])->name('task.store')->middleware('permission:create_tasks');
    Route::get('task/{id}/edit', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'edit'])->name('task.edit')->middleware('permission:edit_tasks');
    Route::match(['put', 'patch'],'task/{id}', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'update'])->name('task.update')->middleware('permission:edit_tasks');
    Route::delete('task/{id}/delete', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'destroy'])->name('task.destroy')->middleware('permission:delete_tasks');
    Route::get('task/change_status', [\App\Http\Controllers\Dashboard\Core\TaskController::class,'change_status'])->name('task.change_status');

});

