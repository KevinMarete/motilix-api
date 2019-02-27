<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblRefund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_refund', function (Blueprint $table) {
            $table->increments('id');
            $table->date('refund_date');
            $table->text('reason_for_refund');
            $table->integer('payment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['refund_date', 'payment_id', 'user_id']);

            $table->foreign('payment_id')->references('id')->on('tbl_payment')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_refund');
    }
}
