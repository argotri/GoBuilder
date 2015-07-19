-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Jan 2015 pada 00.23
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan Untuk Membatasi User per Role' AUTO_INCREMENT=14 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan Untuk list dari form-form yang dibuat user' AUTO_INCREMENT=31 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='digunakan untuk list laporan' AUTO_INCREMENT=16 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Digunakan untuk isinya laporan  maksudnya isinya kolom' AUTO_INCREMENT=60 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id_role` int(11) NOT NULL,
  `nama_role` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `id_role`, `nama_user`, `firstLogin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 0, 'Admin', 0);

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
MODIFY `id_forbidden` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
MODIFY `id_form` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
MODIFY `id_laporan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `laporan_rekap`
--
ALTER TABLE `laporan_rekap`
MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
