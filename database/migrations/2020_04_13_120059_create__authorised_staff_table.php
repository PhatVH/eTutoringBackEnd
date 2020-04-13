<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorisedStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AuthorisedStaff', function (Blueprint $table) {
            $table->increments('authorisedStaff_ID');
            $table->string('authorisedStaff_name', 100);
            $table->string('authorisedStaff_email', 100);
            $table->string('authorisedStaff_phone', 20);
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
        Schema::dropIfExists('AuthorisedStaff');
    }
}
