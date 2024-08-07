<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\breakController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\RegisterUserController;

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
Route::post('/register',[RegisterUserController::class,'store']);

Route::middleware('auth')->group(function(){
Route::get('/', [WorkController::class,'index']);
Route::get('/attendance',[AttendanceController::class,'index']);
});