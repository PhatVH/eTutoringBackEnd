<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('student_ID')->unique();
            $table->unsignedBigInteger('user_ID');
            $table->string('student_name', 100);
            $table->string('student_email', 20);
            $table->string('student_phone', 100);
            $table->unsignedBigInteger('tutor_ID')->nullable();
            $table->dateTime('lastLoggedIn')->nullable();
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
        Schema::dropIfExists('students');
    }
}
