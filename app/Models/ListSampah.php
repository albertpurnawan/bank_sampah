<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SetoranSampah;
use App\Models\Penjualan;


class ListSampah extends Model
{
    use HasFactory;
    protected $table = 'list_sampahs';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_list_sampah',
        'id_setoran_sampah',
        'id_penjualan',
        'id_jenis_sampah',
        'qty'
    ];
    public function list_sampah(){
        return $this->belongsTo(SetoranSampah::class, 'id_setoran_sampah', 'id_setoran_sampah');
    }
    public function penjualan(){
        return $this->belongsTo(Penjualan::class, 'id_penjualan', 'id_penjualan');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_jenis_sampah', 'id_jenis_sampah');
    }
}
