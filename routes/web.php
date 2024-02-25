<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CodesController;
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

Route::get('/', function () {
    return view('auth.loginPage');
});

Route::get('login',[AuthController::class,'loginView'])->name('login');
Route::get('signUp',[AuthController::class,'registerView'])->name('signUp');

Route::post('session',[AuthController::class,'login'])->name('session');
Route::post('register',[AuthController::class,'registerUser'])->name('register');


Route::middleware(['auth'])->group(function () {
    Route::get('codigo',[CodesController::class,'verificarCodigoView'])->name('codigo');
    Route::post('confirmCode',[CodesController::class,'validarCodigo'])->name('confirmCode');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware(['validarCode'])->group(function () {
    Route::get('dashboard',[AuthController::class,'dashboardView'])->name('dashboard');
});
