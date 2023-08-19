<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_hotels', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hotel');
            $table->longText('alamat_hotel');
            $table->string('foto_hotel');
            $table->double('harga_hotel');
            $table->foreignId('lokasi_id')->references('id')->on('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_hotels');
    }
};
