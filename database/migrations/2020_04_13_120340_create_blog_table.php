<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Blog', function (Blueprint $table) {
            $table->increments('blog_ID');
            $table->unsignedInteger('student_ID');
            $table->unsignedInteger('tutor_ID');
            $table->string('blog_title', 1000);
            $table->string('blog_image', 1000);
            $table->timestamps('date_add');

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
        Schema::dropIfExists('Blog');
    }
}
