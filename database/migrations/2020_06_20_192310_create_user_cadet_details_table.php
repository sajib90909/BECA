<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCadetDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cadet_details', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unique();
            $table->string('institute_name', 100)->nullable();
            $table->string('institute_address')->nullable();
            $table->bigInteger('cadet_id')->nullable();
            $table->string('regiment', 100)->nullable();
            $table->string('cadet_rank', 100)->nullable();
            $table->string('cadet_wing', 100)->nullable();
            $table->string('cadet_ship_year',100)->nullable();
            $table->integer('check')->default(0);
            $table->bigInteger('edited_by')->nullable();
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
        Schema::dropIfExists('user_cadet_details');
    }
}
