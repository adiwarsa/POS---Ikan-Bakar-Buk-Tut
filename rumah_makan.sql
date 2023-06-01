-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2023 at 03:53 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.5

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
-- Table structure for table `detail_transaction`
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
-- Dumping data for table `detail_transaction`
--

INSERT INTO `detail_transaction` (`id`, `transaction_id`, `menu_id`, `paket_id`, `qty`, `price`, `created_at`, `updated_at`) VALUES
(15, 14, 51, NULL, 2, 280000, '2023-05-03 21:26:16', '2023-05-03 21:26:16'),
(17, 16, NULL, NULL, 1, 100000, '2023-05-15 03:06:27', '2023-05-15 03:06:27'),
(18, 17, 51, NULL, 1, 140000, '2023-05-17 04:28:38', '2023-05-17 04:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `menu`
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
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `type`, `jenis`, `for`, `id_stock`, `price`, `needqty`, `created_at`, `updated_at`) VALUES
(39, 'Clam 5pcs', 'makanan', 'Alacarte', 'Paket', 36, 0, 5, '2023-05-03 19:32:02', '2023-05-03 19:32:02'),
(40, 'Squid 5pcs', 'makanan', 'Alacarte', 'Paket', 34, 0, 5, '2023-05-03 19:32:47', '2023-05-03 19:32:47'),
(41, 'Prawn 5pcs', 'makanan', 'Alacarte', 'Paket', 37, 0, 5, '2023-05-03 19:33:19', '2023-05-03 19:35:48'),
(42, '500g Crab', 'makanan', 'Alacarte', 'Paket', 38, 0, 1, '2023-05-03 19:36:24', '2023-05-03 19:36:24'),
(43, '500g Fish', 'makanan', 'Alacarte', 'Paket', 40, 0, 1, '2023-05-03 19:36:48', '2023-05-03 19:36:48'),
(44, '1kg Fish', 'makanan', 'Alacarte', 'Paket', 41, 0, 1, '2023-05-03 20:39:00', '2023-05-03 20:39:00'),
(45, 'prawn 8pcs', 'makanan', 'Alacarte', 'Paket', 37, 0, 8, '2023-05-03 20:40:00', '2023-05-03 20:40:00'),
(46, 'Squid 8pcs', 'makanan', 'Alacarte', 'Paket', 34, 0, 8, '2023-05-03 20:40:49', '2023-05-03 20:40:49'),
(47, 'Clam 1kg', 'makanan', 'Alacarte', 'Paket', 36, 0, 20, '2023-05-03 20:41:22', '2023-05-03 20:56:52'),
(48, 'Prawn 1kg', 'makanan', 'Alacarte', 'Paket', 37, 0, 30, '2023-05-03 20:46:44', '2023-05-03 20:57:15'),
(49, 'Squid 1kg', 'makanan', 'Alacarte', 'Paket', 34, 0, 15, '2023-05-03 20:47:17', '2023-05-03 20:57:27'),
(50, '1kg Lobster', 'makanan', 'Alacarte', 'Paket', 43, 0, 1, '2023-05-03 20:51:36', '2023-05-03 20:51:36'),
(51, 'Fish 1kg', 'makanan', 'Alacarte', 'Non Paket', 41, 140000, 1, '2023-05-03 21:20:24', '2023-05-03 21:20:32'),
(52, 'Squid 1kg', 'makanan', 'Alacarte', 'Non Paket', 34, 150000, 15, '2023-05-03 21:21:18', '2023-05-03 21:21:18'),
(53, 'Lobster 1kg', 'makanan', 'Alacarte', 'Non Paket', 43, 550000, 1, '2023-05-03 21:22:06', '2023-05-03 21:22:06'),
(54, 'Crab 1kg', 'makanan', 'Alacarte', 'Non Paket', 39, 320000, 1, '2023-05-03 21:22:32', '2023-05-03 21:22:32'),
(55, 'Prawn 1kg', 'makanan', 'Alacarte', 'Non Paket', 37, 250000, 30, '2023-05-03 21:23:14', '2023-05-03 21:25:09'),
(56, 'Clam 1kg', 'makanan', 'Alacarte', 'Non Paket', 36, 85000, 20, '2023-05-03 21:23:55', '2023-05-03 21:25:03');

-- --------------------------------------------------------

--
-- Table structure for table `menu_paket`
--

