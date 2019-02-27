<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblVehicleDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vehicle_device', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('device_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['device_id', 'user_id', 'order_id']);

            $table->foreign('device_id')->references('id')->on('tbl_device')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('tbl_order')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_vehicle_device');
    }
}
