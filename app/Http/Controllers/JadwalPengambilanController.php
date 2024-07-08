<?php

namespace App\Http\Controllers;

use App\Models\JadwalPengambilan;
use App\Models\SetoranSampah;
use App\Models\AlamatPenjemputan;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;

class JadwalPengambilanController extends Controller
{
    public function index()
    {
        $data = JadwalPengambilan::select(
            'jadwal_pengambilans.id',
            'jadwal_pengambilans.id_jadwal_pengambilan',
            'jadwal_pengambilans.id_user',
            'jadwal_pengambilans.nama_driver',
            'jadwal_pengambilans.nomor',
            'jadwal_pengambilans.status',
            DB::raw('(SELECT GROUP_CONCAT(alamat_penjemputans.alamat SEPARATOR ", ") as alamat 
                      FROM alamat_penjemputans 
                      WHERE alamat_penjemputans.id_jadwal_pengambilan = jadwal_pengambilans.id_jadwal_pengambilan 
                      ORDER BY alamat_penjemputans.id_alamat_penjemputan ASC) as alamat_pengambilan')
        )

        ->leftJoin('alamat_penjemputans', 'alamat_penjemputans.id_jadwal_pengambilan', '=', 'jadwal_pengambilans.id_jadwal_pengambilan')    
        ->groupBy(
            'jadwal_pengambilans.id',
            'jadwal_pengambilans.id_jadwal_pengambilan',
            'jadwal_pengambilans.id_user',
            'jadwal_pengambilans.nama_driver',
            'jadwal_pengambilans.nomor',
            'jadwal_pengambilans.status'
        )
        ->get();
        return view('JadwalPengambilan.jadwal-pengambilan', compact('data'));
    }

