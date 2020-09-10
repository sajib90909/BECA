<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unite_name')->unique();
            $table->text('description')->nullable();
            $table->bigInteger('edited_by')->nullable();
            $table->tinyInteger('publish')->default(1); //1- publish, 0- unpublish, 2- trash
            $table->timestamps();
        });
        DB::table('unites')->insert(
            array(
                'unite_name' => 'Dhaka',
                'description' => 'Default made unit by system',
                'edited_by' => 1,

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
        Schema::dropIfExists('unites');
    }
}
