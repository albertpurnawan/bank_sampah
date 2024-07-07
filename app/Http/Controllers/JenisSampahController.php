<?php

namespace App\Http\Controllers;

use App\Models\JenisSampah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class JenisSampahController extends Controller
{
    public function index()
    {
        $data = JenisSampah::all();
        return view('JenisSampah.jenis-sampah', compact('data'));
    }

    public function create()
    {
        return view('JenisSampah.tambah-jenis-sampah');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'harga_per_kg' => 'integer'
        ]);

        if ($validator->fails()) {
            return redirect()->route('jenis-sampah.tambah-insert')
                             ->withErrors($validator)
                             ->withInput();
        }
        if ($request->id_jenis_sampah) {
            $jenisSampah = JenisSampah::where('id_jenis_sampah', $request->id_jenis_sampah)->first();
            $jenisSampah->update([
                'nama' => $request->input('nama'),
                'harga_per_kg' => $request->input('harga_per_kg'),
            ]);
        }else{
            $config = ['table'=>'jenis_sampahs', 'field'=>'id_jenis_sampah','length'=>9, 'prefix'=>'JSMP-'];
            $id = IdGenerator::generate($config);
            
            $jenisSampah = JenisSampah::create([
                'id_jenis_sampah' => $id,
                'nama' => $request->input('nama'),
                'harga_per_kg' => $request->input('harga_per_kg'),
            ]);
        }

        return redirect()->route('jenis-sampah')->with('success', 'Jenis Sampah created successfully');
    }

    public function edit($id)
    {
        $data =  JenisSampah::find($id);
        return view('JenisSampah.tambah-jenis-sampah', compact('data'));
    }

    public function delete(Request $request)
    {
        // dd($request);
        $ids = $request->ids;
        foreach ($ids as $id) {
            $jenisSampah = JenisSampah::find($id);
            $jenisSampah->delete();
        }
        return redirect()->route('jenis-sampah')->with('success', 'Jenis Sampah Deleted successfully');
    }
}

