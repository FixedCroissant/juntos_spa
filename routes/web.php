<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

//Get Controllers.
//State
use App\Http\Controllers\Admin\StateController;
//County
use App\Http\Controllers\Admin\CountyController;
//Site
use App\Http\Controllers\Admin\SiteController;
//Users
use App\Http\Controllers\Admin\UserController;
//Students
use App\Http\Controllers\StudentController;
//Parents
use App\Http\Controllers\ParentsController;
//Events
use App\Http\Controllers\EventController;
//Coaching Appointments
use App\Http\Controllers\CoachingAppointmentController;
//Class Schedules
use App\Http\Controllers\ClassScheduleController;
//Reporting
use App\Http\Controllers\ReportingController;
//Student Notes
use App\Http\Controllers\StudentNotesController;


Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	//Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

//Students
//Specific route for event attendance for a student.
Route::post('/students/attendance',['as'=>'students.addeventattendance','uses'=>'App\Http\Controllers\StudentController@addEventAttendance']);

Route::resource('students',StudentController::class);
//Adjust parents so that it expects a parameter of our student.
//Route::get('/parents/create/{id}',['as'=>'parents.create','uses'=>'ParentsController@create']);
//Parents
Route::resource('parents',ParentsController::class);
//Student Notes
Route::resource('studentnotes',StudentNotesController::class)->except('show','index','show');

//Event
Route::resource('event',EventController::class);

//See all coaching appointments based on student.
Route::get('/coaching/{studentID}',['as'=>'coaching.seestudentallappointments','uses'=>'App\Http\Controllers\CoachingAppointmentController@seeAllStudentsAppointments']);

//Coaching Appointment
Route::resource('coaching',CoachingAppointmentController::class);
//Class Schedule
Route::resource('schedule',ClassScheduleController::class);
//Reporting Controller
Route::resource('reporting',ReportingController::class);


});

//Admin  Routes
//.name
Route::name('admin.')->group(function(){
Route::get('/admin/index','App\Http\Controllers\Admin\AdminController@index')->name('backend.index');
//Roles
Route::get('/admin/roles/index','App\Http\Controllers\Admin\AdminController@roleIndex')->name('backend.rolesindex');
//States
//Route::get('/admin/state/index','App\Http\Controllers\Admin\AdminController@statesIndex')->name('admin.backend.statesindex');
//Use Resource.
//Not show route.
Route::resource('/admin/states', StateController::class)->except(['show']);
//Counties
Route::resource('/admin/counties', CountyController::class)->except(['show']);
//Sites
Route::resource('/admin/sites', SiteController::class)->except(['show']);
//Users
Route::resource('/admin/users', UserController::class)->except(['show']);

//Misc Actions.//name is admin.settings.index
Route::get('/admin/settings/index',['uses'=>'App\Http\Controllers\Admin\AdminController@settingsList'])->name('settings.index');


//ToDo- Add Coordinator Assignment


//End Admin Routes
});
