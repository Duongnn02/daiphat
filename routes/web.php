<?php

use App\Http\Controllers\Api\LoanPackageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/registers', [AuthController::class, 'registers'])->name('auth.register');
    Route::post('/handlle-register', [AuthController::class, 'handlleRegister'])->name('auth.handlle-register');
    Route::get('loan-index', [LoanPackageController::class, 'index'])->name('loan.index');
    Route::get('approval/{id}', [LoanPackageController::class, 'approval'])->name('loan.approval');
    Route::get('reject/{id}', [LoanPackageController::class, 'reject'])->name('loan.reject');
    Route::get('loan/edit/{id}', [LoanPackageController::class, 'edit'])->name('loan.edit');
    Route::put('loan/update/{id}', [LoanPackageController::class, 'update'])->name('loan.update');
    Route::delete('loan/delete/{id}', [LoanPackageController::class, 'destroy'])->name('loan.destroy');
    Route::resource('user', UserController::class);

    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});
});
Auth::routes();
