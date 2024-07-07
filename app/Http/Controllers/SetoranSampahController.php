<?php

namespace App\Http\Controllers;

use App\Models\SetoranSampah;
use App\Models\TipeSetoran;
use App\Models\JenisSampah;
use App\Models\User;
use App\Models\ListSampah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SetoranSampahController extends Controller
{
    public function index()
    {
        $data = [];
        if ( Auth::user()->role == 'Nasabah') {
            $data = SetoranSampah::where('id_user', Auth::user()->id_user)->get();
        }else{
            $data = SetoranSampah::all();
        }
        return view('SetoranSampah.setoran-sampah', compact('data'));
    }

    public function jenisSampah(){
        $data = JenisSampah::where('nama', 'LIKE', '%'.request('q').'%')->paginate(10);
        return response()->json($data);
    }

    public function create()
    {
        $tipe = TipeSetoran::all();
        $jenis = JenisSampah::all();
        $user = User::all();
        return view('SetoranSampah.tambah-setoran-sampah', compact(['tipe', 'jenis', 'user']));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'tipe_setor' => 'string',
            'nomor' => 'string|max:13',
            'tanggal' => 'date',
            'status' => 'string',
            'total_harga' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->route('setoran-sampah.tambah-insert')
                             ->withErrors($validator)
                             ->withInput();
        }
        if ($request->id_setoran_sampah) {
            $setoranSampah = SetoranSampah::where('id_setoran_sampah', $request->id_setoran_sampah)->first();
            $list_sampah = ListSampah::where('id_setoran_sampah', $request->id_setoran_sampah)->get();
            
            $setoranSampah->update([
                'id_tipe_setoran' => $request->tipe_setor,
                'nama' => explode(" - ", $request->nama)[1],
                'id_user' => explode(" - ", $request->nama)[0],
                'nomor' => $request->nomor,
                'tanggal' => $request->tanggal,
                'status' => $request->status,
                'total_harga' => $request->total_harga
            ]);

            if ($request->input('jenis_sampah')){
                foreach ($request->input('jenis_sampah') as $key => $value) {
                    if (!isset($request->id_list_sampah[$key])) {
                        $config_list = ['table'=>'list_sampahs', 'field'=>'id_list_sampah','length'=>9, 'prefix'=>'LTMP-'];
                        $id_list = IdGenerator::generate($config_list);
                        $list_sampah = ListSampah::create([
                            'id_list_sampah' => $id_list,
                            'id_setoran_sampah' => $request->id_setoran_sampah,
                            'id_jenis_sampah' => explode(" - ",$request->jenis_sampah[$key])[0],
                            'qty' => $request->qty[$key]
                        ]);
                    } else {
                        
                        $id_list = $request->id_list_sampah[$key];
                        $list_sampah = ListSampah::where('id_list_sampah', $id_list)
                                                ->where('id_setoran_sampah', $request->id_setoran_sampah);
                        $list_sampah->update([
                            'id_jenis_sampah' => explode(" - ",$request->jenis_sampah[$key])[0],
                            'qty' => $request->qty[$key]
                        ]);
                    }
    
                }
            }
            $this->updateSaldo($setoranSampah);
        }else{
            $config = ['table'=>'setoran_sampahs', 'field'=>'id_setoran_sampah','length'=>9, 'prefix'=>'SNSH-'];
            $id = IdGenerator::generate($config);
            
            $setoranSampah = SetoranSampah::create([
                'id_setoran_sampah' => $id,
                'id_tipe_setoran' => $request->input('tipe_setor'),
                'nama' => explode(" - ", $request->input('nama'))[1],
                'id_user' => explode(" - ", $request->input('nama'))[0],
                'nomor' => $request->nomor,
                'tanggal' => $request->tanggal,
                'status' => $request->status,
                'total_harga' => $request->total_harga
            ]);
            
            if ($request->input('jenis_sampah')){
                foreach ($request->input('jenis_sampah') as $key => $value) {
                    $config_list = ['table'=>'list_sampahs', 'field'=>'id_list_sampah','length'=>9, 'prefix'=>'LTMP-'];
                    $id_list = IdGenerator::generate($config_list);
                    $list_sampah = ListSampah::create([
                        'id_list_sampah' => $id_list,
                        'id_setoran_sampah' => $id,
                        'id_jenis_sampah' => explode(" - ",$request->jenis_sampah[$key])[0],
                        'qty' => $request->qty[$key]
                    ]);
                }
            }
            $this->updateSaldo($setoranSampah);
        }

        return redirect()->route('setoran-sampah')->with('success', 'Setoran Sampah created successfully');
    }

    public function edit($id)
    {
        $data =  SetoranSampah::find($id);
        $list_sampah = ListSampah::where('id_setoran_sampah', $data->id_setoran_sampah)
            ->join('jenis_sampahs', 'jenis_sampahs.id_jenis_sampah', '=', 'list_sampahs.id_jenis_sampah')
            ->select('list_sampahs.*', DB::raw('CONCAT(jenis_sampahs.id_jenis_sampah, " - ", jenis_sampahs.nama) as nama'), 'jenis_sampahs.harga_per_kg')
            ->get();
        $user = User::all();
        $tipe = TipeSetoran::all();
        $jenis = JenisSampah::all();
        return view('SetoranSampah.tambah-setoran-sampah', compact('data', 'list_sampah', 'user', 'tipe', 'jenis'));
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $setoranSampah = SetoranSampah::find($id);
            $list_sampah = ListSampah::where('id_setoran_sampah', $setoranSampah->id_setornan_sampah)->get();
            foreach ($list_sampah as $key => $value) {
                $value->delete();
            }
            $setoranSampah->delete();
        }
        return redirect()->route('setoran-sampah')->with('success', 'Setoran Sampah Deleted successfully');
    }

    public function deleteRow(Request $request)
    {
        Log::info('Delete request data:', $request->all());

        try {
            $id = $request->input('id'); 
            $listSampah = ListSampah::where('id_list_sampah', $id)->first();

            if (!$listSampah) {
                return response()->json(['error' => 'Data not found'], 404);
            }

            $listSampah->delete();

            return response()->json(['success' => 'Data deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting data:', ['message' => $e->getMessage()]);

            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    
    public function updateSaldo(SetoranSampah $setoranSampah)
    {
        $potongan_harga = 0;
        if ($setoranSampah->status == 'Pesanan Selesai') {
            $user = User::where('id_user', $setoranSampah->id_user)->first();
            $tipe = TipeSetoran::where('id_tipe_setoran', $setoranSampah->id_tipe_setoran)->first();
            $potongan_harga = ($setoranSampah->total_harga * $tipe->potongan_per_transaksi)/100;
            $user->saldo = $user->saldo + $setoranSampah->total_harga - $potongan_harga;
            $user->save();
            DB::table('users')
            ->where('role', 'Admin')
            ->update(['saldo' => DB::raw('users.saldo + ' . $potongan_harga)]);
        }
    }
}
