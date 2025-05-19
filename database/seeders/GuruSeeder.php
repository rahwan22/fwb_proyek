<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run()
    {
        $gurus = [
            [
                'name' => 'Guru 1',
                'email' => 'guru1@example.com',
                'password' => 'pasw12233',
                'nama_guru' => 'Rahwan, S.kom',
                'nip' => '1987654321',
                'alamat' => 'Jl. Guru No. 1',
            ],
            [
                'name' => 'Guru 2',
                'email' => 'guru2@example.com',
                'password' => 'pasw333333',
                'nama_guru' => 'Sri Maharani, S.kom',
                'nip' => '11111111111',
                'alamat' => 'Jl. Guru No. 2',
            ],
            [
                'name' => 'Guru 3',
                'email' => 'guru3@example.com',
                'password' => 'pasq222222',
                'nama_guru' => 'Caca, S.kom',
                'nip' => '2222222222',
                'alamat' => 'Jl. Guru No. 3',
            ],
        ];

        foreach ($gurus as $data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // ini yang bikin hash bcrypt
                'role' => 'guru',
            ]);

            Guru::create([
                'user_id' => $user->id,
                'nama_guru' => $data['nama_guru'],
                'nip' => $data['nip'],
                'alamat' => $data['alamat'],
            ]);
        }
    }
}
