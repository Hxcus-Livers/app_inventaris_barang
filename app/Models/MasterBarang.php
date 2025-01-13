<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barangs';

    protected $primaryKey = 'id_master_barang';

    public $timestamps = false;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'spesifikasi_teknis'
    ];

    public function pengadaan(): HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_master_barang');
    }
}
