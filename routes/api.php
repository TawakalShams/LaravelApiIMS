<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Agent;
use App\Http\Controllers\InsuaranceController;
use App\Http\Controllers\CustomerPayment;
use App\Http\Controllers\PayInsuared;
use App\Http\Controllers\AcidentVerificationController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ViewAllUsers;
// use App\Http\Controllers\ChangePassword;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function ($router) {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::resource('/agents', Agent::class);
Route::resource('/insuarance', InsuaranceController::class);
Route::resource('/payment', CustomerPayment::class);
Route::resource('/payinsuared', PayInsuared::class);
Route::resource('/accident', AcidentVerificationController::class);
Route::resource('/changePassword', ChangePassword::class);

Route::resource('/users', ViewAllUsers::class);
// Route::resource('/customerReport', insuranceReportOfCustomer::class);
