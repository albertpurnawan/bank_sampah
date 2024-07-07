<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Keuangan extends Model
{
    use HasFactory;
    protected $table = 'keuangans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_keuangan',
        'id_user',
        'nama_lengkap_rekening',
        'tipe_penarikan',
        'nomor_rekening',
        'nomor',
        'bank',
        'saldo',
        'status',
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
