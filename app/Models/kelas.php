<?php
// app/Models/Kelas.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'jurusan',
    ];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
}
