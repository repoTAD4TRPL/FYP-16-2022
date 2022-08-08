-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 02:57 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdesta3`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(11) NOT NULL,
  `uuid` varchar(150) NOT NULL,
  `id_jabatan` int(11) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `nip` varchar(30) DEFAULT NULL,
  `kelamin` int(2) DEFAULT NULL COMMENT '1=laki2, 2=perempuan',
  `email` varchar(30) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `file_ttd` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `status` tinyint(1) DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `uuid`, `id_jabatan`, `nama`, `nip`, `kelamin`, `email`, `id_unit`, `password`, `avatar`, `file_ttd`, `is_active`, `status`, `date_created`, `date_updated`) VALUES
(1, '40ede567-6872-4ed0-8c43-e3a5d7b77947', 1, 'Edward Tambunan', 'edward', 1, 'administrator@gmail.com', 0, '$2a$12$GQopQym4.hyAlL9c5JAK7.4PIVISKrzOvxwMfFp1Ybbt0gkcoP/Iu', '26bfea60-8d5e-11ec-8ded-93776d70ff5c.jpeg', '', 1, 1, '2022-02-11 16:00:42', '2022-06-14 10:31:21'),
(2, '10dfab60-8d5b-11ec-bb46-b719e3c84dc9', 4, 'Lisbeth Panjaitan', 'lisbeth', 2, 'dir@gmail.com', 1, '$2y$10$KFg9Q2V2ymCQqRKV2o2cYOj.0B6OPtt8EfgboNV7dQU5Dl/fe2CI2', '7fc2a7d0-e6f7-11ec-a01d-3f3d1177e520.jpeg', 'b42907f0-e6f7-11ec-82ce-5b99f6cf04ae.PNG', 1, 1, '2022-02-14 05:58:00', '2022-06-08 06:53:29'),
(3, '27248790-8d5b-11ec-9284-f10d57475293', 3, 'Mey Sihombing', 'mey', 2, 'bendahara@gmail.com', 1, '$2y$10$YXtihT0x9RIo8Kxg65KInuVkX1vBoVBW5yIt9/Gr7m6cME8xJoebu', '27245b00-8d5b-11ec-b634-f1cffd72de59.jpeg', '', 1, 1, '2022-02-14 05:58:38', '2022-06-18 10:26:31'),
(4, '246e3390-8d5c-11ec-8f18-2f721cbd1278', 2, 'Teresia Siahaan', 'tere', 2, 'sekretaris@gmail.com', NULL, '$2y$10$szOu8sefSmYh8Db8hPZd3e7d8u4lWgEMePR.6JntPf6vVb33zvAGy', '246dcdc0-8d5c-11ec-8e14-9f8bab37830a.jpeg', '', 1, 1, '2022-02-14 06:05:43', '2022-06-21 01:11:19'),
(5, '37ccdea0-8d5c-11ec-90fe-4d27d6ab0397', 5, 'Milo Hutabarat', 'milo', 2, 'anggota@gmail.com', 1, '$2y$10$4N35Yrl7ugYE8.SGnmo6xeO0S/USs/Hc8U9KlfLVOciCBo/oKdP2i', 'e1848420-eacd-11ec-8c0f-3bd95df59e4e.jpeg', '', 1, 1, '2022-02-14 06:06:15', '2022-06-13 04:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `artefak`
--

CREATE TABLE `artefak` (
  `id_artefak` int(11) NOT NULL,
  `uuid_artefak` varchar(150) NOT NULL,
  `nama_dokumen` varchar(150) CHARACTER SET utf8 NOT NULL,
  `file` varchar(300) CHARACTER SET utf8 NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `artefak`
--

INSERT INTO `artefak` (`id_artefak`, `uuid_artefak`, `nama_dokumen`, `file`, `date_created`, `date_updated`, `status`, `upload_by`) VALUES
(4, '', 'PP_Nomor_11_Tahun_2021.pdf', 'file/5/PP_Nomor_11_Tahun_2021.pdf', '2022-06-14 03:51:06', '2022-06-14 03:51:06', 1, ''),
(5, '', 'PP_Nomor_03_tahun_2021.pdf', 'file/4/PP_Nomor_03_tahun_2021.pdf', '2022-06-16 03:59:13', '2022-06-16 03:59:13', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `asset`
--

CREATE TABLE `asset` (
  `id_asset` int(11) NOT NULL,
  `uuid_asset` varchar(150) NOT NULL,
  `nama_asset` varchar(150) NOT NULL,
  `nomor_asset` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_terdaftar` varchar(30) NOT NULL,
  `nilai_asset` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `asset`
--

