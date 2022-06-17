-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Feb 2022 pada 08.49
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bumdesta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `administrator`
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
-- Dumping data untuk tabel `administrator`
--

INSERT INTO `administrator` (`id`, `uuid`, `id_jabatan`, `nama`, `nip`, `kelamin`, `email`, `id_unit`, `password`, `avatar`, `file_ttd`, `is_active`, `status`, `date_created`, `date_updated`) VALUES
(1, '40ede567-6872-4ed0-8c43-e3a5d7b77947', 1, 'Super Admin', '12345', 1, 'administrator@gmail.com', 0, '$2a$12$GQopQym4.hyAlL9c5JAK7.4PIVISKrzOvxwMfFp1Ybbt0gkcoP/Iu', '26bfea60-8d5e-11ec-8ded-93776d70ff5c.jpeg', NULL, 1, 1, '2022-02-11 16:00:42', '2022-02-14 06:20:05'),
(2, '10dfab60-8d5b-11ec-bb46-b719e3c84dc9', 4, 'direktur', '111', 1, 'dir@gmail.com', 1, '$2y$10$KFg9Q2V2ymCQqRKV2o2cYOj.0B6OPtt8EfgboNV7dQU5Dl/fe2CI2', '10df7760-8d5b-11ec-a524-056dae0f4cd4.jpeg', '21c75ab0-8d6e-11ec-aef6-c5760c49771c.png', 1, 1, '2022-02-14 05:58:00', '2022-02-14 08:14:29'),
(3, '27248790-8d5b-11ec-9284-f10d57475293', 3, 'bendahara', '222', 2, 'bendahara@gmail.com', 1, '$2y$10$YXtihT0x9RIo8Kxg65KInuVkX1vBoVBW5yIt9/Gr7m6cME8xJoebu', '27245b00-8d5b-11ec-b634-f1cffd72de59.jpeg', NULL, 1, 1, '2022-02-14 05:58:38', '2022-02-14 06:05:02'),
(4, '246e3390-8d5c-11ec-8f18-2f721cbd1278', 2, 'Sekretaris', '333', 2, 'sekretaris@gmail.com', 1, '$2y$10$szOu8sefSmYh8Db8hPZd3e7d8u4lWgEMePR.6JntPf6vVb33zvAGy', '246dcdc0-8d5c-11ec-8e14-9f8bab37830a.jpeg', NULL, 1, 1, '2022-02-14 06:05:43', '2022-02-14 06:05:43'),
(5, '37ccdea0-8d5c-11ec-90fe-4d27d6ab0397', 5, 'Anggota', '444', 1, 'anggota@gmail.com', 1, '$2y$10$4N35Yrl7ugYE8.SGnmo6xeO0S/USs/Hc8U9KlfLVOciCBo/oKdP2i', '37ccb900-8d5c-11ec-8860-bd98cb9d820c.jpeg', NULL, 1, 1, '2022-02-14 06:06:15', '2022-02-14 06:06:15');

-- --------------------------------------------------------

--
-- Struktur dari tabel `asset`
--

