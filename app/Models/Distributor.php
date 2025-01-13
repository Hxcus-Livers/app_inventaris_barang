<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Distributor extends Model
{
    use HasFactory;

    protected $table = 'distributors';

    protected $primaryKey = 'id_distributor';

    public $timestamps = false;

    protected $fillable = [
        'nama_distributor',
        'alamat',
        'no_telp',
        'email',
        'keterangan'
    ];

    public function pengadaan():HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_distributor');
    }
}
