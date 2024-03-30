-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 05:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaksinasi_hewan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_kabupaten`
--

CREATE TABLE `admin_kabupaten` (
  `id_kab` int(11) NOT NULL,
  `nama_kabupaten` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_kabupaten`
--

INSERT INTO `admin_kabupaten` (`id_kab`, `nama_kabupaten`, `username`, `password`) VALUES
(9101, 'KOTA JAYAPURA', 's', 'wd'),
(9107, 'KAB. PUNCAK JAYA', 'KJAw', 'awdw'),
(9108, 'KAB. ASMAT', 'asd', '123');

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `id_jadwal` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_vaksin`
--

CREATE TABLE `jadwal_vaksin` (
  `id_jadwal` int(11) NOT NULL,
  `id_vaksin` int(11) NOT NULL,
  `tgl_pemberian` date DEFAULT NULL,
  `rizky_bgst` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_vaksin`
--

INSERT INTO `jadwal_vaksin` (`id_jadwal`, `id_vaksin`, `tgl_pemberian`, `rizky_bgst`) VALUES
(3, 3, '2024-03-26', ''),
(4, 5, '2023-12-11', 'lorem_ipsum'),
(5, 5, '2024-04-15', ''),
(6, 5, '2024-03-22', ''),
(7, 3, '2024-03-27', '');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik_ternak`
--

CREATE TABLE `pemilik_ternak` (
  `id_pemilik_ternak` int(11) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `nama_pemilik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilik_ternak`
--

INSERT INTO `pemilik_ternak` (`id_pemilik_ternak`, `id_kab`, `nama_pemilik`, `alamat`, `no_hp`) VALUES
(1, 9108, 'TEST', 'awdbbb', '094'),
(2, 9108, 'Test', 'andm', '08132'),
(4, 9101, 'kawd', 'awdawd', '0912'),
(5, 9101, 'asdkas', 'wrwr', '33'),
(6, 9108, 'jkajw', 'awdawd', '333');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`) VALUES
(1, 'admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `vaksinasi`
--

CREATE TABLE `vaksinasi` (
  `id_vaksinasi` int(11) NOT NULL,
  `id_peternak` int(11) NOT NULL,
  `jumlah_dosis` int(50) NOT NULL,
  `jenis` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaksinasi`
--

INSERT INTO `vaksinasi` (`id_vaksinasi`, `id_peternak`, `jumlah_dosis`, `jenis`) VALUES
(3, 1, 2, 'Rabies'),
(5, 6, 2, 'RRE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_kabupaten`
--
ALTER TABLE `admin_kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`),
  ADD KEY `dokumentasi_ibfk1` (`id_jadwal`);

--
-- Indexes for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_vaksinibfk1` (`id_vaksin`);

--
-- Indexes for table `pemilik_ternak`
--
ALTER TABLE `pemilik_ternak`
  ADD PRIMARY KEY (`id_pemilik_ternak`),
  ADD KEY `pemilik_ternak_ibfk1` (`id_kab`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  ADD PRIMARY KEY (`id_vaksinasi`),
  ADD KEY `vaksinasi_ibfk1` (`id_peternak`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_kabupaten`
--
ALTER TABLE `admin_kabupaten`
  MODIFY `id_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9109;

--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pemilik_ternak`
--
ALTER TABLE `pemilik_ternak`
  MODIFY `id_pemilik_ternak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  MODIFY `id_vaksinasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `dokumentasi_ibfk1` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_vaksin` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  ADD CONSTRAINT `jadwal_vaksinibfk1` FOREIGN KEY (`id_vaksin`) REFERENCES `vaksinasi` (`id_vaksinasi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemilik_ternak`
--
ALTER TABLE `pemilik_ternak`
  ADD CONSTRAINT `pemilik_ternak_ibfk1` FOREIGN KEY (`id_kab`) REFERENCES `admin_kabupaten` (`id_kab`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaksinasi`
--
ALTER TABLE `vaksinasi`
  ADD CONSTRAINT `vaksinasi_ibfk1` FOREIGN KEY (`id_peternak`) REFERENCES `pemilik_ternak` (`id_pemilik_ternak`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
