<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisSampah;
use App\Models\User;
use App\Models\TipeSetoran;
use App\Models\SetoranSampah;
use App\Models\JadwalPengambilan;
use App\Models\Penjualan;
use App\Models\ListSampah;
use Illuminate\Support\Facades\Auth;


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        
        try {
            $informasibank = 0;
            $results = [];
            $query = $request->search;
            if (empty($query)) {
                $query = '%';
            } elseif (is_numeric($query)) {
                $query = intval($query);
            } else {
                $query = "%$query%";
            }
            $page = explode('/', $request->page)[3];
            $page = ucfirst(str_replace('-', ' ', $page));
            $page = str_replace(' ', '', ucwords($page));
            if ($page == 'Pengguna') {
                $page = 'User';
            }
            if ($page == 'InformasiBank') {
                $page = 'SetoranSampah';
                $informasibank = 1;
            }
            if (Auth::check() && Auth::user()->role == 'Nasabah' && $page == 'Penjualan') {
                $page = 'SetoranSampah';
            }

            $modelClass = app("App\Models\\$page");

            $columns = Schema::getColumnListing($modelClass->getTable());
            $columns = array_diff($columns, ['updated_at', 'created_at', 'id']);
            if (Auth::check() && Auth::user()->role == 'Nasabah') {
                $results = $modelClass::where('id_user', Auth::user()->id_user)
                    ->where(function ($q) use ($columns, $query) {
                        foreach ($columns as $column) {
                            $q->orWhereRaw("CONVERT($column, CHAR) LIKE ?", ['%'.$query.'%']);
                        }
                    })->get();
            } else {
                $results = $modelClass::where(function ($q) use ($columns, $query) {
                    foreach ($columns as $column) {
                        $q->orWhereRaw("CONVERT($column, CHAR) LIKE ?", ['%'.$query.'%']);
                    }
                })->get();
            }
            if ($page == 'Penjualan') {
                $penjualanController = new PenjualanController();
                $ids = $results->pluck('id_penjualan')->toArray();
                $results = $penjualanController->extension_search_penjualan($ids);
            }else{
                $penjualanController = new PenjualanController();
                $ids = $results->pluck('id_setoran_sampah')->toArray();
                $results = $penjualanController->extension_search_setoran($ids);
            }

            if ($informasibank == 1) {
                $informasiController = new InformasiBankController();
                $ids = $results->pluck('id_setoran_sampah')->toArray();
                $results = $informasiController->extension_search_informasi($ids);
            }
            return response()->json(['data' => $results], 200); 
        } catch (\Throwable $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }


    }
    
}



