<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;
use App\Models\kelas;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\Guru;

class NilaiSeeder extends Seeder
{
    public function run()
    {
        $siswa = Siswa::first();
        $kelas = Kelas::first();
        $mapel = MataPelajaran::first();
        $guru = Guru::first();
       
            Nilai::firstOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'kelas_id' => $kelas->id,
                    'mata_pelajaran_id' => $mapel->id,
                    'guru_id' => $guru->id,
                ],
                ['nilai' => 100],
               
            );
    }
}
