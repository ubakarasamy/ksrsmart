<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academics', function (Blueprint $table) {
            $table->increments('id');
            $table->date('year_start');
            $table->date('year_end')->nullable();
            $table->date('semester_start');
            $table->date('semester_end')->nullable();
            $table->integer('staff_cl');
            $table->integer('staff_od');
            $table->integer('staff_permission');
            $table->integer('staff_lateregister');
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
        Schema::dropIfExists('academics');
    }
}
