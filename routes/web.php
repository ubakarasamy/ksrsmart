<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

//home and pages
Route::get('/', 'HomeController@index')->name('home');

//Students
Route::get('/students', 'StudentController@index')->name('students');
Route::get('/student/create', 'StudentController@create')->name('student.create');

//Students
Route::get('/staffs', 'StaffController@index')->name('staffs');
Route::get('/staff/create', 'StaffController@create')->name('staff.create');



//Schedule
Route::get('/subject', 'Schedule\ScheduleController@index')->name('subject-home');
Route::get('/schedule', 'Schedule\ScheduleController@assignShedule')->name('schedule-assign');
Route::get('/schedule/view', 'Schedule\ScheduleController@view')->name('schedule-view');


//student
Route::get('/student/attendance/make', 'StudentAttendanceController@index')->name('student-attendance');
Route::get('/student/attendance/edit', 'StudentAttendanceController@EditAt')->name('student-attendance-edit');

Route::get('/student/attendance/view/day', 'StudentAttendanceController@viewByDay')->name('student-attendance-view-day');
Route::get('/student/attendance/view/month', 'StudentAttendanceController@viewByMonth')->name('student-attendance-view-month');
Route::get('/student/attendance/view/overall', 'StudentAttendanceController@viewByOverall')->name('student-attendance-view-overall');
Route::get('/student/attendance/view/subject', 'StudentAttendanceController@viewBySubject')->name('student-attendance-view-subject');

//staff
Route::get('/staff/attendance/make', 'StaffAttendanceController@index')->name('staff-attendance');
Route::get('/staff/attendance/edit', 'StaffAttendanceController@EditAt')->name('staff-attendance-edit');

Route::get('/staff/attendance/view/day', 'StaffAttendanceController@viewByDay')->name('staff-attendance-view-day');
Route::get('/staff/attendance/view/month', 'StaffAttendanceController@viewByMonth')->name('staff-attendance-view-month');
Route::get('/staff/attendance/view/overall', 'StaffAttendanceController@viewByOverall')->name('staff-attendance-view-overall');


Route::get('/staff/profile', 'StaffController@MyProfile')->name('my-profile');


Route::get('/staff/approval/main', 'StaffApprovalController@main')->name('staff-approvals');

Route::get('/staff/approval', 'StaffApprovalController@show')->name('my-approvals');


Route::get('test', 'StudentController@test');

