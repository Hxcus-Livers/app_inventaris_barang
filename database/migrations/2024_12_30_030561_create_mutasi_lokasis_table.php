<?php

use App\Models\Lokasi;
use App\Models\Pengadaan;
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
        Schema::create('mutasi_lokasis', function (Blueprint $table) {
            $table->id('id_mutasi_lokasi')->autoIncrement();
            $table->foreignIdFor(Lokasi::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Pengadaan::class)->constrained()->onDelete('cascade');
            $table->string('flag_lokasi', 45);
            $table->string('flag_pindah', 45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_lokasis');
    }
};
