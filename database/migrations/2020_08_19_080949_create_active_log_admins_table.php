<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActiveLogAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('active_log_admins', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('action_admin_id');
            $table->bigInteger('action_user_id')->nullable();
            $table->string('user_type',50)->nullable();
            $table->string('action_details');
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
        Schema::dropIfExists('active_log_admins');
    }
}
