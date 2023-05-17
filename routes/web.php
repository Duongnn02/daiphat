<?php

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

Route::get('/dashboard', function () {
    return view('content.dashboard');
});
Route::get('/registers', [AuthController::class, 'registers'])->name('auth.register');
Route::post('/handlle-register', [AuthController::class, 'handlleRegister'])->name('auth.handlle-register');
Route::get('user-index',[UserController::class, 'index'])->name('user-index');
