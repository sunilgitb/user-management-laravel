<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('dashboard/users', [UserController::class, 'index'])->name('users.index'); // Get all users
Route::post('users', [UserController::class, 'store'])->name('users.store'); // Create a new user

Route::get('users/create', [UserController::class, 'create'])->name('users.create');
Route::get('users/{id}', [UserController::class, 'show'])->name('users.show');

Route::put('users/{id}', [UserController::class, 'update'])->name('users.edit'); // Update a specific user
Route::delete('users/{id}', [UserController::class, 'destroy'])->name('users.destroy'); // Delete a specific user

require __DIR__.'/auth.php';