CREATE TABLE `menu_paket` (
  `menu_id` bigint UNSIGNED NOT NULL,
  `paket_id` bigint UNSIGNED NOT NULL,
  `qty` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_paket`
--

INSERT INTO `menu_paket` (`menu_id`, `paket_id`, `qty`, `created_at`, `updated_at`) VALUES
(39, 26, 1, NULL, NULL),
(40, 26, 1, NULL, NULL),
(41, 26, 1, NULL, NULL),
(42, 26, 1, NULL, NULL),
(43, 26, 1, NULL, NULL),
(44, 27, 1, NULL, NULL),
(45, 27, 1, NULL, NULL),
(46, 27, 1, NULL, NULL),
(47, 27, 1, NULL, NULL),
(44, 28, 1, NULL, NULL),
(47, 28, 1, NULL, NULL),
(48, 28, 1, NULL, NULL),
(49, 28, 1, NULL, NULL),
(44, 29, 2, NULL, NULL),
(47, 29, 2, NULL, NULL),
(48, 29, 2, NULL, NULL),
(49, 29, 2, NULL, NULL),
(50, 29, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_19_123536_create_pakets_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pakets`
--

CREATE TABLE `pakets` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pakets`
--

INSERT INTO `pakets` (`id`, `name`, `price`, `created_at`, `updated_at`) VALUES
(26, 'Paket D (500g Fish, 500g Crab, 5 Prawn, 5 Squid, 5 Clam)', 350000, '2023-05-03 19:38:27', '2023-05-03 19:38:27'),
(27, 'Paket C ( 1kg Fish, 8 Prawn, 8 Squid, 1kg Clam )', 400000, '2023-05-03 20:42:39', '2023-05-03 20:42:39'),
(28, 'Paket B ( 1kg Fish, 1kg Prawn, 1kg Squid, 1kg Clam )', 750000, '2023-05-03 20:48:47', '2023-05-03 20:48:47'),
(29, 'Paket A ( 2kg Fish, 1kg Lobster, 2kg Prawn, 2kg Squid, 2kg Clam )', 1550000, '2023-05-03 20:53:25', '2023-05-03 20:53:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
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
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id` bigint NOT NULL,
  `code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int DEFAULT NULL,
  `qtytype` double NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `limits` int NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id`, `code`, `name`, `qty`, `qtytype`, `type`, `limits`, `image`, `created_at`, `updated_at`) VALUES
