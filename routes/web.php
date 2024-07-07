<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisSampahController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TipeSetoranController;
use App\Http\Controllers\SetoranSampahController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\JadwalPengambilanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\InformasiBankController;
use App\Livewire\Searchdropdown;



use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/informasi-bank', function () {
    //     return view('InformasiBank.informasi-bank');
    // });

    Route::get('/informasi-bank', [InformasiBankController::class, 'index'])->name('informasi-bank');

    Route::post('/search', [SearchController::class, 'search'])->name('search');
    Route::get('/show-data', [SearchDropdown::class])->name('show-data');

    Route::get('/jenis-sampah', [JenisSampahController::class, 'index'])->name('jenis-sampah');
    Route::get('/jenis-sampah/tambah', [JenisSampahController::class, 'create'])->name('jenis-sampah.tambah');
    Route::post('/jenis-sampah/tambah', [JenisSampahController::class, 'store'])->name('jenis-sampah.tambah-insert');
    Route::get('/jenis-sampah/edit/{id}', [JenisSampahController::class, 'edit'])->name('jenis-sampah.edit');
    Route::post('/jenis-sampah/delete', [JenisSampahController::class, 'delete'])->name('jenis-sampah.delete');
    
    Route::get('/tipe-setoran', [TipeSetoranController::class, 'index'])->name('tipe-setoran');
    Route::get('/tipe-setoran/tambah', [TipeSetoranController::class, 'create'])->name('tipe-setoran.tambah');
    Route::post('/tipe-setoran/tambah', [TipeSetoranController::class, 'store'])->name('tipe-setoran.tambah-insert');
    Route::get('/tipe-setoran/edit/{id}', [TipeSetoranController::class, 'edit'])->name('tipe-setoran.edit');
    Route::post('/tipe-setoran/delete', [TipeSetoranController::class, 'delete'])->name('tipe-setoran.delete');
    
    Route::get('/pengguna', [RegisteredUserController::class, 'show'])->name('pengguna');
    Route::get('/pengguna/tambah', [RegisteredUserController::class, 'createPengguna'])->name('pengguna.tambah');
    Route::post('/pengguna/tambah', [RegisteredUserController::class, 'add'])->name('pengguna.tambah-insert');
    Route::get('/pengguna/edit/{id}', [RegisteredUserController::class, 'edit'])->name('pengguna.edit');
    Route::post('/pengguna/delete', [RegisteredUserController::class, 'delete'])->name('pengguna.delete');

    Route::get('/jadwal-pengambilan', [JadwalPengambilanController::class, 'index'])->name('jadwal-pengambilan');
    Route::get('/jadwal-pengambilan/tambah', [JadwalPengambilanController::class, 'create'])->name('jadwal-pengambilan.tambah');
    Route::post('/jadwal-pengambilan/tambah', [JadwalPengambilanController::class, 'store'])->name('jadwal-pengambilan.tambah-insert');
    Route::get('/jadwal-pengambilan/edit/{id}', [JadwalPengambilanController::class, 'edit'])->name('jadwal-pengambilan.edit');
    Route::post('/jadwal-pengambilan/delete', [JadwalPengambilanController::class, 'delete'])->name('jadwal-pengambilan.delete');
    Route::post('/jadwal-pengambilan/delete/row', [JadwalPengambilanController::class, 'deleteRow'])->name('jadwal-pengambilan.delete-row');
    Route::get('/jadwal-pengambilan/getItemData', [JadwalPengambilanController::class, 'getItemData'])->name('jadwal-pengambilan.getItemData');
    Route::get('/jadwal-pengambilan/selesai/{id}', [JadwalPengambilanController::class, 'approve'])->name('jadwal-pengambilan.selesai');


    Route::get('/setoran-sampah', [SetoranSampahController::class, 'index'])->name('setoran-sampah');
    Route::get('/setoran-sampah/tambah', [SetoranSampahController::class, 'create'])->name('setoran-sampah.tambah');
    Route::post('/setoran-sampah/tambah', [SetoranSampahController::class, 'store'])->name('setoran-sampah.tambah-insert');
    Route::get('/setoran-sampah/edit/{id}', [SetoranSampahController::class, 'edit'])->name('setoran-sampah.edit');
    Route::post('/setoran-sampah/delete', [SetoranSampahController::class, 'delete'])->name('setoran-sampah.delete');
    Route::post('/setoran-sampah/delete/row', [SetoranSampahController::class, 'deleteRow'])->name('setoran-sampah.delete-row');

    Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan');
    Route::get('/penjualan/tambah', [PenjualanController::class, 'create'])->name('penjualan.tambah');
    Route::post('/penjualan/tambah', [PenjualanController::class, 'store'])->name('penjualan.tambah-insert');
    Route::get('/penjualan/edit/{id}', [PenjualanController::class, 'edit'])->name('penjualan.edit');
    Route::post('/penjualan/delete', [PenjualanController::class, 'delete'])->name('penjualan.delete');
    Route::post('/penjualan/delete/row', [PenjualanController::class, 'deleteRow'])->name('penjualan.delete-row');
    Route::get('/penjualan/getItemData', [PenjualanController::class, 'getItemData'])->name('penjualan.getItemData');
    Route::get('/penjualan/terjual/{id}', [PenjualanController::class, 'approve'])->name('penjualan.terjual');


    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');
    Route::get('/keuangan/tarik', [KeuanganController::class, 'create'])->name('keuangan.tarik');
    Route::post('/keuangan/tarik', [KeuanganController::class, 'store'])->name('keuangan.tarik-insert');
    Route::get('/keuangan/edit/{id}', [KeuanganController::class, 'edit'])->name('keuangan.edit');
    Route::get('/keuangan/penarikan/{id}', [KeuanganController::class, 'approve'])->name('keuangan.penarikan');
    Route::get('/generate/kwitansi/{id}', [KeuanganController::class, 'generateKwitansi'])->name('generate.kwitansi');

    Route::get('/profile/profile-bank', function () {
        return view('profile.profile-bank');
    });
    
    Route::get('/profile/ganti-password', function () {
        return view('profile.ganti-password');
    });

    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('/profile/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit-profile');
    Route::post('/profile/edit-profile', [ProfileController::class, 'update'])->name('profile.edit-profile.update');
    Route::post('/profile/ganti-password', [ProfileController::class, 'resetPassword'])->name('profile.ganti-password.update');

    

});

require __DIR__.'/auth.php';
