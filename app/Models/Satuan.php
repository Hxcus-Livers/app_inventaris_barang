<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Satuan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'satuans';

    protected $primaryKey = 'id_satuan';

    public $timestamps = false;

    protected $fillable = [
        'satuan'
    ];

    public function pengadaan():HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_satuan');
    }
}
