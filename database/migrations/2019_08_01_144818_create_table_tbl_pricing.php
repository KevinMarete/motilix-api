<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblPricing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pricing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->double('installation_cost', 8, 2);
            $table->double('subscription_cost', 8, 2);
            $table->double('total_cost', 8, 2);
            $table->integer('payment_after_months')->unsigned();
            $table->json('features');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_pricing');
    }
}
