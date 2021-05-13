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
//Academic Year
use App\Http\Controllers\AcademicYearController;
//Reporting
use App\Http\Controllers\ReportingController;
//Student Notes
use App\Http\Controllers\StudentNotesController;
use App\Http\Controllers\VolunteerController;


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
Route::post('/students/attendance/complete',['as'=>'students.completeAttendance','uses'=>'App\Http\Controllers\StudentController@addEventAttendanceComplete']);
Route::get('/students/attendance/remove/{eventID}/{studentID}',['as'=>'students.removeAttendance','uses'=>'App\Http\Controllers\StudentController@removeEventAttendanceComplete']);


Route::resource('students',StudentController::class);
//Adjust parents so that it expects a parameter of our student.
//Route::get('/parents/create/{id}',['as'=>'parents.create','uses'=>'ParentsController@create']);
//Parents
Route::post('/parents/attendance',['as'=>'parents.addeventattendance','uses'=>'App\Http\Controllers\ParentsController@addEventAttendance']);
Route::post('/parents/attendance/complete',['as'=>'parents.completeAttendance','uses'=>'App\Http\Controllers\ParentsController@addEventAttendanceComplete']);
Route::get('/parents/attendance/remove/{eventID}/{studentID}',['as'=>'parents.removeAttendance','uses'=>'App\Http\Controllers\ParentsController@removeEventAttendanceComplete']);


Route::resource('parents',ParentsController::class);
//Student Notes
Route::resource('studentnotes',StudentNotesController::class)->except('show','index','show');
//Specific route for event attendance for a volunteer.
Route::post('/volunteer/attendance',['as'=>'volunteer.addeventattendance','uses'=>'App\Http\Controllers\VolunteerController@addEventAttendance']);

Route::resource('volunteer',VolunteerController::class)->except('show');

//Event
Route::resource('event',EventController::class);

//Coaching Appointment
Route::resource('coaching',CoachingAppointmentController::class);
Route::get('coaching/{id}/follow_up',['as'=>'coaching.create.follow_up','uses'=>'App\Http\Controllers\CoachingAppointmentController@createFollowUp']);
Route::get('coaching/{id}/follow_up/edit',['as'=>'coaching.edit.follow_up','uses'=>'App\Http\Controllers\CoachingAppointmentController@editFollowUp']);
Route::post('coaching/{id}/follow_up',['as'=>'coaching.create.follow_up_complete','uses'=>'App\Http\Controllers\CoachingAppointmentController@followUpComplete']);
Route::post('coaching/{id}/follow_up/update',['as'=>'coaching.update.follow_up_complete','uses'=>'App\Http\Controllers\CoachingAppointmentController@followUpUpdated']);
//See all coaching appointments based on student.
Route::get('/coaching/{studentID}',['as'=>'coaching.seestudentallappointments','uses'=>'App\Http\Controllers\CoachingAppointmentController@seeAllStudentsAppointments']);
//Class Schedule
Route::resource('schedule',ClassScheduleController::class);
Route::resource('acad_year',AcademicYearController::class);

//Reporting Controller
Route::resource('reporting',ReportingController::class)->only(['index','show']);


});

//Admin  Routes
//.name
Route::name('admin.')->group(function(){
Route::get('/admin/index','App\Http\Controllers\Admin\AdminController@index')->name('backend.index');
//Roles
Route::get('/admin/roles/index','App\Http\Controllers\Admin\AdminController@roleIndex')->name('backend.rolesindex');
Route::resource('/admin/states', StateController::class)->except(['show']);
//Counties
Route::resource('/admin/counties', CountyController::class)->except(['show']);
//Sites
Route::resource('/admin/sites', SiteController::class)->except(['show']);
//Users
Route::resource('/admin/users', UserController::class)->except(['show']);

//Misc Actions.//name is admin.settings.index
Route::get('/admin/settings/index',['uses'=>'App\Http\Controllers\Admin\AdminController@settingsList'])->name('settings.index');
//Remember admin previx.
Route::get('/admin/settings/coordinator_assignment',['uses'=>'App\Http\Controllers\Admin\AdminController@settingsCoordinatorAssignment','as'=>'settings.coordinator.assign']);

Route::post('/admin/settings/coordinator_assignment/user',['uses'=>'App\Http\Controllers\Admin\AdminController@assignedUser','as'=>'settings.coordinator.assign.confirm']);

Route::get('/admin/settings/coordinator_assignment/user/index',['uses'=>'App\Http\Controllers\Admin\AdminController@assignmentIndex','as'=>'settings.coordinator.assign.list']);

Route::delete('/admin/settings/coordinator_assignment/user/delete/{userID}/{id}',array('uses' => 'App\Http\Controllers\Admin\AdminController@removeAccess', 'as' => 'settings.coordinator.removeaccess'));



//ToDo- Add Coordinator Assignment


//End Admin Routes
});
