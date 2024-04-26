<?php

use App\Http\Controllers\auth\LoginController;
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


Route::resource('/login', \App\Http\Controllers\auth\LoginController::class);
Route::resource('/register', \App\Http\Controllers\auth\RegisterController::class);
Route::group(['middleware' => ['isLoggedin']], function () {
    Route::resource('/', \App\Http\Controllers\HomeController::class);
});
