<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/privacy-policy', [App\Http\Controllers\API\PrivacyPolicyController::class,'show']);
Route::get('/users', [App\Http\Controllers\API\UserController::class,'index']);
Route::post('/users/create', [App\Http\Controllers\API\UserController::class,'store']);
Route::delete('/users/{user}', [App\Http\Controllers\API\UserController::class,'delete']);

Route::get('/inventory', [App\Http\Controllers\API\InventoryController::class,'index']);
Route::post('/inventory/create', [App\Http\Controllers\API\InventoryController::class,'store']);