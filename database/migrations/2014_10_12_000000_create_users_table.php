<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->unique();
            $table->string('name')->nullable();
            $table->string('user_type'); //super_admin, unit_admin, author
            $table->string('unite_id');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('edited_by')->nullable();
            $table->string('beca_reg_id')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('check')->default('0'); // 0- unsubmitted-image, 1-submitted-image
            $table->string('password');
            $table->tinyInteger('status')->default('1'); //1- active, 0- deactivated, 2- suspended
            $table->rememberToken();
            $table->timestamps();
        });
        DB::table('users')->insert(
            array(
                'user_name' => 'beca12345',
                'name' => 'Beca Authorities',
                'unite_id' => 1,
                'user_type' => 'author',
                'email' => 'sajib2717@gmail.com',
                'phone' => '01771335956',
                'check' => 1,
                'password' => Hash::make('123456789'),

            )

        );
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
