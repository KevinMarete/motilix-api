<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_device', function (Blueprint $table) {
            $table->increments('id');
            $table->string('model');
            $table->string('input');
            $table->string('serial_number');
            $table->boolean('is_available')->default(true);
            $table->integer('brand_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['serial_number']);
            $table->unique(['brand_id', 'model', 'input', 'serial_number']);

            $table->foreign('brand_id')->references('id')->on('tbl_brand')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_device');
    }
}