INSERT INTO `asset` (`id_asset`, `uuid_asset`, `nama_asset`, `nomor_asset`, `keterangan`, `tanggal_terdaftar`, `nilai_asset`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(4, 'b5b3bc10-d00e-11ec-bd25-0958ecf835f0', 'Laptop', 'LAPTOP65DESA', 'Fasilitas untuk pegawai Bumdes Marsingati', '2022-06-01', 7000000, 1, 'Lisbeth Panjaitan', '2022-05-10 03:10:13', '2022-06-21 01:20:08'),
(5, '3bcbd440-ebce-11ec-803d-054d0ed939be', 'Meja', 'M01DESA', 'Hibah dari Desa Lumban Gaol', '2020-02-06', 2000000, 0, 'Lisbeth Panjaitan', '2022-06-14 10:39:14', '2022-06-21 01:20:29'),
(6, '50531c50-ebce-11ec-8a67-0798b48e533c', 'Kursi', 'KURS01DESA', 'Hibah dari Desa Lumba Gaol', '2020-02-12', 3000000, 0, 'Lisbeth Panjaitan', '2022-06-14 10:39:48', '2022-06-21 01:20:34'),
(7, '66e22300-f100-11ec-8edf-8fba5384f16d', 'Meja', 'ME3543', 'Fasilitas untuk Pegawai BUMDes', '2022-06-16', 2000000, 1, 'Lisbeth Panjaitan', '2022-06-21 01:20:57', '2022-06-21 01:21:22'),
(8, '8c587790-f100-11ec-ac1d-53cd9df6ed6e', 'Kursi', 'KURS6543', 'Fasilitas untuk Pegawai BUMDes', '2022-06-09', 10000000, 1, 'Lisbeth Panjaitan', '2022-06-21 01:21:59', '2022-06-21 01:21:59'),
(9, 'eaeeab80-f20d-11ec-8c06-3d86b932a15d', 'wsd', 'ddddddwf', 'fw', '2022-06-20', 20000, 0, 'Lisbeth Panjaitan', '2022-06-22 09:30:13', '2022-06-22 09:30:16'),
(10, 'ff870650-f20d-11ec-8967-010d8b489431', 'ryhrd', 'sgsf', 'fsfgfb', '2022-06-20', 50000, 0, 'Lisbeth Panjaitan', '2022-06-22 09:30:47', '2022-06-22 09:30:52'),
(11, '1bd8ebd0-f20e-11ec-95cb-8bc6c833d6f6', 'svdsvdf', 'vdwsddws', 'wssdvwdvwd', '2022-06-21', 20000, 0, 'Lisbeth Panjaitan', '2022-06-22 09:31:35', '2022-06-22 09:31:39');

-- --------------------------------------------------------

--
-- Table structure for table `bagi_hasil_usaha`
--

CREATE TABLE `bagi_hasil_usaha` (
  `id_usaha_mitra` int(11) NOT NULL,
  `uuid_bagi_hasil` varchar(150) NOT NULL,
  `jenis_bagi_hasil` varchar(100) NOT NULL COMMENT '1=pemasukan,2=pengeluaran',
  `nama` varchar(100) NOT NULL,
  `id_mitra` int(11) NOT NULL,
  `jumlah` varchar(30) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `nilai` int(15) NOT NULL,
  `status_hasil` int(2) NOT NULL COMMENT '1=success,2=process,3=failed',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bagi_hasil_usaha`
--

INSERT INTO `bagi_hasil_usaha` (`id_usaha_mitra`, `uuid_bagi_hasil`, `jenis_bagi_hasil`, `nama`, `id_mitra`, `jumlah`, `tanggal`, `nilai`, `status_hasil`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, '1c6ce700-8cdc-11ec-9a2e-c7e4589b8070', 'Pendanaan', 'Investasi', 1, '-', '2022-02-13', 15000000, 1, 0, '', '2022-02-13 14:49:13', '2022-06-14 09:48:19'),
(2, 'bf23bb00-8cdd-11ec-b896-07ff491c1371', 'Barang', 'Mobil Truck', 1, '1 Buah', '2022-02-10', 22000000, 3, 0, '', '2022-02-13 15:00:56', '2022-06-14 09:48:13'),
(3, '054397b0-cfa1-11ec-a795-c1ee54d17e97', 'Hibah', 'Traktor', 2, '23', '2022-05-09', 3000000, 1, 0, '', '2022-05-09 14:05:02', '2022-06-14 10:15:24'),
(4, '7154c3e0-d804-11ec-b621-99d2b2b36db9', 'Pendanaan', 'Pendanaaan', 1, '1', '2022-05-19', 30000000, 1, 0, '', '2022-05-20 06:16:53', '2022-06-14 10:15:21'),
(5, '314bbc00-ebc7-11ec-acac-9bb033a6db34', 'Hibah 2', 'Dana', 2, '1', '2022-06-13', 200000, 1, 0, '', '2022-06-14 09:48:49', '2022-06-14 09:49:02'),
(6, '6b1947d0-fc35-11ec-a215-9bb53e35e5ca', 'Hibah', 'Pendanaan Traktor', 3, '2', '2022-07-01', 2000000, 1, 0, 'Lisbeth Panjaitan', '2022-07-05 07:38:10', '2022-07-05 07:45:41');

-- --------------------------------------------------------

--
-- Table structure for table `barang_jasa`
--

CREATE TABLE `barang_jasa` (
  `id_barang_jasa` int(11) NOT NULL,
  `uuid_barang_jasa` varchar(150) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_jasa`
--

INSERT INTO `barang_jasa` (`id_barang_jasa`, `uuid_barang_jasa`, `id_unit`, `jumlah`, `tanggal`, `harga`, `nama`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(12, '7ef8c2c0-f529-11ec-86e1-193a0ac71319', 5, '2', '2022-06-25', 4000000, 'Penyewaan Traktor selama 3 Hari', 1, 'Milo Hutabarat', '2022-06-26 08:25:11', '2022-06-29 06:05:27'),
(13, '4f24df70-f552-11ec-bb69-779a93b84837', 5, '2', '2022-06-18', 100000, 'Penyewaan Traktor', 1, 'Lisbeth Panjaitan', '2022-06-26 13:17:20', '2022-07-01 04:39:42'),
(14, '01962690-f90a-11ec-a3af-b5fdaf96f209', 5, '5', '2022-06-21', 350000, 'uang jetor', 1, 'Milo Hutabarat', '2022-07-01 06:49:51', '2022-07-01 06:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `homestay`
--

CREATE TABLE `homestay` (
  `id_homestay` int(11) NOT NULL,
  `uuid_homestay` varchar(150) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `tipe_kamar` varchar(150) NOT NULL,
  `tanggal_masuk` varchar(30) NOT NULL,
  `tanggal_keluar` varchar(30) NOT NULL,
  `pembeli` varchar(150) NOT NULL,
  `harga` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homestay`
--

INSERT INTO `homestay` (`id_homestay`, `uuid_homestay`, `id_unit`, `nama`, `tipe_kamar`, `tanggal_masuk`, `tanggal_keluar`, `pembeli`, `harga`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, '1e166840-f536-11ec-974f-41950830a74b', 6, 'asd', '1', '2022-06-27', '2022-06-27', 'ewq', 1000000, 0, 'Lisbeth Panjaitan', '2022-06-26 09:55:32', '2022-06-26 09:55:32'),
(2, '35b3f980-f536-11ec-834f-a3b75ad85c73', 6, 'asd', '1', '2022-06-27', '2022-06-27', 'ewq', 1000000, 0, 'Lisbeth Panjaitan', '2022-06-26 09:56:12', '2022-06-26 09:56:12'),
(3, '3fdc5b00-f536-11ec-a132-e77fbffa367e', 6, 'asd', '1', '2022-06-27', '2022-06-27', 'ewq', 1000000, 0, 'Lisbeth Panjaitan', '2022-06-26 09:56:29', '2022-06-26 09:56:29'),
(4, '23406060-f53d-11ec-a0bc-df40a73b392d', 6, 'Homestay Rumah Adat', '2', '2022-06-18', '2022-06-24', 'Dancow Sianipar', 10000000, 1, 'Milo Hutabarat', '2022-06-26 10:45:47', '2022-06-26 10:45:47'),
(5, 'e6cf1640-f772-11ec-9b54-7144d4f48070', 8, 'Homestay Rumah Kayu', '1', '2022-06-17', '2022-06-30', 'Kevin', 1000000, 1, 'Milo Hutabarat', '2022-06-29 06:15:41', '2022-06-29 06:15:41');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(11) NOT NULL,
  `uuid_jabatan` varchar(150) NOT NULL,
  `nama_jabatan` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `uuid_jabatan`, `nama_jabatan`, `status`, `date_created`, `date_updated`) VALUES
(1, 'e8cd73b9-d313-4a23-abbf-f3a203c60b9a', 'Penasihat', 1, '2022-02-06 08:23:13', '2022-06-21 07:48:15'),
(2, 'e6683a7c-c4d0-46f8-8f46-95adb2746985', 'Sekretaris', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(3, 'ce1c6611-b07e-4ebc-9252-c5e5bebcb441', 'Bendahara', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(4, 'd427fc06-ad4d-429c-879d-6cb9da32d41d', 'Direktur', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(5, '5ad418af-c695-4306-9d45-28be01207f7e', 'Manajer Unit', 1, '2022-02-06 08:23:13', '2022-06-16 01:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `keuangan`
--

CREATE TABLE `keuangan` (
  `id_keuangan` int(11) NOT NULL,
  `uuid_keuangan` varchar(150) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `jenis` int(2) NOT NULL COMMENT '1=pemasukan, 2=pengeluaran',
  `keterangan` text NOT NULL,
  `nilai` int(20) NOT NULL,
  `saldo_akhir` int(20) DEFAULT NULL,
  `id_unit` int(11) NOT NULL,
  `approve_direktur` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak',
  `approve_sekretaris` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak',
  `approve_bendahara` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `uuid_keuangan`, `tanggal`, `jenis`, `keterangan`, `nilai`, `saldo_akhir`, `id_unit`, `approve_direktur`, `approve_sekretaris`, `approve_bendahara`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(23, '7acaa1c0-d030-11ec-b441-79a60860192d', '2022-06-14', 2, 'Pajak Bumi Bangunan Tahun 2022', 200000, NULL, 5, 1, 1, 1, 1, 'Lisbeth Panjaitan', '2022-05-10 07:11:57', '2022-06-22 08:03:15'),
(24, '9fca2500-eaf5-11ec-9ac9-ad29f8f90a2c', '2022-06-11', 1, 'Penjualan Pupuk Tanaman', 200000, NULL, 5, 1, 1, 1, 1, 'Milo Hutabarat', '2022-06-13 08:48:41', '2022-06-20 03:05:27'),
(25, 'ab5904e0-eaf5-11ec-91c0-0f2f04488ee5', '2022-06-01', 1, 'Padi', 700000, NULL, 5, 1, 1, 1, 0, 'Milo Hutabarat', '2022-06-13 08:49:00', '2022-06-22 09:29:11'),
(26, '7e7c5310-ed42-11ec-8d68-490a198158f5', '2022-06-15', 2, 'Bahan Bakar 10 Liter', 2000000, NULL, 5, 0, 0, 0, 0, '', '2022-06-16 07:03:58', '2022-06-18 10:07:59'),
(27, 'f91d57b0-eeee-11ec-a7b8-4f09e59a12e5', '2022-06-17', 2, 'Biaya Antar Bahan', 200000, NULL, 6, 0, 0, 0, 0, '', '2022-06-18 10:11:09', '2022-06-18 10:19:23'),
(28, '634dc910-f12c-11ec-9f55-a793b38d71e2', '2022-06-21', 2, 'Membayar gaji operator traktor', 1000000, NULL, 5, 0, 0, 0, 0, 'Lisbeth Panjaitan', '2022-06-21 06:35:48', '2022-06-21 06:41:54'),
(29, '62f85890-f12d-11ec-b42e-e95af2477027', '2022-06-21', 2, 'Biaya Operasional operator traktor', 1250000, NULL, 5, 1, 1, 1, 1, 'Lisbeth Panjaitan', '2022-06-21 06:42:57', '2022-06-21 06:45:55'),
(30, '8ea95d20-f203-11ec-aaa4-59298c9358ac', '2022-06-21', 1, 'test', 200000, NULL, 6, 0, 0, 0, 0, 'Lisbeth Panjaitan', '2022-06-22 08:16:04', '2022-06-22 08:24:02'),
(31, '062daa80-f204-11ec-9183-33c2e7e9ec62', '2022-06-20', 1, 'dfgh', 1654332, NULL, 5, 1, 1, 1, 0, 'Teresia Siahaan', '2022-06-22 08:19:23', '2022-06-22 09:18:34'),
(32, 'c01750a0-f204-11ec-89b7-07e8ee76c5ea', '2022-06-21', 1, 'thrt', 456765, NULL, 5, 1, 0, 1, 0, 'Mey Sihombing', '2022-06-22 08:24:35', '2022-06-22 09:18:30'),
(33, '67c3f5a0-f207-11ec-bf69-450cd2611f56', '2022-06-18', 1, 'gfd', 456543, NULL, 5, 1, 1, 1, 0, 'Mey Sihombing', '2022-06-22 08:43:36', '2022-06-22 09:18:27'),
(34, '55c5dc10-f20c-11ec-ba68-779222285517', '2022-06-21', 1, 'fddf', 2000000, NULL, 5, 1, 0, 1, 0, 'Lisbeth Panjaitan', '2022-06-22 09:18:53', '2022-06-22 09:24:02'),
(35, 'f43058e0-f67f-11ec-8e54-e59229f6761b', '2022-06-27', 1, 'Biaya Operasional Homestay', 5000000, NULL, 5, 1, 0, 1, 1, 'Milo Hutabarat', '2022-06-28 01:16:36', '2022-06-30 09:08:48'),
(36, '9806dee0-fc06-11ec-b275-a78d573fd8eb', '2022-07-04', 1, 'yuyi', 3000000, NULL, 5, 0, 0, 0, 0, 'Lisbeth Panjaitan', '2022-07-05 02:02:59', '2022-07-05 02:04:48'),
(37, '792d7f70-fc32-11ec-99ab-b5642f60ef3f', '2022-07-01', 2, 'Beban Air dan Listrik Juni', 2000000, NULL, 6, 1, 0, 1, 1, 'Lisbeth Panjaitan', '2022-07-05 07:17:05', '2022-07-05 07:20:44'),
(38, '9fa3f940-fd2b-11ec-b0e5-47267881f18d', '2022-07-01', 2, 'Biaya Perbaiki Komputer', 500000, NULL, 5, 1, 0, 1, 1, 'Mey Sihombing', '2022-07-06 13:00:34', '2022-07-06 13:02:35'),
(39, '884c4b80-fdc9-11ec-bbfc-b54d63d04c34', '2022-07-02', 2, 'Biaya Air Juli', 500000, NULL, 8, 1, 0, 1, 1, 'Milo Hutabarat', '2022-07-07 07:50:55', '2022-07-07 08:43:02');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_kegiatan`
--

CREATE TABLE `laporan_kegiatan` (
  `id_laporan_kegiatan` int(11) NOT NULL,
  `uuid_kegiatan` varchar(150) NOT NULL,
  `tanggal` varchar(30) DEFAULT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `lokasi` varchar(100) DEFAULT NULL,
  `approv` int(2) DEFAULT 2 COMMENT '1=approv, 2=waiting, 3=reject',
  `approve_direktur` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak	',
  `approve_sekretaris` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak	',
  `approve_bendahara` int(2) NOT NULL DEFAULT 0 COMMENT '0=pending , 1=acc,2=tolak	',
  `status` tinyint(1) DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id_laporan_kegiatan`, `uuid_kegiatan`, `tanggal`, `id_unit`, `keterangan`, `lokasi`, `approv`, `approve_direktur`, `approve_sekretaris`, `approve_bendahara`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, '90a01ff0-8cf1-11ec-941c-0d76dc237789', '2022-02-08', 1, 'Penyuluhan', 'Jakarta', 2, 1, 1, 1, 1, '', '2022-02-13 17:22:48', '2022-05-10 02:19:57'),
(2, '9e93e4f0-8cf1-11ec-b4fb-f9dc5f5513ef', '2022-02-14', 2, 'Melakukan Ujicoba Kualitas', 'Jakarta', 2, 1, 1, 0, 1, '', '2022-02-13 17:23:11', '2022-02-16 12:22:54'),
(7, '1c261210-d02d-11ec-a0f0-2fdd4a7c4b32', '2022-05-10', 5, 'Perayaan 50 tahun bumdes', 'Porsea', 2, 1, 1, 0, 1, 'Milo Hutabarat', '2022-05-10 06:47:50', '2022-06-20 06:04:13'),
(8, '5140a460-eafc-11ec-8c52-f9479ad6b86b', '2022-06-09', 5, 'Pelatihan 2', 'Laguboti', 2, 1, 1, 0, 1, 'Milo Hutabarat', '2022-06-13 09:36:35', '2022-06-20 06:02:39'),
(9, '63d9b730-eafc-11ec-aa8a-8bb5840b54e2', '2022-06-01', 5, 'Porsea', 'Pelatihan 3', 2, 1, 1, 0, 1, 'Milo Hutabarat', '2022-06-13 09:37:06', '2022-06-20 06:02:25'),
(10, '97a25520-f047-11ec-979b-d53a280d9326', '2022-06-19', 5, 'Pelatihan 4', 'Tambunan', 2, 0, 0, 0, 0, 'Milo Hutabarat', '2022-06-20 03:18:01', '2022-06-20 03:26:10'),
(11, 'ccd28ea0-f053-11ec-89e7-696a1e56d834', '2022-06-19', 6, 'Pelatihan Kasir', 'Lagubotii', 2, 1, 1, 0, 1, 'Milo Hutabarat', '2022-06-20 04:45:25', '2022-07-05 07:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `logistik`
--

CREATE TABLE `logistik` (
  `id_logistik` int(11) NOT NULL,
  `uuid_logistik` varchar(150) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `jumlah` varchar(50) NOT NULL,
  `keterangan` text NOT NULL,
  `harga` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logistik`
--

INSERT INTO `logistik` (`id_logistik`, `uuid_logistik`, `id_unit`, `tanggal`, `jumlah`, `keterangan`, `harga`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(5, '62f951c0-d00a-11ec-9d2c-c3d7aa884d37', 1, '2022-06-11', '1', 'Mengganti Komputer yang sudah rusak', 2000000, 1, 'Lisbeth Panjaitan', '2022-05-10 02:39:17', '2022-07-05 01:51:58'),
(17, 'c5c718f0-f909-11ec-af1f-a79ee3b1bc70', 8, '2022-07-01', '45', 'utk lemari hias', 165000, 1, 'Milo Hutabarat', '2022-07-01 06:48:11', '2022-07-01 06:48:11'),
(18, 'c70b4050-fc06-11ec-95b3-9338cd1e429e', 1, '2022-07-03', '2', 'hk', 1000000, 0, 'Lisbeth Panjaitan', '2022-07-05 02:04:18', '2022-07-05 02:04:42');

-- --------------------------------------------------------

--
-- Table structure for table `manusia`
--

CREATE TABLE `manusia` (
  `id_manusia` int(11) NOT NULL,
  `uuid_manusia` varchar(150) CHARACTER SET utf8 NOT NULL,
  `nama` varchar(512) DEFAULT NULL,
  `kelamin` int(2) DEFAULT NULL COMMENT '1=laki2, 2=perempuan',
  `jabatan` varchar(150) NOT NULL,
  `tugas` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manusia`
--

INSERT INTO `manusia` (`id_manusia`, `uuid_manusia`, `nama`, `kelamin`, `jabatan`, `tugas`, `status`, `is_active`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, '5da73c00-ebba-11ec-b1e3-0da93e94225a', 'Lisbeth Panjaitan', 2, 'Direktur', '1. Menyusun dan melaksanakan rencana program kerja BUMDes\r\n2. Menyusun laporan bulanan\r\n3. Menyusun laporan Tahunan', 1, 1, 'Lisbeth Panjaitan', '2022-06-14 08:17:00', '2022-06-14 08:17:00'),
(2, 'c2c51380-ebbd-11ec-aa8b-a3d237af0cb8', 'Teresia Siahaan', 2, 'Sekretaris', '1. Mendokumentasikan semua keputusan atau kebijakan yang dibuat oleh pengelola operasional BUMDes\r\n2. Melakukan pengarsipan dan pengadministrasian kegiatan-kegiatan BUMDes\r\n3. Menggantikan direktur apabila sedang berhalangan\r\n4. Menginisiasi rapat-rapat rutin atau aksidental untuk memutuskan kebijakan BUMDes Marsingati', 1, 1, 'Lisbeth Panjaitan', '2022-06-14 08:41:19', '2022-06-14 08:41:19'),
(3, '05d6eda0-ebbe-11ec-a90d-2521a2bab1de', 'Mey Sihombing', 2, 'Bendahara', '1. Mencatat segala bentuk pemasukan dan pengeluaran keuangan BUMDes\r\n2. Menggali sumber-sumber keuangan yang menambah sumber penghasilan BUMDes\r\n3. Membuat laporan keuangan BUMDes dan dilaporkan secara berkala kepada direktur BUMDes Marsingati', 1, 1, 'Lisbeth Panjaitan', '2022-06-14 08:43:11', '2022-06-14 08:43:11'),
(4, '50dc6dc0-ebbe-11ec-a689-6d81f18da202', 'Milo Hutabarat', 2, 'Manajer Unit', '1. Menjalankan aktivitas perkantoran sesuai standar operasinal prosedur yang dibuat oleh pengelola operasional BUMDes\r\n2. Menajalankan kegiatan sesuai dengan keputusan pengelola operasional\r\n3. Menjalankan kegiatan dan/atau program pengembangan BUMDes sesuai keputusan pemimpin BUMDes', 1, 1, 'Lisbeth Panjaitan', '2022-06-14 08:45:17', '2022-06-14 08:45:17'),
(5, '9ffbcb90-ebbe-11ec-a5f4-cd413b999908', 'Maimun Simanjuntak', 1, 'Pengawas', 'Mengawasi pelaksanaan kegiatan BUMDes Marsingati', 1, 1, 'Lisbeth Panjaitan', '2022-06-14 08:47:30', '2022-06-14 08:47:30'),
(6, 'a64ee470-ebc6-11ec-8883-27dd157cd815', 'asd', 1, '', 'wf', 0, 1, '', '2022-06-14 09:44:56', '2022-06-14 09:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `mitra`
--

CREATE TABLE `mitra` (
  `id_mitra` int(11) NOT NULL,
  `uuid_mitra` varchar(150) NOT NULL,
  `nama_mitra` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `tanggal_mulai` varchar(40) NOT NULL,
  `tanggal_selesai` varchar(40) NOT NULL,
  `status_mitra` int(3) NOT NULL COMMENT '1=active,2=nonactive',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `uuid_mitra`, `nama_mitra`, `alamat`, `bidang`, `tanggal_mulai`, `tanggal_selesai`, `status_mitra`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, 'efcafdf0-8cd6-11ec-bcda-b51b1761e52f', 'PT HONDA ASTRA', 'JAKARTA, INDONESIA', 'Otomotif', '2022-02-01', '2022-02-28', 1, 0, '', '2022-02-13 14:12:11', '2022-06-22 01:30:10'),
(2, '0a30ea40-8cd8-11ec-9205-efe3b95f2a71', 'PT YAMAHA', 'JAKARTA', 'Otomotif', '2022-01-31', '2022-02-26', 1, 0, '', '2022-02-13 14:20:05', '2022-06-22 01:30:06'),
(3, 'f0c7cc40-fc34-11ec-b189-89749d63bfa9', 'Honda', 'Medan', 'Teknologi', '2022-07-01', '2022-11-30', 1, 1, 'Lisbeth Panjaitan', '2022-07-05 07:34:44', '2022-07-05 07:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `program_kerja`
--

CREATE TABLE `program_kerja` (
  `id_pk` int(11) NOT NULL,
  `uuid_pk` varchar(512) NOT NULL,
  `program` varchar(512) NOT NULL,
  `kegiatan` varchar(150) NOT NULL,
  `anggaran` int(15) NOT NULL,
  `sumber` varchar(512) NOT NULL,
  `output` varchar(512) NOT NULL,
  `indikator` varchar(512) NOT NULL,
  `waktu` date NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_kerja`
--

INSERT INTO `program_kerja` (`id_pk`, `uuid_pk`, `program`, `kegiatan`, `anggaran`, `sumber`, `output`, `indikator`, `waktu`, `date_created`, `date_updated`, `status`) VALUES
(3, '85d8b740-eaca-11ec-8671-55f53c735886', 'Program Pelatihan Masyarakat', '', 2000000, 'Pemerintah Pusat', 'Sertifikat', '1. Berjalan dengan Lancar dan baik\r\n2. Tidak ada hambatan', '2022-06-15', '2022-06-13 03:40:09', '2022-06-13 03:40:09', 0),
(5, 'a0bbada0-eacb-11ec-86cf-015eb673ec61', 'Program Pelatihan 3', '', 10000000, 'pes', 'Sertifikat 3', 'Sukses 3', '2022-06-12', '2022-06-13 03:48:03', '2022-06-13 03:48:03', 0),
(6, '1aa1b5d0-f51c-11ec-8420-ebd070bc5400', 'Program Pelatihan', 'test\r\nfdss', 2000000, 'Pemerintah', 'Sertifikat', 'good\r\ngreat', '2022-06-22', '2022-06-26 06:49:19', '2022-06-26 06:49:19', 0),
(7, '644c30c0-f51f-11ec-9ca8-59808f3f27b8', 'Program Pelatihan 2', 'fvddf', 20000000, 'fbbfd', 'bff2', 'fbfbf4', '2022-06-25', '2022-06-26 07:12:51', '2022-06-26 07:12:51', 0),
(8, '703ca110-f521-11ec-ace1-390845c94781', 'Program Pelatihan', 'dv2', 2000000, 'd vdf', 'd fv', 'trrt', '2022-06-29', '2022-06-26 07:27:30', '2022-06-26 07:27:30', 0),
(9, '90d96fc0-f5c0-11ec-ba79-aff00b8b59da', 'Program Pelatihan', 'dfw', 2000000, 'Pemerintah Pusat', 'bff2', 'wr', '2022-06-14', '2022-06-27 02:26:35', '2022-06-27 02:26:35', 0),
(10, '48cea4e0-f8f7-11ec-acdf-696818363701', 'Program Pelatihan', 'tyh', 2000000, '5uy', 'eyh', 'eyh', '2022-07-13', '2022-07-01 04:35:50', '2022-07-01 04:35:50', 0),
(11, 'a21301f0-fc2a-11ec-ab3c-4b1cec148b22', 'Program Pelatihan', 'Seminar cara menggunakan Laptop', 2000000, 'Pemerintah', 'Sertifikat', 'Mendapatkan Sertifikat', '2022-07-04', '2022-07-05 06:20:57', '2022-07-05 06:20:57', 0);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `uuid_toko` varchar(150) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `harga` int(10) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `pembeli` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `upload_by` varchar(150) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `uuid_toko`, `id_unit`, `keterangan`, `harga`, `tanggal`, `pembeli`, `status`, `upload_by`, `date_created`, `date_updated`) VALUES
(1, '00ddb2c0-f533-11ec-ba75-9dd0e325503b', 6, 'Pembelian 1Kg Cabe merah', 1000000, '2022-06-20', 'Liansky', 1, 'Milo Hutabarat', '2022-06-26 09:33:14', '2022-06-26 09:33:14'),
(2, '2881e5f0-f533-11ec-85b1-69656fb69a5f', 6, 'Pembelian 1 ikat sayur', 1000000, '2022-06-20', 'Angga Simamora', 1, 'Milo Hutabarat', '2022-06-26 09:34:21', '2022-06-26 09:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `unit_usaha`
--

CREATE TABLE `unit_usaha` (
  `id_unit` int(11) NOT NULL,
  `unit_uuid` varchar(150) NOT NULL,
  `nama_unit` text NOT NULL,
  `deskripsi` text NOT NULL,
  `image` text NOT NULL,
  `tanggal_dibuka` varchar(50) NOT NULL,
  `aset` varchar(100) NOT NULL,
  `lapkeu` varchar(512) NOT NULL,
  `lapkeg` varchar(512) CHARACTER SET utf8 NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit_usaha`
--

INSERT INTO `unit_usaha` (`id_unit`, `unit_uuid`, `nama_unit`, `deskripsi`, `image`, `tanggal_dibuka`, `aset`, `lapkeu`, `lapkeg`, `status`, `date_created`, `date_updated`) VALUES
(5, '2e148720-d00a-11ec-bc2c-136cbe51fcf1', 'Traktor', 'Unit traktor yang dijalankan oleh BUMDes Marsingati Lumban Gaol dijalankan oleh seorang operator yang telah dipekerjakan BUMDes. Operator akan mengerjakan sawah masyarakat yang telah setuju sawahnya dikerjakan oleh BUMDes. Pembayaran traktor oleh masyarakat dapat dilakukan di awal, di akhir ataupun dicicil oleh masyarakat tersebut. Upah yang diberikan kepada operator yang menjalankan traktor yaitu Rp25.000,00/rante sawah.', '7e5c21a0-f133-11ec-9c45-2fef1c0bde3f.png', '2020-02-10', 'Traktor', 'http://localhost:8000/administrator/barang-jasa', 'http://localhost:8000/administrator/barang-jasa/tambah', 1, '2022-05-10 02:37:48', '2022-06-26 11:25:19'),
(6, 'f88d91e0-eba6-11ec-8818-cd567df09f87', 'Toko', 'Bisnis online atau toko yang dijalankan oleh BUMDes Marsingati Lumban Gaol yaitu menjual kebutuhan sehari-hari. Kebutuhan sehari-hari seperti bumbu dapur, lauk, sayur mayur, atau kebutuhan rumah lainnya. Toko online dijalankan oleh BUMDes melalui Facebook, WhatsApp dan media sosial lain. Pemesanan pada toko online dilakukan 1 hari sebelum pengantaran barang pesanan. Pengantaran pesanan dilakukan pada esok hari dimulai pukul 09.00 WIB sampai dengan selesai.', '502c8f50-f201-11ec-a65b-5b3b1597c21e.jpeg', '2021-07-13', 'Toko Online', 'http://localhost:8000/administrator/toko', 'http://localhost:8000/administrator/toko/tambah', 1, '2022-06-14 05:58:10', '2022-06-26 11:27:22'),
(8, '29489f40-f540-11ec-b34f-a74748c541d4', 'Homestay', 'Homestay adalah salah satu bentuk penginapan yang populer. Para pengunjung atau tamu menginap di kediaman penduduk setempat di kota tempat mereka bepergian.  Homestay merupakan penginapan yang memberikan kesempatan bagi masyarakat yang bepergian untuk tinggal bersama keluarga lokal dengan biaya tambahan. Homestay menjadi alternatif akomodasi yang terjangkau bahkan disebut ideal untuk pelancong dari segala usia yang mencari pengalaman perjalanan yang nyata dan asli.', '6d82f540-f83b-11ec-97d4-4364a9ede0df.jpeg', '2022-06-01', 'Barang', 'http://localhost:8000/administrator/homestay', 'http://localhost:8000/administrator/homestay/tambah', 1, '2022-06-26 11:07:26', '2022-06-30 06:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `logo` text DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `website`
--

INSERT INTO `website` (`id`, `logo`, `name`) VALUES
(1, '3a07ed60-f133-11ec-99ef-5905286d600a.png', 'BUM Desa Marsingati');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `artefak`
--
ALTER TABLE `artefak`
  ADD PRIMARY KEY (`id_artefak`);

--
-- Indexes for table `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id_asset`);

--
-- Indexes for table `bagi_hasil_usaha`
--
ALTER TABLE `bagi_hasil_usaha`
  ADD PRIMARY KEY (`id_usaha_mitra`);

--
-- Indexes for table `barang_jasa`
--
ALTER TABLE `barang_jasa`
  ADD PRIMARY KEY (`id_barang_jasa`);

--
-- Indexes for table `homestay`
--
ALTER TABLE `homestay`
  ADD PRIMARY KEY (`id_homestay`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indexes for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_laporan_kegiatan`);

--
-- Indexes for table `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id_logistik`);

--
-- Indexes for table `manusia`
--
ALTER TABLE `manusia`
  ADD PRIMARY KEY (`id_manusia`);

--
-- Indexes for table `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indexes for table `program_kerja`
--
ALTER TABLE `program_kerja`
  ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `unit_usaha`
--
ALTER TABLE `unit_usaha`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `artefak`
--
ALTER TABLE `artefak`
  MODIFY `id_artefak` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `asset`
--
ALTER TABLE `asset`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bagi_hasil_usaha`
--
ALTER TABLE `bagi_hasil_usaha`
  MODIFY `id_usaha_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `barang_jasa`
--
ALTER TABLE `barang_jasa`
  MODIFY `id_barang_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `homestay`
--
ALTER TABLE `homestay`
  MODIFY `id_homestay` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_laporan_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `manusia`
--
ALTER TABLE `manusia`
  MODIFY `id_manusia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_kerja`
--
ALTER TABLE `program_kerja`
  MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_usaha`
--
ALTER TABLE `unit_usaha`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
