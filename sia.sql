-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2024 at 01:56 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sia`
--

-- --------------------------------------------------------

--
-- Table structure for table `table_penjualan`
--

CREATE TABLE `table_penjualan` (
  `penjualan_id` int NOT NULL,
  `tanggal_penjualan` date NOT NULL,
  `pelanggan_id` int NOT NULL,
  `total_penjualan` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `akun_id` int NOT NULL,
  `nama_akun` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `jenis_akun` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `saldo_awal` int NOT NULL,
  `tipe_saldo` enum('Debit','Kredit') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barang`
--

CREATE TABLE `tbl_barang` (
  `barang_id` int NOT NULL,
  `nama_barang` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `harga_beli` int NOT NULL,
  `harga_jual` int NOT NULL,
  `stok` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_detail_transaksi`
--

CREATE TABLE `tbl_detail_transaksi` (
  `detail_transaksi_id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `akun_id` int NOT NULL,
  `jenis_transaksi` enum('Debit','Kredit') COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jurnal_umum`
--

CREATE TABLE `tbl_jurnal_umum` (
  `jurnal_id` int NOT NULL,
  `tanggal_jurnal` date NOT NULL,
  `keterangan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `debit_total` int NOT NULL,
  `kredit_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_laporan_keuangan`
--

CREATE TABLE `tbl_laporan_keuangan` (
  `laporan_id` int NOT NULL,
  `jenis_laporan` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `periode` date NOT NULL,
  `isi_laporana` varchar(11) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pelanggan`
--

CREATE TABLE `tbl_pelanggan` (
  `pelanggan_id` int NOT NULL,
  `nama_pelanggan` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` int NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembayaran`
--

CREATE TABLE `tbl_pembayaran` (
  `pembayaran_id` int NOT NULL,
  `transaksi_id` int NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `jumlah_pembayaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pembelian`
--

CREATE TABLE `tbl_pembelian` (
  `pembelian_id` int NOT NULL,
  `tanggal_pembelian` date NOT NULL,
  `suplier_id` int NOT NULL,
  `total_pembelian` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pengguna`
--

CREATE TABLE `tbl_pengguna` (
  `user_id` int NOT NULL,
  `username` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nama_lengkap` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `jabatan` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `hak_akses` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transaksi`
--

CREATE TABLE `tbl_transaksi` (
  `transaksi_id` int NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `jumlah_total` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl__suplier`
--

CREATE TABLE `tbl__suplier` (
  `suplier_id` int NOT NULL,
  `nama_suplier` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `alamat` varchar(25) COLLATE utf8mb4_general_ci NOT NULL,
  `telepon` int NOT NULL,
  `email` varchar(25) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `table_penjualan`
--
ALTER TABLE `table_penjualan`
  ADD PRIMARY KEY (`penjualan_id`),
  ADD UNIQUE KEY `pelanggan_id` (`pelanggan_id`);

--
-- Indexes for table `tbl_akun`
--
ALTER TABLE `tbl_akun`
  ADD PRIMARY KEY (`akun_id`);

--
-- Indexes for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  ADD PRIMARY KEY (`detail_transaksi_id`),
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`),
  ADD UNIQUE KEY `akun_id` (`akun_id`);

--
-- Indexes for table `tbl_jurnal_umum`
--
ALTER TABLE `tbl_jurnal_umum`
  ADD PRIMARY KEY (`jurnal_id`);

--
-- Indexes for table `tbl_laporan_keuangan`
--
ALTER TABLE `tbl_laporan_keuangan`
  ADD PRIMARY KEY (`laporan_id`);

--
-- Indexes for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`);

--
-- Indexes for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  ADD PRIMARY KEY (`pembayaran_id`),
  ADD UNIQUE KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  ADD PRIMARY KEY (`pembelian_id`),
  ADD UNIQUE KEY `suplier_id` (`suplier_id`);

--
-- Indexes for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `tbl__suplier`
--
ALTER TABLE `tbl__suplier`
  ADD PRIMARY KEY (`suplier_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `table_penjualan`
--
ALTER TABLE `table_penjualan`
  MODIFY `penjualan_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_barang`
--
ALTER TABLE `tbl_barang`
  MODIFY `barang_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_detail_transaksi`
--
ALTER TABLE `tbl_detail_transaksi`
  MODIFY `detail_transaksi_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_jurnal_umum`
--
ALTER TABLE `tbl_jurnal_umum`
  MODIFY `jurnal_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_laporan_keuangan`
--
ALTER TABLE `tbl_laporan_keuangan`
  MODIFY `laporan_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pelanggan`
--
ALTER TABLE `tbl_pelanggan`
  MODIFY `pelanggan_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pembayaran`
--
ALTER TABLE `tbl_pembayaran`
  MODIFY `pembayaran_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pembelian`
--
ALTER TABLE `tbl_pembelian`
  MODIFY `pembelian_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_pengguna`
--
ALTER TABLE `tbl_pengguna`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_transaksi`
--
ALTER TABLE `tbl_transaksi`
  MODIFY `transaksi_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl__suplier`
--
ALTER TABLE `tbl__suplier`
  MODIFY `suplier_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
