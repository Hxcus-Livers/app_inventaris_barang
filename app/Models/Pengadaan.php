<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pengadaan extends Model
{
    use HasFactory;

    protected $table = 'pengadaans';
    
    protected $primaryKey = 'id_pengadaan';

    public $timestamps = true;

    protected $fillable = [
        'id_master_barang',
        'id_depresiasi',
        'id_merk',
        'id_satuan',
        'id_sub_kategori_asset',
        'id_distributor',
        'kode_pengadaan',
        'no_invoice',
        'no_seri_barang',
        'tahun_produksi',
        'tgl_pengadaan',
        'harga_barang',
        'nilai_barang',
        'depresiasi_barang',
        'fb',
        'keterangan',
    ];    

    public function masterBarang():BelongsTo
    {
        return $this->belongsTo(MasterBarang::class, 'id_master_barang');
    }
    public function depresiasi():BelongsTo
    {
        return $this->belongsTo(Depresiasi::class, 'id_depresiasi');
    }
    public function merk():BelongsTo
    {
        return $this->belongsTo(Merk::class, 'id_merk');
    }
    public function satuan():BelongsTo
    {
        return $this->belongsTo(Satuan::class, 'id_satuan');
    }
    public function subKategoriAsset():BelongsTo
    {
        return $this->belongsTo(SubKategoriAsset::class, 'id_sub_kategori_asset');
    }
    public function distributor():BelongsTo
    {
        return $this->belongsTo(Distributor::class, 'id_distributor');
    }
    public function opnames(): HasMany
    {
        return $this->hasMany(Opname::class, 'id_pengadaan');
    }
    public function mutasiLokasi(): HasMany
    {
        return $this->hasMany(MutasiLokasi::class, foreignKey: 'id_pengadaan');
    }
    public function hitungDepresiasi(): HasMany
    {
        return $this->hasMany(HitungDepresiasi::class, 'id_pengadaan');
    }
}
