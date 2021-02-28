-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2021 at 06:25 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pengarsipan_surat`
--

-- --------------------------------------------------------

--
-- Table structure for table `disposisi`
--

CREATE TABLE `disposisi` (
  `no_disposisi` varchar(10) NOT NULL,
  `no_agenda` varchar(10) DEFAULT NULL,
  `no_surat` int(20) DEFAULT NULL,
  `kepada` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `status_surat` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `disposisi`
--

INSERT INTO `disposisi` (`no_disposisi`, `no_agenda`, `no_surat`, `kepada`, `keterangan`, `status_surat`, `tanggal`) VALUES
(' 3', '1b', 35, 'Andafa', 'Ini cuma percobaan', 'Pending', '2021-01-12'),
('1', 'a01', 1, 'Koko', 'Teks', 'Terkirim', '2020-11-18'),
('2', 'a02', 2, 'Marry', 'Email', 'Pending', '2020-11-19');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(10) NOT NULL,
  `nama_depan` varchar(50) DEFAULT NULL,
  `nama_belakang` varchar(50) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) DEFAULT NULL,
  `hak` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_depan`, `nama_belakang`, `username`, `password`, `hak`) VALUES
(1, 'Larry', 'Lobster', 'larry', 'lary1', 'petugas'),
(2, 'Jeny', 'Holic', 'jeni1', 'jeny2', 'petugas'),
(4, 'user', 'me', 'user', '$2y$10$h2tWnLlo4sVk7bolhJfWduw3kXI83pFQ4fyRQKS5OnmuIK.SkZLre', 'Petugas'),
(5, 'rohi', 'abdullah', 'rohi', '$2y$10$ZZchdbBMd7/1ER0gyX.3xO1Kuh8fxasvzK3r2mFlhpyw/sa9iqf9.', 'Petugas'),
(6, 'nama', 'adna', 'testing', '$2y$10$ogI.AnsZpMeDGOexntTEy.tqlBhc1cvVCSsl56yZvw0NLgDIjHySC', 'Petugas'),
(8, 'test', 'nama', 'test2', '$2y$10$NTMunlpzL7tALGng5u2ey.lgOpwfnc/4fNg1SSkgRbuB5u8oomUiO', 'Petugas'),
(9, 'user', 'gas', 'baru', '12345', 'petugas'),
(10, 'Admin', 'Ganteng', 'adminmu', 'admin1', 'Admin'),
(412, 'oki', 'pi', 'pi', '$2y$10$K0J2tpoxGHURX.X.bw/zV.peHvnsEza6uKeSKJDBajEY/2yikFwXy', 'petugas'),
(415, 'fwadw', 'fwadw', 'fwad', '$2y$10$7uLf/.XuMOTzzXs6bDLSiO.GK6LrWO2W3zcTogJGCbs1d9Y.qALI2', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `surat_keluar`
--

CREATE TABLE `surat_keluar` (
  `no_agenda` varchar(10) NOT NULL,
  `id` int(10) NOT NULL,
  `jenis_surat` varchar(50) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `no_surat` int(20) DEFAULT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `perihal` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_keluar`
--

INSERT INTO `surat_keluar` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `no_surat`, `pengirim`, `perihal`) VALUES
(' dwa', 2, 'gfdfas', '2021-01-12', 15325, 'sgsefd', 'ddss '),
('a01', 1, 'resmi', '2020-11-17', 1001, 'Budi', 'Rapat'),
('a02', 2, 'Pribadi', '2020-11-18', 1002, 'Nova', 'Liburan'),
('a03', 10, 'Pribadi', '2021-01-14', 12, 'me', '-');

-- --------------------------------------------------------

--
-- Table structure for table `surat_masuk`
--

CREATE TABLE `surat_masuk` (
  `no_agenda` varchar(10) NOT NULL,
  `id` int(10) NOT NULL,
  `jenis_surat` varchar(50) DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `no_surat` int(11) DEFAULT NULL,
  `pengirim` varchar(50) DEFAULT NULL,
  `perihal` varchar(50) DEFAULT NULL,
  `tanggal_terima` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surat_masuk`
--

INSERT INTO `surat_masuk` (`no_agenda`, `id`, `jenis_surat`, `tanggal_kirim`, `no_surat`, `pengirim`, `perihal`, `tanggal_terima`) VALUES
('a01', 1, 'resmi', '2020-11-17', 1000, 'Budi', 'Rapat', '2020-11-17'),
('a02', 2, 'Pribadi', '2020-11-18', 1002, 'Nova', 'Liburan', '2020-11-21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`no_disposisi`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD PRIMARY KEY (`no_agenda`),
  ADD KEY `fk_petugas_suratkeluar` (`id`) USING BTREE;

--
-- Indexes for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD PRIMARY KEY (`no_agenda`),
  ADD KEY `fk_petugas_suratmasuk` (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=416;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat_keluar`
--
ALTER TABLE `surat_keluar`
  ADD CONSTRAINT `fk_petugas_suratmasuk` FOREIGN KEY (`id`) REFERENCES `petugas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `surat_keluar_ibfk_1` FOREIGN KEY (`id`) REFERENCES `petugas` (`id`);

--
-- Constraints for table `surat_masuk`
--
ALTER TABLE `surat_masuk`
  ADD CONSTRAINT `surat_masuk_ibfk_1` FOREIGN KEY (`id`) REFERENCES `petugas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
