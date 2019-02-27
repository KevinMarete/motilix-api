<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblPaymentInstallation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment_installation', function (Blueprint $table) {
            $table->increments('id');
            $table->double('initial_fee', 8, 2);
            $table->integer('payment_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['payment_id', 'order_id', 'initial_fee']);

            $table->foreign('payment_id')->references('id')->on('tbl_payment')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_payment_installation');
    }
}
