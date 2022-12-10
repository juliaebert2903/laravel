<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentDisciplineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_discipline', function (Blueprint $table) {
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('discipline_id')->unsigned();

            $table->primary(['student_id', 'discipline_id']);

            $table->foreign('student_id')->references('id')->on('student');
            $table->foreign('discipline_id')->references('id')->on('discipline');

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
        Schema::dropIfExists('student_discipline');
    }
}
