<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Merk extends Model
{
    use HasFactory;

    protected $table = 'merks';

    protected $primaryKey = 'id_merk';

    public $timestamps = true;

    protected $fillable = [
        'merk',
        'keterangan'
    ];

    public function pengadaan(): HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_merk');
    }
}
