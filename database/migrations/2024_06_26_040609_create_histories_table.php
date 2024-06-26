<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('harga_id');
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('warna_id');
            $table->unsignedBigInteger('kapasitas_mesin_id');
            $table->timestamps();
            $table->foreign('harga_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('warna_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('kapasitas_mesin_id')->references('id')->on('capacities')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('histories');
    }
};
