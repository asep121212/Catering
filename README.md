<p align="center"> <a href="https://laravel.com" target="_blank"> <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"> </a> </p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>
About the Project

Katering adalah aplikasi web berbasis Laravel yang menjadi platform untuk menghubungkan merchant katering dengan perusahaan/kantor yang ingin memesan makanan untuk karyawan.

Aplikasi ini memiliki dua portal utama:

1. Portal Merchant (Katering)

Registrasi & login merchant.

Pengelolaan profil merchant: nama perusahaan, alamat, kontak, deskripsi.

Pengelolaan menu makanan: tambah, edit, hapus, foto, deskripsi, harga, kategori, stok.

Melihat daftar order dan invoice dari customer.

Dashboard statistik penjualan dan menu terpopuler.

Manajemen status order: pending, confirmed, delivered, cancelled.

2. Portal Customer (Kantor)

Registrasi & login customer.

Pencarian merchant berdasarkan lokasi, jenis makanan, kategori, harga, atau rating.

Pemesanan menu: jumlah porsi dan tanggal pengiriman.

Riwayat pemesanan dan akses invoice dalam format PDF.

Memberi rating & review setelah menerima pesanan.

Notifikasi via email dan dashboard untuk status order.

Technologies Used

Backend: Laravel (PHP Framework)

Frontend: Blade Templates, HTML, CSS, JavaScript

Database: MySQL / MariaDB

Authentication & Security: Laravel Breeze / Jetstream (login, register, role-based access)

Version Control: Git + GitHub

Dependency Management: Composer

Tools & Libraries:

Laravel Eloquent ORM (database)

Laravel Migrations (manajemen skema database)

Laravel Validation (form input)

Laravel Mail (notifikasi/email)

Laravel Cashier / Midtrans / Stripe (opsional untuk pembayaran online)

Main Features

Secure login & registration with email verification and reset password.

Role-based access: merchant vs customer.

Menu & kategori management, termasuk stok atau kapasitas makanan.

Filter & sorting menu untuk customer.

Review & rating merchant oleh customer.

Dashboard statistik untuk merchant.

Manajemen invoice PDF.

Status order: pending, confirmed, delivered, cancelled.

Responsif di desktop & mobile.

Validasi form & proteksi input untuk keamanan.

Database Structure (Relasi Utama)

users → role: merchant / customer

merchants → relasi 1-1 dengan users

menus → relasi 1-N dengan merchant

orders → relasi N-N dengan menu (pivot table: order_items)

invoices → relasi 1-1 dengan order

reviews → relasi 1-N dengan merchant

Installation / Setup

Clone repository:

git clone https://github.com/username/marketplace-katering.git
cd marketplace-katering

Install dependencies:

composer install
npm install
npm run dev

Konfigurasi environment:

cp .env.example .env
php artisan key:generate

Edit file .env sesuai konfigurasi database dan environment kamu.

Migrasi database:

php artisan migrate

Jalankan server Laravel:

php artisan serve

Buka browser: http://localhost:8000
