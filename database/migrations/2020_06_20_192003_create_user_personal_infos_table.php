<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPersonalInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_personal_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unique();
            $table->string('name', 100);
            $table->string('spouse_name', 100)->nullable();
            $table->string('father_name', 100)->nullable();
            $table->string('mother_name', 100)->nullable();
            $table->string('gender', 100)->nullable();
            $table->string('blood', 100)->nullable();
            $table->string('height', 100)->nullable();
            $table->string('religion', 100)->nullable();
            $table->date('birth_date')->nullable();
            $table->bigInteger('nid_pass')->nullable();
            $table->string('driving_lic', 100)->nullable();
            $table->string('profile_image')->nullable();
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
        Schema::dropIfExists('user_personal_infos');
    }
}
