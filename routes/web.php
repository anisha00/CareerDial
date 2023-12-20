<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', function () {
    if (Auth::check()) {
        return Auth::user()->is_admin ? redirect('AdminDashboard') : redirect('UserDashboard');
    }
    return view('Auth.loginPage');})->name('login');



    // Your admin routes here
    Route::get('/AdminDashboard',   function () { return view('AdminDashboard');})->name('AdminDashboard');


    // Your admin routes here
    Route::get('/UserDashboard',  function () { return view('UserDashboard');})->name('UserDashBoard');



Route::post('login',[UserController::class,'show'])->name('login');
Route::get('/register',[UserController::class,'index'])->name('register');
Route::post('register',[UserController::class,'store'])->name('register');
Route::get('/logout', [UserController::class,'destroy'])->name('logout');
Route::get('/verify/{token}', [VerificationController::class,'verify'])->name('verification.verify');
