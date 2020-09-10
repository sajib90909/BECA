<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name', 100)->unique();
            $table->string('payment_amount');
            $table->text('details')->nullable();
            $table->string('time_duration');
            $table->integer('publish')->default(1); //1- publish, 0- unpublish, 2- trash
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
        Schema::dropIfExists('member_types');
    }
}
