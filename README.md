# Sistem Pengaduan Masyarakat

Aplikasi web modern untuk mengelola dan memproses pengaduan masyarakat secara efektif, transparan, dan responsif. Dibangun menggunakan Laravel 12, Tailwind CSS, dan Alpine.js.

## ✨ Fitur Utama

-   🔐 Autentikasi multi-level (Admin & Masyarakat)
-   📝 Pembuatan & pengelolaan pengaduan
-   🏷️ Kategorisasi pengaduan
-   💬 Sistem tanggapan & diskusi
-   🔍 Pencarian pengaduan real-time
-   📊 Dashboard admin untuk monitoring
-   👤 Manajemen profil dengan foto
-   📱 Responsive design & animasi modern

## 🚀 Teknologi yang Digunakan

-   PHP 8.2 atau lebih tinggi
-   Laravel 12
-   Tailwind CSS
-   Alpine.js
-   MySQL/SQLite
-   GSAP (Animasi)

## ⚙️ Prasyarat

Pastikan sistem Anda telah terpasang:

-   PHP >= 8.2
-   Composer
-   Node.js & NPM
-   MySQL/SQLite
-   Git

## 🛠️ Instalasi

1. **Clone repositori**

    ```bash
    git clone https://github.com/AndraZero121/pengaduan-masyarakat.git
    cd pengaduan-masyarakat
    ```

2. **Install dependencies PHP**

    ```bash
    composer install
    ```

3. **Install dependencies JavaScript**

    ```bash
    npm install
    ```

4. **Salin file environment**

    ```bash
    cp .env.example .env
    ```

5. **Generate application key**

    ```bash
    php artisan key:generate
    ```

6. **Konfigurasi database** di file `.env`

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pengaduan_masyarakat
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. **Jalankan migrasi & seeder**

    ```bash
    php artisan migrate --seed
    ```

8. **Buat symbolic link untuk storage**

    ```bash
    php artisan storage:link
    ```

9. **Compile assets**

    ```bash
    npm run build
    ```

10. **Jalankan server**
    ```bash
    composer run dev
    ```

## 👤 Akun Default

### Admin

-   Email: sensei@teacher.edu
-   Password: cunny123

### Masyarakat

-   Email: sunaookamishiroko@abydos.sch
-   Password: shirokoiwak

## 🗂️ Struktur Pengaduan

Setiap pengaduan memiliki:

-   Judul
-   Isi pengaduan
-   Kategori
-   Status (terkirim/diproses/selesai/ditolak)
-   Lampiran foto (opsional)
-   Tanggapan dari admin & masyarakat

## 📁 Struktur Folder

-   `app/` - Kode backend (Controller, Model, Middleware)
-   `resources/views/` - Blade template (UI/UX)
-   `public/` - Aset publik & entry point aplikasi
-   `routes/` - Definisi routing aplikasi
-   `database/` - Migrasi, seeder, dan factory
-   `config/` - Konfigurasi aplikasi
-   `tests/` - Unit & feature test

## 🧪 Testing

Jalankan seluruh pengujian dengan:

```bash
php artisan test
```

## 📜 Lisensi

Project ini dilisensikan di bawah [MIT License](LICENSE).

## 🤝 Kontribusi

Kontribusi sangat terbuka! Untuk perubahan besar, silakan buka issue terlebih dahulu untuk diskusi.
