# 🌷 Ulviary - Automated Setup Script
# Run this script in PowerShell to configure the project automatically.

Write-Host " tulip: Memulai instalasi otomatis Ulviary..." -ForegroundColor Cyan

# 1. Check for .env file
if (-not (Test-Path ".env")) {
    Write-Host "tulip: Menyalin .env.example menjadi .env..." -ForegroundColor Yellow
    Copy-Item ".env.example" ".env"
} else {
    Write-Host "tulip: .env sudah ada, melewati penyalinan." -ForegroundColor Green
}

# 2. Run composer install
Write-Host "tulip: Menginstal dependensi PHP (Composer)..." -ForegroundColor Yellow
composer install

if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Gagal menginstal dependensi PHP via Composer." -ForegroundColor Red
    Exit 1
}

# 3. Run npm install
Write-Host "tulip: Menginstal dependensi Frontend (NPM)..." -ForegroundColor Yellow
npm install

if ($LASTEXITCODE -ne 0) {
    Write-Host "Error: Gagal menginstal dependensi Frontend via NPM." -ForegroundColor Red
    Exit 1
}

# 4. Generate app key
Write-Host "tulip: Membuat Application Key..." -ForegroundColor Yellow
php artisan key:generate

# 5. Run database migrations & seeding
Write-Host "tulip: Menjalankan migrasi dan seeding database..." -ForegroundColor Yellow
php artisan migrate --seed

if ($LASTEXITCODE -ne 0) {
    Write-Host "Peringatan: Gagal melakukan migrasi database. Pastikan database MySQL Anda menyala dan sesuai konfigurasi di .env!" -ForegroundColor Magenta
}

# 6. Build assets
Write-Host "tulip: Membangun aset frontend (Vite)..." -ForegroundColor Yellow
npm run build

Write-Host "`n tulip: Instalasi selesai sukses!" -ForegroundColor Green
Write-Host "Jalankan 'php artisan serve' dan buka http://127.0.0.1:8000 di browser Anda." -ForegroundColor Cyan
