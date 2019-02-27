<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order', function (Blueprint $table) {
            $table->increments('id');
            $table->date('year_of_manufacture');
            $table->string('number_plate');
            $table->string('physical_address');
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->integer('vehicle_model_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['number_plate', 'user_id', 'model_id']);

            $table->foreign('user_id')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('vehicle_model_id')->references('id')->on('tbl_vehicle_model')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_order');
    }
}
