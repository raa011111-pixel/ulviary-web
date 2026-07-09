# 🌷 Ulviary - Ruang Berbagi Inspirasi

Ulviary adalah aplikasi web berbasis blog premium yang didesain secara estetis dan responsif untuk berbagi gagasan, opini, dan cerita menarik. Proyek ini dibangun menggunakan **Laravel 13**, **Tailwind CSS v4**, dan **Alpine.js**.

---

## 🚀 Fitur Utama
1. **Desain Visual Premium**: Menggunakan tema soft pastel pink, font modern (Instrument Sans & Playfair Display), transisi halus, dan tata letak responsif (mobile-friendly).
2. **Sistem Peran (Role-based Access)**:
   - **Admin**: Akses penuh untuk mengelola artikel, kategori, pengguna (Kelola Pengguna), dan Branding Web.
   - **Blogger**: Akses untuk menulis, menyunting, dan menghapus artikel & kategori milik mereka sendiri.
3. **Interactive Avatar (Profile Picture)**: Dukungan unggah foto profil dengan live preview instan menggunakan Alpine.js.
4. **Unified Media Carousel**: Slider gambar interaktif yang menggabungkan gambar thumbnail dan galeri (hingga 5 media) dengan auto-slide looping, zoom lightbox, dan display aspect-ratio tanpa terpotong (`object-contain`).
5. **Branding Web Dinamis**: Admin dapat mengganti Logo web dan Favicon tab browser secara langsung dari dashboard.
6. **Toast & Modals System**: Interaksi humanis menggunakan modal konfirmasi hapus kustom dan notifikasi toast mengambang untuk penambahan, pembaruan, dan validasi kesalahan.

---

## 💻 Cara Menjalankan di Localhost

### Prasyarat System
- PHP >= 8.5
- Composer
- Node.js & NPM
- MySQL/MariaDB (melalui XAMPP/Laragon)

---

### Opsi A: Instalasi Otomatis (Menggunakan PowerShell Script)

Jika Anda menggunakan Windows, Anda dapat menyiapkan seluruh proyek secara otomatis dengan satu perintah:

1. Buka **PowerShell** di root folder proyek ini (`c:\xampp\htdocs\Ulviary`).
2. Jalankan script setup otomatis:
   ```powershell
   .\install.ps1
   ```
3. *Catatan*: Jika terdapat kebijakan pembatasan eksekusi script pada sistem Anda, jalankan dahulu perintah berikut sebelum mengeksekusi script:
   ```powershell
   Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
   ```
4. Selesai! Anda tinggal menjalankan `php artisan serve` untuk membukanya.

---

### Opsi B: Instalasi Manual

Jika Anda ingin mengonfigurasinya satu per satu:

1. Buat database baru bernama `ulviary` di phpMyAdmin lokal Anda.
2. Salin berkas lingkungan `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
3. Buka file `.env` dan konfigurasikan detail database lokal Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
4. Instal paket dependensi PHP dan Node.js:
   ```bash
   composer install
   npm install
   ```
5. Buat Application Key baru:
   ```bash
   php artisan key:generate
   ```
6. Jalankan migrasi tabel beserta database seeder:
   ```bash
   php artisan migrate --seed
   ```
7. Kompilasi aset Frontend untuk lingkungan produksi/lokal:
   ```bash
   npm run build
   ```
8. Jalankan server lokal Laravel:
   ```bash
   php artisan serve
   ```
9. Buka browser Anda dan akses: `http://127.0.0.1:8000`.

---

### 👥 Akun Demo Default (Seeder)
- **Akun Admin**:
  - Email: `khaira@admin.com`
  - Sandi: `password`
- **Akun Blogger**:
  - Email: `wita@gmail.com`
  - Sandi: `password`

---

## ☁️ Panduan Deploy Hosting
Untuk panduan langkah-demi-langkah mengenai tata cara mengunggah dan mengonfigurasi website ini ke layanan hosting gratis **InfinityFree**, silakan baca dokumen terpisah:
👉 **[Panduan Deployment InfinityFree](DEPLOYMENT.md)**
