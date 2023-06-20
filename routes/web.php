<?php

use App\Http\Controllers\Api\LoanPackageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InforPayController;
use App\Http\Controllers\LogoController;
use App\Http\Controllers\SupportAppController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {
Route::middleware(['admin'])->group(function () {

    Route::get('logo-index', [LogoController::class, 'index'])->name('logo.index');
    Route::get('logo-create', [LogoController::class, 'create'])->name('logo.create');
    Route::post('logo-store', [LogoController::class, 'store'])->name('logo.store');
    Route::delete('logo/delete/{id}', [LogoController::class, 'destroy'])->name('logo.destroy');
    Route::get('change-status/{id}', [LogoController::class, 'changeStatus'])->name('logo.change-status');

    Route::get('app-index', [SupportAppController::class, 'index'])->name('app.index');
    Route::get('app-create', [SupportAppController::class, 'create'])->name('app.create');
    Route::post('app-store', [SupportAppController::class, 'store'])->name('app.store');
    Route::delete('app/delete/{id}', [SupportAppController::class, 'destroy'])->name('app.destroy');
    Route::get('app/change-status/{id}', [SupportAppController::class, 'changeStatus'])->name('app.change-status');

    Route::get('infor-pay-index', [InforPayController::class, 'index'])->name('infor-pay.index');
    Route::get('infor-pay-create', [InforPayController::class, 'create'])->name('infor-pay.create');
    Route::post('infor-pay-store', [InforPayController::class, 'store'])->name('infor-pay.store');
    Route::delete('infor-pay/delete/{id}', [InforPayController::class, 'destroy'])->name('infor-pay.destroy');


    Route::get('loan-index', [LoanPackageController::class, 'index'])->name('loan.index');
    Route::get('approval/{id}', [LoanPackageController::class, 'approval'])->name('loan.approval');
    Route::get('reject/{id}', [LoanPackageController::class, 'reject'])->name('loan.reject');
    Route::get('approval-withdrawl/{id}', [LoanPackageController::class, 'approvalWithdrawl'])->name('loan.approval-withdrawl');
    Route::get('reject-withdraw/{id}', [LoanPackageController::class, 'rejectWithdrawl'])->name('loan.reject-withdraw');
    Route::get('loan/edit/{id}', [LoanPackageController::class, 'edit'])->name('loan.edit');
    Route::put('loan/update/{id}', [LoanPackageController::class, 'update'])->name('loan.update');
    Route::delete('loan/delete/{id}', [LoanPackageController::class, 'destroy'])->name('loan.destroy');

    Route::resource('user', UserController::class);
    Route::get('change-password', [AuthController::class, 'viewChangePassword'])->name('user.view-change-password');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('user.change-password');
    Route::get('forget-password/{id}', [AuthController::class, 'forgetPassword'])->name('user.forget-password');

    Route::get('/', [HomeController::class, 'index'])->name('dashboard');
});
});
Route::get('read-contract/{id}', [LoanPackageController::class, 'readContract'])->name('read-contract');
Auth::routes();
