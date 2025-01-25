<?php

namespace Database\Seeders;

use App\Models\SiswaData;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userAkun =  User::create([
            'name' => 'Siswa User',
            'username' => '123456789',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('siswa123'),
            'role' => 'Siswa',
            'last_login_at' => now(),
        ]);

        SiswaData::create([
            'class' => 'X IPA 1',
            'gender' => 'L',
            'user_id' => $userAkun->id,
        ]);
    }
}
