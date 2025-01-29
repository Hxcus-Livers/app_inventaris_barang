<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasis';

    protected $primaryKey = 'id_lokasi';

    public $timestamps = true;

    protected $fillable = [
        'kode_lokasi',
        'nama_lokasi',
        'keterangan'
    ];

    public function mutasiLokasi(): HasMany
    {
        return $this->hasMany(MutasiLokasi::class, 'id_lokasi');
    }
}
