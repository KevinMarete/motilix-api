<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblOrderLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_order_log', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status');
            $table->dateTime('transaction_time')->useCurrent();
            $table->integer('order_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['status', 'transaction_time', 'order_id', 'user_id']);

            $table->foreign('order_id')->references('id')->on('tbl_order')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('tbl_order_log');
    }
}
