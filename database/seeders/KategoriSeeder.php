<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['nama' => 'Infrastruktur', 'deskripsi' => 'Pengaduan terkait infrastruktur umum'],
            ['nama' => 'Kesehatan', 'deskripsi' => 'Pengaduan terkait layanan kesehatan'],
            ['nama' => 'Pelayanan', 'deskripsi' => 'Pengaduan terkait pelayanan publik'],
            ['nama' => 'Keamanan', 'deskripsi' => 'Pengaduan terkait keamanan dan ketertiban'],
            ['nama' => 'Lingkungan', 'deskripsi' => 'Pengaduan terkait lingkungan hidup'],
            ['nama' => 'Pendidikan', 'deskripsi' => 'Pengaduan terkait pendidikan'],
            ['nama' => 'Ekonomi', 'deskripsi' => 'Pengaduan terkait perekonomian'],
            ['nama' => 'Kebersihan', 'deskripsi' => 'Pengaduan terkait kebersihan'],
            ['nama' => 'Fasilitas Umum', 'deskripsi' => 'Pengaduan terkait fasilitas umum'],
            ['nama' => 'Lainnya', 'deskripsi' => 'Pengaduan lainnya'],
        ];

        foreach ($kategori as $item) {
            Kategori::create($item);
        }
    }
}
