<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. kelas dan users harus dibuat dulu karena menjadi foreign key di siswa dan guru
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->string('jurusan');
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['admin', 'guru', 'siswas'])->default('siswas');
            $table->timestamps();
        });

        // 2. siswa dan guru bergantung pada users, siswa juga bergantung ke kelas
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('nama_siswa');
            $table->string('nisn')->unique();
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });

        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('nama_guru');
            $table->string('nip')->unique();
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        // 3. mata_pelajaran bergantung ke guru
        Schema::create('mata_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mapel');
            $table->unsignedBigInteger('guru_id');
            $table->timestamps();

            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
        });

        // 4. nilai bergantung ke siswa, guru, dan mata_pelajaran
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id'); 
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->unsignedBigInteger('guru_id');
            $table->integer('nilai');
            $table->timestamps();

            $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade'); //baru
            $table->foreign('mata_pelajaran_id')->references('id')->on('mata_pelajarans')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Urutan dibalik dari yang paling akhir dibuat
        Schema::dropIfExists('nilai');
        Schema::dropIfExists('mata_pelajarans');
        Schema::dropIfExists('guru');
        Schema::dropIfExists('siswas');
        Schema::dropIfExists('users');
        Schema::dropIfExists('kelas');
    }
};
