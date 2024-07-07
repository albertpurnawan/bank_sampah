<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ListSampah;
use App\Models\User;

class Penjualan extends Model
{
    use HasFactory;
    protected $table = 'penjualans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_penjualan',
        'id_user',
        'final_harga',
        'tanggal',
        'status'
    ];
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}

