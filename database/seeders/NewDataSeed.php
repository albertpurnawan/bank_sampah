<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\JenisSampah;
use App\Models\TipeSetoran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewDataSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id_user' => 'COMPANY',
                'nama' => 'Company',
                'foto' => null,
                'email' => 'company@example.com',
                'kode_pos' => null,
                'tanggal_lahir' => null,
                'kota' => null,
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => null,
                'bank' => null,
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '0',
                'role' => 'COMPANY',
                'email_verified_at' => now(),
                'password' => Hash::make('company'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [ 
                'id_user' => 'USER-0001',
                'nama' => 'Admin',
                'foto' => null,
                'email' => 'admin@example.com',
                'kode_pos' => null,
                'tanggal_lahir' => null,
                'kota' => null,
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => null,
                'bank' => null,
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '0',
                'role' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USER-0002',
                'nama' => 'Nasabah',
                'foto' => null,
                'email' => 'nasabah@example.com',
                'kode_pos' => null,
                'tanggal_lahir' => null,
                'kota' => null,
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => null,
                'bank' => null,
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '0',
                'role' => 'Nasabah',
                'email_verified_at' => now(),
                'password' => Hash::make('nasabah'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USER-0003',
                'nama' => 'Nasabah2',
                'foto' => Str::random(10),
                'email' => 'nasabah2@example.com',
                'kode_pos' => Str::random(5),
                'tanggal_lahir' => now()->subYears(rand(18, 60)),
                'kota' => Str::random(10),
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => Str::random(20),
                'bank' => Str::random(10),
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '1',
                'role' => 'Nasabah',
                'email_verified_at' => now(),
                'password' => Hash::make('nasabah'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USER-0004',
                'nama' => 'Nasabah3',
                'foto' => Str::random(10),
                'email' => 'nasabah3@example.com',
                'kode_pos' => Str::random(5),
                'tanggal_lahir' => now()->subYears(rand(18, 60)),
                'kota' => Str::random(10),
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => Str::random(20),
                'bank' => Str::random(10),
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '1',
                'role' => 'Nasabah',
                'email_verified_at' => now(),
                'password' => Hash::make('nasabah'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 'USER-0005',
                'nama' => 'Nasabah4',
                'foto' => Str::random(10),
                'email' => 'nasabah4@example.com',
                'kode_pos' => Str::random(5),
                'tanggal_lahir' => now()->subYears(rand(18, 60)),
                'kota' => Str::random(10),
                'nomor' => '08'.rand(1111111111, 9999999999),
                'alamat' => Str::random(20),
                'bank' => Str::random(10),
                'nomor_rekening' => rand(1111111111111111, 9999999999999999),
                'is_lengkap' => '1',
                'role' => 'Nasabah',
                'email_verified_at' => now(),
                'password' => Hash::make('nasabah'),
                'saldo' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $i = 0;
        $jenisSampahs = [
            ['id_jenis_sampah' => 'JSMP-0001','nama' => 'Botol Plastik', 'harga_per_kg' => 2500],
            ['id_jenis_sampah' => 'JSMP-0002', 'nama' => 'Besi', 'harga_per_kg' => 10000],
            ['id_jenis_sampah' => 'JSMP-0003', 'nama' => 'Kertas', 'harga_per_kg' => 500],
            ['id_jenis_sampah' => 'JSMP-0004', 'nama' => 'Logam', 'harga_per_kg' => 15000],
            ['id_jenis_sampah' => 'JSMP-0005', 'nama' => 'Minyak Tanah', 'harga_per_kg' => 20000],
            ['id_jenis_sampah' => 'JSMP-0006', 'nama' => 'Pemborong', 'harga_per_kg' => 30000],
            ['id_jenis_sampah' => 'JSMP-0007', 'nama' => 'Plastik', 'harga_per_kg' => 4000],
            ['id_jenis_sampah' => 'JSMP-0008', 'nama' => 'Sampah Kebakaran', 'harga_per_kg' => 10000],
            ['id_jenis_sampah' => 'JSMP-0009', 'nama' => 'Tongkat', 'harga_per_kg' => 2500],
        ];
        foreach ($jenisSampahs as $jenisSampah) {
            DB::table('jenis_sampahs')->insert([
                'id_jenis_sampah' => $jenisSampah['id_jenis_sampah'],
                'nama' => $jenisSampah['nama'],
                'harga_per_kg' => $jenisSampah['harga_per_kg']
            ]);
        }

        // Dummy data for Tipe Setoran
        $tipeSetorans = [
            [ 'id_tipe_setoran' => 'TESN-0001' ,'tipe' => 'Dijemput', 'potongan_per_transaksi' => 30],
            [ 'id_tipe_setoran' => 'TESN-0002' ,'tipe' => 'Ditempat', 'potongan_per_transaksi' => 15],
        ];
        foreach ($tipeSetorans as $tipeSetoran) {
            DB::table('tipe_setorans')->insert([
                'id_tipe_setoran' => $tipeSetoran['id_tipe_setoran'],
                'tipe' => $tipeSetoran['tipe'],
                'potongan_per_transaksi' => $tipeSetoran['potongan_per_transaksi']
            ]);
        }

        // Dummy data for Setoran Sampah
        $users = DB::table('users')->get()->toArray();
        $tipeSetorans = DB::table('tipe_setorans')->get()->toArray();
        $list_status = [
            'Pesanan Baru',
            'Penjemputan',
            'Pesanan Diterima',
            'Pesanan Selesai',
            'Pesanan Ditolak',
        ];
        foreach (range(1, 10) as $i) {
            $qty = rand(2, 5);
            $jenisSampahs = DB::table('jenis_sampahs')->inRandomOrder()->limit($qty)->get();
            $tipeSetoran = $tipeSetorans[array_rand($tipeSetorans)];
            $user = $users[array_rand($users)];
            $status = $list_status[array_rand($list_status)];
            $totalHarga = 0;

            $id_setoran_sampah = "SNSH-" . str_pad($i, 4, '0', STR_PAD_LEFT);
            DB::table('setoran_sampahs')->insert([
                'id_setoran_sampah' => $id_setoran_sampah,
                'id_tipe_setoran' => $tipeSetoran->id_tipe_setoran,
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'tanggal' => now()->subDays(rand(0, 100)),
                'nomor' => '08' . rand(1111111111, 9999999999),
                'status' => $status,
                'total_harga' => $totalHarga,
            ]);

            // Dummy data for List Sampah
            foreach ($jenisSampahs as $key => $sampah) {
                $listSampah = [
                    'id_list_sampah' => "LTMP-" . str_pad($i . $key, 4, '0', STR_PAD_LEFT),
                    'id_setoran_sampah' => $id_setoran_sampah,
                    'id_jenis_sampah' => $sampah->id_jenis_sampah,
                    'qty' => 1,
                ];
                DB::table('list_sampahs')->insert($listSampah);
                $totalHarga += $sampah->harga_per_kg;
            }

            DB::table('setoran_sampahs')->where('id_setoran_sampah', $id_setoran_sampah)->update(['total_harga' => $totalHarga]);
        }
    }
}
