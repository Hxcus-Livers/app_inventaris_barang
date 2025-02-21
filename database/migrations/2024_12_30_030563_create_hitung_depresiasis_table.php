<?php

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
        Schema::create('hitung_depresiasis', function (Blueprint $table) {
            $table->id('id_hitung_depresiasi')->autoIncrement();
            $table->foreignIdFor(Pengadaan::class, 'id_pengadaan')->constrained()->onDelete('cascade');
            $table->date('tgl_hitung_depresiasi');
            $table->string('bulan', 10);
            $table->integer('durasi');
            $table->integer('nilai_barang');
            $table->unsignedInteger('edited_count')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('last_edited_at')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('last_edited_by')->nullable();
            $table->foreign('last_edited_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hitung_depresiasis');
    }
};
