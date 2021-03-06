<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_address_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unique();
            $table->string('present_house', 100)->nullable();
            $table->string('present_village', 100)->nullable();
            $table->string('present_upazila', 100)->nullable();
            $table->string('present_district', 100)->nullable();
            $table->string('present_division', 100)->nullable();
            $table->string('permanent_house', 100)->nullable();
            $table->string('permanent_village', 100)->nullable();
            $table->string('permanent_upazila', 100)->nullable();
            $table->string('permanent_district', 100)->nullable();
            $table->string('permanent_division', 100)->nullable();
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
        Schema::dropIfExists('user_address_infos');
    }
}
