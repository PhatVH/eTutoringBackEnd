<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Add constraints to tables

        Schema::table('students', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users');
            $table->foreign('tutor_ID')->references('id')->on('tutors');
        });

        Schema::table('tutors', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users');
        });

        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('student_ID')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('tutor_ID')->references('id')->on('tutors')->onDelete('cascade');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('tutor_ID')->references('id')->on('tutors');
            $table->foreign('student_ID')->references('id')->on('students');
        });

        Schema::table('reports', function (Blueprint $table) {
            $table->foreign('student_ID')->references('id')->on('students');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->foreign('student_ID')->references('id')->on('students');
            $table->foreign('tutor_ID')->references('id')->on('tutors');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('student_ID')->references('id')->on('students');
            $table->foreign('tutor_ID')->references('id')->on('tutors');
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('host')->references('id')->on('users');
            $table->foreign('invite')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
