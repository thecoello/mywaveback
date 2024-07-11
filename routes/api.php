<?php

use App\Http\Controllers\AditionalPointsController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\AuthenticateUserId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/user', [UserController::class, 'createUser']);

Route::post('/login', [LoginController::class, 'login']);

Route::get('/getallpoints', [ContractController::class, 'getAllPoints']);
Route::get('/getallpointsregion/{region}', [ContractController::class, 'getAllPointsRegion']);
Route::get('/getpoints/{id}', [ContractController::class, 'getPoints']);

Route::middleware(['auth:sanctum', AuthenticateUserId::class])->group(function () {
  Route::get('/users', [UserController::class, 'getAllUsers'])->middleware(AdminMiddleware::class); 
  Route::get('/adminusers', [UserController::class, 'getAllAdminUsers'])->middleware(AdminMiddleware::class); 
  Route::get('/user/{id}', [UserController::class, 'getUser']);
  Route::put('/user/{id}', [UserController::class, 'updateUser']);
  Route::delete('/user/{id}', [UserController::class, 'deleteUser']);
  Route::get('/logout', [LoginController::class, 'logout']);


  Route::post('/contract', [ContractController::class, 'createContract']);
  Route::get('/contracts/{id}', [ContractController::class, 'getAllContracts']);
  Route::get('/contract/{id}', [ContractController::class, 'getContract']);
  Route::delete('/contract/{id}', [ContractController::class, 'deleteContract']);

  Route::post('/point', [AditionalPointsController::class, 'createAditionalPoints'])->middleware(AdminMiddleware::class);
  Route::get('/points/{id}', [AditionalPointsController::class, 'getAllAditionalPoints']);
  Route::delete('/point/{id}', [AditionalPointsController::class, 'deleteAditionalPoints'])->middleware(AdminMiddleware::class);
});
