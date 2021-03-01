<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\PostController;
use App\Http\Controllers\API\AuthController;
use App\Models\User;

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




Route::post('/register',[App\Http\Controllers\API\AuthController::class,'register']);
Route::post('/login',[App\Http\Controllers\API\AuthController::class,'login']);
Route::post('/logout',[App\Http\Controllers\API\AuthController::class,'logout']);

Route::apiResource('/students',App\Http\Controllers\API\StudentController::class)->middleware('auth:api');
Route::apiResource('/parents',App\Http\Controllers\API\ParentsController::class)->middleware('auth:api');
Route::apiResource('/events',App\Http\Controllers\API\EventController::class)->middleware('auth:api');
