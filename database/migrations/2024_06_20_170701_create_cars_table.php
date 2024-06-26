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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('image_url')->nullable();
            $table->unsignedBigInteger('harga_id');
            $table->unsignedBigInteger('seat_id');
            $table->unsignedBigInteger('warna_id');
            $table->unsignedBigInteger('kapasitas_mesin_id');
            $table->timestamps();

            $table->foreign('harga_id')->references('id')->on('prices')->onDelete('cascade');
            $table->foreign('warna_id')->references('id')->on('colors')->onDelete('cascade');
            $table->foreign('kapasitas_mesin_id')->references('id')->on('capacities')->onDelete('cascade');
            $table->foreign('seat_id')->references('id')->on('seats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
