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

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('student_ID')->references('id')->on('students');
            $table->foreign('tutor_ID')->references('id')->on('tutors');
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('host_ID')->references('id')->on('users');
            $table->foreign('invite_ID')->references('id')->on('users');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('tutor_user_id')->references('id')->on('users');
            $table->foreign('student_user_id')->references('id')->on('users');
        });

        Schema::table('chat_contents', function (Blueprint $table) {
            $table->foreign('chat_ID')->references('id')->on('chats');
            $table->foreign('sender')->references('id')->on('users');
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
