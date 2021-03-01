<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

//SPA Controller for working with the API route file.
Route::get('/{any}', [App\Http\Controllers\VueController::class,'index'])->where('any', '^(?!api).*$');

Auth::routes();