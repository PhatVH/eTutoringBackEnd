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
            $table->foreign('user_ID')->references('id')->on('users')->onDelete('set null');
            $table->foreign('tutor_ID')->references('id')->on('tutors')->onDelete('set null');
        });

        Schema::table('tutors', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('staff', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->foreign('user_ID')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('meetings', function (Blueprint $table) {
            $table->foreign('host_ID')->references('id')->on('users')->onDelete('set null');
            $table->foreign('invite_ID')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('tutor_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('student_user_id')->references('id')->on('users')->onDelete('set null');
        });

        Schema::table('chat_contents', function (Blueprint $table) {
            $table->foreign('chat_ID')->references('id')->on('chats')->onDelete('set null');
            $table->foreign('sender')->references('id')->on('users')->onDelete('set null');
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
