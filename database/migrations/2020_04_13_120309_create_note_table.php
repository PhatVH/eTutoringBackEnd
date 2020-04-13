<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Note', function (Blueprint $table) {
            $table->increments('note_ID');
            $table->unsignedInteger('student_ID');
            $table->unsignedInteger('tutor_ID');
            $table->string('note_content', 100);
            $table->timestamps('note_date_add');

            $table->foreign('student_ID')->references('student_ID')->on('Student');
            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Note');
    }
}
