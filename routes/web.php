<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodDonationController;
use App\Http\Controllers\FoodRequestController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {

    // ======================
    // PROFILE (ALL ROLES)
    // ======================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ======================
    // USER FEATURES
    // ======================
    Route::middleware('role:user')->group(function () {
        Route::resource('donations', FoodDonationController::class);
        Route::resource('requests', FoodRequestController::class);
    });

    // ======================
    // ADMIN FEATURES
    // ======================
    Route::middleware('role:admin')->group(function () {
        Route::resource('donations', FoodDonationController::class);
        Route::resource('requests', FoodRequestController::class);
        Route::resource('categories', FoodCategoryController::class);
        Route::resource('users', UserController::class);
    });
});


require __DIR__.'/auth.php';
