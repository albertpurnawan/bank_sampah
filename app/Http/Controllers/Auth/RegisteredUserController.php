<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    public function show(): View
    {
        $data = User::all();
        return view('Pengguna.pengguna', compact('data'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'nomor' => ['required', 'string', 'max:13'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => [Rule::in(['admin', 'user'])],
        ]);

        $config = ['table'=>'users', 'field'=>'id_user','length'=>9, 'prefix'=>'USER-'];
        $id = IdGenerator::generate($config);
        $user = User::create([
            'id_user' => $id,
            'nama' => $request->nama,
            'email' => $request->email,
            'nomor' => $request->nomor,
            'password' => Hash::make($request->password),
        ]);
        $this->checkIsLengkap($user);
        event(new Registered($user));

        // Auth::guard('web')->login($user);

        return redirect(route('login'));
    }

    public function createPengguna()
    {
        return view('pengguna.tambah-pengguna');
    }

    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
            ],
            'nomor' => ['required', 'string', 'max:13'],
            'role' => [Rule::in(['Admin', 'Nasabah', 'COMPANY'])],
        ]);
        $is_lengkap = 0;
        if ($request->id_user) {
            $user = User::where('id_user', $request->id_user)->first();
            $user->update([
                'nama' => $request->nama,
                'email' => $request->email,
                'nomor' => $request->nomor,
                'role' => $request->role,
            ]);
            $this->checkIsLengkap($user);
        }else{
            $config = ['table'=>'users', 'field'=>'id_user','length'=>5, 'prefix'=>'U'];
            $id = IdGenerator::generate($config);
            $user = User::create([
                'id_user' => $id,
                'nama' => $request->nama,
                'email' => $request->email,
                'nomor' => $request->nomor,
                'role' => $request->role,
                'password' => Hash::make($request->email),
            ]);
            $this->checkIsLengkap($user);
            event(new Registered($user));
        }

        return redirect()->route('pengguna')->with('success', 'Pengguna updated successfully');

    }

    private function checkIsLengkap($user){
        $is_lengkap = empty($user->nama) || empty($user->email) || empty($user->kode_pos) || empty($user->tanggal_lahir) || empty($user->kota) || empty($user->nomor) || empty($user->alamat) || empty($user->bank) || empty($user->nomor_rekening) || empty($user->role);
        $user->is_lengkap = !$is_lengkap;
        $user->save();
    }

    public function edit($id): View
    {
        $data = User::where('id', $id)->first();
        return view('Pengguna.tambah-pengguna', compact('data'));
    }

    public function delete(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $user = User::where('id', $id)->first();
            $user->delete();
        }
        return redirect()->route('pengguna')->with('success', 'Pengguna Deleted successfully');
    }
}

