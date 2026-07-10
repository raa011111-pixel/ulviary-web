<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Users
        $admin = User::create([
            'name' => 'Admin Blogger',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $author = User::create([
            'name' => 'Author Blog',
            'email' => 'author@example.com',
            'password' => bcrypt('password'),
            'role' => 'blogger',
        ]);

        // 2. Seed Categories
        $categoriesData = [
            [
                'user_id' => $admin->id,
                'name' => 'Teknologi',
                'slug' => 'teknologi',
                'description' => 'Kategori seputar teknologi, web development, gadget, dan pemrograman.',
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Edukasi',
                'slug' => 'edukasi',
                'description' => 'Materi pembelajaran, tutorial, dan edukasi bermanfaat.',
            ],
            [
                'user_id' => $author->id,
                'name' => 'Gaya Hidup',
                'slug' => 'gaya-hidup',
                'description' => 'Tips gaya hidup, traveling, dan keseharian.',
            ],
            [
                'user_id' => $author->id,
                'name' => 'Kesehatan',
                'slug' => 'kesehatan',
                'description' => 'Kategori tentang kesehatan fisik, mental, dan tips medis.',
            ],
            [
                'user_id' => $admin->id,
                'name' => 'Kuliner',
                'slug' => 'kuliner',
                'description' => 'Resep makanan, review restoran, dan kuliner nusantara.',
            ],
        ];

        $categories = [];
        foreach ($categoriesData as $cData) {
            $categories[] = Category::create($cData);
        }

        // 3. Seed Articles
        $articlesData = [
            [
                'user_id' => $admin->id,
                'category_id' => $categories[0]->id, // Teknologi
                'title' => 'Belajar Laravel untuk Pemula',
                'content' => '<h1>Belajar Laravel 11/12/13</h1><p>Laravel adalah salah satu framework PHP yang paling populer di dunia saat ini. Framework ini menawarkan sintaksis yang elegan, dokumentasi yang kaya, dan ekosistem yang luas untuk membantu pengembang membangun aplikasi web modern dengan cepat dan aman.</p><p>Dalam artikel ini, kita akan membahas dasar-dasar MVC di Laravel, routing, controller, database migrations, dan bagaimana membuat tampilan sederhana menggunakan Blade Templating Engine.</p>',
                'thumbnail' => null,
                'status' => 'published',
            ],
            [
                'user_id' => $admin->id,
                'category_id' => $categories[0]->id, // Teknologi
                'title' => 'Masa Depan Web Development dengan Tailwind CSS',
                'content' => '<h1>Revolusi Tailwind CSS</h1><p>Tailwind CSS telah mengubah cara developer mendesain situs web. Dengan konsep utility-first, Anda tidak perlu lagi menulis ribuan baris CSS manual atau membuat class-class custom yang membingungkan.</p><p>Versi terbaru Tailwind CSS membawa peningkatan performa yang luar biasa melalui engine baru, integrasi langsung dengan Vite, serta konfigurasi berbasis CSS yang lebih modular.</p>',
                'thumbnail' => null,
                'status' => 'published',
            ],
            [
                'user_id' => $author->id,
                'category_id' => $categories[2]->id, // Gaya Hidup
                'title' => '5 Tips Produktivitas Saat Bekerja dari Rumah',
                'content' => '<h1>Work From Home yang Produktif</h1><p>Bekerja dari rumah (WFH) menawarkan fleksibilitas yang tinggi, tetapi juga menyimpan banyak distraksi. Berikut adalah 5 tips penting untuk menjaga produktivitas:</p><ul><li>Tetapkan jam kerja yang konsisten.</li><li>Buat ruang kerja khusus yang nyaman.</li><li>Gunakan teknik Pomodoro untuk manajemen waktu.</li><li>Batasi penggunaan media sosial saat bekerja.</li><li>Sempatkan beristirahat secara berkala untuk menjaga fokus.</li></ul>',
                'thumbnail' => null,
                'status' => 'published',
            ],
            [
                'user_id' => $author->id,
                'category_id' => $categories[3]->id, // Kesehatan
                'title' => 'Pentingnya Menjaga Pola Tidur Teratur',
                'content' => '<h1>Kunci Kesehatan: Tidur Cukup</h1><p>Tidur berkualitas adalah pilar utama kesehatan selain makanan bergizi dan olahraga. Tidur yang cukup (7-8 jam per hari untuk dewasa) membantu regenerasi sel-sel tubuh, meningkatkan kekebalan tubuh, serta menjaga kesehatan mental dan emosional Anda.</p><p>Kurang tidur secara kronis dapat memicu berbagai penyakit berbahaya seperti penyakit jantung, diabetes, dan obesitas.</p>',
                'thumbnail' => null,
                'status' => 'published',
            ],
            [
                'user_id' => $admin->id,
                'category_id' => $categories[4]->id, // Kuliner
                'title' => 'Resep Nasi Goreng Spesial Rumahan',
                'content' => '<h1>Nasi Goreng Lezat & Praktis</h1><p>Nasi goreng adalah kuliner khas Indonesia yang dicintai semua kalangan. Cara membuatnya sangat mudah dengan bumbu-bumbu dapur sederhana seperti bawang merah, bawang putih, cabai, kecap manis, garam, dan telur.</p><p>Anda juga bisa menambahkan suwiran ayam, bakso, sosis, atau sayuran pelengkap agar nasi goreng buatan Anda semakin spesial dan bergizi.</p>',
                'thumbnail' => null,
                'status' => 'published',
            ],
            [
                'user_id' => $admin->id,
                'category_id' => $categories[1]->id, // Edukasi
                'title' => 'Tips Belajar Pemrograman Secara Otodidak',
                'content' => '<h1>Menjadi Programmer Otodidak</h1><p>Belajar pemrograman secara mandiri membutuhkan kedisiplinan yang tinggi. Tentukan bahasa pemrograman yang ingin dipelajari, pilih roadmap yang tepat, dan mulailah membangun proyek-proyek kecil untuk menguji pemahaman Anda secara langsung.</p>',
                'thumbnail' => null,
                'status' => 'draft', // DRAFT - should not appear on public home
            ],
        ];

        $articles = [];
        foreach ($articlesData as $aData) {
            $articles[] = Article::create($aData);
        }

        // 4. Seed Comments
        Comment::create([
            'article_id' => $articles[0]->id, // Belajar Laravel
            'name' => 'Budi Santoso',
            'content' => 'Artikel yang sangat bermanfaat untuk pemula seperti saya! Penjelasannya sangat jelas.',
        ]);

        Comment::create([
            'article_id' => $articles[0]->id, // Belajar Laravel
            'name' => 'Siti Aminah',
            'content' => 'Sangat setuju! Laravel mempermudah pengerjaan proyek web skala besar.',
        ]);

        Comment::create([
            'article_id' => $articles[1]->id, // Tailwind CSS
            'name' => 'Rian Hidayat',
            'content' => 'Tailwind memang keren banget, bikin pengerjaan UI jadi jauh lebih cepat!',
        ]);
    }
}
