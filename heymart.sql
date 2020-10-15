-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08 Mar 2018 pada 17.02
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `heymart`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `nama_kategori` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `created_at`, `updated_at`) VALUES
(1, 'Anti Gores', '2018-02-27 12:47:24', '2018-02-27 12:47:39'),
(2, 'Sembako', '2018-02-28 04:04:39', '2018-03-01 08:39:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(10) UNSIGNED NOT NULL,
  `kode_member` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `kode_member`, `nama`, `alamat`, `telpon`, `created_at`, `updated_at`) VALUES
(1, 20180227194830, 'Ahmad Al Khaidar', 'Depok', '08896539453', '2018-02-27 12:48:30', '2018-02-27 12:48:30'),
(2, 20180301104759, 'Levi Tan Rio', 'Ciputat', '083812345678', '2018-03-01 03:47:59', '2018-03-01 03:47:59');

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_05_17_231123_buat_tabel_kategori', 1),
(4, '2017_05_18_000802_buat_tabel_produk', 1),
(5, '2017_05_18_103204_buat_tabel_supplier', 1),
(6, '2017_05_18_103438_buat_tabel_member', 1),
(7, '2017_05_18_103716_buat_tabel_pembelian', 1),
(8, '2017_05_18_104108_buat_tabel_pembelian_detail', 1),
(9, '2017_05_18_104505_buat_tabel_penjualan', 1),
(10, '2017_05_18_110941_buat_tabel_penjualan_detail', 1),
(11, '2017_05_18_111512_buat_tabel_pengeluaran', 1),
(12, '2017_05_18_111942_buat_tabel_setting', 1),
(13, '2017_05_18_112540_ubah_tabel_users', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `total_item` int(10) UNSIGNED NOT NULL,
  `total_harga` bigint(20) UNSIGNED NOT NULL,
  `diskon` int(10) UNSIGNED NOT NULL,
  `bayar` bigint(20) UNSIGNED NOT NULL,
  `user` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_supplier`, `total_item`, `total_harga`, `diskon`, `bayar`, `user`, `created_at`, `updated_at`) VALUES
(32, 2, 1000, 2000000, 0, 2000000, 3, '2018-03-02 06:57:46', '2018-03-02 06:58:00'),
(33, 1, 100, 400000000, 0, 4000000, 3, '2018-03-02 06:58:36', '2018-03-02 06:58:49'),
(36, 2, 100, 200000, 0, 200000, 4, '2018-03-05 06:32:44', '2018-03-05 06:32:54'),
(37, 2, 10, 20000, 0, 2000, 4, '2018-03-05 06:49:59', '2018-03-05 06:50:07'),
(41, 2, 10, 20000, 0, 20000, 4, '2018-03-05 07:44:02', '2018-03-05 08:11:55'),
(42, 2, 5, 20000000, 0, 20000000, 4, '2018-03-05 08:21:11', '2018-03-05 08:21:27'),
(43, 2, 10, 20000, 0, 20000, 4, '2018-03-05 08:36:44', '2018-03-05 08:37:00'),
(44, 2, 10, 20000, 0, 20000, 3, '2018-03-06 02:22:37', '2018-03-06 02:22:45'),
(45, 1, 10, 20000, 0, 20000, 3, '2018-03-06 02:22:59', '2018-03-06 02:23:17'),
(47, 2, 7, 14000, 0, 14000, 4, '2018-03-06 02:41:41', '2018-03-06 02:44:44'),
(48, 2, 15, 37500, 0, 37500, 3, '2018-03-06 02:45:47', '2018-03-06 02:45:56'),
(49, 2, 10, 20000, 0, 20000, 4, '2018-03-06 02:47:47', '2018-03-06 02:48:20'),
(50, 2, 17, 34000, 0, 34000, 4, '2018-03-06 02:53:39', '2018-03-06 02:54:32'),
(52, 2, 20, 40000, 0, 40000, 4, '2018-03-06 03:15:37', '2018-03-06 03:16:28'),
(53, 2, 3, 12000000, 0, 12000000, 3, '2018-03-06 03:25:15', '2018-03-06 03:25:30'),
(61, 2, 10, 20000, 0, 20000, 3, '2018-03-06 08:46:01', '2018-03-06 08:46:09'),
(62, 2, 10, 20000, 0, 20000, 3, '2018-03-06 08:46:14', '2018-03-06 08:47:17'),
(63, 2, 100, 200000, 0, 200000, 3, '2018-03-06 08:58:32', '2018-03-06 09:01:13'),
(65, 2, 20, 40000, 0, 40000, 3, '2018-03-06 09:04:54', '2018-03-06 09:05:23'),
(66, 2, 20, 40000, 0, 40000, 3, '2018-03-06 09:07:15', '2018-03-06 09:07:42'),
(68, 2, 10, 20000, 0, 20000, 3, '2018-03-06 09:21:00', '2018-03-06 09:21:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembelian_detail`
--

CREATE TABLE `pembelian_detail` (
  `id_pembelian_detail` int(10) UNSIGNED NOT NULL,
  `id_pembelian` int(10) UNSIGNED NOT NULL,
  `kode_produk` bigint(20) UNSIGNED NOT NULL,
  `harga_beli` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `sub_total` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembelian_detail`
--

INSERT INTO `pembelian_detail` (`id_pembelian_detail`, `id_pembelian`, `kode_produk`, `harga_beli`, `jumlah`, `sub_total`, `created_at`, `updated_at`) VALUES
(35, 32, 2032018133818, 2000, 1000, 2000000, '2018-03-02 06:57:51', '2018-03-02 06:57:57'),
(36, 33, 2032018134045, 4000000, 100, 400000000, '2018-03-02 06:58:41', '2018-03-02 06:58:46'),
(39, 36, 2032018133846, 2000, 100, 200000, '2018-03-05 06:32:48', '2018-03-05 06:32:51'),
(40, 37, 2032018133846, 2000, 10, 20000, '2018-03-05 06:50:03', '2018-03-05 06:50:06'),
(41, 38, 2032018133846, 2000, 1, 2000, '2018-03-05 06:50:33', '2018-03-05 06:50:33'),
(42, 39, 2032018133846, 2000, 1, 2000, '2018-03-05 07:36:02', '2018-03-05 07:36:02'),
(43, 40, 2032018133846, 2000, 1, 2000, '2018-03-05 07:42:02', '2018-03-05 07:42:02'),
(44, 41, 2032018133846, 2000, 10, 20000, '2018-03-05 07:44:07', '2018-03-05 08:11:53'),
(45, 42, 2032018134111, 4000000, 5, 20000000, '2018-03-05 08:21:23', '2018-03-05 08:21:25'),
(46, 43, 2032018133846, 2000, 10, 20000, '2018-03-05 08:36:55', '2018-03-05 08:36:58'),
(47, 44, 2032018133846, 2000, 10, 20000, '2018-03-05 08:37:26', '2018-03-06 02:22:42'),
(48, 45, 2032018133818, 2000, 10, 20000, '2018-03-06 02:23:12', '2018-03-06 02:23:15'),
(51, 48, 2032018151439, 2500, 15, 37500, '2018-03-06 02:45:51', '2018-03-06 02:45:54'),
(52, 49, 2032018133846, 2000, 10, 20000, '2018-03-06 02:47:50', '2018-03-06 02:48:18'),
(53, 50, 2032018133846, 2000, 17, 34000, '2018-03-06 02:53:42', '2018-03-06 02:54:31'),
(55, 52, 2032018133846, 2000, 20, 40000, '2018-03-06 03:15:40', '2018-03-06 03:16:26'),
(56, 53, 2032018134045, 4000000, 3, 12000000, '2018-03-06 03:25:19', '2018-03-06 03:25:28'),
(57, 54, 2032018133818, 2000, 10, 20000, '2018-03-06 03:34:16', '2018-03-06 03:34:40'),
(58, 55, 2032018133818, 2000, 100, 200000, '2018-03-06 05:23:48', '2018-03-06 05:23:52'),
(59, 56, 2032018133818, 2000, 50, 100000, '2018-03-06 05:25:21', '2018-03-06 05:25:24'),
(62, 61, 2032018133818, 2000, 10, 20000, '2018-03-06 08:46:05', '2018-03-06 08:46:07'),
(64, 63, 2032018133818, 2000, 100, 200000, '2018-03-06 09:00:12', '2018-03-06 09:00:14'),
(66, 65, 2032018133818, 2000, 20, 40000, '2018-03-06 09:04:57', '2018-03-06 09:05:21'),
(67, 66, 2032018133818, 2000, 20, 40000, '2018-03-06 09:07:18', '2018-03-06 09:07:40'),
(70, 68, 2032018133818, 2000, 10, 20000, '2018-03-06 09:21:03', '2018-03-06 09:21:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(10) UNSIGNED NOT NULL,
  `jenis_pengeluaran` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nominal` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `jenis_pengeluaran`, `nominal`, `created_at`, `updated_at`) VALUES
(1, 'Gaji Karyawan', 20000000, '2018-03-02 02:08:45', '2018-03-02 02:09:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` int(10) UNSIGNED NOT NULL,
  `kode_member` bigint(20) UNSIGNED NOT NULL,
  `total_item` int(10) UNSIGNED NOT NULL,
  `total_harga` bigint(20) UNSIGNED NOT NULL,
  `diskon` int(10) UNSIGNED NOT NULL,
  `bayar` bigint(20) UNSIGNED NOT NULL,
  `diterima` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `kode_member`, `total_item`, `total_harga`, `diskon`, `bayar`, `diterima`, `id_user`, `status`, `created_at`, `updated_at`) VALUES
(24, 20180227194830, 500, 1250000, 10, 1125000, 1300000, 3, 'selesai', '2018-03-02 06:55:50', '2018-03-02 07:10:50'),
(25, 20180227194830, 10, 25000, 10, 22500, 22500, 3, 'selesai', '2018-03-02 07:17:09', '2018-03-02 07:20:41'),
(26, 20180301104759, 1, 4500000, 10, 4050000, 4050000, 3, 'selesai', '2018-03-02 07:25:06', '2018-03-02 07:26:08'),
(27, 20180227194830, 10, 25000, 10, 22500, 22500, 3, 'retur', '2018-03-02 07:30:45', '2018-03-05 06:26:48'),
(28, 20180227194830, 1, 4500000, 10, 4050000, 4050000, 3, 'selesai', '2018-03-02 08:29:58', '2018-03-02 08:30:37'),
(29, 20180227194830, 20, 50000, 10, 45000, 45000, 4, 'selesai', '2018-03-05 06:32:32', '2018-03-05 06:33:18'),
(30, 20180301104759, 10, 25000, 10, 22500, 25000, 4, 'retur', '2018-03-05 06:33:22', '2018-03-05 06:34:03'),
(32, 20180227194830, 1, 4500000, 10, 4050000, 4050000, 4, 'selesai', '2018-03-05 09:10:12', '2018-03-05 09:10:39'),
(33, 20180227194830, 500, 1250000, 10, 1125000, 1200000, 3, 'selesai', '2018-03-06 03:18:10', '2018-03-06 03:18:27'),
(34, 20180227194830, 98, 441000000, 10, 396900000, 397000000, 3, 'retur', '2018-03-06 03:18:31', '2018-03-06 03:20:48'),
(35, 20180227194830, 15, 45000, 10, 40500, 40500, 3, 'selesai', '2018-03-06 03:18:58', '2018-03-06 03:19:13'),
(36, 20180301104759, 184, 460000, 10, 414000, 414000, 4, 'selesai', '2018-03-06 03:19:26', '2018-03-06 03:19:47'),
(37, 20180301104759, 4, 18000000, 10, 16200000, 16200000, 4, 'selesai', '2018-03-06 03:19:50', '2018-03-06 03:20:05'),
(39, 20180227194830, 5, 22500000, 10, 20250000, 20250000, 4, 'selesai', '2018-03-06 03:22:29', '2018-03-06 03:22:51'),
(41, 20180227194830, 110, 275000, 10, 247500, 250000, 3, 'selesai', '2018-03-06 05:24:00', '2018-03-06 05:24:23'),
(42, 20180227194830, 50, 125000, 10, 112500, 150000, 3, 'selesai', '2018-03-06 05:27:53', '2018-03-06 05:28:08'),
(43, 20180301104759, 2, 9000000, 10, 8100000, 9000000, 3, 'selesai', '2018-03-06 08:12:37', '2018-03-06 08:12:57'),
(44, 20180227194830, 10, 25000, 10, 22500, 25000, 3, 'selesai', '2018-03-07 07:25:29', '2018-03-07 07:26:40'),
(45, 20180227194830, 10, 25000, 10, 22500, 22500, 3, 'selesai', '2018-03-07 09:25:00', '2018-03-07 09:51:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan_detail`
--

CREATE TABLE `penjualan_detail` (
  `id_penjualan_detail` int(10) UNSIGNED NOT NULL,
  `id_penjualan` int(10) UNSIGNED NOT NULL,
  `kode_produk` bigint(20) UNSIGNED NOT NULL,
  `harga_jual` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `diskon` int(10) UNSIGNED NOT NULL,
  `sub_total` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `penjualan_detail`
--

INSERT INTO `penjualan_detail` (`id_penjualan_detail`, `id_penjualan`, `kode_produk`, `harga_jual`, `jumlah`, `diskon`, `sub_total`, `created_at`, `updated_at`) VALUES
(21, 24, 2032018133818, 2500, 500, 0, 1250000, '2018-03-02 06:58:59', '2018-03-02 07:10:08'),
(22, 25, 2032018133818, 2500, 10, 0, 25000, '2018-03-02 07:19:31', '2018-03-02 07:19:34'),
(23, 26, 2032018134045, 4500000, 1, 0, 4500000, '2018-03-02 07:25:57', '2018-03-02 07:25:57'),
(25, 28, 2032018134045, 4500000, 1, 0, 4500000, '2018-03-02 08:30:27', '2018-03-02 08:30:27'),
(26, 29, 2032018133846, 2500, 20, 0, 50000, '2018-03-05 06:33:00', '2018-03-05 06:33:04'),
(29, 32, 2032018134111, 4500000, 1, 0, 4500000, '2018-03-05 09:10:26', '2018-03-05 09:10:26'),
(30, 33, 2032018133818, 2500, 500, 0, 1250000, '2018-03-06 03:18:15', '2018-03-06 03:18:19'),
(32, 35, 2032018151439, 3000, 15, 0, 45000, '2018-03-06 03:19:01', '2018-03-06 03:19:04'),
(33, 36, 2032018133846, 2500, 184, 0, 460000, '2018-03-06 03:19:30', '2018-03-06 03:19:39'),
(34, 37, 2032018134111, 4500000, 4, 0, 18000000, '2018-03-06 03:19:53', '2018-03-06 03:19:56'),
(35, 39, 2032018134111, 4500000, 5, 0, 22500000, '2018-03-06 03:22:36', '2018-03-06 03:22:39'),
(36, 41, 2032018133818, 2500, 110, 0, 275000, '2018-03-06 05:24:04', '2018-03-06 05:24:07'),
(37, 42, 2032018133818, 2500, 50, 0, 125000, '2018-03-06 05:27:57', '2018-03-06 05:28:00'),
(38, 43, 2032018134045, 4500000, 2, 0, 9000000, '2018-03-06 08:12:42', '2018-03-06 08:12:44'),
(40, 44, 2032018133818, 2500, 10, 0, 25000, '2018-03-07 07:25:36', '2018-03-07 07:26:30'),
(47, 45, 2032018133818, 2500, 10, 0, 25000, '2018-03-07 09:51:23', '2018-03-07 09:51:25');

-- --------------------------------------------------------

--
-- Struktur dari tabel `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(10) UNSIGNED NOT NULL,
  `kode_produk` bigint(20) UNSIGNED NOT NULL,
  `id_kategori` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL,
  `nama_produk` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_beli` bigint(20) UNSIGNED NOT NULL,
  `diskon` int(10) UNSIGNED NOT NULL,
  `harga_jual` bigint(20) UNSIGNED NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL,
  `sertifikat` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `retur` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `id_kategori`, `id_user`, `nama_produk`, `merk`, `harga_beli`, `diskon`, `harga_jual`, `stok`, `sertifikat`, `retur`, `created_at`, `updated_at`) VALUES
(11, 2032018133818, 2, 3, 'Mie Soto', 'Indomie', 2000, 0, 2500, 150, 'Tidak', 10, '2018-03-02 06:38:18', '2018-03-07 09:51:33'),
(12, 2032018133846, 2, 4, 'Mie Soto', 'Indomie', 2000, 0, 2500, 0, 'Tidak', 10, '2018-03-02 06:38:46', '2018-03-06 03:19:47'),
(13, 2032018134045, 1, 3, 'Vivo V7', 'Vivo', 4000000, 0, 4500000, 1, 'Ya', 2, '2018-03-02 06:40:45', '2018-03-06 09:23:25'),
(14, 2032018134111, 1, 4, 'Vivo V7', 'Vivo', 4000000, 0, 4500000, 0, 'Ya', NULL, '2018-03-02 06:41:11', '2018-03-06 03:22:51'),
(15, 2032018151439, 2, 3, 'Mie Goreng', 'Indomie', 2500, 0, 3000, 0, 'Tidak', NULL, '2018-03-02 08:14:39', '2018-03-06 03:19:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `setting`
--

CREATE TABLE `setting` (
  `id_setting` int(10) UNSIGNED NOT NULL,
  `nama_perusahaan` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telepon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kartu_member` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sertifikat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon_member` int(10) UNSIGNED NOT NULL,
  `tipe_nota` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `setting`
--

INSERT INTO `setting` (`id_setting`, `nama_perusahaan`, `alamat`, `telepon`, `logo`, `kartu_member`, `sertifikat`, `diskon_member`, `tipe_nota`, `created_at`, `updated_at`) VALUES
(1, 'Hellomart', 'Jl. Citarum, Slawi, Tegal', '085823423232', 'logo.png', 'card.png', 'sertifikat.jpg', 10, 1, NULL, '2018-03-01 09:55:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(10) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `telpon` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telpon`, `created_at`, `updated_at`) VALUES
(1, 'PT.Vivo Indonesia', 'Jakarta-Pusat', '088888888888', '2018-02-27 12:50:25', '2018-02-28 01:58:30'),
(2, 'PT.Indomie', 'Jakarta-Pusat', '087777777777', '2018-02-28 01:58:12', '2018-03-02 02:05:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `foto` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `level` int(10) UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `foto`, `level`) VALUES
(1, 'admin', 'admin@pos.com', '$2y$10$MiTmJbZBESwJmSHc0GhCju8WZjPNSHyYKJ3QlHPMr1iYWFZwH0nmC', '5Ebrcb8zF76W06KlJnFWhajmfiVppGXdhyFyPIXjcTCO96MxnmA7BVYWI8LW', NULL, NULL, 'user.png', 1),
(2, 'Annisa Salsabila', 'annisasalsabila@pos.com', '$2y$10$ZZ4ZvNtsUG2jRWoZRAFCieYCyx3g6Lmd0zq.qog794Fmp7nGCyBhC', NULL, NULL, NULL, 'user.png', 1),
(3, 'Lelouch Kaida', 'lelouch@gmail.com', '$2y$10$ApMQM.Ge0ZxSSAwBlywuM.dCkw7D8/mf27EPNx7rttPybGQBD3ZZ2', 'Aw6u4lw7fpfcZPUW0q0ZFzbIqSiSBg5wUjond7DPmhqFv1CWZC3ctb3suS4X', NULL, '2018-03-06 02:40:29', 'user.png', 2),
(4, 'levi', 'levi@gmail.com', '$2y$10$o2AmSIqK/GPNR68xZ5PVx.12CP8odaZhsYtha92xa5rqLRDqJqs4.', 'ZZQzs9kXdQNmfm5f67QfDxlLwfxHcMKvNLWoNd5IPT6f1pCuhMbcrUHaYMz8', NULL, NULL, 'user.png', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indexes for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  ADD PRIMARY KEY (`id_pembelian_detail`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indexes for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  ADD PRIMARY KEY (`id_penjualan_detail`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id_setting`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

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
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `pembelian_detail`
--
ALTER TABLE `pembelian_detail`
  MODIFY `id_pembelian_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id_penjualan` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `penjualan_detail`
--
ALTER TABLE `penjualan_detail`
  MODIFY `id_penjualan_detail` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id_setting` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
