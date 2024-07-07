<?php

namespace App\Http\Controllers;

use App\Models\TipeSetoran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class TipeSetoranController extends Controller
{
    public function index()
    {
        $data = TipeSetoran::all();
        return view('TipeSetoran.tipe-setoran', compact('data'));
    }

    public function create()
    {
        return view('TipeSetoran.tambah-tipe-setoran');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipe' => 'string|max:255',
            'potongan_per_transaksi' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->route('tipe-setoran.tambah-insert')
                             ->withErrors($validator)
                             ->withInput();
        }
        if ($request->id_tipe_setoran) {
            $TipeSetoran = TipeSetoran::where('id_tipe_setoran', $request->id_tipe_setoran)->first();
            $TipeSetoran->update([
                'tipe' => $request->input('tipe'),
                'potongan_per_transaksi' => $request->input('potongan_per_transaksi'),
            ]);
        }else{
            $config = ['table'=>'tipe_setorans', 'field'=>'id_tipe_setoran','length'=>9, 'prefix'=>'SNSH-'];
            $id = IdGenerator::generate($config);
            
            $TipeSetoran = TipeSetoran::create([
                'id_tipe_setoran' => $id,
                'tipe' => $request->input('tipe'),
                'potongan_per_transaksi' => $request->input('potongan_per_transaksi'),
            ]);
        }

        return redirect()->route('tipe-setoran')->with('success', 'Tipe Setoran created successfully');
    }

    public function edit($id)
    {
        $data =  TipeSetoran::find($id);
        return view('tipeSetoran.tambah-tipe-setoran', compact('data'));
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $TipeSetoran = TipeSetoran::find($id);
            $TipeSetoran->delete();
        }
        return redirect()->route('tipe-setoran')->with('success', 'Tipe Setoran Deleted successfully');
    }
}

