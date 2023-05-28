<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FakeDataController;
use App\Http\Controllers\Api\LoanPackageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
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
Route::post('register', [AuthController::class, 'register']);
Route::get('data-customer', [FakeDataController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);

Route::get('getMoneyLoan/{id}', [LoanPackageController::class, 'getMoneyLoan']);
Route::group(['middleware' => ['auth:api']], function () {
    Route::post('uploadCmnd/{id}', [AuthController::class, 'uploadCmnd']);
    Route::post('loan-store', [LoanPackageController::class, 'store']);
    Route::get('user/{id}', [UserController::class, 'show']);
    Route::get('loan/{id}', [LoanPackageController::class, 'show']);
    Route::post('messages', [MessageController::class, 'store']);
    Route::get('messages/{id}', [MessageController::class, 'index']);
    Route::get('messages/show/{id}', [MessageController::class, 'show']);
    Route::get('get-money-loan/{id}', [LoanPackageController::class, 'getMoneyLoan']);

});