    public function create()
    {
        $setoran_user = SetoranSampah::select('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user', DB::raw('MAX(users.nama) as nama'), DB::raw('MAX(users.alamat) as alamat'))
            ->join('users', 'users.id_user', '=', 'setoran_sampahs.id_user')
            ->where('setoran_sampahs.id_tipe_setoran', '=', 'TESN-0001')
            ->where('setoran_sampahs.status', '=', 'Pesanan Baru')
            ->whereNotIn('setoran_sampahs.id_setoran_sampah', function ($query) {
                $query->select('id_setoran_sampah')
                    ->from('alamat_penjemputans');
            })
            ->groupBy('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user')
            ->orderBy('setoran_sampahs.id_setoran_sampah', 'asc')
            ->get();
        $user = User::where('role', 'Admin')->get();
        return view('JadwalPengambilan.tambah-jadwal-pengambilan', compact('setoran_user', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_driver' => 'string|max:255',
            'nomor' => 'string|max:13',
        ]);

        if ($validator->fails()) {
            return redirect()->route('jadwal-pengambilan.tambah-insert')
                             ->withErrors($validator)
                             ->withInput();
        }
        if ($request->id_jadwal_pengambilan) {
            
            $JadwalPengambilan = JadwalPengambilan::where('id_jadwal_pengambilan', $request->id_jadwal_pengambilan)->first();
            $alamat_penjemputan = AlamatPenjemputan::where('id_alamat_penjemputan', $request->id_alamat_penjemputan)->get();
            $JadwalPengambilan->update([
                'id_user' => explode(" - ",$request->input('nama_driver'))[0],
                'nama_driver' => explode(" - ",$request->input('nama_driver'))[1],
                'nomor' => $request->input('nomor'),
            ]);
            // dd($request);
            if ($request->input('setoran_sampah')){
                foreach ($request->input('setoran_sampah') as $key => $value) {
                    if (!isset($request->id_alamat_penjemputan[$key])) {
                        $config_list = ['table'=>'alamat_penjemputans', 'field'=>'id_alamat_penjemputan','length'=>9, 'prefix'=>'ATPN-'];
                        $id_list = IdGenerator::generate($config_list);
                        $alamat_penjemputan = AlamatPenjemputan::create([
                            'id_alamat_penjemputan' => $id_list,
                            'id_jadwal_pengambilan' => $request->id_jadwal_pengambilan,
                            'id_setoran_sampah' => explode(" - ",$request->setoran_sampah[$key])[0],
                            'nama' => $request->nama[$key],
                            'alamat' => $request->alamat[$key]
                        ]);
                    } else {
                        
                        $id_list = $request->id_alamat_penjemputan[$key];
                        $alamat_penjemputan = AlamatPenjemputan::where('id_alamat_penjemputan', $id_list)
                                                ->where('id_jadwal_pengambilan', $request->id_jadwal_pengambilan);
                        $alamat_penjemputan->update([
                            'id_setoran_sampah' => explode(" - ",$request->setoran_sampah[$key])[0],
                            'nama' => $request->nama[$key],
                            'alamat' => $request->alamat[$key]
                        ]);
                    }
                    DB::table('setoran_sampahs')
                    ->where('id_setoran_sampah', explode(" - ",$request->setoran_sampah[$key])[0])
                    ->update(['status' => 'Penjemputan']);
                }
            }
        }else{
            // dd($request);
            $config = ['table'=>'jadwal_pengambilans', 'field'=>'id_jadwal_pengambilan','length'=>9, 'prefix'=>'JLSP-'];
            $id = IdGenerator::generate($config);
            
            $JadwalPengambilan = JadwalPengambilan::create([
                'id_jadwal_pengambilan' => $id,
                'id_user' => explode(" - ",$request->input('nama_driver'))[0],
                'nama_driver' => explode(" - ",$request->input('nama_driver'))[1],
                'nomor' => $request->input('nomor'),
                'status' => 'Pending',
            ]);
            if ($request->input('setoran_sampah')){
                foreach ($request->input('setoran_sampah') as $key => $value) {
                    $config_list = ['table'=>'alamat_penjemputans', 'field'=>'id_alamat_penjemputan','length'=>9, 'prefix'=>'ATPN-'];
                    $id_list = IdGenerator::generate($config_list);
                    $alamat_penjemputan = AlamatPenjemputan::create([
                        'id_alamat_penjemputan' => $id_list,
                        'id_jadwal_pengambilan' => $id,
                        'id_setoran_sampah' => explode(" - ",$request->setoran_sampah[$key])[0],
                        'nama' => $request->nama[$key],
                        'alamat' => $request->alamat[$key]
                    ]);
                    DB::table('setoran_sampahs')
                    ->where('id_setoran_sampah', explode(" - ",$request->setoran_sampah[$key])[0])
                    ->update(['status' => 'Penjemputan']);
                }
            }
        }

        return redirect()->route('jadwal-pengambilan')->with('success', 'Jadwal Pengambilan created successfully');
    }

