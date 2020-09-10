<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuponCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupon_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code')->unique();
            $table->integer('member_type');
            $table->integer('status')->default(0); //1- used by members, 0-unused
            $table->bigInteger('user_id')->nullable();
            $table->integer('receive_cash')->default(0);
            $table->integer('publish')->default(1); //1- publish, 0- unpublish, 2- trash
            $table->string('user_phone')->nullable();
            $table->bigInteger('edited_by')->nullable();
            $table->date('use_date')->nullable();
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
        Schema::dropIfExists('cupon_codes');
    }
}
