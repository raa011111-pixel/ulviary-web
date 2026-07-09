# ☁️ Panduan Deploy Ke InfinityFree - Ulviary

Layanan hosting gratis **InfinityFree** membatasi struktur direktori di mana semua berkas proyek web Anda wajib berada langsung di dalam folder `/htdocs/` (tidak bisa diakses di luarnya). 

Proyek **Ulviary** telah dikonfigurasi khusus agar tetap kompatibel dengan batasan ini secara aman dan dinamis. Berikut langkah demi langkah deployment-nya:

---

## 💾 1. Impor Database ke InfinityFree
1. Masuk ke **Control Panel** akun InfinityFree Anda.
2. Buat database MySQL baru (misalnya: `if0_41968298_ulviary`).
3. Catat detail koneksi MySQL yang ditampilkan (Host, Port, User, Database Name).
4. Buka **phpMyAdmin** database tersebut di InfinityFree.
5. Impor berkas cadangan database [ulviary.sql](ulviary.sql) yang terletak di root folder proyek ini.

---

## 🔑 2. Konfigurasi Lingkungan (.env)
Aplikasi ini mendukung **Dual-Environment Detection** sehingga Anda tidak perlu merusak konfigurasi lokal di `.env` Anda. Cukup tambahkan kredensial InfinityFree Anda pada baris konfigurasi produksi di `.env`:

```env
# Database Konfigurasi untuk Hosting Live (InfinityFree)
# Otomatis digunakan jika diakses via domain internet/live
DB_HOST_PROD=sql212.infinityfree.com
DB_PORT_PROD=3306
DB_DATABASE_PROD=if0_41968298_ulviary
DB_USERNAME_PROD=if0_41968298
DB_PASSWORD_PROD=SANDI_MYSQL_INFINITYFREE_ANDA
```
*Sistem Laravel akan secara otomatis memakai settingan `PROD` ini jika dideteksi diakses dari domain non-localhost (seperti domain `is-best.net` Anda).*

---

## 📦 3. Kompilasi Aset Frontend
Sebelum diunggah via FTP, Anda wajib mengompilasi berkas JavaScript dan CSS terlebih dahulu secara lokal:
```bash
npm run build
```
Langkah ini akan memaketkan Tailwind CSS v4 ke folder `public/build/` agar siap dijalankan oleh server web InfinityFree.

---

## 📤 4. Unggah Berkas via FTP (FileZilla)
1. Buka aplikasi client FTP Anda (misalnya **FileZilla**).
2. Sambungkan dengan detail akun FTP InfinityFree Anda.
3. Masuk ke direktori **/htdocs/** di server hosting.
4. **Unggah seluruh isi folder proyek Ulviary** (seperti folder `app`, `config`, `public`, `vendor`, `.env`, `.htaccess`, dan file root lainnya) langsung ke dalam folder `/htdocs/`.
5. Pastikan semua file terunggah dengan sempurna.

> [!IMPORTANT]
> **Mengatasi Error "Composer dependencies require a PHP version..."**
>
> Jika setelah mengunggah Anda menemui error platform check dari Composer di browser, hal itu dikarenakan adanya perbedaan versi PHP local Anda (misal PHP 8.5) dengan versi PHP server InfinityFree Anda (misal PHP 8.2).
>
> Kami telah **menonaktifkan platform-check** secara default di berkas `composer.json` proyek ini. Silakan jalankan `composer install` sekali lagi pada komputer lokal Anda, kemudian **unggah ulang folder `vendor/`** Anda ke direktori `/htdocs/` di server hosting. Autoloader baru akan melewati pemeriksaan versi PHP secara otomatis!

---

## 🔒 5. Penjelasan Mengenai Folder & Keamanan

### A. Pengalihan URL via `.htaccess`
Di root direktori telah disiapkan berkas `.htaccess`:
```htaccess
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```
File ini bertugas mengalihkan semua lalu lintas domain utama secara transparan langsung menuju folder `/public/`. Anda **tidak perlu** repot memindahkan file-file di dalam folder `public` ke luar. Cukup biarkan struktur asli Laravel tetap utuh.

### B. Penyimpanan File Gambar (Uploads)
InfinityFree memblokir fungsi pembuatan symbolic link (`php artisan storage:link`). Untuk mengatasi hal ini, sistem manajemen file Ulviary (foto profil avatar, thumbnail artikel, dan gambar galeri) telah dikonfigurasi untuk **menyimpan langsung secara fisik** ke dalam direktori:
📁 `public/uploads/` (di hosting akan terbaca sebagai `/htdocs/public/uploads/`)

Dengan demikian, seluruh media yang diunggah oleh Admin dan Blogger akan langsung terakses ke browser publik secara instan tanpa memicu error tautan rusak!