    public function edit($id)
    {
        $data =  JadwalPengambilan::find($id);
        $user = User::where('role', 'Admin')->get();
        $selected_setoran_user = AlamatPenjemputan::select('alamat_penjemputans.*')
            ->where('id_jadwal_pengambilan', $data->id_jadwal_pengambilan)
            ->get();
        $setoran_user = SetoranSampah::select('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user', DB::raw('MAX(users.nama) as nama'), DB::raw('MAX(users.alamat) as alamat'))
        ->join('users', 'users.id_user', '=', 'setoran_sampahs.id_user')
        ->where('setoran_sampahs.id_tipe_setoran', '=', 'TESN-0001')
        ->where('setoran_sampahs.status', '=', 'Pesanan Baru')
        ->whereNotIn('setoran_sampahs.id_setoran_sampah', function ($query) {
            $query->select('id_setoran_sampah')
                ->from('alamat_penjemputans');
        })
        ->groupBy('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user')
        ->orderBy('setoran_sampahs.id_setoran_sampah', 'asc')
        ->get();
        return view('JadwalPengambilan.tambah-jadwal-pengambilan', compact('data', 'user', 'setoran_user', 'selected_setoran_user'));
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $jadwalPengambilan = JadwalPengambilan::find($id);
            $alamatPenjemputan = AlamatPenjemputan::where('id_jadwal_pengambilan', $jadwalPengambilan->id_jadwal_pengambilan)->get();
            if ($alamatPenjemputan) {
                foreach ($alamatPenjemputan as $alamatPenjemputan) {
                DB::table('setoran_sampahs')
                ->where('id_setoran_sampah', $alamatPenjemputan->id_setoran_sampah)
                ->update(['status' => 'Pesanan Baru']);
                $jadwalPengambilan->delete();
                $alamatPenjemputan->delete();
                }
            }
        }
        return redirect()->route('jadwal-pengambilan')->with('success', 'Jadwal Pengambilan Deleted successfully');

    }

    public function deleteRow(Request $request)
    {
        Log::info('Delete request data:', $request->all());

        try {
            $id = $request->input('id'); 
            $alamatPenjemputan = AlamatPenjemputan::where('id_alamat_penjemputan', $id)->first();
            DB::table('setoran_sampahs')
                    ->where('id_setoran_sampah', $alamatPenjemputan->id_setoran_sampah)
                    ->update(['status' => 'Pesanan Baru']);
            if (!$alamatPenjemputan) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $alamatPenjemputan->delete();

            return response()->json(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting data:', ['message' => $e->getMessage()]);

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function getItemData(){
        try{
            $results = SetoranSampah::select('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user', DB::raw('MAX(users.nama) as nama'), DB::raw('MAX(users.alamat) as alamat'))
            ->join('users', 'users.id_user', '=', 'setoran_sampahs.id_user')
            ->where('setoran_sampahs.id_tipe_setoran', '=', 'TESN-0001')
            ->where('setoran_sampahs.status', '=', 'Pesanan Baru')
            ->whereNotIn('setoran_sampahs.id_setoran_sampah', function ($query) {
                $query->select('id_setoran_sampah')
                    ->from('alamat_penjemputans');
            })
            ->groupBy('setoran_sampahs.id_setoran_sampah', 'setoran_sampahs.id_user')
            ->orderBy('setoran_sampahs.id_setoran_sampah', 'asc')
            ->get();
            return response()->json(['data' => $results], 200); 
        } catch (\Throwable $e) {
            Log::error('Search error: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function approve($id)
    {
        DB::table('jadwal_pengambilans')
        ->where('id', $id)
        ->update(['status' => 'Selesai']);
        $jadwal_pengambilan = JadwalPengambilan::find($id);
        $alamat_penjemputan = AlamatPenjemputan::where('id_jadwal_pengambilan', $jadwal_pengambilan->id_jadwal_pengambilan)->get();
        $ids = $alamat_penjemputan->pluck('id_setoran_sampah')->toArray();
        DB::table('setoran_sampahs')
                    ->whereIn('id_setoran_sampah', $ids)
                    ->update(['status' => 'Pesanan Diterima']);

        return redirect()->route('jadwal-pengambilan')->with('success', 'Jadwal Pengambilan updated successfully');
    }

    public function extension_search_pengambilan($ids)
    {
        $data = JadwalPengambilan::whereIn('jadwal_pengambilans.id_jadwal_pengambilan', $ids)
        ->select(
            'jadwal_pengambilans.id',
            'jadwal_pengambilans.id_jadwal_pengambilan',
            'jadwal_pengambilans.id_user',
            'jadwal_pengambilans.nama_driver',
            'jadwal_pengambilans.nomor',
            'jadwal_pengambilans.status',
            DB::raw('(SELECT GROUP_CONCAT(alamat_penjemputans.alamat SEPARATOR ", ") as alamat 
                      FROM alamat_penjemputans 
                      WHERE alamat_penjemputans.id_jadwal_pengambilan = jadwal_pengambilans.id_jadwal_pengambilan 
                      ORDER BY alamat_penjemputans.id_alamat_penjemputan ASC) as alamat_pengambilan')
        )

        ->leftJoin('alamat_penjemputans', 'alamat_penjemputans.id_jadwal_pengambilan', '=', 'jadwal_pengambilans.id_jadwal_pengambilan')    
        ->groupBy(
            'jadwal_pengambilans.id',
            'jadwal_pengambilans.id_jadwal_pengambilan',
            'jadwal_pengambilans.id_user',
            'jadwal_pengambilans.nama_driver',
            'jadwal_pengambilans.nomor',
            'jadwal_pengambilans.status'
        )
        ->get();
        return $data;
    }


}
