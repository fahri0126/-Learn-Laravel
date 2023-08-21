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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            // $table->foreignId('user_id')->constrained('users');
            $table->foreignId('kategori_id')->constrained('kategoris');
            // $table->foreignId('pesan_id')->constrained('pesans');
            $table->foreignId('unit_id')->constrained('units');
            $table->integer('berat')->nullable();
            $table->integer('harga')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
};
