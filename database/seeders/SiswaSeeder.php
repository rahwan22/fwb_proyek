<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;

class SiswaSeeder extends Seeder
{
    public function run()
    {

        $user = User::where('email', 'siswa@example.com')->first();
        $kelas = Kelas::first();

        // Menambahkan siswa pertama
        Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
            'nama_siswa' => 'rawhan',
            'nisn' => '1234567890',
            'alamat' => 'Jl. Raya No. 1',
        ]);

        // Menambah siswa lainnya
        Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
            'nama_siswa' => 'Sri Maharani',
            'nisn' => '1234567891',
            'alamat' => 'Jl. Raya No. 2',
        ]);
        Siswa::create([
            'user_id' => $user->id,
            'kelas_id' => $kelas->id,
            'nama_siswa' => 'Caca',
            'nisn' => '1234567892',
            'alamat' => 'Jl. Raya No. 3',
        ]);

       
    }
}
