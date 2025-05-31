<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Nadia Maghdalena',
            'npm' => '2308107010040',
            'jurusan' => 'Teknik Informatika',
            'email' => 'nad@gmail.com',
            'password' => Hash::make('Nadia21@'),
        ]);

        User::create([
            'name' => 'Na Jaemin',
            'npm' => '2308107010001',
            'jurusan' => 'Sistem Informasi',
            'email' => 'jaemin@gmail.com',
            'password' => Hash::make('Jaemin13@'),
        ]);
    }
}
