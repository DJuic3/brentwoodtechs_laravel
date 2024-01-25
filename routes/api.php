<?php

namespace App\Http\Middleware;


use App\Http\Controllers\MobileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\PasswordController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [MobileController::class, 'register']);
Route::post('/login', [MobileController::class, 'login']);
Route::get('/mobileusers', [UserController::class, 'getUsers']);
Route::post('/password/reset', [PasswordController::class, 'sendPasswordResetLink']);
Route::middleware(['cors', 'auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/add-user-data', [UserController::class, 'addUserData']);
    Route::get('/get-user-data', [UserController::class, 'getUserData']);
    Route::get('user-details', [UserController::class, 'getUserDetails']);
    Route::get('/personalitems', [MobileController::class, 'personalitems']);
});
Route::get('/finance/create', [MobileController::class, 'create']);
Route::post('/finance/store', [MobileController::class, 'store'])->name('finance.store');

Route::get('/finance/index', [MobileController::class, 'financeindex'])->name('finance.index');