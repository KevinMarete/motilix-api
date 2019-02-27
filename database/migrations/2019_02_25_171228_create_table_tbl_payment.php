<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('transaction_time')->useCurrent();
            $table->integer('card_id')->unsigned();
            $table->integer('device_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['transaction_time', 'card_id', 'device_id']);

            $table->foreign('card_id')->references('id')->on('tbl_card')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('device_id')->references('id')->on('tbl_device')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_payment');
    }
}
