-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2024 at 01:58 PM
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
(9108, 'KAB. ASMAT', 'asd', '123'),
(9109, 'KAB. JAYAPURA', 'test', '4321');

-- --------------------------------------------------------

--
-- Table structure for table `distribusi_vaksin`
--

CREATE TABLE `distribusi_vaksin` (
  `id` int(11) NOT NULL,
  `id_kabupaten` int(11) NOT NULL,
  `id_jenis_vaksin` int(11) NOT NULL,
  `tahun_vaksin` varchar(4) NOT NULL,
  `jumlah_dosis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dokumentasi`
--

CREATE TABLE `dokumentasi` (
  `id_dokumentasi` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp(),
  `alamat` text NOT NULL,
  `foto` varchar(250) NOT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_vaksin`
--

CREATE TABLE `jadwal_vaksin` (
  `id_jadwal` int(11) NOT NULL,
  `id_jenis_vaksin` int(11) NOT NULL,
  `hari_vaksin` varchar(10) NOT NULL,
  `tgl_vaksin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jadwal_vaksin`
--

INSERT INTO `jadwal_vaksin` (`id_jadwal`, `id_jenis_vaksin`, `hari_vaksin`, `tgl_vaksin`) VALUES
(21, 1, 'Sabtu', '2024-05-09'),
(22, 1, 'Sabtu', '2024-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_vaksin`
--

CREATE TABLE `jenis_vaksin` (
  `id` int(11) NOT NULL,
  `jenis_vaksin` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_vaksin`
--

INSERT INTO `jenis_vaksin` (`id`, `jenis_vaksin`) VALUES
(1, 'Rabies');

-- --------------------------------------------------------

--
-- Table structure for table `pemilik_ternak`
--

CREATE TABLE `pemilik_ternak` (
  `nik` varchar(16) NOT NULL,
  `id_usulan` int(11) NOT NULL,
  `id_kab` int(11) NOT NULL,
  `nama_pemilik` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `jumlah_ternak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pemilik_ternak`
--

INSERT INTO `pemilik_ternak` (`nik`, `id_usulan`, `id_kab`, `nama_pemilik`, `alamat`, `no_hp`, `jumlah_ternak`) VALUES
('2', 1, 9108, 'Test', 'andm', '08132', 0),
('4', 1, 9101, 'kawd', 'awdawd', '0912', 0),
('5', 1, 9101, 'asdkas', 'wrwr', '33', 0),
('6', 1, 9108, 'jkajw', 'awdawd', '333', 0),
('7', 1, 9109, 'RRE', 'sdfsdf', '23123', 0),
('8', 1, 9109, 'DDe', 'asdasd', '23123', 0);

-- --------------------------------------------------------

--
-- Table structure for table `peserta_vaksin`
--

CREATE TABLE `peserta_vaksin` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `id_jadwal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta_vaksin`
--

INSERT INTO `peserta_vaksin` (`id`, `nik`, `id_jadwal`) VALUES
(1, '2', 21);

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
-- Table structure for table `usulan`
--

CREATE TABLE `usulan` (
  `id` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `jumlah_ternak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usulan`
--

INSERT INTO `usulan` (`id`, `nama`, `alamat`, `no_hp`, `jumlah_ternak`) VALUES
(1, 'adwa', 'Entrop', '081312312', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_kabupaten`
--
ALTER TABLE `admin_kabupaten`
  ADD PRIMARY KEY (`id_kab`);

--
-- Indexes for table `distribusi_vaksin`
--
ALTER TABLE `distribusi_vaksin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `distribusi_vaksin_ibfk1` (`id_kabupaten`),
  ADD KEY `distribusi_vaksin_ibfk2` (`id_jenis_vaksin`);

--
-- Indexes for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD PRIMARY KEY (`id_dokumentasi`),
  ADD KEY `dokumentasi_ibfk1` (`id_peserta`);

--
-- Indexes for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `jadwal_vaksinibfk1` (`id_jenis_vaksin`);

--
-- Indexes for table `jenis_vaksin`
--
ALTER TABLE `jenis_vaksin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilik_ternak`
--
ALTER TABLE `pemilik_ternak`
  ADD PRIMARY KEY (`nik`),
  ADD KEY `pemilik_ternak_ibfk1` (`id_kab`),
  ADD KEY `pemilik_ternak_ibfk2` (`id_usulan`);

--
-- Indexes for table `peserta_vaksin`
--
ALTER TABLE `peserta_vaksin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peserta_vaksin_ibfk1` (`nik`),
  ADD KEY `peserta_vaksin_ibfk2` (`id_jadwal`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `usulan`
--
ALTER TABLE `usulan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_kabupaten`
--
ALTER TABLE `admin_kabupaten`
  MODIFY `id_kab` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9110;

--
-- AUTO_INCREMENT for table `distribusi_vaksin`
--
ALTER TABLE `distribusi_vaksin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  MODIFY `id_dokumentasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  MODIFY `id_jadwal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `jenis_vaksin`
--
ALTER TABLE `jenis_vaksin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `peserta_vaksin`
--
ALTER TABLE `peserta_vaksin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `usulan`
--
ALTER TABLE `usulan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `distribusi_vaksin`
--
ALTER TABLE `distribusi_vaksin`
  ADD CONSTRAINT `distribusi_vaksin_ibfk1` FOREIGN KEY (`id_kabupaten`) REFERENCES `admin_kabupaten` (`id_kab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `distribusi_vaksin_ibfk2` FOREIGN KEY (`id_jenis_vaksin`) REFERENCES `jenis_vaksin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dokumentasi`
--
ALTER TABLE `dokumentasi`
  ADD CONSTRAINT `dokumentasi_ibfk1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta_vaksin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jadwal_vaksin`
--
ALTER TABLE `jadwal_vaksin`
  ADD CONSTRAINT `jadwal_vaksinibfk1` FOREIGN KEY (`id_jenis_vaksin`) REFERENCES `jenis_vaksin` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pemilik_ternak`
--
ALTER TABLE `pemilik_ternak`
  ADD CONSTRAINT `pemilik_ternak_ibfk1` FOREIGN KEY (`id_kab`) REFERENCES `admin_kabupaten` (`id_kab`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pemilik_ternak_ibfk2` FOREIGN KEY (`id_usulan`) REFERENCES `usulan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peserta_vaksin`
--
ALTER TABLE `peserta_vaksin`
  ADD CONSTRAINT `peserta_vaksin_ibfk1` FOREIGN KEY (`nik`) REFERENCES `pemilik_ternak` (`nik`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `peserta_vaksin_ibfk2` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_vaksin` (`id_jadwal`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
