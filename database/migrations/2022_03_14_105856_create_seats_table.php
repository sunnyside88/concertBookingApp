<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->integer('concert_id')->unsigned();
            $table->integer('booking_id')->unsigned();
            $table->foreign('concert_id')->references('id')->on('concert')->onDelete('cascade');
            $table->foreign('booking_id')->references('id')->on('booking');
            $table->boolean('isBooked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
