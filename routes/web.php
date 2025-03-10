<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\KPIController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\FinanceReportController;


Route::middleware(['role:admin'])->group(function () {
    Route::get('/finances/reports/profit-loss', [FinanceReportController::class, 'profitLoss'])->name('finance.reports.profit_loss');
    Route::get('/finances/reports/ledger', [FinanceReportController::class, 'ledger'])->name('finance.reports.ledger');
    Route::resource('finances', FinanceController::class);

    Route::resource('budgets', BudgetController::class);
    Route::resource('departments', DepartmentController::class);

    Route::resource('kpis', KPIController::class);

    Route::get('assets', [AssetController::class, 'index'])->name('assets.index');
    Route::get('assets/create', [AssetController::class, 'create'])->name('assets.create');
    Route::post('assets/store', [AssetController::class, 'store'])->name('assets.store');
    Route::post('assets/{asset}/status', [AssetController::class, 'updateStatus'])->name('assets.updateStatus');

    Route::get('performance-reviews', [PerformanceReviewController::class, 'index'])->name('performance_reviews.index');
    Route::get('performance-reviews/create', [PerformanceReviewController::class, 'create'])->name('performance_reviews.create');
    Route::post('performance-reviews/store', [PerformanceReviewController::class, 'store'])->name('performance_reviews.store');
});

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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});

require __DIR__.'/auth.php';
