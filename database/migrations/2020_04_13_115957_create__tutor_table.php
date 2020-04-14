<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tutor', function (Blueprint $table) {
            $table->increments('tutor_ID');
            $table->string('tutor_name', 100);
            $table->string('tutor_phone', 20);
            $table->string('tutor_email', 100);
            $table->unsignedInteger('student_ID')->nullable();
            $table->unsignedInteger('document_ID')->nullable();
            $table->timestamps();

            $table->foreign('student_ID')->references('student_ID')->on('Student');
            $table->foreign('document_ID')->references('document_ID')->on('Document')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Tutor');
    }
}
