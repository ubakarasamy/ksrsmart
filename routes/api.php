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

Route::get('test', 'StudentController@test');


Route::get('students', 'StudentController@showAll');
Route::post('student/store', 'StudentController@store');
Route::put('student/update', 'StudentController@update');

Route::get('staffs', 'StaffController@showAll');
Route::post('staff/store', 'StaffController@store');
Route::put('staff/update', 'StaffController@update');


Route::get('schedule/subject/show', 'Schedule\SubjectController@show');
Route::post('schedule/subject/store', 'Schedule\SubjectController@store');


Route::get('schedule/show', 'Schedule\ScheduleController@showAllSchedules');
Route::post('schedule/store', 'Schedule\ScheduleController@store');

// Store Date And Hour for overall count
Route::post('student/attendance/dateandhour', 'StudentAttendanceController@storeDateandHourFirst');

Route::post('student/attendance/hour', 'StudentAttendanceController@setStudentStatusEveryHour');

Route::post('student/attendance/hour/all', 'StudentAttendanceController@setStudentStatusEveryHourAll');

Route::post('student/attendance/view/bydate', 'StudentAttendanceController@StudentStatusByDate');

Route::post('student/attendance/view/byday', 'StudentAttendanceController@StudentStatusDay');

Route::post('student/attendance/view/byoverall', 'StudentAttendanceController@StudentStatusOverall');

Route::post('student/attendance/view/bysubject', 'StudentAttendanceController@StudentStatusSubject');


Route::post('staff/attendance/date', 'StaffAttendanceController@storeDate');
Route::post('staff/attendance/individual', 'StaffAttendanceController@makeStaffAt');
Route::post('staff/attendance/allat', 'StaffAttendanceController@makeAllStaffAt');
Route::post('staff/attendance/getdate', 'StaffAttendanceController@getAllatbydate');

Route::post('staff/attendance/withdates', 'StaffAttendanceController@getAttendancesbydates');

Route::get('staffs/attendances', 'StaffAttendanceController@AllAts');

Route::post('staff/profile/update', 'StaffController@ProfileUpdate');

Route::post('staff/approval/create', 'StaffApprovalController@store');

Route::post('staff/approval/getmyapprovals', 'StaffApprovalController@getMyApprovals');

Route::get('staff/approval/getallapprovals', 'StaffApprovalController@getAllApprovals');

Route::delete('staff/approval/removemyapprovals', 'StaffApprovalController@destroy');

Route::put('staff/approval/getmyapprovals', 'StaffApprovalController@updateApproval');