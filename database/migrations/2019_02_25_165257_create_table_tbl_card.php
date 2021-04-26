<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblCard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_card', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_on_card');
            $table->string('card_number');
            $table->string('expiry_period');
            $table->string('gateway_token')->nullable();
            $table->date('subscription_date');
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name_on_card', 'card_number', 'user_id']);

            $table->foreign('user_id')->references('id')->on('tbl_vehicle_model')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_card');
    }
}
