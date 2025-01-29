<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubKategoriAsset extends Model
{
    use HasFactory;

    protected $table = 'sub_kategori_assets';

    protected $primaryKey = 'id_sub_kategori_asset';
    public $timestamps = true;
    protected $fillable = [
        'id_kategori_asset',
        'kode_sub_kategori_asset',
        'sub_kategori_asset'
    ];

    public function kategoriAsset():BelongsTo
    {
        return $this->belongsTo(KategoriAsset::class, 'id_kategori_asset');
    }

    public function pengadaan():HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_sub_kategori_asset');
    }
}
