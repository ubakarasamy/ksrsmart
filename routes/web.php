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
Route::get('/subject', 'Schedule\ScheduleController@index')->name('schedule-home');

Route::get('/schedule', 'Schedule\ScheduleController@assignShedule')->name('schedule-assign');






Route::get('test', 'StudentController@test');