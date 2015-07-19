-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Jan 2015 pada 08.38
-- Versi Server: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gobuilder`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `forbiden_menu`
--

CREATE TABLE IF NOT EXISTS `forbiden_menu` (
`id_forbidden` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan Untuk Membatasi User per Role' AUTO_INCREMENT=12 ;

--
-- Dumping data untuk tabel `forbiden_menu`
--

INSERT INTO `forbiden_menu` (`id_forbidden`, `id_role`, `id_menu`) VALUES
(6, 4, 13),
(7, 4, 12),
(8, 4, 14),
(9, 3, 13),
(10, 3, 15),
(11, 3, 12);

-- --------------------------------------------------------

--
-- Struktur dari tabel `form`
--

CREATE TABLE IF NOT EXISTS `form` (
`id_form` int(11) NOT NULL,
  `nama_form` varchar(100) NOT NULL,
  `nama_tabel` varchar(50) NOT NULL,
  `tgl_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan Untuk list dari form-form yang dibuat user' AUTO_INCREMENT=29 ;

--
-- Dumping data untuk tabel `form`
--

INSERT INTO `form` (`id_form`, `nama_form`, `nama_tabel`, `tgl_create`, `user_create`) VALUES
(27, 'Data Barang Kantor', 'FORM_54BCC42F90614', '2015-01-19 08:45:35', 'admin'),
(28, 'Form Penjualan Tiket', 'FORM_54C5F6C27F00D', '2015-01-26 08:11:46', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_54bcc42f90614`
--

CREATE TABLE IF NOT EXISTS `form_54bcc42f90614` (
`id` int(6) unsigned NOT NULL,
  `NAMABARANG1` varchar(100) NOT NULL COMMENT 'Nama Barang,text',
  `JUMLAHSTOK2` int(20) NOT NULL COMMENT 'Jumlah Stok,number',
  `KETERANGAN3` text COMMENT 'Keterangan,text_area'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `form_54c5f6c27f00d`
--

CREATE TABLE IF NOT EXISTS `form_54c5f6c27f00d` (
`id` int(6) unsigned NOT NULL,
  `PAXPASSANGER1` varchar(100) NOT NULL COMMENT 'Pax / Passanger,text',
  `ADDRESS2` text NOT NULL COMMENT 'Address,text_area',
  `JUMLAHTIKET3` int(20) NOT NULL COMMENT 'Jumlah Tiket,number'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data untuk tabel `form_54c5f6c27f00d`
--

INSERT INTO `form_54c5f6c27f00d` (`id`, `PAXPASSANGER1`, `ADDRESS2`, `JUMLAHTIKET3`) VALUES
(1, 'Argo Triwidodo', 'Jalan Lespadangan 01', 2),
(2, 'Budi', 'Jalan Lespadangan 02 Mojokerto', 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
`id_laporan` int(11) NOT NULL,
  `nama_laporan` varchar(50) NOT NULL,
  `judul_laporan` varchar(100) NOT NULL,
  `id_form` int(11) NOT NULL,
  `nama_tabel` varchar(50) NOT NULL,
  `tipe_laporan` varchar(20) NOT NULL,
  `tgl_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_create` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='digunakan untuk list laporan' AUTO_INCREMENT=14 ;

--
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id_laporan`, `nama_laporan`, `judul_laporan`, `id_form`, `nama_tabel`, `tipe_laporan`, `tgl_create`, `user_create`) VALUES
(12, 'Data Kantor', 'Laporan Data Kantor', 27, 'FORM_54BCC42F90614', 'mendatar', '2015-01-19 08:46:14', 'admin'),
(13, 'Penjualan Tiket', 'Penjualan Tiket', 28, 'FORM_54C5F6C27F00D', 'mendatar', '2015-01-26 12:43:24', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan_rekap`
--

CREATE TABLE IF NOT EXISTS `laporan_rekap` (
`id_detail` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `judul_kolom` varchar(100) NOT NULL COMMENT 'digunakan untuk judul kolom diatasnya',
  `urutan_kolom` int(3) NOT NULL COMMENT 'digunakan untuk urutan dari kolom ( Terendah 1 tertinggi tak terhingga)',
  `nama_kolom_tabel` varchar(100) NOT NULL COMMENT 'Kolom yang digunakan pada tabel / query',
  `fungsi` varchar(200) DEFAULT NULL COMMENT 'fungsi ini digunakan untuk apakah Summary atau Average ,'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan untuk isinya laporan  maksudnya isinya kolom' AUTO_INCREMENT=48 ;

--
-- Dumping data untuk tabel `laporan_rekap`
--

INSERT INTO `laporan_rekap` (`id_detail`, `id_laporan`, `judul_kolom`, `urutan_kolom`, `nama_kolom_tabel`, `fungsi`) VALUES
(33, 12, 'Nama Barang', 1, 'NAMABARANG1', ''),
(34, 12, 'Jumlah Stok', 2, 'JUMLAHSTOK2', 'sum'),
(35, 12, 'Keterangan', 3, 'KETERANGAN3', ''),
(45, 13, 'Pax / Passanger', 1, 'PAXPASSANGER1', ''),
(46, 13, 'Address', 2, 'ADDRESS2', ''),
(47, 13, 'Jumlah Tiket', 3, 'JUMLAHTIKET3', 'sum');

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id_menu` int(11) NOT NULL,
  `nama_menu` varchar(50) NOT NULL,
  `id_form` int(11) DEFAULT NULL,
  `id_laporan` int(11) DEFAULT NULL,
  `icon` varchar(100) DEFAULT NULL,
  `urutan` int(3) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `id_form`, `id_laporan`, `icon`, `urutan`) VALUES
(12, 'Data Kantor', 27, NULL, NULL, NULL),
(13, 'Laporan Data Kantor', NULL, 12, NULL, NULL),
(14, 'Penjualan  Tiket', 28, NULL, NULL, NULL),
(15, 'Laporan Penjualan Tiket', NULL, 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id_role` int(11) NOT NULL,
  `nama_role` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(3, 'Help Desk'),
(4, 'Management');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_role` int(4) DEFAULT NULL COMMENT '0 adalah admin yang paling dewa',
  `nama_user` varchar(30) NOT NULL,
  `firstLogin` int(1) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_role`, `nama_user`, `firstLogin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Admin', 0),
(3, 'hp', 'd2ccda10db94c2b5d51beed10484c025', 3, 'Help Desk', 0),
(4, 'mg', 'b351bb9b0af6e4fc678749675c53ad67', 4, 'Management', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `forbiden_menu`
--
ALTER TABLE `forbiden_menu`
 ADD PRIMARY KEY (`id_forbidden`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
 ADD PRIMARY KEY (`id_form`);

--
-- Indexes for table `form_54bcc42f90614`
--
ALTER TABLE `form_54bcc42f90614`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `form_54c5f6c27f00d`
--
ALTER TABLE `form_54c5f6c27f00d`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
 ADD PRIMARY KEY (`id_laporan`);

--
-- Indexes for table `laporan_rekap`
--
ALTER TABLE `laporan_rekap`
 ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
 ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `forbiden_menu`
--
ALTER TABLE `forbiden_menu`
MODIFY `id_forbidden` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `form_54bcc42f90614`
--
ALTER TABLE `form_54bcc42f90614`
MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `form_54c5f6c27f00d`
--
ALTER TABLE `form_54c5f6c27f00d`
MODIFY `id` int(6) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `laporan_rekap`
--
ALTER TABLE `laporan_rekap`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
