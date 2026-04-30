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
```bash
cp .env.example .env
```

Sesuaikan bagian database di file .env sebagai berikut:
```bash
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=sikapi
DB_USERNAME=sikapi_user
DB_PASSWORD=password
```

2. Jalankan Kontainer
Gunakan Docker Compose untuk membangun dan menjalankan layanan:
```bash
docker-compose up -d
```

3. Migrasi Database
Setelah kontainer berjalan, jalankan migrasi untuk menyiapkan tabel:
```bash
docker-compose exec app php artisan migrate:fresh --seed
```

4. Menjalankan Frontend (Tailwind v4)
Untuk melihat perubahan desain secara real-time, jalankan Vite:
```bash
docker-compose exec app npm run dev
```

---

## Akun Pengujian

Aplikasi SIKAPI memiliki beberapa level akses. Jika Anda sudah menjalankan perintah `migrate:fresh --seed`, akun-akun di bawah ini sudah tersedia secara otomatis untuk pengujian:

### 1. Super Admin (Akses Penuh Panel Filament)
Digunakan untuk mengelola seluruh data platform.
- **URL Login:** http://localhost:8000/admin
- **Email:** admin@sikapi.go.id
- **Password:** password

### 2. Admin Kementerian / Instansi
Digunakan oleh perwakilan kementerian untuk merilis dan memantau kebijakan instansi mereka.
- **Email:** admin.kemenkes@sikapi.go.id
- **Password:** password

### 3. Pakar Hukum Terverifikasi
Akun publik dengan badge "Pakar" yang diizinkan untuk berdiskusi di Ruang Pakar.
- **Nama:** Dr. Budi Santoso, S.H., M.H.
- **Email:** budi.santoso@gmail.id
- **Password:** password

### 4. Warga / Masyarakat Umum
Akun publik standar untuk memberikan dukungan (vote) dan berdiskusi di Ruang Publik.
- **Nama:** Siti Aminah
- **Email:** siti.aminah@gmail.id
- **Password:** password

- **Nama:** Fazril Syaveral Hillaby
- **Email:** fazril@sikapi.go.id
- **Password:** password

---

Note: Jika user di atas belum ada di database lokalmu, buat secara manual dengan perintah:
```bash
docker-compose exec app php artisan db:seed
```