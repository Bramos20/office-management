<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

Route::middleware('api')->group(function () {
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('employees', EmployeeController::class);
});
