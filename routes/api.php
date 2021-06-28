<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Agent;
use App\Http\Controllers\VehiclesController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InsuaranceController;
use App\Http\Controllers\CustomerPayment;
use App\Http\Controllers\PayInsuared;
use App\Http\Controllers\VehiclesPayed;
use App\Http\Controllers\insuranceReportOfCustomer;
use App\Http\Controllers\AcidentController;

/*CustomerPayment
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

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
Route::resource('/vehicles', VehiclesController::class);
Route::resource('/customers', CustomerController::class);
Route::resource('/commission', CommissionController::class);
Route::resource('/insuarance', InsuaranceController::class);
Route::resource('/payment', CustomerPayment::class);
Route::resource('/payinsuared', PayInsuared::class);
Route::resource('/vehiclesPayed', VehiclesPayed::class);
Route::resource('/customerReport', insuranceReportOfCustomer::class);
Route::resource('/acident', AcidentController::class);
