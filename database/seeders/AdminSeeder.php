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
            'name' => 'masyarakat',
            'email' => 'masyarakat@silapor.id',
            'password' => Hash::make('masyarakat123'),
            'role' => 'admin',
            'nik' => '1234567890123457',
            'telp' => '081234567890'
        ]);

        User::create([
            'name' => 'asgar fatwahyudi',
            'email' => 'asgarganteng@silapor.id',
            'password' => Hash::make('asgar123'),
            'role' => 'masyarakat',
            'nik' => '6543210987654322',
            'telp' => '089876543210'
        ]);
    }
}
