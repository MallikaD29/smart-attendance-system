<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Admin\AttendanceController as AdminAttendanceController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:Admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return 'Admin Dashboard';
    })->name('admin.dashboard');

    Route::get('/admin/employees', [EmployeeController::class, 'index'])
        ->name('admin.employees.index');

    Route::get('/admin/employees/create', [EmployeeController::class, 'create'])
        ->name('admin.employees.create');

    Route::post('/admin/employees', [EmployeeController::class, 'store'])
        ->name('admin.employees.store');

    Route::get('/admin/employees/{employee}/edit', [EmployeeController::class, 'edit'])
        ->name('admin.employees.edit');

    Route::put('/admin/employees/{employee}', [EmployeeController::class, 'update'])
        ->name('admin.employees.update');

    Route::delete('/admin/employees/{employee}', [EmployeeController::class, 'destroy'])
        ->name('admin.employees.destroy');

    Route::get('/admin/attendance', [AdminAttendanceController::class, 'index'])
        ->name('admin.attendance');
});

Route::middleware(['auth', 'role:HR'])->group(function () {
    Route::get('/hr/dashboard', function () {
        return 'HR Dashboard';
    })->name('hr.dashboard');
});

Route::middleware(['auth', 'role:Employee'])->group(function () {

    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard');
    })->name('employee.dashboard');

    Route::post('/employee/check-in', [AttendanceController::class, 'checkIn'])
        ->name('employee.checkin');

    Route::post('/employee/check-out', [AttendanceController::class, 'checkOut'])
        ->name('employee.checkout');
});

require __DIR__ . '/auth.php';
