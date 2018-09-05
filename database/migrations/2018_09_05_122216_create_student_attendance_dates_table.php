<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendanceDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendance_dates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('degree');
            $table->string('department');
            $table->string('year');
            $table->string('semester');
            $table->string('section');
            $table->date('date');
            $table->integer('total_hours');
            $table->date('semester_start');
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
        Schema::dropIfExists('student_attendance_dates');
    }
}
