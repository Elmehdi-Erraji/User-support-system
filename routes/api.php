<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});




Route::post('register', [\App\Http\Controllers\Auth\AuthController::class, 'register']);


Route::post('/login', [\App\Http\Controllers\Auth\AuthController::class, 'login']);




Route::middleware('auth:sanctum')->group(function(){

    Route::get('user' , [App\Http\Controllers\Auth\AuthController::class , 'user']);

    Route::post ('logout' , [App\Http\Controllers\Auth\AuthController::class , 'logout']);

});



















