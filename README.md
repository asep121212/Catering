<p align="center"> <a href="https://laravel.com" target="_blank"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"> </a> </p> <p align="center"> <a href="#"><img src="https://img.shields.io/badge/Project-Marketplace%20Katering-blue" alt="Marketplace Katering"></a> <a href="#"><img src="https://img.shields.io/badge/Status-Active-green" alt="Project Status"></a> <a href="#"><img src="https://img.shields.io/badge/License-MIT-green" alt="License"></a> </p>
📌 Deskripsi Proyek
Marketplace Katering adalah aplikasi web berbasis Laravel yang menjadi platform untuk menghubungkan perusahaan katering (merchant) dengan kantor/perusahaan yang ingin memesan makanan untuk karyawan.

Tujuan utama aplikasi ini adalah memudahkan transaksi, manajemen menu, pemesanan, dan pembuatan invoice secara digital, dengan antarmuka intuitif dan responsif.

Customer
Emai : customer@test.com
Pas : password

Merchatn
Emai : merchant@test.com
Pas : password

🖥️ Fitur Aplikasi

1. Portal Merchant (Katering)

Registrasi & Login (dengan Theme Selection)

Pengelolaan Profil Merchant: nama perusahaan, alamat, kontak, deskripsi

Pengelolaan Menu: tambah, edit, hapus menu, foto, deskripsi, harga

Daftar Order & Invoice dari customer

Dashboard statistik penjualan & menu populer

Manajemen status order: pending, confirmed, delivered, cancelled

2. Portal Customer (Kantor)

Registrasi & Login (dengan Theme Selection)

Pencarian merchant berdasarkan lokasi, jenis makanan, kategori, harga, rating

Pemesanan menu: jumlah porsi & tanggal pengiriman

Akses invoice PDF yang dihasilkan sistem

Memberi review & rating setelah menerima pesanan

Notifikasi status order via email dan dashboard

🛠️ Teknologi yang Digunakan
Backend: Laravel 11 (PHP Framework)

Frontend: Blade, HTML, CSS, JavaScript

Database: MySQL / MariaDB

Authentication: Laravel Breeze / Jetstream (Login, Register, Role-based Access)

Tools & Libraries:

Laravel Eloquent ORM

Laravel Migrations

Laravel Validation

Laravel Mail

🚀 Instalasi & Setup

1. Clone repository
   git clone https://github.com/username/Catering.git
   cd Catering
2. Install dependencies
   composer install
   npm install
   npm run dev
3. Konfigurasi Environment
   cp .env.example .env
   php artisan key:generate

Edit .env sesuai konfigurasi database dan environment kamu.

4. Migrasi Database
   (Database Sql Berada di database file)
   php artisan migrate
5. Jalankan Server
   php artisan serve

Buka browser: http://localhost:8000
