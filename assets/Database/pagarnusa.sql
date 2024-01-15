-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2024 at 12:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pagarnusa`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `level` enum('admin','wasit') NOT NULL,
  `hp` int(20) NOT NULL,
  `aktif` enum('Y','N') NOT NULL,
  `pin` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hukuman`
--

CREATE TABLE `hukuman` (
  `id_hukuman` varchar(100) NOT NULL,
  `id_tanding` varchar(100) NOT NULL,
  `id_peserta` varchar(100) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `babak` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` varchar(100) NOT NULL,
  `id_tanding` varchar(100) NOT NULL,
  `id_wasit` varchar(100) NOT NULL,
  `id_peserta` varchar(100) NOT NULL,
  `babak` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `waktu` time NOT NULL,
  `timer` bigint(20) NOT NULL,
  `status` enum('proses','gagal','pakai') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nilai_fix`
--

CREATE TABLE `nilai_fix` (
  `id_nilai` varchar(100) NOT NULL,
  `id_tanding` varchar(100) NOT NULL,
  `id_peserta` varchar(100) NOT NULL,
  `babak` int(11) NOT NULL,
  `skor` int(11) NOT NULL,
  `ket` varchar(20) NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `partai`
--

CREATE TABLE `partai` (
  `id_partai` varchar(100) NOT NULL,
  `urut` int(11) NOT NULL,
  `babak` varchar(20) NOT NULL,
  `merah` varchar(100) NOT NULL,
  `biru` varchar(100) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id_peserta` varchar(100) NOT NULL,
  `kategori` enum('USIA DINI','PRA REMAJA') NOT NULL,
  `kontingen` text NOT NULL,
  `nama` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `jkl` enum('Laki-laki','Perempuan') NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `berat` int(11) NOT NULL,
  `pelatih` varchar(100) NOT NULL,
  `hp` int(20) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanding`
--

CREATE TABLE `tanding` (
  `id_tanding` varchar(100) NOT NULL,
  `id_partai` varchar(100) NOT NULL,
  `wasit` varchar(100) NOT NULL,
  `juri1` varchar(100) NOT NULL,
  `juri2` varchar(100) NOT NULL,
  `juri3` varchar(100) NOT NULL,
  `juri4` varchar(100) NOT NULL,
  `juri5` varchar(100) NOT NULL,
  `status` enum('belum','berjalan','dijeda','selesai') NOT NULL,
  `aktif` enum('N','Y') NOT NULL,
  `gel` int(11) NOT NULL,
  `babak` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','dewan') NOT NULL,
  `aktif` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `username`, `password`, `level`, `aktif`) VALUES
('245d9184-f76d-4812-abf5-0b424a4138a8', 'Administrator', 'admin', '$2y$10$.NS2EUwzf/8ZMZxaetbfTehZbea/d0.PLzhW3rsQoxilHRx150gu6', 'admin', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `wasit`
--

CREATE TABLE `wasit` (
  `id_wasit` varchar(100) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `hp` int(20) NOT NULL,
  `pin` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `hukuman`
--
ALTER TABLE `hukuman`
  ADD PRIMARY KEY (`id_hukuman`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_tanding` (`id_tanding`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_tanding` (`id_tanding`),
  ADD KEY `id_wasit` (`id_wasit`);

--
-- Indexes for table `nilai_fix`
--
ALTER TABLE `nilai_fix`
  ADD PRIMARY KEY (`id_nilai`),
  ADD KEY `id_peserta` (`id_peserta`),
  ADD KEY `id_tanding` (`id_tanding`);

--
-- Indexes for table `partai`
--
ALTER TABLE `partai`
  ADD PRIMARY KEY (`id_partai`),
  ADD KEY `merah` (`merah`),
  ADD KEY `biru` (`biru`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id_peserta`);

--
-- Indexes for table `tanding`
--
ALTER TABLE `tanding`
  ADD PRIMARY KEY (`id_tanding`),
  ADD KEY `id_partai` (`id_partai`),
  ADD KEY `wasit` (`wasit`),
  ADD KEY `juri5` (`juri5`),
  ADD KEY `juri1` (`juri1`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `wasit`
--
ALTER TABLE `wasit`
  ADD PRIMARY KEY (`id_wasit`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hukuman`
--
ALTER TABLE `hukuman`
  ADD CONSTRAINT `hukuman_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `hukuman_ibfk_2` FOREIGN KEY (`id_tanding`) REFERENCES `tanding` (`id_tanding`);

--
-- Constraints for table `nilai`
--
ALTER TABLE `nilai`
  ADD CONSTRAINT `nilai_ibfk_1` FOREIGN KEY (`id_peserta`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `nilai_ibfk_2` FOREIGN KEY (`id_tanding`) REFERENCES `tanding` (`id_tanding`),
  ADD CONSTRAINT `nilai_ibfk_3` FOREIGN KEY (`id_wasit`) REFERENCES `wasit` (`id_wasit`);

--
-- Constraints for table `partai`
--
ALTER TABLE `partai`
  ADD CONSTRAINT `partai_ibfk_1` FOREIGN KEY (`merah`) REFERENCES `peserta` (`id_peserta`),
  ADD CONSTRAINT `partai_ibfk_2` FOREIGN KEY (`biru`) REFERENCES `peserta` (`id_peserta`);

--
-- Constraints for table `tanding`
--
ALTER TABLE `tanding`
  ADD CONSTRAINT `tanding_ibfk_1` FOREIGN KEY (`id_partai`) REFERENCES `partai` (`id_partai`),
  ADD CONSTRAINT `tanding_ibfk_2` FOREIGN KEY (`wasit`) REFERENCES `wasit` (`id_wasit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
