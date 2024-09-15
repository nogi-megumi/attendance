<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\BreakController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\AuthenticatedSessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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
// メール認証のルート
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('/profile', function () {
})->middleware('verified');

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
