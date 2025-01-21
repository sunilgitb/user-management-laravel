<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;


Route::post('/register', [UserController::class, 'register']); 
Route::post('/login', [UserController::class, 'login']);       


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user(); 
    });

    
    Route::get('users', [UserController::class, 'index']);          
    Route::post('users', [UserController::class, 'store']);         
    Route::get('users/{id}', [UserController::class, 'show']);      
    Route::put('users/{id}', [UserController::class, 'update']);    
    Route::delete('users/{id}', [UserController::class, 'destroy']); 

    Route::post('/logout', [UserController::class, 'logout']); 
});
