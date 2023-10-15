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
        Schema::create('lokasi_umkm', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('data_umkm_id');
            $table->foreign('data_umkm_id')->references('id')->on('data_umkm')->cascadeOnDelete();
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lokasi_umkms');
    }
};
