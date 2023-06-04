<?php

use App\Http\Controllers\Api\LoanPackageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoController;

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


    Route::get('loan-index', [LoanPackageController::class, 'index'])->name('loan.index');
    Route::get('approval/{id}', [LoanPackageController::class, 'approval'])->name('loan.approval');
    Route::get('reject/{id}', [LoanPackageController::class, 'reject'])->name('loan.reject');
    Route::get('loan/edit/{id}', [LoanPackageController::class, 'edit'])->name('loan.edit');
    Route::put('loan/update/{id}', [LoanPackageController::class, 'update'])->name('loan.update');
    Route::delete('loan/delete/{id}', [LoanPackageController::class, 'destroy'])->name('loan.destroy');

    Route::resource('user', UserController::class);
    Route::get('change-password', [AuthController::class, 'viewChangePassword'])->name('user.view-change-password');
    Route::post('change-password', [AuthController::class, 'changePassword'])->name('user.change-password');

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
});
});
Auth::routes();
