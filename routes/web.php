<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodDonationController;
use App\Http\Controllers\FoodRequestController;
use App\Http\Controllers\FoodCategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // CRUD Food Donation
    Route::resource('donations', FoodDonationController::class);

    // CRUD Food Request
    Route::resource('requests', FoodRequestController::class);

    // CRUD Food Category
    Route::resource('categories', FoodCategoryController::class);
    
    //CRUD User
    Route::resource('users', UserController::class);
});

require __DIR__.'/auth.php';