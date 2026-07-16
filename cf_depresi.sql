-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2025 at 01:34 AM
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
-- Database: `cf_depresi`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `username`, `password`, `nama`) VALUES
(1, 'admin', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `balas_pesan`
--

CREATE TABLE `balas_pesan` (
  `id_balas` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_pesan` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balas_pesan`
--

INSERT INTO `balas_pesan` (`id_balas`, `id_member`, `id_pesan`, `pesan`, `status`, `waktu`) VALUES
(19, 10, 30, 'hai, ada yang bisa kami bantu?', 'notyet', '2023-10-22 13:18:35'),
(20, 10, 31, 'boleh dong', 'notyet', '2023-10-22 13:20:10'),
(21, 10, 32, 'iyaa, gimana?', 'notyet', '2023-11-05 17:24:18');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kd_gejala` varchar(5) NOT NULL,
  `kd_penyakit` varchar(5) NOT NULL,
  `nama_gejala` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kd_gejala`, `kd_penyakit`, `nama_gejala`) VALUES
(1, 'G01', 'K01', 'Mengalami Perubahan Emosi'),
(2, 'G02', 'K01', 'Lelah'),
(3, 'G03', 'K01', 'Sedih'),
(4, 'G04', 'K02', 'Penurunan Minat Dalam Aktivitas yang Biasanya Dinikmati'),
(5, 'G05', 'K02', 'Memiliki Gagasan Tentang Rasa Bersalah atau Tidak Berguna'),
(6, 'G06', 'K02', 'Ketidakpercayaan Pada Diri Sendiri atau Kurang nya Rasa Harga Diri'),
(7, 'G07', 'K02', 'Gangguan Tidur '),
(8, 'G08', 'K02', 'Gangguan Pola Makan'),
(9, 'G09', 'K03', 'Mengalami Gangguan Kesehatan'),
(10, 'G10', 'K03', 'Memiliki Perasaan Lelah yang Mendalam'),
(11, 'G11', 'K03', 'Hilang nya Minat Dalam Aktivitas Sosial'),
(12, 'G12', 'K03', 'Memiliki Perasaan Putus Asa atau Ingin Mengakhiri Hidup'),
(16, 'G13', 'K03', 'Memiliki Pandangan Masa Depan yang Suram atau Pesimis'),
(20, 'G14', 'K03', 'Mengalami Waham atau Halusinasi');

-- --------------------------------------------------------

--
-- Table structure for table `hasil_konsultasi`
--

CREATE TABLE `hasil_konsultasi` (
  `id_hasilkonsultasi` int(11) NOT NULL,
  `no_konsul` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `kd_penyakit` varchar(5) CHARACTER SET latin1 NOT NULL,
  `cf1` double NOT NULL,
  `cf2` double NOT NULL,
  `cf3` double NOT NULL,
  `cf4` double NOT NULL,
  `max` double NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hasil_konsultasi`
--

INSERT INTO `hasil_konsultasi` (`id_hasilkonsultasi`, `no_konsul`, `id_member`, `kd_penyakit`, `cf1`, `cf2`, `cf3`, `cf4`, `max`, `waktu`) VALUES
(1, 2, 10, 'K01', 0.85, 0, 0, 0, 85, '2023-11-05 17:22:36'),
(2, 3, 10, '', 0, 0, 0, 0, 0, '2023-11-05 17:28:57'),
(3, 4, 10, 'K03', 0.376, 0.204, 0.864, 0, 86.4, '2023-11-05 17:34:05'),
(4, 5, 10, 'K01', 0.389, 0, 0, 0, 38.88, '2023-11-05 17:49:36'),
(5, 6, 10, 'K01', 0.828, 0.624, 0.782, 0, 82.79, '2023-11-13 19:15:32'),
(6, 7, 10, 'K01', 0.992, 0.982, 0.975, 0, 99.19, '2023-11-13 20:04:25'),
(7, 8, 10, 'K01', 0.858, 0.384, 0.485, 0, 85.81, '2023-11-13 20:28:08'),
(8, 9, 10, 'K01', 0.718, 0.716, 0.519, 0, 71.83, '2023-11-14 07:39:19'),
(9, 9, 10, 'K01', 0.718, 0.716, 0.519, 0, 71.83, '2023-11-14 07:40:52'),
(10, 10, 10, 'K01', 0.963, 0.504, 0.388, 0, 96.31, '2023-12-05 16:59:14'),
(11, 10, 10, 'K01', 0.963, 0.504, 0.388, 0, 96.31, '2023-12-05 17:05:27'),
(12, 10, 10, 'K01', 0.963, 0.504, 0.388, 0, 96.31, '2023-12-05 17:05:27'),
(13, 11, 10, 'K01', 0.992, 0.982, 0.192, 0, 99.19, '2023-12-05 17:13:00'),
(14, 12, 10, 'K03', 0.55, 0.825, 0.885, 0, 88.5, '2023-12-05 18:35:54'),
(15, 12, 10, 'K03', 0.55, 0.825, 0.885, 0, 88.5, '2023-12-05 18:37:56'),
(16, 13, 10, 'K01', 0.898, 0.716, 0.388, 0, 89.77, '2023-12-05 18:40:02'),
(17, 14, 11, 'K03', 0.376, 0.384, 0.549, 0, 54.92, '2023-12-14 01:42:03'),
(18, 15, 10, '', 0, 0, 0, 0, 0, '2023-12-14 15:50:01'),
(19, 15, 10, '', 0, 0, 0, 0, 0, '2023-12-14 15:50:14'),
(20, 16, 10, 'K02', 0.55, 0.647, 0.192, 0, 64.75, '2023-12-14 15:52:06'),
(21, 16, 10, 'K02', 0.55, 0.647, 0.192, 0, 64.75, '2023-12-14 15:58:52'),
(22, 16, 10, 'K02', 0.55, 0.647, 0.192, 0, 64.75, '2023-12-14 16:08:49'),
(23, 17, 10, 'K02', 0.389, 0.72, 0.497, 0, 71.95, '2023-12-14 17:04:39');

-- --------------------------------------------------------

--
-- Table structure for table `konsultasi`
--

CREATE TABLE `konsultasi` (
  `id_konsultasi` int(11) NOT NULL,
  `no_konsul` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `kd_gejala` varchar(5) NOT NULL,
  `cf` double NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konsultasi`
--

INSERT INTO `konsultasi` (`id_konsultasi`, `no_konsul`, `id_member`, `kd_gejala`, `cf`, `tanggal`) VALUES
(870, 1, 10, 'G01', 1, '2023-10-22'),
(871, 1, 10, 'G02', 0.8, '2023-10-22'),
(872, 1, 10, 'G03', 0.4, '2023-10-22'),
(873, 1, 10, 'G04', 0.1, '2023-10-22'),
(874, 1, 10, 'G05', 0.6, '2023-10-22'),
(875, 1, 10, 'G06', 1, '2023-10-22'),
(876, 1, 10, 'G07', 0.8, '2023-10-22'),
(877, 1, 10, 'G08', 0.8, '2023-10-22'),
(878, 2, 10, 'G01', 1, '2023-11-05'),
(879, 2, 10, 'G02', 1, '2023-11-05'),
(880, 2, 10, 'G03', 1, '2023-11-05'),
(881, 3, 10, 'G01', 0.4, '2023-11-05'),
(882, 3, 10, 'G02', 0.8, '2023-11-05'),
(883, 3, 10, 'G04', 1, '2023-11-05'),
(884, 3, 10, 'G06', 0.4, '2023-11-05'),
(885, 3, 10, 'G08', 0.1, '2023-11-05'),
(886, 3, 10, 'G10', 1, '2023-11-05'),
(887, 3, 10, 'G12', 0.1, '2023-11-05'),
(888, 3, 10, 'G14', 0.8, '2023-11-05'),
(889, 4, 10, 'G01', 0.1, '2023-11-05'),
(890, 4, 10, 'G02', 0.4, '2023-11-05'),
(891, 4, 10, 'G03', 0.6, '2023-11-05'),
(892, 4, 10, 'G04', 0.8, '2023-11-05'),
(893, 4, 10, 'G05', 1, '2023-11-05'),
(894, 4, 10, 'G06', 0.1, '2023-11-05'),
(895, 4, 10, 'G07', 0.8, '2023-11-05'),
(896, 4, 10, 'G08', 0.6, '2023-11-05'),
(897, 4, 10, 'G09', 1, '2023-11-05'),
(898, 4, 10, 'G10', 1, '2023-11-05'),
(899, 4, 10, 'G11', 0.4, '2023-11-05'),
(900, 4, 10, 'G12', 0.6, '2023-11-05'),
(901, 4, 10, 'G13', 1, '2023-11-05'),
(902, 4, 10, 'G14', 0.8, '2023-11-05'),
(903, 5, 10, 'G01', 1, '2023-11-05'),
(904, 5, 10, 'G02', 0.1, '2023-11-05'),
(905, 5, 10, 'G03', 0.4, '2023-11-05'),
(906, 5, 10, 'G04', 0.6, '2023-11-05'),
(907, 5, 10, 'G05', 0.8, '2023-11-05'),
(908, 5, 10, 'G09', 1, '2023-11-05'),
(909, 5, 10, 'G10', 0.4, '2023-11-05'),
(910, 5, 10, 'G12', 0.8, '2023-11-05'),
(911, 5, 10, 'G13', 0.6, '2023-11-05'),
(912, 5, 10, 'G14', 0.8, '2023-11-05'),
(913, 6, 10, 'G01', 1, '2023-11-13'),
(914, 6, 10, 'G02', 1, '2023-11-13'),
(915, 6, 10, 'G03', 0.4, '2023-11-13'),
(916, 6, 10, 'G04', 0.6, '2023-11-13'),
(917, 6, 10, 'G05', 0.8, '2023-11-13'),
(918, 6, 10, 'G06', 1, '2023-11-13'),
(919, 6, 10, 'G07', 0.1, '2023-11-13'),
(920, 6, 10, 'G08', 1, '2023-11-13'),
(921, 6, 10, 'G09', 0.8, '2023-11-13'),
(922, 6, 10, 'G10', 1, '2023-11-13'),
(923, 6, 10, 'G11', 0.4, '2023-11-13'),
(924, 6, 10, 'G12', 0.6, '2023-11-13'),
(925, 6, 10, 'G13', 0.1, '2023-11-13'),
(926, 6, 10, 'G14', 1, '2023-11-13'),
(927, 7, 10, 'G01', 1, '2023-11-13'),
(928, 7, 10, 'G02', 1, '2023-11-13'),
(929, 7, 10, 'G03', 1, '2023-11-13'),
(930, 7, 10, 'G04', 1, '2023-11-13'),
(931, 7, 10, 'G05', 1, '2023-11-13'),
(932, 7, 10, 'G06', 1, '2023-11-13'),
(933, 7, 10, 'G07', 1, '2023-11-13'),
(934, 7, 10, 'G08', 1, '2023-11-13'),
(935, 7, 10, 'G09', 1, '2023-11-13'),
(936, 7, 10, 'G10', 1, '2023-11-13'),
(937, 7, 10, 'G11', 1, '2023-11-13'),
(938, 7, 10, 'G12', 1, '2023-11-13'),
(939, 7, 10, 'G13', 1, '2023-11-13'),
(940, 7, 10, 'G14', 1, '2023-11-13'),
(941, 8, 10, 'G01', 0.8, '2023-11-13'),
(942, 8, 10, 'G02', 1, '2023-11-13'),
(943, 8, 10, 'G03', 0.6, '2023-11-13'),
(944, 8, 10, 'G04', 0.4, '2023-11-13'),
(945, 8, 10, 'G05', 0.6, '2023-11-13'),
(946, 8, 10, 'G06', 0.4, '2023-11-13'),
(947, 8, 10, 'G07', 0.1, '2023-11-13'),
(948, 8, 10, 'G08', 0.6, '2023-11-13'),
(949, 8, 10, 'G09', 0.8, '2023-11-13'),
(950, 8, 10, 'G10', 0.4, '2023-11-13'),
(951, 8, 10, 'G11', 0.6, '2023-11-13'),
(952, 8, 10, 'G12', 0.1, '2023-11-13'),
(953, 8, 10, 'G13', 1, '2023-11-13'),
(954, 8, 10, 'G14', 0.6, '2023-11-13'),
(955, 9, 10, 'G01', 1, '2023-11-14'),
(956, 9, 10, 'G02', 0.4, '2023-11-14'),
(957, 9, 10, 'G03', 0.6, '2023-11-14'),
(958, 9, 10, 'G04', 0.8, '2023-11-14'),
(959, 9, 10, 'G05', 0.4, '2023-11-14'),
(960, 9, 10, 'G06', 1, '2023-11-14'),
(961, 9, 10, 'G07', 0.4, '2023-11-14'),
(962, 9, 10, 'G08', 1, '2023-11-14'),
(963, 9, 10, 'G09', 0.6, '2023-11-14'),
(964, 9, 10, 'G10', 0.6, '2023-11-14'),
(965, 9, 10, 'G11', 0.1, '2023-11-14'),
(966, 9, 10, 'G12', 0.1, '2023-11-14'),
(967, 9, 10, 'G13', 0.6, '2023-11-14'),
(968, 9, 10, 'G14', 0.4, '2023-11-14'),
(969, 10, 10, 'G01', 1, '2023-12-05'),
(970, 10, 10, 'G02', 1, '2023-12-05'),
(971, 10, 10, 'G03', 1, '2023-12-05'),
(972, 10, 10, 'G04', 1, '2023-12-05'),
(973, 10, 10, 'G05', 0.4, '2023-12-05'),
(974, 10, 10, 'G06', 0.8, '2023-12-05'),
(975, 10, 10, 'G07', 0.6, '2023-12-05'),
(976, 10, 10, 'G08', 0.1, '2023-12-05'),
(977, 10, 10, 'G09', 0.6, '2023-12-05'),
(978, 10, 10, 'G10', 0.4, '2023-12-05'),
(979, 10, 10, 'G11', 0.1, '2023-12-05'),
(980, 10, 10, 'G12', 0.6, '2023-12-05'),
(981, 10, 10, 'G13', 1, '2023-12-05'),
(982, 10, 10, 'G14', 0.8, '2023-12-05'),
(983, 11, 10, 'G01', 1, '2023-12-05'),
(984, 11, 10, 'G02', 1, '2023-12-05'),
(985, 11, 10, 'G03', 1, '2023-12-05'),
(986, 11, 10, 'G04', 1, '2023-12-05'),
(987, 11, 10, 'G05', 1, '2023-12-05'),
(988, 11, 10, 'G06', 1, '2023-12-05'),
(989, 11, 10, 'G07', 1, '2023-12-05'),
(990, 11, 10, 'G08', 1, '2023-12-05'),
(991, 11, 10, 'G09', 1, '2023-12-05'),
(992, 11, 10, 'G10', 0.1, '2023-12-05'),
(993, 11, 10, 'G11', 0.1, '2023-12-05'),
(994, 11, 10, 'G12', 0.4, '2023-12-05'),
(995, 11, 10, 'G13', 1, '2023-12-05'),
(996, 11, 10, 'G14', 1, '2023-12-05'),
(997, 12, 10, 'G01', 0.8, '2023-12-05'),
(998, 12, 10, 'G02', 0.4, '2023-12-05'),
(999, 12, 10, 'G03', 1, '2023-12-05'),
(1000, 12, 10, 'G04', 0.6, '2023-12-05'),
(1001, 12, 10, 'G05', 0.1, '2023-12-05'),
(1002, 12, 10, 'G06', 0.6, '2023-12-05'),
(1003, 12, 10, 'G07', 1, '2023-12-05'),
(1004, 12, 10, 'G08', 1, '2023-12-05'),
(1005, 12, 10, 'G09', 1, '2023-12-05'),
(1006, 12, 10, 'G10', 1, '2023-12-05'),
(1007, 12, 10, 'G11', 1, '2023-12-05'),
(1008, 12, 10, 'G12', 0.1, '2023-12-05'),
(1009, 12, 10, 'G13', 0.6, '2023-12-05'),
(1010, 12, 10, 'G14', 0.4, '2023-12-05'),
(1011, 13, 10, 'G01', 1, '2023-12-05'),
(1012, 13, 10, 'G02', 1, '2023-12-05'),
(1013, 13, 10, 'G03', 1, '2023-12-05'),
(1014, 13, 10, 'G04', 0.4, '2023-12-05'),
(1015, 13, 10, 'G05', 0.1, '2023-12-05'),
(1016, 13, 10, 'G06', 0.6, '2023-12-05'),
(1017, 13, 10, 'G07', 0.8, '2023-12-05'),
(1018, 13, 10, 'G08', 0.4, '2023-12-05'),
(1019, 13, 10, 'G09', 0.6, '2023-12-05'),
(1020, 13, 10, 'G10', 0.4, '2023-12-05'),
(1021, 13, 10, 'G11', 0.1, '2023-12-05'),
(1022, 13, 10, 'G12', 0.6, '2023-12-05'),
(1023, 13, 10, 'G13', 0.4, '2023-12-05'),
(1024, 13, 10, 'G14', 0.1, '2023-12-05'),
(1025, 14, 11, 'G01', 0.1, '2023-12-13'),
(1026, 14, 11, 'G02', 0.4, '2023-12-13'),
(1027, 14, 11, 'G03', 0.6, '2023-12-13'),
(1028, 14, 11, 'G04', 0.8, '2023-12-13'),
(1029, 14, 11, 'G05', 0.6, '2023-12-13'),
(1030, 14, 11, 'G06', 0.4, '2023-12-13'),
(1031, 14, 11, 'G07', 0.6, '2023-12-13'),
(1032, 14, 11, 'G08', 0.1, '2023-12-13'),
(1033, 14, 11, 'G09', 0.4, '2023-12-13'),
(1034, 14, 11, 'G10', 0.6, '2023-12-13'),
(1035, 14, 11, 'G11', 0.8, '2023-12-13'),
(1036, 14, 11, 'G12', 0.1, '2023-12-13'),
(1037, 14, 11, 'G13', 1, '2023-12-13'),
(1038, 14, 11, 'G14', 1, '2023-12-13'),
(1039, 15, 10, 'G01', 1, '2023-12-14'),
(1040, 16, 10, 'G01', 1, '2023-12-14'),
(1041, 16, 10, 'G02', 0.4, '2023-12-14'),
(1042, 16, 10, 'G03', 0.6, '2023-12-14'),
(1043, 16, 10, 'G04', 0.8, '2023-12-14'),
(1044, 16, 10, 'G05', 0.1, '2023-12-14'),
(1045, 16, 10, 'G06', 0.4, '2023-12-14'),
(1046, 16, 10, 'G07', 1, '2023-12-14'),
(1047, 16, 10, 'G08', 0.8, '2023-12-14'),
(1048, 16, 10, 'G09', 0.4, '2023-12-14'),
(1049, 16, 10, 'G10', 0.1, '2023-12-14'),
(1050, 16, 10, 'G11', 0.6, '2023-12-14'),
(1051, 16, 10, 'G12', 0.1, '2023-12-14'),
(1052, 16, 10, 'G13', 0.8, '2023-12-14'),
(1053, 16, 10, 'G14', 1, '2023-12-14'),
(1054, 17, 10, 'G01', 0.8, '2023-12-14'),
(1055, 17, 10, 'G02', 0.1, '2023-12-14'),
(1056, 17, 10, 'G03', 0.4, '2023-12-14'),
(1057, 17, 10, 'G04', 0.4, '2023-12-14'),
(1058, 17, 10, 'G05', 0.8, '2023-12-14'),
(1059, 17, 10, 'G06', 1, '2023-12-14'),
(1060, 17, 10, 'G07', 0.6, '2023-12-14'),
(1061, 17, 10, 'G08', 1, '2023-12-14'),
(1062, 17, 10, 'G09', 0.1, '2023-12-14'),
(1063, 17, 10, 'G10', 0.4, '2023-12-14'),
(1064, 17, 10, 'G11', 1, '2023-12-14'),
(1065, 17, 10, 'G12', 0.6, '2023-12-14'),
(1066, 17, 10, 'G13', 0.8, '2023-12-14'),
(1067, 17, 10, 'G14', 0.4, '2023-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(15) NOT NULL,
  `jk` varchar(6) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_lahir` date NOT NULL DEFAULT '0000-00-00',
  `username` varchar(15) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `jk`, `alamat`, `tgl_lahir`, `username`, `password`) VALUES
(4, 'doromerouno', 'pria', 'doromerouno', '1999-01-01', 'doromerouno', 'doromerouno'),
(10, 'admin', 'pria', 'jakarta', '1999-06-04', 'admin', 'admin'),
(11, 'ilham', 'pria', 'cogreg', '1998-01-01', 'ilham', 'ilham');

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `kd_penyakit` varchar(5) NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `penanggulangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kd_penyakit`, `nama_penyakit`, `keterangan`, `penanggulangan`) VALUES
(1, 'K01', 'Depresi Sandwich Generation Rendah', 'Mengalami depresi dalam Sandwich Generation tingkatan rendah', 'Melakukan aktifitas atau kegiatan positif<br />menjaga komunikasi, serta jaga Kesehatan fisik dan pikiran.'),
(2, 'K02', 'Depresi Sandwich Generation Sedang', 'Mengalami depresi dalam Sandwich Generation dengan tingkatan sedang', 'Tentukan makna dan tujuan hidup, lakukan <br />komunikasi dengan teman terdekat atau keluarga lain, dan imbangi dengan aktifitas positif.'),
(3, 'K03', 'Depresi Sandwich Generation Berat', 'Mengalami depresi dalam Sandwich Generation dengan tingkatan Berat', 'Jangan ragu untuk berbicara dengan keluarga <br>atau teman terdekat tentang apa yang anda  alami mereka dapat memberikan dukungan  emosional <br />yang sangat dibutuhkan.Dan ingatlah, untuk merawat diri sendiri. Sisihkan waktu untuk istirahat, <br />aktivitas menyenangkan yang positif dan olahraga, banyak beribadah dan bertaqwa pada tuhan YME. <br />Jika saran sudah coba dilakukan tetapi belum berdampak pada depresi silahkan, datang ke psikologi <br /> untuk konsultasi atau terapi  secara langsung');

-- --------------------------------------------------------

--
-- Table structure for table `pesanm`
--

CREATE TABLE `pesanm` (
  `id_pesanm` int(11) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_balas` int(11) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(10) NOT NULL,
  `waktu` datetime NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanm`
--

INSERT INTO `pesanm` (`id_pesanm`, `id_member`, `id_balas`, `pesan`, `status`, `waktu`) VALUES
(30, 10, 0, 'halo', 'ok', '2023-10-22 13:17:59'),
(31, 10, 0, 'mau tanya boleh dok?', 'ok', '2023-10-22 13:19:55'),
(32, 10, 0, 'haii dok', 'ok', '2023-11-05 17:24:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `balas_pesan`
--
ALTER TABLE `balas_pesan`
  ADD PRIMARY KEY (`id_balas`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `hasil_konsultasi`
--
ALTER TABLE `hasil_konsultasi`
  ADD PRIMARY KEY (`id_hasilkonsultasi`);

--
-- Indexes for table `konsultasi`
--
ALTER TABLE `konsultasi`
  ADD PRIMARY KEY (`id_konsultasi`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `pesanm`
--
ALTER TABLE `pesanm`
  ADD PRIMARY KEY (`id_pesanm`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balas_pesan`
--
ALTER TABLE `balas_pesan`
  MODIFY `id_balas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `hasil_konsultasi`
--
ALTER TABLE `hasil_konsultasi`
  MODIFY `id_hasilkonsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `konsultasi`
--
ALTER TABLE `konsultasi`
  MODIFY `id_konsultasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1068;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanm`
--
ALTER TABLE `pesanm`
  MODIFY `id_pesanm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
