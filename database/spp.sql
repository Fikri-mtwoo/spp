-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 13 Nov 2021 pada 01.10
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_angkatan`
--

CREATE TABLE `tabel_angkatan` (
  `id_angkatan` int(11) NOT NULL,
  `tahun_angkatan` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_angkatan`
--

INSERT INTO `tabel_angkatan` (`id_angkatan`, `tahun_angkatan`, `tahun_ajaran`) VALUES
(1, '2021', '2021-2022'),
(2, '2022', '2022-2023');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_buku`
--

CREATE TABLE `tabel_buku` (
  `id_buku` char(10) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `harga_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_buku`
--

INSERT INTO `tabel_buku` (`id_buku`, `nama_buku`, `harga_buku`) VALUES
('BK424', 'Buku Paket Matematika', 50000),
('BK730', 'Buku Paket Fisika', 50000),
('BK741', 'LKS Penjaskes', 10000),
('BK786', 'LKS Seni Budaya', 10000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_detail_tagihan_buku`
--

CREATE TABLE `tabel_detail_tagihan_buku` (
  `id_detail_tagihan_buku` int(11) NOT NULL,
  `id_tagihan` char(20) NOT NULL,
  `id_buku` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_detail_tagihan_buku`
--

INSERT INTO `tabel_detail_tagihan_buku` (`id_detail_tagihan_buku`, `id_tagihan`, `id_buku`) VALUES
(9, 'TGNBK5219017', 'BK424'),
(10, 'TGNBK5219017', 'BK730'),
(11, 'TGNBK5219017', 'BK741'),
(12, 'TGNBK5219017', 'BK786'),
(26, 'TGNBK7998451', 'BK424'),
(27, 'TGNBK7998451', 'BK730'),
(31, 'TGNBK5875276', 'BK424'),
(32, 'TGNBK5875276', 'BK730'),
(33, 'TGNBK5875276', 'BK741'),
(34, 'TGNBK5875276', 'BK786'),
(35, 'TGNBK3369135', 'BK424'),
(36, 'TGNBK3369135', 'BK730'),
(37, 'TGNBK3369135', 'BK741'),
(38, 'TGNBK3369135', 'BK786'),
(39, 'TGNBK1687873', 'BK424'),
(40, 'TGNBK1687873', 'BK730');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jurnal`
--

CREATE TABLE `tabel_jurnal` (
  `id_jurnal` int(11) NOT NULL,
  `keterangan_jurnal` varchar(255) NOT NULL,
  `tgl_input` date NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jenis_saldo` enum('masuk','keluar','','') NOT NULL,
  `saldo` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_jurnal`
--

INSERT INTO `tabel_jurnal` (`id_jurnal`, `keterangan_jurnal`, `tgl_input`, `tgl_transaksi`, `jenis_saldo`, `saldo`) VALUES
(1, 'uang spp', '2021-11-05', '2021-11-05', 'masuk', 1500000),
(2, 'sarpras', '2021-11-05', '2021-11-05', 'keluar', 500000),
(4, 'uang spp', '2021-11-05', '2021-10-05', 'masuk', 2000000),
(5, 'pembayaran buku', '2021-11-05', '2020-01-05', 'masuk', 1500000),
(6, 'SPP', '2021-11-06', '2021-11-06', 'masuk', 300000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_jurusan`
--

CREATE TABLE `tabel_jurusan` (
  `id_jurusan` int(11) NOT NULL,
  `nama_jurusan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_jurusan`
--

INSERT INTO `tabel_jurusan` (`id_jurusan`, `nama_jurusan`) VALUES
(1, 'A'),
(2, 'B'),
(4, 'C');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_kelas`
--

CREATE TABLE `tabel_kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` int(11) NOT NULL,
  `romawi_kelas` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_kelas`
--

INSERT INTO `tabel_kelas` (`id_kelas`, `nama_kelas`, `romawi_kelas`) VALUES
(1, 10, 'X'),
(3, 11, 'XI');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_petugas`
--

CREATE TABLE `tabel_petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_petugas`
--

INSERT INTO `tabel_petugas` (`id_petugas`, `nama_petugas`, `username`, `password`, `profile`) VALUES
(1, 'Bendahara', 'bendahara', '827ccb0eea8a706c4c34a16891f84e7b', '86920211029.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_siswa`
--

CREATE TABLE `tabel_siswa` (
  `nisn_siswa` char(11) NOT NULL,
  `nis_siswa` char(11) NOT NULL,
  `nama_siswa` varchar(255) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_jurusan` int(11) NOT NULL,
  `jenis_kelamin` enum('laki-laki','perempuan','','') NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` char(13) NOT NULL,
  `id_angkatan` int(11) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `status` enum('aktif','keluar','pindah','berhenti') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_siswa`
--

INSERT INTO `tabel_siswa` (`nisn_siswa`, `nis_siswa`, `nama_siswa`, `id_kelas`, `id_jurusan`, `jenis_kelamin`, `alamat`, `no_telp`, `id_angkatan`, `profile`, `status`) VALUES
('0123456789', '210101', 'Dodi Mulyanto', 3, 2, 'laki-laki', 'Bekasi Timur', '087645324684', 1, '77620211030.jpg', 'aktif'),
('0123459876', '120301', 'Nazarrudin Alif', 1, 2, 'laki-laki', 'Bekasi Kota', '023532678754', 1, NULL, 'aktif'),
('0987654321', '120201', 'Fajar Nugroho', 1, 2, 'laki-laki', 'Grand Wisata', '087643563674', 1, NULL, 'aktif'),
('2346676865', '342433', 'Abdul', 1, 2, 'laki-laki', 'asdadad', '42342424', 1, NULL, 'aktif'),
('3647632466', '43663', 'bangkit', 1, 2, 'perempuan', 'dewi sartika', '087788013363', 1, '78920211110.jpg', 'aktif'),
('9876534567', '687687', 'Aan Abdul Rohman', 1, 2, 'laki-laki', 'sfsafsafa', '53253225325', 1, NULL, 'aktif');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_spp`
--

CREATE TABLE `tabel_spp` (
  `id_spp` int(11) NOT NULL,
  `id_angkatan` int(11) NOT NULL,
  `nominal_spp` int(11) NOT NULL,
  `nominal_gedung` int(11) NOT NULL,
  `nominal_pendaftaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_spp`
--

INSERT INTO `tabel_spp` (`id_spp`, `id_angkatan`, `nominal_spp`, `nominal_gedung`, `nominal_pendaftaran`) VALUES
(1, 1, 250000, 1500000, 300000),
(5, 2, 300000, 1000000, 100000),
(7, 1, 50000, 1000000, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_tagihan_buku`
--

CREATE TABLE `tabel_tagihan_buku` (
  `id_tagihan_buku` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `total_buku` int(11) NOT NULL,
  `total_nominal_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_tagihan_buku`
--

INSERT INTO `tabel_tagihan_buku` (`id_tagihan_buku`, `nisn_siswa`, `id_kelas`, `total_buku`, `total_nominal_buku`) VALUES
('TGNBK1687873', '0123456789', 3, 2, 100000),
('TGNBK3369135', '9876534567', 1, 4, 120000),
('TGNBK5219017', '0123456789', 1, 4, 120000),
('TGNBK5875276', '3647632466', 1, 4, 120000),
('TGNBK7998451', '0123459876', 1, 2, 100000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_tagihan_gedung`
--

CREATE TABLE `tabel_tagihan_gedung` (
  `id_tagihan_gedung` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_tagihan_gedung`
--

INSERT INTO `tabel_tagihan_gedung` (`id_tagihan_gedung`, `nisn_siswa`, `id_spp`) VALUES
('TGNGD177', '9876534567', 7),
('TGNGD992', '2346676865', 1),
('TRSKGD653', '0987654321', 1),
('TRSKGD885', '0123456789', 1),
('TRSKGD901', '0123459876', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_transaksi_buku`
--

CREATE TABLE `tabel_transaksi_buku` (
  `id_transaksi_buku` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `id_tagihan_buku` char(20) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_transaksi_buku`
--

INSERT INTO `tabel_transaksi_buku` (`id_transaksi_buku`, `nisn_siswa`, `id_tagihan_buku`, `jumlah_bayar`, `tanggal_bayar`, `keterangan`, `id_petugas`) VALUES
('TRSKGD1104529', '0123456789', 'TGNBK5219017', 20000, '2021-11-10', 'LUNAS', 1),
('TRSKGD8412122', '0123456789', 'TGNBK5219017', 100000, '2021-11-03', 'pembayaran ke-1', 1),
('TRSKGD9304972', '3647632466', 'TGNBK5875276', 120000, '2021-11-06', 'LUNAS', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_transaksi_gedung`
--

CREATE TABLE `tabel_transaksi_gedung` (
  `id_transaksi_gedung` char(20) NOT NULL,
  `id_tagihan_gedung` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_petugas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_transaksi_gedung`
--

INSERT INTO `tabel_transaksi_gedung` (`id_transaksi_gedung`, `id_tagihan_gedung`, `nisn_siswa`, `jumlah_bayar`, `tanggal_bayar`, `keterangan`, `id_petugas`) VALUES
('TRSKGD1212622', 'TRSKGD885', '0123456789', 1000000, '2021-11-04', 'lunas', 1),
('TRSKGD1886343', 'TGNGD177', '9876534567', 500000, '2021-11-10', 'pembayaran ke-1', 1),
('TRSKGD205', 'TRSKGD885', '0123456789', 300000, '2021-11-02', 'pembayaran ke-2', 1),
('TRSKGD643', 'TRSKGD885', '0123456789', 200000, '2021-11-02', 'pembayaran ke-1', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_transaksi_pendaftaran`
--

CREATE TABLE `tabel_transaksi_pendaftaran` (
  `id_transaksi_pendaftaran` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_transaksi_pendaftaran`
--

INSERT INTO `tabel_transaksi_pendaftaran` (`id_transaksi_pendaftaran`, `nisn_siswa`, `id_spp`, `jumlah_bayar`, `tanggal_bayar`, `keterangan`, `id_petugas`) VALUES
('TRSKPDF283', '0123456789', 1, 300000, '2021-11-10', 'LUNAS', 1),
('TRSKPDF304', '2346676865', 1, NULL, NULL, NULL, NULL),
('TRSKPDF510', '0123459876', 1, NULL, NULL, NULL, NULL),
('TRSKPDF518', '9876534567', 7, 100000, '2021-11-10', 'LUNAS', 1),
('TRSKPDF840', '0987654321', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_transaksi_spp`
--

CREATE TABLE `tabel_transaksi_spp` (
  `id_transaksi_spp` char(20) NOT NULL,
  `nisn_siswa` char(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `bulan_spp` int(11) NOT NULL,
  `tahun_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `tanggal_bayar` date DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_transaksi_spp`
--

INSERT INTO `tabel_transaksi_spp` (`id_transaksi_spp`, `nisn_siswa`, `id_kelas`, `id_spp`, `bulan_spp`, `tahun_spp`, `jumlah_bayar`, `tanggal_bayar`, `keterangan`, `id_petugas`) VALUES
('TRSKSPP1385321', '0123459876', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP1431340', '0987654321', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP1656291', '9876534567', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP1773105', '2346676865', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP1919311', '3647632466', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP1951011', '0123459876', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2071596', '0123459876', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2181195', '2346676865', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2363438', '9876534567', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2381305', '0987654321', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2437383', '9876534567', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2515577', '0987654321', 1, 7, 8, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2833124', '2346676865', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP2858235', '0123459876', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3211899', '9876534567', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3234129', '9876534567', 1, 7, 10, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3427025', '0123456789', 1, 7, 10, 2022, 50000, '2021-11-10', 'LUNAS', 1),
('TRSKSPP3488550', '0123459876', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP3501516', '0123456789', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3687779', '0123456789', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3688495', '0987654321', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP3918664', '2346676865', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4109787', '0123459876', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4156932', '9876534567', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4234625', '0123456789', 1, 7, 8, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4236429', '2346676865', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4267692', '0123456789', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4343839', '2346676865', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4448190', '0123456789', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4617833', '0123459876', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4635832', '9876534567', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4909096', '0123459876', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP4932267', '3647632466', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5192787', '3647632466', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5204685', '2346676865', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP5318742', '0987654321', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5404469', '9876534567', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5493284', '0123456789', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5614901', '3647632466', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5709789', '0987654321', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP5994738', '0123456789', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP6271919', '3647632466', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP6335556', '0123459876', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP6463021', '3647632466', 1, 7, 9, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP6925042', '0123456789', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP6926901', '0987654321', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP7012314', '0123456789', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP7038431', '0123456789', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP7047709', '2346676865', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP7154140', '0987654321', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP7306751', '3647632466', 1, 7, 10, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP7609809', '3647632466', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP7612978', '0987654321', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP7809616', '9876534567', 1, 7, 8, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8077939', '0987654321', 1, 7, 10, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8149405', '3647632466', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP8171382', '0987654321', 1, 7, 7, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8211955', '2346676865', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP8344872', '2346676865', 1, 7, 8, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8423662', '9876534567', 1, 7, 11, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP8461879', '2346676865', 1, 7, 10, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8498489', '3647632466', 1, 7, 8, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8534894', '2346676865', 1, 7, 5, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8573761', '3647632466', 1, 7, 4, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8743613', '0123459876', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP8795350', '3647632466', 1, 7, 1, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP9613743', '0987654321', 1, 7, 2, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP9648189', '0123456789', 1, 7, 3, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP9778071', '9876534567', 1, 7, 12, 2021, NULL, NULL, NULL, NULL),
('TRSKSPP9863503', '9876534567', 1, 7, 6, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP9904786', '0123459876', 1, 7, 10, 2022, NULL, NULL, NULL, NULL),
('TRSKSPP9998440', '0123459876', 1, 7, 8, 2022, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tabel_angkatan`
--
ALTER TABLE `tabel_angkatan`
  ADD PRIMARY KEY (`id_angkatan`);

--
-- Indeks untuk tabel `tabel_buku`
--
ALTER TABLE `tabel_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indeks untuk tabel `tabel_detail_tagihan_buku`
--
ALTER TABLE `tabel_detail_tagihan_buku`
  ADD PRIMARY KEY (`id_detail_tagihan_buku`);

--
-- Indeks untuk tabel `tabel_jurnal`
--
ALTER TABLE `tabel_jurnal`
  ADD PRIMARY KEY (`id_jurnal`);

--
-- Indeks untuk tabel `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  ADD PRIMARY KEY (`id_jurusan`);

--
-- Indeks untuk tabel `tabel_kelas`
--
ALTER TABLE `tabel_kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indeks untuk tabel `tabel_petugas`
--
ALTER TABLE `tabel_petugas`
  ADD PRIMARY KEY (`id_petugas`);

--
-- Indeks untuk tabel `tabel_siswa`
--
ALTER TABLE `tabel_siswa`
  ADD PRIMARY KEY (`nisn_siswa`);

--
-- Indeks untuk tabel `tabel_spp`
--
ALTER TABLE `tabel_spp`
  ADD PRIMARY KEY (`id_spp`);

--
-- Indeks untuk tabel `tabel_tagihan_buku`
--
ALTER TABLE `tabel_tagihan_buku`
  ADD PRIMARY KEY (`id_tagihan_buku`);

--
-- Indeks untuk tabel `tabel_tagihan_gedung`
--
ALTER TABLE `tabel_tagihan_gedung`
  ADD PRIMARY KEY (`id_tagihan_gedung`);

--
-- Indeks untuk tabel `tabel_transaksi_buku`
--
ALTER TABLE `tabel_transaksi_buku`
  ADD PRIMARY KEY (`id_transaksi_buku`);

--
-- Indeks untuk tabel `tabel_transaksi_gedung`
--
ALTER TABLE `tabel_transaksi_gedung`
  ADD PRIMARY KEY (`id_transaksi_gedung`);

--
-- Indeks untuk tabel `tabel_transaksi_pendaftaran`
--
ALTER TABLE `tabel_transaksi_pendaftaran`
  ADD PRIMARY KEY (`id_transaksi_pendaftaran`);

--
-- Indeks untuk tabel `tabel_transaksi_spp`
--
ALTER TABLE `tabel_transaksi_spp`
  ADD PRIMARY KEY (`id_transaksi_spp`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tabel_angkatan`
--
ALTER TABLE `tabel_angkatan`
  MODIFY `id_angkatan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tabel_detail_tagihan_buku`
--
ALTER TABLE `tabel_detail_tagihan_buku`
  MODIFY `id_detail_tagihan_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tabel_jurnal`
--
ALTER TABLE `tabel_jurnal`
  MODIFY `id_jurnal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tabel_jurusan`
--
ALTER TABLE `tabel_jurusan`
  MODIFY `id_jurusan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tabel_kelas`
--
ALTER TABLE `tabel_kelas`
  MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tabel_petugas`
--
ALTER TABLE `tabel_petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tabel_spp`
--
ALTER TABLE `tabel_spp`
  MODIFY `id_spp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
