<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTblService extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_service', function (Blueprint $table) {
            $table->increments('id');

            $table->date('maintenance_date');
            $table->jsonb('checks');
            $table->double('amount', 8, 2);
            $table->integer('valuation')->unsigned();
            $table->integer('rating')->unsigned();
            $table->string('device');
            $table->integer('centre_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['maintenance_date', 'checks', 'amount', 'valuation', 'rating', 'device', 'centre_id']);

            $table->foreign('device')->references('serial_number')->on('tbl_device')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('centre_id')->references('id')->on('tbl_centre')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_service');
    }
}
