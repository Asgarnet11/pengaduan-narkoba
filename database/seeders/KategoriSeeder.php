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
            ['nama' => 'sabu-sabu', 'deskripsi' => 'Pengaduan terkait penyalahgunaan sabu-sabu'],
            ['nama' => 'narkoba', 'deskripsi' => 'Pengaduan terkait penyalahgunaan narkoba'],
            ['nama' => 'obat terlarang', 'deskripsi' => 'Pengaduan terkait obat-obatan terlarang'],
            ['nama' => 'minuman keras', 'deskripsi' => 'Pengaduan terkait minuman keras'],
            ['nama' => 'perjudian', 'deskripsi' => 'Pengaduan terkait perjudian'],
            ['nama' => 'senjata api', 'deskripsi' => 'Pengaduan terkait kepemilikan senjata api ilegal'],
            ['nama' => 'senjata tajam', 'deskripsi' => 'Pengaduan terkait kepemilikan senjata tajam ilegal'],
            ['nama' => 'pencurian', 'deskripsi' => 'Pengaduan terkait pencurian atau perampokan'],
            ['nama' => 'kekerasan dalam rumah tangga', 'deskripsi' => 'Pengaduan terkait kekerasan dalam rumah tangga'],
            ['nama' => 'kekerasan seksual', 'deskripsi' => 'Pengaduan terkait kekerasan seksual'],
            ['nama' => 'ganja', 'deskripsi' => 'Pengaduan terkait infrastruktur umum'],

        ];

        foreach ($kategori as $item) {
            Kategori::create($item);
        }
    }
}
