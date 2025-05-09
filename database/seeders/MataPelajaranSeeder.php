<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MataPelajaran;
use App\Models\Guru;

class MataPelajaranSeeder extends Seeder
{
    public function run()
    {
        $guru = Guru::first();

        MataPelajaran::firstOrCreate(
            ['nama_mapel' => 'Matematika'],
            ['guru_id' => $guru->id]
        );
        MataPelajaran::firstOrCreate(
            ['nama_mapel' => 'fisika'],
            ['guru_id' => $guru->id]
        );
        MataPelajaran::firstOrCreate(
            ['nama_mapel' => 'Bahasa indonesia'],
            ['guru_id' => $guru->id]
        );
    }
}