(34, '00011', 'Squid 1kg isi 15pcs', 75, 5, 'Kg', 15, '1683193324_Screenshot 2023-04-13 131705.png', '2023-05-03 18:48:50', '2023-05-17 04:28:06'),
(36, '00012', 'Clam 1kg isi 20pcs', 100, 5, 'Kg', 20, '', '2023-05-03 19:21:55', '2023-05-03 19:26:49'),
(37, '00013', 'Prawn 1kg isi 30pcs', 190, 7, 'Kg', 30, '', '2023-05-03 19:22:36', '2023-05-16 03:35:17'),
(38, '00014', 'Crab 500g', 10, 5, 'Kg', 2, '', '2023-05-03 19:23:16', '2023-05-05 06:09:29'),
(39, '00015', 'Crab 1kg', 4, 4, 'Kg', 1, '', '2023-05-03 19:23:47', '2023-05-03 19:30:33'),
(40, '00016', 'Fish 500g', 11, 6, 'Kg', 2, '', '2023-05-03 19:24:13', '2023-05-15 03:06:27'),
(41, '00017', 'Fish 1kg', 2, 2, 'Kg', 1, '', '2023-05-03 19:24:42', '2023-05-17 04:28:38'),
(42, '00018', 'Lobster 500g', 10, 5, 'Kg', 2, '', '2023-05-03 19:25:19', '2023-05-03 19:25:19'),
(43, '00019', 'Lobster 1kg', 5, 5, 'Kg', 1, '', '2023-05-03 19:26:01', '2023-05-03 19:26:01'),
(47, 'RAR212', 'Aqua', 45, 3, 'Box', 20, '', '2023-05-15 21:03:48', '2023-05-16 03:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `stock_in`
--

CREATE TABLE `stock_in` (
  `id` bigint NOT NULL,
  `id_stock` bigint NOT NULL,
  `id_supplier` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `qty` int NOT NULL,
  `pcs` int NOT NULL,
  `price` double NOT NULL,
  `total_price` double NOT NULL,
  `date_in` date DEFAULT NULL,
  `supplier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telp_supplier` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_in`
--

INSERT INTO `stock_in` (`id`, `id_stock`, `id_supplier`, `id_user`, `qty`, `pcs`, `price`, `total_price`, `date_in`, `supplier`, `telp_supplier`, `file`, `created_at`, `updated_at`) VALUES
(20, 40, 0, 0, 1, 2, 50000, 50000, '2023-05-04', 'Ari Jaya', '089898898898', '1683170893_Screenshot 2023-04-13 131705.png', '2023-05-03 19:28:01', '2023-05-03 19:28:13'),
(21, 37, 0, 0, 2, 60, 50000, 100000, '2023-05-06', 'Agus', '08989889898', '1683337117_Screenshot 2023-04-13 131705.png', '2023-05-05 17:38:38', '2023-05-05 17:38:38'),
(26, 34, 2, 2, 1, 15, 1234, 1234, '2023-05-17', 'Panturateetew', '08973122412', '1684326433_DFD Rizky-P4 Stock Out.drawio.png', '2023-05-17 04:27:13', '2023-05-17 04:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `stock_out`
--

CREATE TABLE `stock_out` (
  `id` bigint NOT NULL,
  `id_stock` int NOT NULL,
  `id_user` bigint NOT NULL,
  `qty` int NOT NULL,
  `pcs` int NOT NULL,
  `date_out` date NOT NULL,
  `description` text,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock_out`
--

INSERT INTO `stock_out` (`id`, `id_stock`, `id_user`, `qty`, `pcs`, `date_out`, `description`, `created_at`, `updated_at`) VALUES
(26, 39, 0, 1, 1, '2023-05-04', NULL, '2023-05-03 19:30:33', '2023-05-03 19:30:33'),
(33, 34, 2, 1, 15, '2023-05-17', 'rarawwaaaaaa', '2023-05-17 04:28:06', '2023-05-17 04:28:22');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint NOT NULL,
  `nama` varchar(255) NOT NULL,
  `telp` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama`, `telp`, `created_at`, `updated_at`) VALUES
(2, 'Panturateetew', '08973122412', '2023-05-16 02:17:57', '2023-05-16 02:18:30'),
(3, 'Rizcupa', '0877777772', '2023-05-16 02:36:54', '2023-05-16 02:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` bigint NOT NULL,
  `id_user` bigint NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `pay` double NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `id_user`, `code`, `name`, `total_price`, `pay`, `created_at`, `updated_at`) VALUES
(14, 0, 'TR04FMHMAYRMB2023', 'Rio', 280000, 280000, '2023-05-03 21:26:16', '2023-05-03 21:26:16'),
(16, 0, 'TR15UNZMAYLIK2023', 'Komang', 100000, 10000, '2023-05-15 03:06:27', '2023-05-15 03:06:27'),
(17, 2, 'TR177AZMAYUHZ2023', '1', 140000, 111111111111, '2023-05-17 04:28:38', '2023-05-17 04:28:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'adi', 'adi@gmail.com', NULL, '$2y$10$rP7sc/cpRtqm/Uca3D0/rO4n52DH2zEQ/xYXzSqz7Uj6W5M2Wj29C', 'V93GrbnbDnvfCtqJmpZ6v0LQiJTifxB1EYyqVE3F8Rwg4TuQrresDyzp6tlZ', '2023-03-31 01:42:20', '2023-04-30 08:31:39', 1),
(2, 'Kadek Sumardana', 'kadek@gmail.com', '2023-04-28 03:06:56', '$2y$10$rP7sc/cpRtqm/Uca3D0/rO4n52DH2zEQ/xYXzSqz7Uj6W5M2Wj29C', NULL, '2023-04-28 03:06:56', '2023-04-28 03:06:56', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `transaction_id` (`transaction_id`),
  ADD KEY `paket_id` (`paket_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_paket`
--
ALTER TABLE `menu_paket`
  ADD KEY `paket` (`paket_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pakets`
--
ALTER TABLE `pakets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in`
--
ALTER TABLE `stock_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out`
--
ALTER TABLE `stock_out`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pakets`
--
ALTER TABLE `pakets`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `stock_in`
--
ALTER TABLE `stock_in`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `stock_out`
--
ALTER TABLE `stock_out`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaction`
--
ALTER TABLE `detail_transaction`
  ADD CONSTRAINT `menu_id` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `paket_id` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  ADD CONSTRAINT `transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `menu_paket`
--
ALTER TABLE `menu_paket`
  ADD CONSTRAINT `paket` FOREIGN KEY (`paket_id`) REFERENCES `pakets` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
