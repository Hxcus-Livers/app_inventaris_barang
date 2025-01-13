<?php

use App\Models\Depresiasi;
use App\Models\Distributor;
use App\Models\MasterBarang;
use App\Models\Merk;
use App\Models\Satuan;
use App\Models\SubKategoriAsset;
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
        Schema::create('pengadaans', function (Blueprint $table) {
            $table->id('id_pengadaan')->autoIncrement();
            $table->foreignIdFor(MasterBarang::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Depresiasi::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Merk::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Satuan::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(SubKategoriAsset::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignIdFor(Distributor::class)->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('kode_pengadaan', 20);
            $table->string('no_invoice', 20);
            $table->string('no_seri_barang', 50);
            $table->string('tahun_produksi', 5);
            $table->date('tgl_pengadaan');
            $table->integer('harga_barang');
            $table->integer('nilai_barang');
            $table->enum('fb', ['0', '1']);
            $table->string('keterangan', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengadaans');
    }
};
