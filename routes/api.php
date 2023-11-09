<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResources;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


// ------------------- public endPoints ----------------------

Route::post('/login',           [AuthController::class, 'login']);
Route::post('/register',        [AuthController::class, 'register']);

//for testing purposes
Route::get('/users', function () {

    return UserResources::collection(User::all());
});
Route::get('/user/{id}', function ($id) {
    return new UserResources(User::findOrFail($id));
});

// ------------------- authenticated endPoints ----------------------
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/user', function (Request $request) {

        return new UserResources(Auth::user());
    });
});
