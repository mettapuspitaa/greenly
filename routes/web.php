<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmissionController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {return view('auth.signup');});
Route::get('/login', function () {return view('auth.login');});
Route::get('/dashboard', function () {return view('user.dashboard');});
Route::get('/carboncalc', function () {return view('user.calculate');});

Route::post('/loginin', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/admin-dashboard', [EmissionController::class, 'index'])->name('emission.index'); 
Route::post('/emission', [EmissionController::class, 'store'])->name('emission.store'); 
Route::get('/emission/{emission}/edit', [EmissionController::class, 'edit'])->name('emission.edit'); 
Route::put('/emission/{emission}', [EmissionController::class, 'update'])->name('emission.update');
Route::delete('/emission/{emission}', [EmissionController::class, 'destroy'])->name('emission.destroy'); 

Route::get('/profile', function () {return view('admin.profile');})->name('profile');
Route::get('/uprofile', function () {return view('user.user-profile');})->name('userprofile');
Route::post('/profile/update', [AuthController::class, 'updateProfile'])->name('profile.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/emission-all-categories', [EmissionController::class, 'fetchAllCategories'])->name('emission.allCategories');

Route::get('/history', [HistoryController::class, 'index']);