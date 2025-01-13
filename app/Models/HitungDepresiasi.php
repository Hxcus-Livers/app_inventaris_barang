<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class HitungDepresiasi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hitung_depresiasis';

    protected $primaryKey = 'id_hitung_depresiasi';

    public $timestamps = false;

    protected $fillable = [
        'id_pengadaan',
        'tgl_hitung_depresiasi',
        'bulan',
        'durasi',
        'nilai_barang'
    ];

    public function pengadaan():BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
}
