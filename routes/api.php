<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('signIn', [AuthController::class, 'login'])->name('api.signIn');
Route::post('signUp', [AuthController::class, 'signUp'])->name('api.signUp');
