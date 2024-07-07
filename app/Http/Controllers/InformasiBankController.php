<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SetoranSampah;
use App\Models\ListSampah;
use App\Models\JenisSampah;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class InformasiBankController extends Controller
{
    public function index()
    {
        $data = SetoranSampah::leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
        ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
        ->leftJoin('users', 'users.id_user', '=', 'setoran_sampahs.id_user')
        ->select(
            'setoran_sampahs.id',
            'setoran_sampahs.id_setoran_sampah',
            'setoran_sampahs.id_user',
            'users.nama',
            'setoran_sampahs.status',
            'setoran_sampahs.tanggal',
            'setoran_sampahs.created_at',
            'setoran_sampahs.updated_at',
            DB::raw("SUM(list_sampahs.qty) as qty"),
            DB::raw("SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga")
        )
        ->groupBy(
            'setoran_sampahs.id',
            'setoran_sampahs.id_setoran_sampah',
            'setoran_sampahs.id_user',
            'users.nama',
            'setoran_sampahs.status',
            'setoran_sampahs.tanggal',
            'setoran_sampahs.created_at',
            'setoran_sampahs.updated_at'
        )
        ->get();
        

        $total_transaksi = count($data);
        $total_sampah = $data->sum('qty');
        return view('InformasiBank.informasi-bank', compact('data', 'total_sampah', 'total_transaksi'));
    }

    public function extension_search_informasi($ids){
        $data = SetoranSampah::whereIn('setoran_sampahs.id_setoran_sampah', $ids)
        ->leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
        ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
        ->leftJoin('users', 'users.id_user', '=', 'setoran_sampahs.id_user')
        ->select(
            'setoran_sampahs.id',
            'setoran_sampahs.id_setoran_sampah',
            'setoran_sampahs.id_user',
            'users.nama',
            'setoran_sampahs.status',
            'setoran_sampahs.tanggal',
            'setoran_sampahs.created_at',
            'setoran_sampahs.updated_at',
            DB::raw("SUM(list_sampahs.qty) as qty"),
            DB::raw("SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga")
        )
        ->groupBy(
            'setoran_sampahs.id',
            'setoran_sampahs.id_setoran_sampah',
            'setoran_sampahs.id_user',
            'users.nama',
            'setoran_sampahs.status',
            'setoran_sampahs.tanggal',
            'setoran_sampahs.created_at',
            'setoran_sampahs.updated_at'
        )
        ->get();
        return $data;
    }
}
