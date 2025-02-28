<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;

Route::get('payroll', [PayrollController::class, 'index'])->name('payroll.index');
Route::get('payroll/create', [PayrollController::class, 'create'])->name('payroll.create');
Route::post('payroll/store', [PayrollController::class, 'store'])->name('payroll.store');

Route::get('attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::post('attendance/clock-in', [AttendanceController::class, 'markAttendance'])->name('attendance.clock-in');
Route::post('attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clock-out');

Route::resource('leaves', LeaveRequestController::class);
Route::patch('leaves/{leave}/approve', [LeaveRequestController::class, 'approve'])->name('leaves.approve');
Route::patch('leaves/{leave}/reject', [LeaveRequestController::class, 'reject'])->name('leaves.reject');

Route::resource('tasks', TaskController::class);
Route::resource('employees', EmployeeController::class);

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
