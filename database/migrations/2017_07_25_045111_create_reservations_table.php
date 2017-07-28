<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('status');
            $table->integer('room_id')->unsigned();
            $table->string('target');
            $table->integer('target_id');
            $table->text('request')->nullable();
            $table->tinyInteger('quantity');
            $table->datetime('checkin_date');
            $table->datetime('checkout_date');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('room_id')->references('id')->on('rooms')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
