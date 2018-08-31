<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentShedduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_sheddule', function (Blueprint $table) {
            $table->increments('id');
            $table->string('degree');
            $table->string('department');
            $table->string('year');
            $table->integer('semester');
            $table->string('section');
            $table->string('day');
            $table->string('subject_name');
            $table->string('subject_id');
            $table->string('subject_overall'); 
            $table->string('subject_staff');
            $table->string('academic_semester'); //we can find the current semester
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
        Schema::dropIfExists('student_sheddule');
    }
}
