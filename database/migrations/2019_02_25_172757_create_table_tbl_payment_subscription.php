<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblPaymentSubscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_payment_subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->double('membership_fee', 8, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('payment_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['payment_id', 'start_date', 'end_date', 'membership_fee']);

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
        Schema::dropIfExists('tbl_payment_subscription');
    }
}
