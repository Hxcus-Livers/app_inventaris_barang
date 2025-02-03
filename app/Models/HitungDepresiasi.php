<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HitungDepresiasi extends Model
{
    use HasFactory;

    protected $table = 'hitung_depresiasis';

    protected $primaryKey = 'id_hitung_depresiasi';

    public $timestamps = true;

    protected $fillable = [
        'id_pengadaan',
        'tgl_hitung_depresiasi',
        'bulan',
        'durasi',
        'nilai_barang',
        'last_edited_at',
        'created_by',
        'edited_count',
        'last_edited_by',
    ];

    public function pengadaan():BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_edited_by');
    }

}
