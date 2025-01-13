<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutasiLokasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'mutasi_lokasis';

    protected $primaryKey = 'id_mutasi_lokasi';

    public $timestamps = false;

    protected $fillable = [
        'id_lokasi',
        'id_pengadaan',
        'flag_lokasi',
        'flag_pindah'
    ];

    public function lokasi():BelongsTo
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi');
    }
    public function pengadaan():BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
}
