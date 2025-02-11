<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class MasterBarang extends Model
{
    use HasFactory;

    protected $table = 'master_barangs';

    protected $primaryKey = 'id_master_barang';

    public $timestamps = true;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'spesifikasi_teknis'
    ];

    public function pengadaan(): HasMany
    {
        return $this->hasMany(Pengadaan::class, 'id_master_barang');
    }

    public function getTotalQuantityAttribute()
    {
        return $this->pengadaan()->sum('jumlah_barang');
    }

    public function getConditionCounts()
    {
        $counts = [
            'baik' => 0,
            'rusak' => 0,
            'hilang' => 0
        ];

        foreach ($this->pengadaan as $pengadaan) {
            $opnames = Opname::where('id_pengadaan', $pengadaan->id_pengadaan)->get();
            foreach ($opnames as $opname) {
                $counts[strtolower($opname->kondisi)] += $opname->jumlah_barang;
            }
        }

        return $counts;
    }
}
