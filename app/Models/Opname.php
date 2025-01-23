<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Opname extends Model
{
    use HasFactory;

    protected $table = 'opnames';

    protected $primaryKey = 'id_opname';

    public $timestamps = false;

    protected $fillable = [
        'id_pengadaan',
        'tgl_opname',
        'kondisi',
        'keterangan'
    ];

    public function pengadaan():BelongsTo
    {
        return $this->belongsTo(Pengadaan::class, 'id_pengadaan');
    }
}
