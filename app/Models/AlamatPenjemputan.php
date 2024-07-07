<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SetoranSampah;

class AlamatPenjemputan extends Model
{
    use HasFactory;
    protected $table = 'alamat_penjemputans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_alamat_penjemputan',
        'id_jadwal_pengambilan',
        'id_setoran_sampah',
        'nama',
        'alamat',
    ];
    public function setoran_sampah(){
        return $this->belongsTo(SetoranSampah::class, 'id_setoran_sampah', 'id_setoran_sampah');
    }
    
    public function jadwal_pengambilan(){
        return $this->belongsTo(SetoranSampah::class, 'id_jadwal_pengambilan', 'id_jadwal_pengambilan');
    }
}
