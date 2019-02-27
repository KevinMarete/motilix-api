<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblInvoice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->date('payment_date');
            $table->integer('payment_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['payment_date', 'payment_id']);

            $table->foreign('payment_id')->references('id')->on('tbl_payment')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_invoice');
    }
}
