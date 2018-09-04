<?php

use Illuminate\Http\Request;

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

Route::get('students', 'StudentController@showAll');
Route::post('student/store', 'StudentController@store');
Route::put('student/update', 'StudentController@update');


Route::get('schedule/subject/show', 'Schedule\SubjectController@show');
Route::post('schedule/subject/store', 'Schedule\SubjectController@store');


Route::get('schedule/show', 'Schedule\ScheduleController@showAllSchedules');
Route::post('schedule/store', 'Schedule\ScheduleController@store');

Route::post('student/attendance/store', 'StudentAttendanceController@store');

Route::post('student/attendance/setstatus', 'StudentAttendanceController@setStatus');


Route::post('student/attendance/view/bydate', 'StudentAttendanceController@ViewJsonByDate');