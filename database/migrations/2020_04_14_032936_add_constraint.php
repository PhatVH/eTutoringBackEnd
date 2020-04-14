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

        Schema::table('Student', function (Blueprint $table) {
            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor');
        });

        // Schema::table('Tutor', function (Blueprint $table) {
        //     $table->foreign('document_ID')->references('document_ID')->on('Document')->onDelete('cascade');
        // });

        Schema::table('Document', function (Blueprint $table) {
            $table->foreign('student_ID')->references('student_ID')->on('Student')->onDelete('cascade');
            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor')->onDelete('cascade');
        });

        Schema::table('Message', function (Blueprint $table) {
            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor');
            $table->foreign('student_ID')->references('student_ID')->on('Student');
        });

        Schema::table('Report', function (Blueprint $table) {
            $table->foreign('student_ID')->references('student_ID')->on('Student');
        });

        Schema::table('Note', function (Blueprint $table) {
            $table->foreign('student_ID')->references('student_ID')->on('Student');
            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor');
        });

        Schema::table('Blog', function (Blueprint $table) {
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
        //
    }
}
