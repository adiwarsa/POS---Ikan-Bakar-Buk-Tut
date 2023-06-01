-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 28 Apr 2023 pada 11.50
-- Versi server: 8.0.30
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rumah_makan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaction`
--

CREATE TABLE `detail_transaction` (
  `id` bigint NOT NULL,
  `transaction_id` bigint NOT NULL,
  `menu_id` bigint DEFAULT NULL,
  `paket_id` bigint UNSIGNED DEFAULT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `detail_transaction`
--

INSERT INTO `detail_transaction` (`id`, `transaction_id`, `menu_id`, `paket_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 31, NULL, 1, 150000, '2023-04-28 03:26:52', '2023-04-28 03:26:52'),
(2, 1, NULL, 22, 1, 500000, '2023-04-28 03:26:52', '2023-04-28 03:26:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id` bigint NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `for` varchar(255) NOT NULL,
  `id_stock` int NOT NULL,
  `price` double NOT NULL,
  `needqty` int NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id`, `name`, `type`, `jenis`, `for`, `id_stock`, `price`, `needqty`, `created_at`, `updated_at`) VALUES
(13, '500g FISH', 'makanan', 'Alacarte', 'Paket', 20, 0, 1, '2023-04-19 21:16:20', '2023-04-19 21:46:43'),
(14, '3 PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 3, '2023-04-19 21:18:43', '2023-04-19 21:46:11'),
(15, '5 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 5, '2023-04-19 21:19:44', '2023-04-19 21:46:19'),
(16, '5 CLAM', 'makanan', 'Alacarte', 'Paket', 24, 0, 5, '2023-04-19 21:20:37', '2023-04-19 21:46:27'),
(17, '500g CRAB', 'makanan', 'Alacarte', 'Paket', 25, 0, 1, '2023-04-21 04:54:00', '2023-04-21 04:54:00'),
(18, '4 PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 4, '2023-04-21 04:55:39', '2023-04-21 04:55:39'),
(19, '4 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 4, '2023-04-21 04:56:15', '2023-04-21 04:56:15'),
(20, '6 CLAM', 'makanan', 'Alacarte', 'Paket', 24, 0, 6, '2023-04-21 04:56:39', '2023-04-21 04:56:39'),
(21, '8 PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 8, '2023-04-21 05:02:50', '2023-04-21 05:02:50'),
(22, '8 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 8, '2023-04-21 05:03:41', '2023-04-21 05:03:41'),
(23, '1kg CLAM', 'makanan', 'Alacarte', 'Paket', 24, 0, 15, '2023-04-21 05:04:36', '2023-04-21 05:04:36'),
(24, '500g LOBSTER', 'makanan', 'Alacarte', 'Paket', 26, 0, 1, '2023-04-21 06:08:14', '2023-04-21 06:08:14'),
(25, '6 PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 6, '2023-04-21 06:09:35', '2023-04-21 06:11:26'),
(26, '10 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 10, '2023-04-21 06:10:21', '2023-04-21 06:11:45'),
(27, '1kg PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 50, '2023-04-21 06:13:51', '2023-04-21 06:13:51'),
(28, '15 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 15, '2023-04-21 06:14:13', '2023-04-21 06:14:13'),
(29, '1.5kg PRAWN', 'makanan', 'Alacarte', 'Paket', 22, 0, 75, '2023-04-21 06:15:55', '2023-04-21 06:15:55'),
(30, '30 SQUID SATAY', 'makanan', 'Alacarte', 'Paket', 23, 0, 30, '2023-04-21 06:16:15', '2023-04-21 06:16:15'),
(31, 'SQUID', 'makanan', 'Alacarte', 'Non Paket', 23, 150000, 15, '2023-04-28 03:24:15', '2023-04-28 03:26:09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu_paket`
--

CREATE TABLE `menu_paket` (
  `menu_id` bigint UNSIGNED NOT NULL,
  `paket_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `menu_paket`
--

INSERT INTO `menu_paket` (`menu_id`, `paket_id`, `qty`, `created_at`, `updated_at`) VALUES
(13, 17, 1, NULL, NULL),
(14, 17, 1, NULL, NULL),
(15, 17, 1, NULL, NULL),
(16, 17, 1, NULL, NULL),
(13, 19, 1, NULL, NULL),
(17, 19, 1, NULL, NULL),
(18, 19, 1, NULL, NULL),
(19, 19, 1, NULL, NULL),
(20, 19, 1, NULL, NULL),
(13, 21, 2, NULL, NULL),
(21, 21, 1, NULL, NULL),
(22, 21, 1, NULL, NULL),
(23, 21, 1, NULL, NULL),
(13, 22, 2, NULL, NULL),
(20, 22, 1, NULL, NULL),
(24, 22, 1, NULL, NULL),
(25, 22, 1, NULL, NULL),
(26, 22, 1, NULL, NULL),
(13, 23, 2, NULL, NULL),
(23, 23, 1, NULL, NULL),
(27, 23, 1, NULL, NULL),
(28, 23, 1, NULL, NULL),
(13, 24, 4, NULL, NULL),
(23, 24, 2, NULL, NULL),
(24, 24, 2, NULL, NULL),
(29, 24, 1, NULL, NULL),
(30, 24, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_19_123536_create_pakets_table', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pakets`
--

INSERT INTO `pakets` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(17, 'SET MENU F', 200000, '2023-04-21 04:51:14', '2023-04-21 04:51:14'),
(19, 'SET MENU E', 300000, '2023-04-21 04:58:27', '2023-04-21 04:58:27'),
(21, 'SET MENU D', 350000, '2023-04-21 06:04:35', '2023-04-21 06:04:35'),
(22, 'SET MENU C', 500000, '2023-04-21 06:12:44', '2023-04-21 06:12:44'),
(23, 'SET MENU B', 700000, '2023-04-21 06:14:58', '2023-04-21 06:14:58'),
(24, 'SET MENU A', 1550000, '2023-04-21 06:17:11', '2023-04-21 06:17:11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `id` bigint NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int DEFAULT NULL,
  `qtytype` int NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limits` int NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock`
--

INSERT INTO `stock` (`id`, `code`, `name`, `qty`, `qtytype`, `type`, `limits`, `image`, `created_at`, `updated_at`) VALUES
(20, '00012', 'FISH', 20, 10, 'Kg', 2, '1681966852_Screenshot 2023-04-13 131705.png', '2023-04-19 20:53:56', '2023-04-28 03:42:59'),
(22, '00015', 'PRAWN', 494, 10, 'Kg', 50, '', '2023-04-19 21:03:44', '2023-04-28 03:26:52'),
(23, '00016', 'SQUID', 125, 10, 'Kg', 15, '', '2023-04-19 21:04:27', '2023-04-28 03:26:52'),
(24, '00017', 'CLAM', 144, 10, 'Kg', 15, '', '2023-04-19 21:05:27', '2023-04-28 03:26:52'),
(25, '00018', 'CRAB', 20, 10, 'Kg', 2, '', '2023-04-21 04:52:48', '2023-04-21 04:59:07'),
(26, '00019', 'LOBSTER', 19, 10, 'Box', 2, '', '2023-04-21 06:07:12', '2023-04-28 03:26:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint NOT NULL,
  `id_stock` bigint NOT NULL,
  `qty` int NOT NULL,
  `price` double NOT NULL,
  `total_price` double NOT NULL,
  `date_in` date DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp_supplier` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stock_in`
--

INSERT INTO `stock_in` (`id`, `id_stock`, `qty`, `price`, `total_price`, `date_in`, `supplier`, `telp_supplier`, `file`, `created_at`, `updated_at`) VALUES
(11, 20, 4, 100000, 400000, '2023-04-28', 'ARI JAYA', '087878878878', '1682681840_Screenshot 2023-04-13 131705.png', '2023-04-28 03:05:26', '2023-04-28 03:41:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock_out`
--

CREATE TABLE `stock_out` (
  `id` bigint NOT NULL,
  `id_stock` int NOT NULL,
  `qty` int NOT NULL,
  `date_out` date NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `stock_out`
--

INSERT INTO `stock_out` (`id`, `id_stock`, `qty`, `date_out`, `created_at`, `updated_at`) VALUES
(18, 20, 2, '2023-04-28', '2023-04-28 03:42:59', '2023-04-28 03:42:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`id`, `code`, `name`, `total_price`, `created_at`, `updated_at`) VALUES
(1, 'TR28QOJAPRBPD2023', 'PUTU', 650000, '2023-04-28 03:26:52', '2023-04-28 03:26:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Adi', 'adi@gmail.com', NULL, '$2y$10$rP7sc/cpRtqm/Uca3D0/rO4n52DH2zEQ/xYXzSqz7Uj6W5M2Wj29C', NULL, '2023-03-31 01:42:20', '2023-04-08 06:52:12', 1),
(2, 'Kadek Sumardana', 'kadek@gmail.com', '2023-04-28 03:06:56', '$2y$10$zTmOEgfS2QcEJ4qgBy2TKOCqDW7mE4W8xjR73wEEm.DIAX9Qfwl5C', NULL, '2023-04-28 03:06:56', '2023-04-28 03:06:56', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `paket_id` (`paket_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `menu_paket`
--
ALTER TABLE `menu_paket`
  ADD KEY `paket` (`paket_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `paket_id` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Ketidakleluasaan untuk tabel `menu_paket`
--
ALTER TABLE `menu_paket`
  ADD CONSTRAINT `paket` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
