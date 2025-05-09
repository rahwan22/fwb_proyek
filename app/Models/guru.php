<?php
// app/Models/Guru.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    protected $table = 'guru';
    protected $fillable = ['user_id', 'nama_guru', 'nip', 'alamat'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
