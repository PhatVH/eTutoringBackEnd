<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Message', function (Blueprint $table) {
            $table->increments('message_ID');
            $table->unsignedInteger('tutor_ID');
            $table->unsignedInteger('student_ID');
            $table->string('message_content', 100);
            $table->timestamps('message_date_add');

            $table->foreign('tutor_ID')->references('tutor_ID')->on('Tutor');
            $table->foreign('student_ID')->references('student_ID')->on('Student');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Message');
    }
}
