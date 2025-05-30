<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Sensei',
            'email' => 'sensei@teacher.edu',
            'password' => Hash::make('cunny132'),
            'role' => 'admin',
            'nik' => '1234567890123456',
            'telp' => '081234567890'
        ]);

        User::create([
            'name' => 'Sunaookami Shiroko',
            'email' => 'sunaookamishiroko@abydos.sch',
            'password' => Hash::make('shirokoiwak'),
            'role' => 'masyarakat',
            'nik' => '6543210987654321',
            'telp' => '089876543210'
        ]);
    }
}
