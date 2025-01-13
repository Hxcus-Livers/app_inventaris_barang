<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;


class Merk extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'merks';

    protected $primaryKey = 'id_merk';

    public $timestamps = false;

    protected $fillable = [
        'lama_depresiasi',
        'keterangan'
    ];

    public function pengadaan(): HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_merk');
    }
}
