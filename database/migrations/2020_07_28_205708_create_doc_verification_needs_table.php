<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocVerificationNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_verification_needs', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id');
            $table->tinyInteger('user_nid_pass_doc')->default(0);
            $table->tinyInteger('user_cadet_certificate_doc')->default(0);
            $table->tinyInteger('user_beca_doc')->default(0);
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
        Schema::dropIfExists('doc_verification_needs');
    }
}
