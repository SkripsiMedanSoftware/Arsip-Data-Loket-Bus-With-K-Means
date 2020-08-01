-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2020 at 04:58 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skripsi_pengarsipan_loket_kmeans`
--

-- --------------------------------------------------------

--
-- Table structure for table `data_bus`
--

CREATE TABLE `data_bus` (
  `id` int(5) NOT NULL,
  `merk_bus` varchar(127) NOT NULL,
  `kelas_bus` varchar(32) NOT NULL,
  `jumlah_kursi` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_bus_loket`
--

CREATE TABLE `data_bus_loket` (
  `id` int(5) NOT NULL,
  `loket` int(5) NOT NULL,
  `bus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_loket`
--

CREATE TABLE `data_loket` (
  `id` int(5) NOT NULL,
  `nama_loket` varchar(28) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_paket`
--

CREATE TABLE `data_paket` (
  `id` int(5) NOT NULL,
  `tujuan` int(5) NOT NULL,
  `pengirim` varchar(40) NOT NULL,
  `penerima` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `data_penumpang`
--

CREATE TABLE `data_penumpang` (
  `id` int(5) NOT NULL,
  `nama_penumpang` varchar(60) NOT NULL,
  `tujuan` int(5) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `data_tujuan`
--

CREATE TABLE `data_tujuan` (
  `id` int(5) NOT NULL,
  `nama_tujuan` varchar(41) DEFAULT NULL,
  `loket` int(5) NOT NULL,
  `bus` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(4) NOT NULL,
  `role` enum('admin','pimpinan','kabag') NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `seluler` varchar(15) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `nama_lengkap` varchar(80) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `status` enum('aktif','non-aktif','blokir') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `role`, `email`, `seluler`, `username`, `password`, `nama_lengkap`, `alamat`, `status`) VALUES
(1, 'admin', 'admin@pengarsipan-bus.medansoftware.com', '082167368585', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', NULL, 'aktif'),
(2, 'pimpinan', 'pimpinan@pengarsipan-bus.medansoftware.com', '082167368586', 'pimpinan', '90973652b88fe07d05a4304f0a945de8', 'Pimpinan', NULL, 'aktif'),
(3, 'kabag', 'kabag@pengarsipan-bus.medansoftware.com', '082167368587', 'kabag', '1a50ef14d0d75cd795860935ee0918af', 'Kepala Bagian', NULL, 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data_bus`
--
ALTER TABLE `data_bus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_bus_loket`
--
ALTER TABLE `data_bus_loket`
  ADD KEY `loket` (`loket`,`bus`),
  ADD KEY `bus` (`bus`);

--
-- Indexes for table `data_loket`
--
ALTER TABLE `data_loket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_paket`
--
ALTER TABLE `data_paket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `data_penumpang`
--
ALTER TABLE `data_penumpang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `data_tujuan`
--
ALTER TABLE `data_tujuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loket` (`loket`,`bus`),
  ADD KEY `bus` (`bus`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data_bus`
--
ALTER TABLE `data_bus`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_loket`
--
ALTER TABLE `data_loket`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_paket`
--
ALTER TABLE `data_paket`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_penumpang`
--
ALTER TABLE `data_penumpang`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_tujuan`
--
ALTER TABLE `data_tujuan`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `data_bus_loket`
--
ALTER TABLE `data_bus_loket`
  ADD CONSTRAINT `data_bus_loket_ibfk_1` FOREIGN KEY (`loket`) REFERENCES `data_loket` (`id`),
  ADD CONSTRAINT `data_bus_loket_ibfk_2` FOREIGN KEY (`bus`) REFERENCES `data_bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `data_paket`
--
ALTER TABLE `data_paket`
  ADD CONSTRAINT `data_paket_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `data_tujuan` (`id`);

--
-- Constraints for table `data_penumpang`
--
ALTER TABLE `data_penumpang`
  ADD CONSTRAINT `data_penumpang_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `data_tujuan` (`id`);

--
-- Constraints for table `data_tujuan`
--
ALTER TABLE `data_tujuan`
  ADD CONSTRAINT `data_tujuan_ibfk_1` FOREIGN KEY (`loket`) REFERENCES `data_loket` (`id`),
  ADD CONSTRAINT `data_tujuan_ibfk_2` FOREIGN KEY (`bus`) REFERENCES `data_bus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
