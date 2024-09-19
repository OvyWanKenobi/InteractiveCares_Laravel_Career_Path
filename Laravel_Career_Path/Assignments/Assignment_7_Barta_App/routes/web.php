<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
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




Route::view('/login', view: 'guest.login')->name('login')->middleware('guest');
Route::view('/register', view: 'guest.register')->name('register')->middleware('guest');
Route::post('/login', [GuestController::class, 'loginSubmit'])->middleware('guest')->name('login-submit');
Route::post('/register', [GuestController::class, 'registerSubmit'])->middleware('guest')->name('register-submit');


Route::get('/', [UserController::class, 'index'])->middleware('auth')->name('home');
Route::get('/profile', [UserController::class, 'profile'])->middleware('auth')->name('profile');
Route::get('/edit-profile', [UserController::class, 'editProfile'])->middleware('auth')->name('edit-profile');
Route::post('/edit-profile', [UserController::class, 'editProfileSubmit'])->middleware('auth')->name('edit-profile-submit');


Route::get('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect(route('login'));
})->middleware('auth')->name('logout');
