<?php
// app/Models/Siswa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    
    protected $table = 'siswas';
    protected $fillable = ['user_id', 'kelas_id', 'nama_siswa', 'nisn', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
    
    

}

