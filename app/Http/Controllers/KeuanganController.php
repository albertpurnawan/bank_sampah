<?php

namespace App\Http\Controllers;

use App\Models\Keuangan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Helpers\NumberHelper;
use Illuminate\Support\Facades\DB;    
use PDF;

class KeuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $saldo=0;
        $saldo_bank = User::where('id_user', 'COMPANY')->first()->saldo;
        $data = [];
        if (Auth::user()->role == 'Nasabah') {
            // dd(Auth::user()->role);
            $user = User::find(Auth::user()->id);
            $saldo = $user->saldo;
            $data = Keuangan::where('id_user', $user->id_user)->get();
        }else{
            $data = Keuangan::all();
            $saldo = User::where('role', 'Admin')->first()->saldo;

        }
        return view('Keuangan.keuangan', compact('data', 'saldo_bank', 'saldo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $max_tarik = User::find(Auth::user()->id)->saldo;
        return view('Keuangan.tarik-keuangan', compact('max_tarik'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'nama_lengkap_rekening' => 'string|max:255',
            'tipe_penarikan' => 'string|max:255',
            'saldo_manual' => 'numeric|min:0|nullable',
            'saldo_online' => 'numeric|min:0|nullable',
            'nomor_rekening' => 'string|min:0|max:20|nullable',
            'nomor' => 'string|max:13|nullable',
            'bank' => 'string|max:255|nullable',
            'status' => 'string|max:255',
        ]);
        // dd($validator);
        if ($validator->fails()) {
            return redirect()->route('keuangan.tarik-insert')
                             ->withErrors($validator)
                             ->withInput();
        }

        if ($request->id_keuangan) {
            $keuangan = Keuangan::where('id_keuangan', $request->id_keuangan)->first();
            $keuangan->update([
                'id_keuangan' => $request->id_keuangan ? $request->id_keuangan : null,
                'id_user' => $request->id_user ? $request->id_user : null,
                'nama_lengkap_rekening' => $request->input('nama_lengkap_rekening') ? $request->input('nama_lengkap_rekening') : null,
                'tipe_penarikan' => $request->input('tipe_penarikan') ? $request->input('tipe_penarikan') : null,
                'saldo' => $request->input('saldo_manual') ? $request->input('saldo_manual') : $request->input('saldo_online'),
                'nomor_rekening' => $request->input('nomor_rekening') ? $request->input('nomor_rekening') : null,
                'nomor' => $request->input('nomor') ? $request->input('nomor') : null,
                'bank' => $request->input('bank') ? $request->input('bank') : null,
                'status' => "Dalam Proses",
            ]);
            return redirect()->route('keuangan')->with('success', 'Penarikan updated successfully');
        }else{
            $config = ['table'=>'keuangans', 'field'=>'id_keuangan','length'=>9, 'prefix'=>'KNGN-'];
            $id = IdGenerator::generate($config);
            
            $keuangan = Keuangan::create([
                'id_keuangan' => $id,
                'id_user' => Auth::user()->id_user,
                'nama_lengkap_rekening' => $request->input('nama_lengkap_rekening') ? $request->input('nama_lengkap_rekening') : null,
                'tipe_penarikan' => $request->input('tipe_penarikan') ? $request->input('tipe_penarikan') : null,
                'saldo' => $request->input('saldo_manual') ? $request->input('saldo_manual') : $request->input('saldo_online'),
                'nomor_rekening' => $request->input('nomor_rekening') ? $request->input('nomor_rekening') : null,
                'nomor' => $request->input('nomor') ? $request->input('nomor') : null,
                'bank' => $request->input('bank') ? $request->input('bank') : null,
                'status' => "Dalam Proses",
            ]);
            return redirect()->route('keuangan')->with('success', 'Penarikan created successfully');
        }
    }

    public function edit($id)
    {
        $data =  Keuangan::find($id);
        $max_tarik = User::find(Auth::user()->id)->saldo;
        // dd($data);
        return view('Keuangan.tarik-keuangan', compact('data', 'max_tarik'));
    }

    public function approve($id)
    {
        DB::table('keuangans')
        ->where('id', $id)
        ->update(['status' => 'Penarikan Sukses']);
        $keuangan = Keuangan::find($id);
        $this->updateSaldo($keuangan);
        return redirect()->route('keuangan')->with('success', 'Keuagan Approved successfully');
    }

    public function updateSaldo(Keuangan $keuangan)
    {
        if ($keuangan->status == 'Penarikan Sukses') {
            $user = User::where('id_user', "COMPANY")->first();
            $user->saldo = $user->saldo - $keuangan->saldo;
            $user->save();
            User::where('id_user', $keuangan->id_user)->update(['saldo' => DB::raw('users.saldo - ' . $keuangan->saldo)]);
        }
    }

    public function generateKwitansi($id) {
        $data = Keuangan::find($id);
    
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $data->terbilang = NumberHelper::terbilang($data->saldo);
        $pdf = PDF::loadView('Keuangan.kwitansi', ['data' => $data]);
        return $pdf->download('Keuangan.kwitansi.pdf');
    }
}
