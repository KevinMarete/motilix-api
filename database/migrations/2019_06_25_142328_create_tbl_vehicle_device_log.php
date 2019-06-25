<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblVehicleDeviceLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_vehicle_device_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->dateTime('transaction_time')->useCurrent();
            $table->integer('vehicle_device_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['status', 'transaction_time', 'vehicle_device_id', 'user_id']);

            $table->foreign('vehicle_device_id')->references('id')->on('tbl_vehicle_device')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('tbl_user')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_vehicle_device_log');
    }
}
