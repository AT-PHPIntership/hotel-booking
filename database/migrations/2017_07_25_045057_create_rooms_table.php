<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('hotel_id')->unsigned();
            $table->text('descript')->nullable();
            $table->float('price');
            $table->string('size')->nullable();
            $table->integer('total');
            $table->string('bed')->nullable();
            $table->text('direction')->nullable();
            $table->integer('max_guest');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('hotel_id')->references('id')->on('hotels')
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
        Schema::dropIfExists('rooms');
    }
}
