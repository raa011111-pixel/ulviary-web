-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2026 at 10:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ulviary`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `status` enum('draft','published') NOT NULL DEFAULT 'draft',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `user_id`, `category_id`, `title`, `slug`, `content`, `thumbnail`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 1, 'Masa Depan Web Development dengan Tailwind CSS', 'masa-depan-web-development-dengan-tailwind-css', '<h1>Revolusi Tailwind CSS</h1><p>Tailwind CSS telah mengubah cara developer mendesain situs web. Dengan konsep utility-first, Anda tidak perlu lagi menulis ribuan baris CSS manual atau membuat class-class custom yang membingungkan.</p><p>Versi terbaru Tailwind CSS membawa peningkatan performa yang luar biasa melalui engine baru, integrasi langsung dengan Vite, serta konfigurasi berbasis CSS yang lebih modular.</p>', 'uploads/thumbnails/1783145026_6a48a242193ff.jpg', 'published', '2026-07-03 19:37:07', '2026-07-03 23:03:46'),
(3, 2, 3, '5 Tips Produktivitas Saat Bekerja dari Rumah', '5-tips-produktivitas-saat-bekerja-dari-rumah', '<h1>Work From Home yang Produktif</h1><p>Bekerja dari rumah (WFH) menawarkan fleksibilitas yang tinggi, tetapi juga menyimpan banyak distraksi. Berikut adalah 5 tips penting untuk menjaga produktivitas:</p><ul><li>Tetapkan jam kerja yang konsisten.</li><li>Buat ruang kerja khusus yang nyaman.</li><li>Gunakan teknik Pomodoro untuk manajemen waktu.</li><li>Batasi penggunaan media sosial saat bekerja.</li><li>Sempatkan beristirahat secara berkala untuk menjaga fokus.</li></ul>', NULL, 'published', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(4, 2, 4, 'Pentingnya Menjaga Pola Tidur Teratur', 'pentingnya-menjaga-pola-tidur-teratur', '<h1>Kunci Kesehatan: Tidur Cukup</h1><p>Tidur berkualitas adalah pilar utama kesehatan selain makanan bergizi dan olahraga. Tidur yang cukup (7-8 jam per hari untuk dewasa) membantu regenerasi sel-sel tubuh, meningkatkan kekebalan tubuh, serta menjaga kesehatan mental dan emosional Anda.</p><p>Kurang tidur secara kronis dapat memicu berbagai penyakit berbahaya seperti penyakit jantung, diabetes, dan obesitas.</p>', NULL, 'published', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(5, 1, 5, 'Resep Nasi Goreng Spesial Rumahan', 'resep-nasi-goreng-spesial-rumahan', '<h1>Nasi Goreng Lezat & Praktis</h1><p>Nasi goreng adalah kuliner khas Indonesia yang dicintai semua kalangan. Cara membuatnya sangat mudah dengan bumbu-bumbu dapur sederhana seperti bawang merah, bawang putih, cabai, kecap manis, garam, dan telur.</p><p>Anda juga bisa menambahkan suwiran ayam, bakso, sosis, atau sayuran pelengkap agar nasi goreng buatan Anda semakin spesial dan bergizi.</p>', NULL, 'published', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(6, 1, 2, 'Tips Belajar Pemrograman Secara Otodidak', 'tips-belajar-pemrograman-secara-otodidak', '<h1>Menjadi Programmer Otodidak</h1><p>Belajar pemrograman secara mandiri membutuhkan kedisiplinan yang tinggi. Tentukan bahasa pemrograman yang ingin dipelajari, pilih roadmap yang tepat, dan mulailah membangun proyek-proyek kecil untuk menguji pemahaman Anda secara langsung.</p>', NULL, 'draft', '2026-07-03 19:37:07', '2026-07-03 19:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `article_galleries`
--

CREATE TABLE `article_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article_galleries`
--

INSERT INTO `article_galleries` (`id`, `article_id`, `image_path`, `created_at`, `updated_at`) VALUES
(2, 2, 'uploads/galleries/1783136223_6a487fdf9053f.jpg', '2026-07-03 20:37:03', '2026-07-03 20:37:03'),
(3, 2, 'uploads/galleries/1783136223_6a487fdf912dc.jpg', '2026-07-03 20:37:03', '2026-07-03 20:37:03'),
(5, 2, 'uploads/galleries/1783136223_6a487fdf931dc.jpg', '2026-07-03 20:37:03', '2026-07-03 20:37:03'),
(6, 2, 'uploads/galleries/1783145076_6a48a274d84f9.jpg', '2026-07-03 23:04:36', '2026-07-03 23:04:36'),
(7, 2, 'uploads/galleries/1783145076_6a48a274d933d.jpg', '2026-07-03 23:04:36', '2026-07-03 23:04:36');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-admin@example.com|127.0.0.1', 'i:1;', 1783144754),
('laravel-cache-admin@example.com|127.0.0.1:timer', 'i:1783144754;', 1783144754);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Teknologi', 'teknologi', 'Kategori seputar teknologi, web development, gadget, dan pemrograman.', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(2, 1, 'Edukasi', 'edukasi', 'Materi pembelajaran, tutorial, dan edukasi bermanfaat.', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(3, 2, 'Gaya Hidup', 'gaya-hidup', 'Tips gaya hidup, traveling, dan keseharian.', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(4, 2, 'Kesehatan', 'kesehatan', 'Kategori tentang kesehatan fisik, mental, dan tips medis.', '2026-07-03 19:37:07', '2026-07-03 19:37:07'),
(5, 1, 'Kuliner', 'kuliner', 'Resep makanan, review restoran, dan kuliner nusantara.', '2026-07-03 19:37:07', '2026-07-03 19:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `article_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `name`, `content`, `created_at`, `updated_at`) VALUES
(3, 2, 'Rian Hidayat', 'Tailwind memang keren banget, bikin pengerjaan UI jadi jauh lebih cepat!', '2026-07-03 19:37:07', '2026-07-03 19:37:07');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` smallint(5) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_07_04_014235_create_categories_table', 1),
(5, '2026_07_04_014236_create_articles_table', 1),
(6, '2026_07_04_014236_create_comments_table', 1),
(7, '2026_07_04_022016_create_settings_table', 1),
(8, '2026_07_04_023452_add_role_and_avatar_to_users_table', 1),
(9, '2026_07_04_023459_create_article_galleries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('lh7DVKpmLhMonvVtBpIYXifNP4IpvLi2ZMKTo8NM', NULL, '127.0.0.1', 'Mozilla/5.0 (Linux; Android 15; Pixel 9) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Mobile Safari/537.36', 'eyJfdG9rZW4iOiJWVG1NQ0dmNDRpaVdMUklWd0lsN0wwaGJla0dXMHd1a2NUQnp5ekV5IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwXC9jb250YWN0Iiwicm91dGUiOiJwdWJsaWMuY29udGFjdCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX19', 1783154433),
('Manu52oSwEJmAWhWRQQwguXMPsGmzviijAgFhHfQ', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/149.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJFUzljbTFaNWtsMmUxalZRT2hUd3puWjJRWnlwNm5sQ2NNSU9aV3FuIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cL2xvY2FsaG9zdDo4MDAwIiwicm91dGUiOiJob21lIn0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfX0=', 1783143943),
('NGHFdjHuDlwVmqE2kUwIedfBhoROWaqbKVA2mlj0', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/150.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJnbkVPdkFMVWdQOHFRVjg2NE41TEpDdjJPYTIzdXRKRm9RaHBRQzE3IiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvbG9jYWxob3N0OjgwMDBcL3Byb2ZpbGUiLCJyb3V0ZSI6InByb2ZpbGUuZWRpdCJ9LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1783145115);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'site_name', 'Ulviary', '2026-07-03 19:48:22', '2026-07-03 19:48:22'),
(2, 'site_logo', 'uploads/branding/logo_1783144210.png', '2026-07-03 19:48:22', '2026-07-03 22:50:10'),
(3, 'site_favicon', 'uploads/branding/favicon_1783144210.png', '2026-07-03 22:50:10', '2026-07-03 22:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'blogger',
  `avatar` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Khaira Ulvi (Admin)', 'khaira@admin.com', NULL, '$2y$12$qCSWYg8i02UwX4iSiBQFH.kyGlg2PCCT7OQwnmmLVa/rGXiY4at.i', 'admin', 'uploads/avatars/1783133508_6a4875443fd3e.jpg', 'j1gyS6CqOGtpgKU61dVDDO208uUo3LPg6rL18ju7yF7fBRaPLkmJuEW5zrQ8', '2026-07-03 19:37:06', '2026-07-03 19:52:13'),
(2, 'Wita', 'wita@gmail.com', NULL, '$2y$12$UvpcsrrnAWeY7t/PIe6XGOkJ.n1U7xSwPXEd4HWHsOiN9CdH2cj1e', 'blogger', 'uploads/avatars/1783144299_6a489f6ba2c52.webp', NULL, '2026-07-03 19:37:07', '2026-07-03 22:51:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_user_id_foreign` (`user_id`),
  ADD KEY `articles_category_id_foreign` (`category_id`);

--
-- Indexes for table `article_galleries`
--
ALTER TABLE `article_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_galleries_article_id_foreign` (`article_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_user_id_foreign` (`user_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_article_id_foreign` (`article_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `article_galleries`
--
ALTER TABLE `article_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `articles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `article_galleries`
--
ALTER TABLE `article_galleries`
  ADD CONSTRAINT `article_galleries_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_article_id_foreign` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
