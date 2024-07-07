<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        return view('profile.edit-profile');
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation
        $validator = Validator::make($request->all(), [
            'nama' => 'string|max:255',
            'kode_pos' => 'string|max:10',
            'tanggal_lahir' => 'date',
            'kota' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'nomor' => 'string|max:12',
            'alamat' => 'string|max:500',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            'bank' => 'string|max:12',
            'nomor_rekening' => 'string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit-profile.update')
                             ->withErrors($validator)
                             ->withInput();
        }

        // Update user profile
        $user->nama = $request->input('nama') ?? $user->nama;
        $user->kode_pos = $request->input('kode_pos') ?? $user->kode_pos;
        $user->tanggal_lahir = $request->input('tanggal_lahir') ?? $user->tanggal_lahir;
        $user->kota = $request->input('kota') ?? $user->kota;
        $user->email = $request->input('email') ?? $user->email;
        $nomor = $request->input('nomor-2') ?? $user->nomor;
        $nomor = preg_replace('/^0+/', '', $nomor);
        $user->nomor = $nomor;
        $user->alamat = $request->input('alamat') ?? $user->alamat;
        $user->bank = $request->input('bank') ?? $user->bank;
        $user->nomor_rekening = $request->input('nomor_rekening') ?? $user->nomor_rekening;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $imageName = time() . '.' . $file->extension();
            $file->move(public_path('assets/images'), $imageName);
            $user->foto = '/assets/images/' . $imageName;
        }
        $this->checkIsLengkap($user);
        return redirect()->route('profile.edit-profile.update')->with('success', 'Profile updated successfully.');
    }

    /**
     * Reset the user's password.
     */
    public function resetPassword(Request $request): RedirectResponse
    {
        $request->validateWithBag('passwordReset', [
            'old_password' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    $fail('Old password is incorrect.');
                }
            }],
            'new_password' => ['required', 'min:8'],
            'new_password_confirmation' => ['required', 'same:new_password'],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->route('profile.ganti-password.update')->with('success', 'Password reset successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    private function checkIsLengkap($user){
        $is_lengkap = empty($user->nama) || empty($user->email) || empty($user->kode_pos) || empty($user->tanggal_lahir) || empty($user->kota) || empty($user->nomor) || empty($user->alamat) || empty($user->bank) || empty($user->nomor_rekening) || empty($user->role);
        $user->is_lengkap = !$is_lengkap;
        $user->save();
    }
}

