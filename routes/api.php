<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('sign-in', [AuthController::class, 'signIn'])->name('api.signIn');
Route::post('sign-up', [AuthController::class, 'signUp'])->name('api.signUp');
