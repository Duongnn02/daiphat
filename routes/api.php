<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FakeDataController;
use App\Http\Controllers\Api\LoanPackageController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\SupportAppController;
use App\Http\Controllers\InforPayController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('uploadCmnd/{id}', [AuthController::class, 'uploadCmnd']);
    Route::post('change-password', [AuthController::class, 'changePassword']);
    Route::get('get-app', [SupportAppController::class, 'getAppSupport']);
    Route::get('get-infor-pay', [InforPayController::class, 'getInforPay']);

    Route::get('user/{id}', [UserController::class, 'show']);
    Route::post('user-store/{id}', [UserController::class, 'storeInfor']);
    Route::post('user-store-bank/{id}', [UserController::class, 'storeBank']);
    Route::post('upload-additional/{id}', [UserController::class, 'uploadAdditional']);
    Route::post('upload-signature/{id}', [UserController::class, 'uploadSignature']);

    Route::post('messages-store', [MessageController::class, 'store']);
    Route::get('messages-show/{id}', [MessageController::class, 'show']);
    Route::get('messages', [MessageController::class, 'index']);
    Route::delete('messages-delete-all/{id}', [MessageController::class, 'deleteAllMessages']);
    Route::delete('messages-delete/{id}', [MessageController::class, 'delete']);

    Route::get('loan-show', [LoanPackageController::class, 'show']);
    Route::get('handle-withdrawl/{id}', [LoanPackageController::class, 'handleWithdrawl']);
    Route::get('loan-approved', [LoanPackageController::class, 'approved']);
    Route::get('viewed', [LoanPackageController::class, 'viewed']);
    Route::post('loan-store', [LoanPackageController::class, 'store']);
    Route::get('get-money-loan', [LoanPackageController::class, 'getMoneyLoan']);

    Route::post('payment-store', [\App\Http\Controllers\Api\PaymentController::class, 'store']);
    Route::get('get-payment', [\App\Http\Controllers\Api\PaymentController::class, 'getPayment']);
});
Route::post('register', [AuthController::class, 'register']);
Route::get('data-customer', [FakeDataController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::get('get-logo', [AuthController::class, 'getLogo']);

Route::get('getMoneyLoan/{id}', [LoanPackageController::class, 'getMoneyLoan']);
Route::post('forget-password', [AuthController::class, 'forgetPassword']);
