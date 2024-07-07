<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TipeSetoran;

class SetoranSampah extends Model
{
    use HasFactory;
    protected $table = 'setoran_sampahs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_setoran_sampah',
        'id_tipe_setoran',
        'id_user',
        'nama',
        'nomor',
        'status',
        'tanggal',
        'total_harga',
    ];
    public function setoran_sampah(){
        return $this->belongsTo(TipeSetoran::class, 'id_tipe_setoran', 'id_tipe_setoran');
    }
}
