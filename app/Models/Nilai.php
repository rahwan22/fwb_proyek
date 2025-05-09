<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai'; // <- ini yang penting

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'mata_pelajaran_id',
        'guru_id',
        'nilai',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
    
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
    
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    
}
