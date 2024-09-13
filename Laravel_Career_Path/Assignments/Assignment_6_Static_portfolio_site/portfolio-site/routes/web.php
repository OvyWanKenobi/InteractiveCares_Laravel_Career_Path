<?php

use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/workexperience', [ExperienceController::class, 'index'])->name('experiences');


Route::get('/projects', [ProjectController::class, 'index'])->name('projects');

Route::get('/projects/{projectName}', [ProjectController::class, 'details'])->name('projects.details');

Route::fallback(function () {
    return redirect()->route('home'); 
});