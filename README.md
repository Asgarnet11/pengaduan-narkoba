# Sistem Pengaduan Masyarakat

Aplikasi web untuk mengelola dan memproses pengaduan masyarakat dengan mudah dan efisien. Dibangun menggunakan Laravel 12 dan Tailwind CSS.

## Fitur Utama

-   🔒 Sistem autentikasi multi-level (Admin & Masyarakat)
-   📝 Pembuatan dan pengelolaan pengaduan
-   🏷️ Kategorisasi pengaduan
-   💬 Sistem tanggapan dan diskusi
-   🔍 Pencarian pengaduan real-time
-   📊 Dashboard admin untuk monitoring
-   👤 Manajemen profil dengan foto
-   📱 Responsive design

## Teknologi yang Digunakan

-   PHP 8.2
-   Laravel 12
-   Tailwind CSS
-   Alpine.js
-   MySQL/SQLite
-   GSAP (Animasi)

## Prasyarat

Sebelum menginstal, pastikan sistem Anda memenuhi persyaratan berikut:

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/SQLite
-   Git

## Instalasi

1. Clone repositori

```bash
git clone https://github.com/AndraZero121/pengaduan-masyarakat.git
cd pengaduan-masyarakat
```

2. Install dependencies PHP

```bash
composer install
```

3. Install dependencies JavaScript

```bash
npm install
```

4. Salin file environment

```bash
cp .env.example .env
```

5. Generate application key

```bash
php artisan key:generate
```

6. Konfigurasi database di file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pengaduan_masyarakat
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

8. Buat symbolic link untuk storage

```bash
php artisan storage:link
```

9. Compile assets

```bash
npm run dev
```

10. Jalankan server

```bash
composer run dev
```

## Akun Default

### Admin

-   Email: sensei@teacher.edu
-   Password: cunny123

### Masyarakat

-   Email: sunaookamishiroko@abydos.sch
-   Password: shirokoiwak

## Struktur Pengaduan

Setiap pengaduan memiliki:

-   Judul
-   Isi pengaduan
-   Kategori
-   Status (terkirim/diproses/selesai/ditolak)
-   Lampiran foto (opsional)
-   Tanggapan dari admin dan masyarakat

## Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## Kontribusi

Kontribusi selalu diterima dengan baik. Untuk perubahan besar, harap buka issue terlebih dahulu untuk mendiskusikan perubahan yang ingin dilakukan.

## Kredit

Dibuat dengan ❤️ oleh [AndraZero121]
