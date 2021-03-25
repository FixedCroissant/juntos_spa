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

//Google OAuth
Route::get('/googleRedirect',[App\Http\Controllers\API\AuthController::class,'googleRedirect']);
//Call back
Route::get('/google/callback',[App\Http\Controllers\API\AuthController::class,'googleCallback']);
//End Google OAuth


//Temporarily remove middleware.
Route::apiResource('/students',App\Http\Controllers\API\StudentController::class);
//Temporarily remove middleware.
Route::apiResource('/parents',App\Http\Controllers\API\ParentsController::class);
Route::apiResource('/events',App\Http\Controllers\API\EventController::class);
//Create a temporary route to add and remove event attendance for students.
Route::post('/events/attendance/{id}',[App\Http\Controllers\API\EventController::class,'addAttendance']);
Route::post('/events/attendance/{id}/remove',[App\Http\Controllers\API\EventController::class,'removeAttendance']);

//Coach Appointments
Route::get('/coachAppointment/index',[App\Http\Controllers\API\CoachAppointmentController::class,'index']);
Route::get('/coachAppointment/create',[App\Http\Controllers\API\CoachAppointmentController::class,'create']);
Route::post('/coachAppointment/store',[App\Http\Controllers\API\CoachAppointmentController::class,'store']);
Route::get('/coachAppointment/{id}/edit',[App\Http\Controllers\API\CoachAppointmentController::class,'edit']);
//To-Do UPDATE
Route::post('/coachAppointment/{id}/update',[App\Http\Controllers\API\CoachAppointmentController::class,'update']);
//To-Do DELETE

//Schedules/class.
//Get all schedules for a specific student instead of typically just displaying everything that exists.
Route::get('/schedule/index/{id}',[App\Http\Controllers\API\ScheduleController::class,'index']);
//Save new schedule/class.
Route::post('/schedule/store',[App\Http\Controllers\API\ScheduleController::class,'store']);
//Delete a new class.
Route::delete('/schedule/class/{id}/remove',[App\Http\Controllers\API\ScheduleController::class,'destroy']);
//Update a specific class.
Route::post('/schedule/class/{id}/update',[App\Http\Controllers\API\ScheduleController::class,'update']);





//ADMIN AREA
//TEMPORARILY NO MIDDLEWARE ON THESE ROUTES.
Route::get('/admin/users',[App\Http\Controllers\API\AdminController::class,'users']);
//Get information on our individual user.
Route::get('/admin/user/{id}/edit/',[App\Http\Controllers\API\AdminController::class,'edit']);
//Update Role for User.
Route::post('/admin/user/{id}/role',[App\Http\Controllers\API\AdminController::class,'role']);
//Get All Roles in the System.
Route::get('/admin/user/roles/index',[App\Http\Controllers\API\AdminController::class,'getRoles']);
//END ADMIN AREA