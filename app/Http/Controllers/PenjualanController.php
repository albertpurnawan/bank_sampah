<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\SetoranSampah;
use App\Models\AlamatPenjemputan;
use App\Models\User;
use App\Models\ListSampah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class PenjualanController extends Controller
{
    public function index()
    {
    //     $data = Penjualan::select('jadwal_pengambilans.*', DB::raw("
    //     (SELECT GROUP_CONCAT(alamat_penjemputans.alamat SEPARATOR ', ') 
    //      FROM alamat_penjemputans 
    //      WHERE alamat_penjemputans.id_jadwal_pengambilan = jadwal_pengambilans.id_jadwal_pengambilan
    //      ORDER BY alamat_penjemputans.id_alamat_penjemputan) as alamat_penjemputan
    // "))
    // ->leftJoin('alamat_penjemputans', 'alamat_penjemputans.id_jadwal_pengambilan', '=', 'jadwal_pengambilans.id_jadwal_pengambilan')
    // ->groupBy('jadwal_pengambilans.id_jadwal_pengambilan', 'jadwal_pengambilans.id')
    // ->get();
        $data = [];
        if ( Auth::user()->role == 'Nasabah') {


            $data = SetoranSampah::where('status', 'Pesanan Selesai')
            ->where('id_user', Auth::user()->id_user)
            ->leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
            ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->select(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
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
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at'
            )
            ->get();
        
        }else{
            $data = DB::table('penjualans')
            ->join('list_sampahs', 'penjualans.id_penjualan', '=', 'list_sampahs.id_penjualan')
            ->select('penjualans.id','penjualans.id_penjualan', 'penjualans.tanggal', 'penjualans.final_harga', 'penjualans.status', DB::raw('SUM(list_sampahs.qty) as qty'))
            ->groupBy('penjualans.id','penjualans.id_penjualan', 'penjualans.tanggal', 'penjualans.final_harga', 'penjualans.status')
            ->get();
        }
        $total_transaksi = count($data);
        $total_sampah = $data->sum('qty');
        return view('penjualan.penjualan', compact('data', 'total_sampah', 'total_transaksi'));
    }

    public function create()
{
        $list_setoran = ListSampah::select(
            'list_sampahs.id_setoran_sampah',
            DB::raw('SUM(list_sampahs.qty) as qty'),
            DB::raw('SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga')
        )
        ->join('setoran_sampahs', 'setoran_sampahs.id_setoran_sampah', '=', 'list_sampahs.id_setoran_sampah')
        ->join('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
        ->where('setoran_sampahs.status', '=', 'Pesanan Selesai')
        ->whereNull('list_sampahs.id_penjualan')
        ->groupBy('list_sampahs.id_setoran_sampah')
        ->orderBy('list_sampahs.id_setoran_sampah', 'asc')
        ->get();
        $user = User::all();
        return view('penjualan.tambah-penjualan', compact('list_setoran', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'final_harga' => 'integer',
            'tanggal' => 'date',
        ]);

        if ($validator->fails()) {
            return redirect()->route('penjualan.tambah-insert')
                             ->withErrors($validator)
                             ->withInput();
        }
        if ($request->id_penjualan) {
            $penjualan = Penjualan::where('id_penjualan', $request->id_penjualan)->first();
            $penjualan->update([
                'final_harga' => $request->input('final_harga'),
                'tanggal' => $request->input('tanggal')
            ]);
            if ($request->input('penjualan')){
                foreach ($request->input('penjualan') as $key => $value) {
                    DB::table('list_sampahs')
                    ->where('id_setoran_sampah', $request->penjualan[$key])
                    ->update(['id_penjualan' => $request->id_penjualan]);
                }
            }
        }else{
            $config = ['table'=>'penjualans', 'field'=>'id_penjualan','length'=>9, 'prefix'=>'PJLN-'];
            $id = IdGenerator::generate($config);
            
            $penjualan = Penjualan::create([
                'id_penjualan' => $id,
                'id_user' => Auth::user()->id_user,
                'final_harga' => $request->input('final_harga'),
                'tanggal' => $request->input('tanggal'),
                'status' => 'Belum Terjual',
            ]);

            if ($request->input('penjualan')){
                foreach ($request->input('penjualan') as $key => $value) {
                    DB::table('list_sampahs')
                    ->where('id_setoran_sampah', $request->penjualan[$key])
                    ->update(['id_penjualan' => $id]);
                }
            }
        }

        return redirect()->route('penjualan')->with('success', 'Penjualan created successfully');
    }

    public function edit($id)
    {
        $data =  Penjualan::find($id);
        $user = User::where('role', 'Admin')->get();
        $selected_list_setoran = ListSampah::select(
            'list_sampahs.id_setoran_sampah',
                DB::raw('SUM(list_sampahs.qty) as qty'),
                DB::raw('SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga')
            )
            ->join('setoran_sampahs', 'setoran_sampahs.id_setoran_sampah', '=', 'list_sampahs.id_setoran_sampah')
            ->join('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->where('setoran_sampahs.status', '=', 'Pesanan Selesai')
            ->where('id_penjualan', $data->id_penjualan)
            ->groupBy('list_sampahs.id_setoran_sampah')
            ->orderBy('list_sampahs.id_setoran_sampah', 'asc')
            ->get();
        $list_setoran = ListSampah::select(
            'list_sampahs.id_setoran_sampah',
                DB::raw('SUM(list_sampahs.qty) as qty'),
                DB::raw('SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga')
            )
            ->join('setoran_sampahs', 'setoran_sampahs.id_setoran_sampah', '=', 'list_sampahs.id_setoran_sampah')
            ->join('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->where('setoran_sampahs.status', '=', 'Pesanan Selesai')
            ->whereNull('list_sampahs.id_penjualan')
            ->groupBy('list_sampahs.id_setoran_sampah')
            ->orderBy('list_sampahs.id_setoran_sampah', 'asc')
            ->get();

        return view('penjualan.tambah-penjualan', compact('data', 'user', 'list_setoran', 'selected_list_setoran'));
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $penjualan = Penjualan::find($id);
            $list_sampah = ListSampah::where('id_penjualan', $penjualan->id_penjualan)->get();
            if ($list_sampah) {
                foreach ($list_sampah as $list_sampah) {
                DB::table('list_sampahs')
                ->where('id_penjualan', $list_sampah->id_penjualan)
                ->update(['id_penjualan' => null]);
                }
                $penjualan->delete();

            }
        }
        return redirect()->route('penjualan')->with('success', 'Penjualan Deleted successfully');

    }

    public function deleteRow(Request $request)
    {
        Log::info('Delete request data:', $request->all());

        try {
            $id = $request->input('id'); 

            DB::table('list_sampahs')
            ->where('id_setoran_sampah', $id)
            ->update(['id_penjualan' => null]);
            
            return response()->json(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting data:', ['message' => $e->getMessage()]);

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getItemData(){
        try{
            $results = ListSampah::select(
                'list_sampahs.id_setoran_sampah', 'list_sampahs.id_penjualan',
                DB::raw('SUM(list_sampahs.qty) as qty'),
                DB::raw('SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg) as total_harga')
            )
            ->join('setoran_sampahs', 'setoran_sampahs.id_setoran_sampah', '=', 'list_sampahs.id_setoran_sampah')
            ->join('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->where('setoran_sampahs.status', '=', 'Pesanan Selesai')
            ->groupBy('list_sampahs.id_setoran_sampah', 'list_sampahs.id_penjualan' )
            ->orderBy('list_sampahs.id_setoran_sampah', 'asc')
            ->get();
            $results = $results->whereNull('id_penjualan')->values();
            return response()->json(['data' => $results], 200); 
        } catch (\Throwable $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function approve($id)
    {
        DB::table('penjualans')
        ->where('id', $id)
        ->update(['status' => 'Terjual']);
        $penjualan = Penjualan::find($id);
        $this->updateSaldo($penjualan);
        return redirect()->route('penjualan')->with('success', 'Penjualan Approved successfully');
    }

    public function updateSaldo(Penjualan $penjualan)
    {
        if ($penjualan->status == 'Terjual') {
            $user = User::where('id_user', "COMPANY")->first();
            $user->saldo = $user->saldo + $penjualan->final_harga;
            $user->save();
        }
    }

    public function extension_search_penjualan($ids){
        $data = [];
        if ( Auth::user()->role == 'Nasabah') {
            $data = SetoranSampah::where('status', 'Pesanan Selesai')
            ->where('id_user', Auth::user()->id_user)
            ->whereIn('id_penjualan', $ids)
            ->leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
            ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->select(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
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
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at'
            )
            ->get();
        
        }else{
            $data = DB::table('penjualans')
            ->join('list_sampahs', 'penjualans.id_penjualan', '=', 'list_sampahs.id_penjualan')
            ->whereIn('penjualans.id_penjualan', $ids)
            ->select('penjualans.id','penjualans.id_penjualan', 'penjualans.tanggal', 'penjualans.final_harga', 'penjualans.status', DB::raw('SUM(list_sampahs.qty) as qty'))
            ->groupBy('penjualans.id','penjualans.id_penjualan', 'penjualans.tanggal', 'penjualans.final_harga', 'penjualans.status')
            ->get();
        }
        return $data;
    }

    public function extension_search_setoran($ids){
        $data = [];
        if ( Auth::user()->role == 'Nasabah') {
            $data = SetoranSampah::where('setoran_sampahs.id_user', Auth::user()->id_user)
            ->whereIn('setoran_sampahs.id_setoran_sampah', $ids)
            ->leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
            ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->select(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at',
                DB::raw("SUM(list_sampahs.qty) as qty"),
                DB::raw("IFNULL(SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg), 0) as total_harga")
            )
            ->groupBy(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at'
            )
            ->get();
        }else{
            $data = SetoranSampah::whereIn('setoran_sampahs.id_setoran_sampah', $ids)
            ->leftJoin('list_sampahs', 'list_sampahs.id_setoran_sampah', '=', 'setoran_sampahs.id_setoran_sampah')
            ->leftJoin('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->select(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at',
                DB::raw("SUM(list_sampahs.qty) as qty"),
                DB::raw("IFNULL(SUM(list_sampahs.qty * jenis_sampahs.harga_per_kg), 0) as total_harga")
            )
            ->groupBy(
                'setoran_sampahs.id',
                'setoran_sampahs.id_setoran_sampah',
                'setoran_sampahs.id_user',
                'setoran_sampahs.status',
                'setoran_sampahs.tanggal',
                'setoran_sampahs.created_at',
                'setoran_sampahs.updated_at'
            )
            ->get();
        }
        return $data;
    }
}
