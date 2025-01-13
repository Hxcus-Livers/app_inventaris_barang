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
        Schema::create('kategori_assets', function (Blueprint $table) {
            $table->id('id_kategori_asset')->autoIncrement();
            $table->string('kode_kategori_asset', 20);
            $table->string('kategori_asset', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategori_assets');
    }
};
