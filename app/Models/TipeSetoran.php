<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipeSetoran extends Model
{
    use HasFactory;

    protected $table = 'tipe_setorans';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_tipe_setoran',
        'tipe',
        'potongan_per_transaksi'
    ];
}
