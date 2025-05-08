<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OnboardingController;
use App\Http\Controllers\PinController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('auth')->group(function(){
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);

    Route::middleware('auth:sanctum')->group(function() {
        Route::get('user',[AuthController::class,'user']);
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function() {
    Route::post('setup/pin', [PinController::class,'setupPin']);
    Route::post('validate/pin', [PinController::class,'validatePin']);
    Route::post('generate/account-number',[AccountController::class,'store']);

});
