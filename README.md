<p align="center"><strong> SISTEM MANAJEMEN DATA SEKOLAH</strong></p>

<div align="center">

![logo_unsulbar](public/logo.jpg)



<b>Rahwan</b><br>
<b>D0222005</b><br>
<b>Framework Web Based</b><br>
<b>2025</b>
</div>


| Role      | Hak Akses                                                                                                                     |
| --------- | ------------------------------------------------------------------------------------------------------------------------------- |
| **Admin** | - Kelola data siswa, guru, kelas, mata pelajaran dan nilai<br>- Tambah/edit/hapus nilai siswa<br>- Akses penuh ke semua halaman |
| **Guru**  | - Lihat dan kelola data nilai siswa sesuai mapel yang diampu<br>- Tambah/edit/hapus nilai                                       |
| **Siswa** | - Melihat nilai miliknya sendiri<br>- Mengetahui status kelulusan (lulus/tidak lulus)                                           |





Tabel-tabel database beserta field dan tipe datanya

1. tabel kelas

| Field       | Tipe Data     | Keterangan                      |
| ----------- | ------------- | ------------------------------- |
| id          | bigint (auto) | Primary Key                     |
| nama\_kelas | string        | Nama kelas (contoh: X IPA 1)    |
| jurusan     | string        | Jurusan kelas (contoh: IPA/IPS) |
| created\_at | timestamp     | Waktu dibuat                    |
| updated\_at | timestamp     | Waktu diperbarui                |


2. tabel users

| Field       | Tipe Data       | Keterangan             |
| ----------- | --------------- | ---------------------- |
| id          | bigint (auto)   | Primary Key            |
| name        | string          | Nama pengguna          |
| email       | string (unique) | Email unik untuk login |
| password    | string          | Password (hashed)      |
| role        | enum            | admin / guru / siswas  |
| created\_at | timestamp       | Waktu dibuat           |
| updated\_at | timestamp       | Waktu diperbarui       |


3. tabel siswas

| Field       | Tipe Data         | Keterangan                 |
| ----------- | ----------------- | -------------------------- |
| id          | bigint (auto)     | Primary Key                |
| user\_id    | unsignedBigInt    | Relasi ke `users(id)`      |
| kelas\_id   | unsignedBigInt    | Relasi ke `kelas(id)`      |
| nama\_siswa | string            | Nama lengkap siswa         |
| nisn        | string (unique)   | Nomor Induk Siswa Nasional |
| alamat      | string (nullable) | Alamat siswa               |
| created\_at | timestamp         | Waktu dibuat               |
| updated\_at | timestamp         | Waktu diperbarui           |

---------------
4. tabel gurus
---------------
| Field       | Tipe Data         | Keterangan            |
| ----------- | ----------------- | --------------------- |
| id          | bigint (auto)     | Primary Key           |
| user\_id    | unsignedBigInt    | Relasi ke `users(id)` |
| nama\_guru  | string            | Nama lengkap guru     |
| nip         | string (unique)   | Nomor Induk Pegawai   |
| alamat      | string (nullable) | Alamat guru           |
| created\_at | timestamp         | Waktu dibuat          |
| updated\_at | timestamp         | Waktu diperbarui      |


5. tabel mata_pelajarans

| Field       | Tipe Data      | Keterangan           |
| ----------- | -------------- | -------------------- |
| id          | bigint (auto)  | Primary Key          |
| nama\_mapel | string         | Nama mata pelajaran  |
| guru\_id    | unsignedBigInt | Relasi ke `guru(id)` |
| created\_at | timestamp      | Waktu dibuat         |
| updated\_at | timestamp      | Waktu diperbarui     |



6. tabel nilai 

| Field               | Tipe Data      | Keterangan                      |
| ------------------- | -------------- | ------------------------------- |
| id                  | bigint (auto)  | Primary Key                     |
| siswa_id            | unsignedBigInt | Relasi ke `siswas(id)`          |
| kelas\_id           | unsignedBigInt | Relasi ke `kelas(id)`           |
| mata\_pelajaran\_id | unsignedBigInt | Relasi ke `mata_pelajarans(id)` |
| guru\_id            | unsignedBigInt | Relasi ke `guru(id)`            |
| nilai               | integer        | Nilai ujian siswa               |
| created\_at         | timestamp      | Waktu dibuat                    |
| updated\_at         | timestamp      | Waktu diperbarui                |


Jenis relasi dan tabel yang bereklasi

| No | Tabel 1           | Tabel 2           | Jenis Relasi | Foreign Key                                    | Keterangan                                      |
| -- | ----------------- | ----------------- | ------------ | ---------------------------------------------- | ----------------------------------------------- |
| 1  | `users`           | `siswas`          | One-to-One   | `siswas.user_id → users.id`                    | Setiap siswa terhubung ke satu user             |
| 2  | `users`           | `guru`            | One-to-One   | `guru.user_id → users.id`                      | Setiap guru terhubung ke satu user              |
| 3  | `kelas`           | `siswas`          | One-to-Many  | `siswas.kelas_id → kelas.id`                   | Satu kelas bisa memiliki banyak siswa           |
| 4  | `guru`            | `mata_pelajarans` | One-to-Many  | `mata_pelajarans.guru_id → guru.id`            | Satu guru bisa mengampu beberapa mata pelajaran |
| 5  | `siswas`          | `nilai`           | One-to-Many  | `nilai.siswa_id → siswas.id`                   | Satu siswa bisa memiliki banyak nilai           |
| 6  | `kelas`           | `nilai`           | One-to-Many  | `nilai.kelas_id → kelas.id`                    | Nilai dikaitkan juga dengan kelas siswa         |
| 7  | `mata_pelajarans` | `nilai`           | One-to-Many  | `nilai.mata_pelajaran_id → mata_pelajarans.id` | Nilai dikaitkan dengan mata pelajaran tertentu  |
| 8  | `guru`            | `nilai`           | One-to-Many  | `nilai.guru_id → guru.id`                      | Guru yang memberikan nilai                      |



