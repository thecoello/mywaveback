<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user', [UserController::class,'createUser']);
Route::get('/user/{id}', [UserController::class,'getUser']);


