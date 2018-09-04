<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendanceRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendance_records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('schedule_id');
            $table->date('date');
            $table->integer('student_attendance_id')->unsigned();
            $table->foreign('student_attendance_id')->references('id')->on('student_attendances')->onDelete('cascade');
            $table->boolean('present')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attendance_records');
    }
}
