<?php

use App\Http\Controllers\AditionalPointsController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::post('/user', [UserController::class,'createUser']);
Route::get('/users', [UserController::class,'getAllUsers']);
Route::get('/user/{id}', [UserController::class,'getUser']);
Route::put('/user/{id}', [UserController::class,'updateUser']);
Route::delete('/user/{id}', [UserController::class,'deleteUser']);

Route::post('/contract', [ContractController::class,'createContract']);
Route::get('/contracts/{id}', [ContractController::class,'getAllContracts']);
Route::get('/contract/{id}', [ContractController::class,'getContract']);
Route::put('/contract/{id}', [ContractController::class,'updateContract']);
Route::delete('/contract/{id}', [ContractController::class,'deleteContract']);
Route::get('/getallpoints', [ContractController::class,'getAllPoints']);
Route::get('/getallpointsregion/{region}', [ContractController::class,'getAllPointsRegion']);
Route::get('/getpoints/{id}', [ContractController::class,'getPoints']);

Route::post('/point', [AditionalPointsController::class,'createAditionalPoints']);
Route::get('/points/{id}', [AditionalPointsController::class,'getAllAditionalPoints']);
Route::get('/point/{id}', [AditionalPointsController::class,'getAditionalPoints']);
Route::put('/point/{id}', [AditionalPointsController::class,'updateAditionalPoints']);
Route::delete('/point/{id}', [AditionalPointsController::class,'deleteAditionalPoints']);
