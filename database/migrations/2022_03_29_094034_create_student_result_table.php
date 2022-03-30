<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_result', function (Blueprint $table) {
            $table->id('result_id');
            $table->string('course');
            $table->float('mark');
            $table->string('student_id');
            $table->foreign('student_id')->references('student_id')->on('student_info');
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
        Schema::dropIfExists('student_result');
    }
};
