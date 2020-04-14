<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConstraint extends Migration
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
            $table->foreign('tutor_ID')->references('id')->on('tutors');
        });

        // Schema::table('Tutor', function (Blueprint $table) {
        //     $table->foreign('document_ID')->references('document_ID')->on('Document')->onDelete('cascade');
        // });

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
