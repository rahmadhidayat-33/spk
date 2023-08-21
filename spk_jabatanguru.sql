-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2023 at 07:35 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_jabatanguru`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_akun`
--

CREATE TABLE `tbl_akun` (
  `kode_akun` char(5) NOT NULL,
  `nama_lengkap` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_akun`
--

INSERT INTO `tbl_akun` (`kode_akun`, `nama_lengkap`, `username`, `password`, `level`) VALUES
('A01', 'administrator', 'admin', 'ra717112at', 'admin'),
('A02', 'wakil', 'waka', 'ra717112at', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alternatif`
--

CREATE TABLE `tbl_alternatif` (
  `nip` varchar(25) NOT NULL,
  `nama_alternatif` varchar(25) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `gol` varchar(10) NOT NULL,
  `program_studi` varchar(25) NOT NULL,
  `jabatan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_alternatif`
--

INSERT INTO `tbl_alternatif` (`nip`, `nama_alternatif`, `jenis_kelamin`, `gol`, `program_studi`, `jabatan`) VALUES
('317197416147', 'Susi Yenti, S.Ag', 'perempuan', 'III-D', 'SKI', 'ada'),
('317198105057', 'Yessi Herlina, S. Sos', 'perempuan', 'III-D', 'IPS Terpadu', 'ada'),
('317199119168', 'Firman Hidayat, Lc', 'laki-laki', 'III-D', 'Muhadatsah, Ushul Fiqh', 'tidak ada'),
('317199417155', 'Mira Putri Dewi, S.E', 'perempuan', 'III-D', 'Tahsin Qiraah', 'ada'),
('317199519165', 'Jefri, S.Pd', 'laki-laki', 'III-D', 'Jefri, S.Pd', 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kriteria`
--

CREATE TABLE `tbl_kriteria` (
  `id_kriteria` varchar(10) NOT NULL,
  `nama_kriteria` varchar(25) NOT NULL,
  `bobot` double NOT NULL,
  `kategori` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_kriteria`
--

INSERT INTO `tbl_kriteria` (`id_kriteria`, `nama_kriteria`, `bobot`, `kategori`) VALUES
('C1', 'Lama Mengabdi', 0.27, 'Benefit'),
('C2', 'Pendidikan Terakhir', 0.25, 'Benefit'),
('C3', 'Absensi Kehadiran', 0.15, 'Cost'),
('C4', 'Prestasi', 0.1, 'Benefit'),
('C5', 'Disiplin Kedatangan', 0.11, 'Benefit'),
('C6', 'Kemampuan Mengajar', 0.12, 'Benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penilaian`
--

CREATE TABLE `tbl_penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `id_kriteria` char(5) NOT NULL,
  `id_sub` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_penilaian`
--

INSERT INTO `tbl_penilaian` (`id_penilaian`, `tanggal`, `nip`, `id_kriteria`, `id_sub`) VALUES
(7, '2023-07-10', '317197416147', 'C1', 'D03'),
(8, '2023-07-10', '317197416147', 'C2', 'D07'),
(9, '2023-07-10', '317197416147', 'C3', 'D11'),
(10, '2023-07-10', '317197416147', 'C4', 'D18'),
(11, '2023-07-10', '317197416147', 'C5', 'D21'),
(12, '2023-07-10', '317197416147', 'C6', 'D28'),
(13, '2023-07-10', '317198105057', 'C1', 'D01'),
(14, '2023-07-10', '317198105057', 'C2', 'D07'),
(15, '2023-07-10', '317198105057', 'C3', 'D09'),
(16, '2023-07-10', '317198105057', 'C4', 'D18'),
(17, '2023-07-10', '317198105057', 'C5', 'D23'),
(18, '2023-07-10', '317198105057', 'C6', 'D29'),
(19, '2023-07-10', '317199119168', 'C1', 'D05'),
(20, '2023-07-10', '317199119168', 'C2', 'D07'),
(21, '2023-07-10', '317199119168', 'C3', 'D10'),
(22, '2023-07-10', '317199119168', 'C4', 'D19'),
(23, '2023-07-10', '317199119168', 'C5', 'D23'),
(24, '2023-07-10', '317199119168', 'C6', 'D27'),
(25, '2023-07-10', '317199417155', 'C1', 'D03'),
(26, '2023-07-10', '317199417155', 'C2', 'D07'),
(27, '2023-07-10', '317199417155', 'C3', 'D11'),
(28, '2023-07-10', '317199417155', 'C4', 'D18'),
(29, '2023-07-10', '317199417155', 'C5', 'D23'),
(30, '2023-07-10', '317199417155', 'C6', 'D28'),
(31, '2023-07-10', '317199519165', 'C1', 'D05'),
(32, '2023-07-10', '317199519165', 'C2', 'D07'),
(33, '2023-07-10', '317199519165', 'C3', 'D09'),
(34, '2023-07-10', '317199519165', 'C4', 'D20'),
(35, '2023-07-10', '317199519165', 'C5', 'D21'),
(36, '2023-07-10', '317199519165', 'C6', 'D28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pimpinan`
--

CREATE TABLE `tbl_pimpinan` (
  `id` varchar(10) NOT NULL,
  `nama_pimpinan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_pimpinan`
--

INSERT INTO `tbl_pimpinan` (`id`, `nama_pimpinan`) VALUES
('1910115261', 'Drs. Metriadi');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rengking`
--

CREATE TABLE `tbl_rengking` (
  `id_rengking` int(11) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_alternatif` varchar(25) NOT NULL,
  `nilai` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rengking`
--

INSERT INTO `tbl_rengking` (`id_rengking`, `nip`, `nama_alternatif`, `nilai`) VALUES
(1, '317197416147', 'Susi Yenti, S.Ag', 0.84),
(2, '317198105057', 'Yessi Herlina, S. Sos', 0.81),
(3, '317199119168', 'Firman Hidayat, Lc', 0.59),
(4, '317199417155', 'Mira Putri Dewi, S.E', 0.78),
(5, '317199519165', 'Jefri, S.Pd', 0.56);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subkriteria`
--

CREATE TABLE `tbl_subkriteria` (
  `id_sub` char(5) NOT NULL,
  `nama_sub` varchar(25) NOT NULL,
  `nilai_sub` double NOT NULL,
  `id_kriteria` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subkriteria`
--

INSERT INTO `tbl_subkriteria` (`id_sub`, `nama_sub`, `nilai_sub`, `id_kriteria`) VALUES
('D01', 'Minimal 10 tahun', 1, 'C1'),
('D02', 'Minimal 8 tahun', 0.75, 'C1'),
('D03', 'Minimal 6 tahun', 0.5, 'C1'),
('D04', 'Minimal 5 tahun', 0.25, 'C1'),
('D05', 'Minimal 3 tahun', 0.1, 'C1'),
('D06', 'Ijazah S2', 1, 'C2'),
('D07', 'Ijazah S1', 0.5, 'C2'),
('D08', 'Ijazah SLTA', 0.1, 'C2'),
('D09', 'Tidak ada absen', 1, 'C3'),
('D10', '1x absen', 0.75, 'C3'),
('D11', '2x absen', 0.5, 'C3'),
('D12', '3x absen', 0.25, 'C3'),
('D13', '4x absen', 1, 'C3'),
('D14', '≥ 5x absen', 0.01, 'C3'),
('D15', '≥ 5 prestasi', 1, 'C4'),
('D16', '4 prestasi', 0.75, 'C4'),
('D17', '3 prestasi', 0.5, 'C4'),
('D18', '2 prestasi', 0.25, 'C4'),
('D19', '1 prestasi', 0.1, 'C4'),
('D20', 'Tidak ada prestasi', 0.01, 'C4'),
('D21', 'Tidak pernah terlambat', 1, 'C5'),
('D22', '1x keterlambatan', 0.75, 'C5'),
('D23', '3x keterlambatan', 0.5, 'C5'),
('D24', '3x keterlambatan ', 0.25, 'C5'),
('D25', '4x keterlambatan', 0.1, 'C5'),
('D26', '≥ 5x keterlambatan', 0.01, 'C5'),
('D27', 'Sangat Baik', 1, 'C6'),
('D28', ' Baik', 0.75, 'C6'),
('D29', 'Cukup', 0.5, 'C6'),
('D30', 'Kurang ', 0.25, 'C6'),
('D31', 'Sangat Kurang', 0.1, 'C6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_alternatif`
--
ALTER TABLE `tbl_alternatif`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `tbl_kriteria`
--
ALTER TABLE `tbl_kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  ADD PRIMARY KEY (`id_penilaian`);

--
-- Indexes for table `tbl_pimpinan`
--
ALTER TABLE `tbl_pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_rengking`
--
ALTER TABLE `tbl_rengking`
  ADD PRIMARY KEY (`id_rengking`);

--
-- Indexes for table `tbl_subkriteria`
--
ALTER TABLE `tbl_subkriteria`
  ADD PRIMARY KEY (`id_sub`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_penilaian`
--
ALTER TABLE `tbl_penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_rengking`
--
ALTER TABLE `tbl_rengking`
  MODIFY `id_rengking` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
