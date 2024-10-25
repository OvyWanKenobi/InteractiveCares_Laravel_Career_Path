<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\File;
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


Route::middleware(['guest'])->group(function () {

    Route::view('/login', view: 'guest.login')->name('login');
    Route::view('/register', view: 'guest.register')->name('register');
    Route::post('/login', [GuestController::class, 'loginSubmit'])->name('login-submit');
    Route::post('/register', [GuestController::class, 'registerSubmit'])->name('register-submit');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
    Route::get('/profile/{user:username}', [UserController::class, 'profile'])->name('profile');
    Route::get('/edit-profile', [UserController::class, 'editProfile'])->name('edit-profile');
    Route::put('/edit-profile', [UserController::class, 'editProfileSubmit'])->name('edit-profile-submit');

    Route::resource('posts', PostController::class);

    Route::resource('comments', CommentController::class);

    Route::get('/search', [PostController::class, 'search'])->name('search');

    Route::get('/get-local-photo/{filePath}', [UserController::class, 'getLocalPhoto'])->where('filePath', '.*')->name('get-local-photo');



    Route::get('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect(route('login'));
    })->name('logout');
});
