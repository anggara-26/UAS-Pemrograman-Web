<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;

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
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/pricing', function () {
    return view('pricing');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::post('/register-user', [CustomAuthController::class, 'registerUser'])->name('register-user');

Route::post('/login-user', [CustomAuthController::class, 'loginUser'])->name('login-user');

Route::get('/dashboard', [CustomAuthController::class, 'dashboard'])->middleware('isLoggedIn')->name('dashboard');

Route::post('/logout', [CustomAuthController::class, 'logout'])->name('logout');