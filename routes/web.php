<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/profile/create', [App\Http\Controllers\ProfileController::class, 'create'])->name('profile.create');
Route::post('/profile/store', [App\Http\Controllers\ProfileController::class, 'store'])->name('profile.store');
Route::put('/profile/update/{id}', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
