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



//Schedule
Route::get('/subject', 'Schedule\ScheduleController@index')->name('subject-home');
Route::get('/schedule', 'Schedule\ScheduleController@assignShedule')->name('schedule-assign');
Route::get('/schedule/view', 'Schedule\ScheduleController@view')->name('schedule-view');



Route::get('/student/attendance/make', 'StudentAttendanceController@index')->name('student-attendance');


Route::get('/student/attendance/view/day', 'StudentAttendanceController@viewByDay')->name('student-attendance-view-day');
Route::get('/student/attendance/view/month', 'StudentAttendanceController@viewByMonth')->name('student-attendance-view-month');
Route::get('/student/attendance/view/overall', 'StudentAttendanceController@viewByOverall')->name('student-attendance-view-overall');



Route::get('test', 'StudentController@test');

