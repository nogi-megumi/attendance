<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/register', [RegisterUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/', [WorkController::class, 'index']);
    Route::post('/', [WorkController::class, 'store']);
    Route::put('/work/update', [WorkController::class, 'update']);
    Route::post('/break', [BreakController::class, 'store']);
    Route::put('/break/update', [BreakController::class, 'update']);
    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::get('/user', [AttendanceController::class, 'userIndex']);
    Route::get('/user/show/{user}', [AttendanceController::class, 'userDetail'])->name('attendance.userDetail');
});