CREATE TABLE `asset` (
  `id_asset` int(11) NOT NULL,
  `uuid_asset` varchar(150) NOT NULL,
  `nama_asset` varchar(150) NOT NULL,
  `nomor_asset` varchar(50) NOT NULL,
  `lokasi` text NOT NULL,
  `keterangan` text NOT NULL,
  `tanggal_terdaftar` varchar(30) NOT NULL,
  `nilai_asset` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `asset`
--

INSERT INTO `asset` (`id_asset`, `uuid_asset`, `nama_asset`, `nomor_asset`, `lokasi`, `keterangan`, `tanggal_terdaftar`, `nilai_asset`, `status`, `date_created`, `date_updated`) VALUES
(1, 'b74ff490-8ce3-11ec-8388-5bdc5644006a', 'Tanah 7 Hektar', 'ASET7HEKTAR', 'Jakarta', '-', '2022-02-13', 30000000, 1, '2022-02-13 15:43:40', '2022-02-13 15:51:31'),
(2, 'b3f0d7a0-8ce4-11ec-9da8-57385f945760', 'Sepeda Motor', 'SP7MTR', 'Kantor', '-', '2022-02-01', 77000000, 1, '2022-02-13 15:50:44', '2022-02-13 15:50:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bagi_hasil_usaha`
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `bagi_hasil_usaha`
--

INSERT INTO `bagi_hasil_usaha` (`id_usaha_mitra`, `uuid_bagi_hasil`, `jenis_bagi_hasil`, `nama`, `id_mitra`, `jumlah`, `tanggal`, `nilai`, `status_hasil`, `status`, `date_created`, `date_updated`) VALUES
(1, '1c6ce700-8cdc-11ec-9a2e-c7e4589b8070', 'Pendanaan', 'Investasi', 1, '-', '2022-02-13', 15000000, 2, 1, '2022-02-13 14:49:13', '2022-02-13 15:08:06'),
(2, 'bf23bb00-8cdd-11ec-b896-07ff491c1371', 'Barang', 'Mobil Truck', 1, '1 Buah', '2022-02-10', 22000000, 1, 1, '2022-02-13 15:00:56', '2022-02-13 15:00:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_jasa`
--

CREATE TABLE `barang_jasa` (
  `id_barang_jasa` int(11) NOT NULL,
  `uuid_barang_jasa` varchar(150) NOT NULL,
  `id_unit` int(11) NOT NULL,
  `jenis` int(2) NOT NULL COMMENT '1=sewa, 2=beli',
  `jumlah` varchar(50) NOT NULL,
  `tanggal` varchar(30) NOT NULL,
  `harga` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang_jasa`
--

INSERT INTO `barang_jasa` (`id_barang_jasa`, `uuid_barang_jasa`, `id_unit`, `jenis`, `jumlah`, `tanggal`, `harga`, `nama`, `status`, `date_created`, `date_updated`) VALUES
(1, '29f0ed30-8bf9-11ec-8add-a5061c9c3bdf', 1, 1, '1 buah', '2022-02-12', 2000000, 'Sewa Alat Berat', 1, '2022-02-12 11:44:40', '2022-02-13 13:05:48'),
(2, 'f77a8670-8bfc-11ec-a4fe-2b5548d6129f', 1, 2, '2 buah', '2022-02-13', 12000000, 'Beli traktor', 1, '2022-02-12 12:11:54', '2022-02-13 13:37:27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
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
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `uuid_jabatan`, `nama_jabatan`, `status`, `date_created`, `date_updated`) VALUES
(1, 'e8cd73b9-d313-4a23-abbf-f3a203c60b9a', 'Admin', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(2, 'e6683a7c-c4d0-46f8-8f46-95adb2746985', 'Sekretaris', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(3, 'ce1c6611-b07e-4ebc-9252-c5e5bebcb441', 'Bendahara', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(4, 'd427fc06-ad4d-429c-879d-6cb9da32d41d', 'Direktur', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13'),
(5, '5ad418af-c695-4306-9d45-28be01207f7e', 'Anggota', 1, '2022-02-06 08:23:13', '2022-02-06 08:23:13');

-- --------------------------------------------------------

--
-- Struktur dari tabel `keuangan`
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `keuangan`
--

INSERT INTO `keuangan` (`id_keuangan`, `uuid_keuangan`, `tanggal`, `jenis`, `keterangan`, `nilai`, `saldo_akhir`, `id_unit`, `approve_direktur`, `approve_sekretaris`, `approve_bendahara`, `status`, `date_created`, `date_updated`) VALUES
(1, '4ede7a60-8cec-11ec-b061-f724721c3182', '2022-02-06', 1, 'Hasil Jual Alat', 5000000, 15000000, 1, 1, 1, 1, 1, '2022-02-13 16:45:10', '2022-02-14 09:25:47'),
(2, '7c74b000-8cec-11ec-8a56-e9d96fa8f50a', '2022-02-13', 2, 'Beli Alat Tambang 2', 4000000, 4000000, 2, 0, 0, 0, 1, '2022-02-13 16:46:27', '2022-02-16 12:26:32'),
(4, 'eb9b3500-8d62-11ec-8c5d-fbf6670bf547', '2022-01-01', 1, 'Bahan Baku', 8000000, 8000000, 1, 1, 1, 1, 1, '2022-02-14 06:54:14', '2022-02-16 12:33:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_kegiatan`
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `laporan_kegiatan`
--

INSERT INTO `laporan_kegiatan` (`id_laporan_kegiatan`, `uuid_kegiatan`, `tanggal`, `id_unit`, `keterangan`, `lokasi`, `approv`, `approve_direktur`, `approve_sekretaris`, `approve_bendahara`, `status`, `date_created`, `date_updated`) VALUES
(1, '90a01ff0-8cf1-11ec-941c-0d76dc237789', '2022-02-08', 1, 'Penyuluhan', 'Jakarta', 2, 1, 1, 1, 1, '2022-02-13 17:22:48', '2022-02-14 13:37:37'),
(2, '9e93e4f0-8cf1-11ec-b4fb-f9dc5f5513ef', '2022-02-14', 2, 'Melakukan Ujicoba Kualitas', 'Jakarta', 2, 1, 1, 0, 1, '2022-02-13 17:23:11', '2022-02-16 12:22:54');

-- --------------------------------------------------------

--
-- Struktur dari tabel `logistik`
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `logistik`
--

INSERT INTO `logistik` (`id_logistik`, `uuid_logistik`, `id_unit`, `tanggal`, `jumlah`, `keterangan`, `harga`, `status`, `date_created`, `date_updated`) VALUES
(1, '76337a10-8be2-11ec-b67f-a7ee538cc74a', 3, '2022-02-11', '1 Buah', 'Tiang Jalan', 5000000, 1, '2022-02-12 09:02:10', '2022-02-12 09:14:23'),
(2, '2d563f60-8be6-11ec-966a-dd6fdc933db1', 3, '2022-01-31', '2', 'Alat penghitung uang', 4000000, 1, '2022-02-12 09:28:46', '2022-02-12 09:28:46');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitra`
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
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `mitra`
--

INSERT INTO `mitra` (`id_mitra`, `uuid_mitra`, `nama_mitra`, `alamat`, `bidang`, `tanggal_mulai`, `tanggal_selesai`, `status_mitra`, `status`, `date_created`, `date_updated`) VALUES
(1, 'efcafdf0-8cd6-11ec-bcda-b51b1761e52f', 'PT HONDA ASTRA', 'JAKARTA, INDONESIA', 'Otomotif', '2022-02-01', '2022-02-28', 1, 1, '2022-02-13 14:12:11', '2022-02-13 14:18:44'),
(2, '0a30ea40-8cd8-11ec-9205-efe3b95f2a71', 'PT YAMAHA', 'JAKARTA', 'Otomotif', '2022-01-31', '2022-02-26', 1, 1, '2022-02-13 14:20:05', '2022-02-13 14:20:05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit_usaha`
--

CREATE TABLE `unit_usaha` (
  `id_unit` int(11) NOT NULL,
  `unit_uuid` varchar(150) NOT NULL,
  `nama_unit` text NOT NULL,
  `deskripsi` text NOT NULL,
  `image` text NOT NULL,
  `tanggal_dibuka` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `unit_usaha`
--

INSERT INTO `unit_usaha` (`id_unit`, `unit_uuid`, `nama_unit`, `deskripsi`, `image`, `tanggal_dibuka`, `status`, `date_created`, `date_updated`) VALUES
(1, '2a9a6a60-8bd9-11ec-af88-cfc319115052', 'Simpan Pinjam', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic', '2a9a3400-8bd9-11ec-a60e-19da60c20eff.png', '2022-02-11', 1, '2022-02-12 07:55:38', '2022-02-12 08:20:47'),
(2, 'd1fbdbc0-8bd9-11ec-bd82-37c7f8b3969c', 'Pengelolaan Minyak', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic', '781d1090-8bdc-11ec-b864-4d64ac39db29.png', '2022-02-12', 1, '2022-02-12 08:00:18', '2022-02-12 08:19:16'),
(3, 'dcb82720-8bd9-11ec-8b5b-fb5477984095', 'Peralatan Sewa', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic', 'dcb80f50-8bd9-11ec-87c0-9b465228c8ec.png', '2022-02-12', 1, '2022-02-12 08:00:36', '2022-02-12 08:00:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `website`
--

CREATE TABLE `website` (
  `id` int(11) NOT NULL,
  `logo` text DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `website`
--

INSERT INTO `website` (`id`, `logo`, `name`) VALUES
(1, 'f60e6770-8f22-11ec-824f-6350c59fa1c1.png', 'Bumdes');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `asset`
--
ALTER TABLE `asset`
  ADD PRIMARY KEY (`id_asset`);

--
-- Indeks untuk tabel `bagi_hasil_usaha`
--
ALTER TABLE `bagi_hasil_usaha`
  ADD PRIMARY KEY (`id_usaha_mitra`);

--
-- Indeks untuk tabel `barang_jasa`
--
ALTER TABLE `barang_jasa`
  ADD PRIMARY KEY (`id_barang_jasa`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  ADD PRIMARY KEY (`id_keuangan`);

--
-- Indeks untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  ADD PRIMARY KEY (`id_laporan_kegiatan`);

--
-- Indeks untuk tabel `logistik`
--
ALTER TABLE `logistik`
  ADD PRIMARY KEY (`id_logistik`);

--
-- Indeks untuk tabel `mitra`
--
ALTER TABLE `mitra`
  ADD PRIMARY KEY (`id_mitra`);

--
-- Indeks untuk tabel `unit_usaha`
--
ALTER TABLE `unit_usaha`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indeks untuk tabel `website`
--
ALTER TABLE `website`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `asset`
--
ALTER TABLE `asset`
  MODIFY `id_asset` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `bagi_hasil_usaha`
--
ALTER TABLE `bagi_hasil_usaha`
  MODIFY `id_usaha_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `barang_jasa`
--
ALTER TABLE `barang_jasa`
  MODIFY `id_barang_jasa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `keuangan`
--
ALTER TABLE `keuangan`
  MODIFY `id_keuangan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `laporan_kegiatan`
--
ALTER TABLE `laporan_kegiatan`
  MODIFY `id_laporan_kegiatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `logistik`
--
ALTER TABLE `logistik`
  MODIFY `id_logistik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `mitra`
--
ALTER TABLE `mitra`
  MODIFY `id_mitra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `unit_usaha`
--
ALTER TABLE `unit_usaha`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `website`
--
ALTER TABLE `website`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
