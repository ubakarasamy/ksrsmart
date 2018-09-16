<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('staff_id');
            $table->string('approval_for');
            $table->string('status');
            $table->integer('approved_by');
            $table->date('year_start');
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
        Schema::dropIfExists('staff_approvals');
    }
}
