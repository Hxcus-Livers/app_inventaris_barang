<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class KategoriAsset extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori_assets';

    protected $primaryKey = 'id_kategori_asset';

    public $timestamps = false;

    protected $fillable = [
        'kode_kategori_asset',
        'kategori_asset'
    ];

    public function subKategoriAsset():HasMany
    {
        return $this->hasMany(SubKategoriAsset::class, 'id_kategori_asset');
    }
}
