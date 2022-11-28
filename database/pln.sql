-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2022 at 07:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pln`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id_images` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `nama_gambar` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id_images`, `id_login`, `nama_gambar`, `file`) VALUES
(1, 11, 'AIW', 'AIW.jpg'),
(3, 18, 'aku', 'aku.jpg'),
(4, 19, 'anu', 'anu.jpg'),
(5, 20, 'yu gi oh', 'yu gi oh.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `level` tinyint(4) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `username`, `password`, `level`, `aktif`) VALUES
(1, 'dewa', '123', 100, 1),
(11, 'indro', '123', 0, 1),
(18, 'dadang', '321', 3, 1),
(19, 'faisal', '123', 1, 1),
(20, 'supri kicau', '123', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meter`
--

CREATE TABLE `meter` (
  `id_meter` int(11) NOT NULL,
  `no_meter` varchar(12) DEFAULT NULL,
  `id_tarif` int(11) NOT NULL,
  `pemilik` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `telp` varchar(13) NOT NULL,
  `aktif` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meter`
--

INSERT INTO `meter` (`id_meter`, `no_meter`, `id_tarif`, `pemilik`, `alamat`, `telp`, `aktif`) VALUES
(34, '202211090001', 1, 'Indro Dwi Saputro', 'Jalan Subulussalam Gg. Awi RT. 37 NO.61', '0825462132', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `id_tagihan` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `biaya_admin` int(11) NOT NULL,
  `denda` int(11) NOT NULL,
  `biaya_tagihan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `id_login`, `id_tagihan`, `tanggal_bayar`, `biaya_admin`, `denda`, `biaya_tagihan`) VALUES
(24, 1, 44, '2022-11-09', 1600, 0, 1400000),
(25, 1, 45, '2022-11-11', 1600, 0, 1400000),
(26, 1, 46, '2022-11-11', 1600, 0, 1400000),
(27, 19, 47, '2022-11-11', 1600, 0, 1400000);

--
-- Triggers `pembayaran`
--
DELIMITER $$
CREATE TRIGGER `terbayar` AFTER INSERT ON `pembayaran` FOR EACH ROW BEGIN
UPDATE tagihan SET tagihan.status = '1'
WHERE id_tagihan = new.id_tagihan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penggunaan`
--

CREATE TABLE `penggunaan` (
  `id_penggunaan` int(11) NOT NULL,
  `no_meter` varchar(12) NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `meter_awal` int(11) NOT NULL,
  `meter_akhir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penggunaan`
--

INSERT INTO `penggunaan` (`id_penggunaan`, `no_meter`, `bulan`, `tahun`, `meter_awal`, `meter_akhir`) VALUES
(45, '202211090001', 1, 2022, 0, 200),
(46, '202211090001', 2, 2022, 200, 400),
(47, '202211090001', 3, 2022, 400, 600),
(48, '202211090001', 4, 2022, 600, 800);

--
-- Triggers `penggunaan`
--
DELIMITER $$
CREATE TRIGGER `tambah_tagihan` AFTER INSERT ON `penggunaan` FOR EACH ROW BEGIN
INSERT INTO tagihan SET id_penggunaan = new.id_penggunaan,
jumlah_meter = new.meter_akhir - new.meter_awal;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tagihan` AFTER UPDATE ON `penggunaan` FOR EACH ROW BEGIN
UPDATE tagihan SET tagihan.jumlah_meter = new.meter_akhir - new.meter_awal
WHERE tagihan.id_penggunaan = old.id_penggunaan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tagihan`
--

CREATE TABLE `tagihan` (
  `id_tagihan` int(11) NOT NULL,
  `id_penggunaan` int(11) NOT NULL,
  `jumlah_meter` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tagihan`
--

INSERT INTO `tagihan` (`id_tagihan`, `id_penggunaan`, `jumlah_meter`, `status`) VALUES
(44, 45, 200, 1),
(45, 46, 200, 1),
(46, 47, 200, 1),
(47, 48, 200, 1);

--
-- Triggers `tagihan`
--
DELIMITER $$
CREATE TRIGGER `deldel` AFTER DELETE ON `tagihan` FOR EACH ROW BEGIN
DELETE FROM penggunaan WHERE id_penggunaan = old.id_penggunaan;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tarif`
--

CREATE TABLE `tarif` (
  `id_tarif` int(11) NOT NULL,
  `daya` int(11) NOT NULL,
  `tarif_kwh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tarif`
--

INSERT INTO `tarif` (`id_tarif`, `daya`, `tarif_kwh`) VALUES
(1, 1300, 7000),
(4, 3400, 20000),
(6, 2400, 12000),
(8, 3000, 8000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_images`),
  ADD KEY `id_login` (`id_login`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indexes for table `meter`
--
ALTER TABLE `meter`
  ADD PRIMARY KEY (`id_meter`),
  ADD UNIQUE KEY `no_meter` (`no_meter`),
  ADD KEY `id_tarif` (`id_tarif`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `id_tagihan` (`id_tagihan`);

--
-- Indexes for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD PRIMARY KEY (`id_penggunaan`),
  ADD KEY `no_meter` (`no_meter`);

--
-- Indexes for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_penggunaan` (`id_penggunaan`);

--
-- Indexes for table `tarif`
--
ALTER TABLE `tarif`
  ADD PRIMARY KEY (`id_tarif`),
  ADD UNIQUE KEY `daya` (`daya`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id_images` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `meter`
--
ALTER TABLE `meter`
  MODIFY `id_meter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `penggunaan`
--
ALTER TABLE `penggunaan`
  MODIFY `id_penggunaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `tagihan`
--
ALTER TABLE `tagihan`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `tarif`
--
ALTER TABLE `tarif`
  MODIFY `id_tarif` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meter`
--
ALTER TABLE `meter`
  ADD CONSTRAINT `meter_ibfk_1` FOREIGN KEY (`id_tarif`) REFERENCES `tarif` (`id_tarif`) ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`id_tagihan`) REFERENCES `tagihan` (`id_tagihan`);

--
-- Constraints for table `penggunaan`
--
ALTER TABLE `penggunaan`
  ADD CONSTRAINT `penggunaan_ibfk_1` FOREIGN KEY (`no_meter`) REFERENCES `meter` (`no_meter`) ON UPDATE CASCADE;

--
-- Constraints for table `tagihan`
--
ALTER TABLE `tagihan`
  ADD CONSTRAINT `tagihan_ibfk_1` FOREIGN KEY (`id_penggunaan`) REFERENCES `penggunaan` (`id_penggunaan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
