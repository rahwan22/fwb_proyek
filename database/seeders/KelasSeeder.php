<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    public function run()
    {
        Kelas::firstOrCreate(['nama_kelas' => 'XII IPA 1'], ['jurusan' => 'IPA']);
        Kelas::firstOrCreate(['nama_kelas' => 'XII IPA 2'], ['jurusan' => 'IPA']);
        Kelas::firstOrCreate(['nama_kelas' => 'UTBK 2'], ['jurusan'=> 'Bhs Inggris' ]);
    }
}
