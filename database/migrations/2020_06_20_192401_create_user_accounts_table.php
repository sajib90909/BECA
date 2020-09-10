<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone', 190)->unique();
            $table->string('password');
            $table->bigInteger('member_type')->nullable();
            $table->string('status',100)->default('not_check');//approve,banned,deactivated
            $table->bigInteger('approved_by')->nullable();
            $table->integer('check_doc')->default(1); //1- need document verification
            $table->integer('check_payment')->default(0); //1- confirm-payment
            $table->integer('check')->default(0); //1- submit all form
            $table->rememberToken();
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
        Schema::dropIfExists('user_accounts');
    }
}
