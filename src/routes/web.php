<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AuthenticatedSessionController;

Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('verified')->group(function () {
    Route::get('/', [WorkController::class, 'index']);
    Route::post('/', [WorkController::class, 'store']);
    Route::put('/work/update', [WorkController::class, 'update']);
    Route::post('/break', [BreakController::class, 'store']);
    Route::put('/break/update', [BreakController::class, 'update']);
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/user', [AttendanceController::class, 'userIndex']);
    Route::get('/user/show/{user}', [AttendanceController::class, 'userDetail'])->name('attendance.userDetail');
});
