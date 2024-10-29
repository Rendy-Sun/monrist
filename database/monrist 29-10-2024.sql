-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2024 at 08:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monrist`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_pemesanan`
--

CREATE TABLE `invoice_pemesanan` (
  `id` int(11) NOT NULL,
  `tanggal_order` date NOT NULL,
  `tanggal_paket_diambil` date NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `rmb` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `ongkir_aplikasi` int(11) NOT NULL,
  `total_pembelian` int(11) NOT NULL,
  `kurs` int(11) NOT NULL,
  `rupiah` int(11) NOT NULL,
  `no_resi` int(11) NOT NULL,
  `per_resi` int(11) NOT NULL,
  `total_ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_pemesanan`
--

INSERT INTO `invoice_pemesanan` (`id`, `tanggal_order`, `tanggal_paket_diambil`, `nama_toko`, `rmb`, `diskon`, `ongkir_aplikasi`, `total_pembelian`, `kurs`, `rupiah`, `no_resi`, `per_resi`, `total_ongkir`) VALUES
(1, '2024-10-01', '2024-10-01', 'Subject', 123, 123, 123, 123, 123, 123, 123, 123, 123);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stok_produk`
--

CREATE TABLE `stok_produk` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `total_harga_masuk` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `total_harga_keluar` int(11) NOT NULL,
  `sisa_stok` int(11) NOT NULL,
  `harga_sisa_stok` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` int(11) NOT NULL,
  `nama_unit` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_pemesanan`
--
ALTER TABLE `invoice_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stok_produk`
--
ALTER TABLE `stok_produk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_pemesanan`
--
ALTER TABLE `invoice_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stok_produk`
--
ALTER TABLE `stok_produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
