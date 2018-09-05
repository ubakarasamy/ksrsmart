<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentDateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_date_attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('student_id');
            $table->integer('total_hours')->default(0);
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
        Schema::dropIfExists('student_date_attendances');
    }
}
