# SIKAPI - Sinkronisasi Kebijakan dan Aspirasi Publik

SIKAPI adalah platform berbasis web yang memungkinkan kementerian/pemerintah untuk mempublikasikan rancangan kebijakan (RUU/Peraturan) dan memfasilitasi diskusi dua arah antara pakar hukum dan masyarakat umum.

## Stack Teknologi
- Framework: Laravel 12
- UI: Tailwind CSS v4 + Alpine.js
- Admin Panel: Filament v3
- Database: MySQL 8.0
- Environment: Docker

---

## Cara Run Dengan Docker

Ikuti langkah-langkah di bawah ini untuk menjalankan development environment menggunakan Docker:

1. Persiapan File Environment
Salin file .env.example menjadi .env dan pastikan konfigurasi database sesuai dengan docker-compose.yml.

Perintah: cp .env.example .env

Sesuaikan bagian database di file .env sebagai berikut:
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sikapi
DB_USERNAME=sikapi_user
DB_PASSWORD=password

2. Jalankan Kontainer
Gunakan Docker Compose untuk membangun dan menjalankan layanan:
docker-compose up -d

3. Migrasi Database
Setelah kontainer berjalan, jalankan migrasi untuk menyiapkan tabel:
docker-compose exec app php artisan migrate

4. Menjalankan Frontend (Tailwind v4)
Untuk melihat perubahan desain secara real-time, jalankan Vite:
docker-compose exec app npm run dev

---

## Akses Panel Pemerintah (Filament)

Panel ini digunakan oleh kementerian untuk membuat thread kebijakan publik dan mengelola konten.

- URL: http://localhost:8000/admin
- Email: admin@sikapi.go.id
- Password: admin123

Note: Jika user di atas belum ada di database lokalmu, buat secara manual dengan perintah:
docker-compose exec app php artisan make:filament-user