<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Depresiasi extends Model
{
    use HasFactory;

    protected $table = 'depresiasis';

    protected $primaryKey = 'id_depresiasi';

    public $timestamps = false;

    protected $fillable = [
        'lama_depresiasi',
        'keterangan'
    ];

    public function pengadaan(): HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_depresiasi');
    }
}
