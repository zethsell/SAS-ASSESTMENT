<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookStoreController;

#No auth routes
Route::post('sign-in', [AuthController::class, 'signIn'])->name('api.signIn');
Route::post('sign-up', [AuthController::class, 'signUp'])->name('api.signUp');
Route::post('sign-out', [AuthController::class, 'signOut'])->name('api.signOut');

#auth routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'books' => BookStoreController::class,
    ]);
});
