<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AlamatPenjemputan;

class JadwalPengambilan extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'jadwal_pengambilans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_jadwal_pengambilan',
        'id_user',
        'nama_driver',
        'nomor',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
