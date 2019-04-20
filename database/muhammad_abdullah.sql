-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2017 at 06:58 AM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `muhammad_abdullah`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE IF NOT EXISTS `buku` (
  `id_buku` int(11) NOT NULL AUTO_INCREMENT,
  `id_katalog` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(90) NOT NULL,
  `pengarang` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `hal` varchar(4) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `harga` varchar(11) NOT NULL,
  `deskripsi` varchar(300) NOT NULL,
  `tanggal` date NOT NULL,
  `tanggal_edit` date NOT NULL,
  PRIMARY KEY (`id_buku`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `id_katalog`, `id_kategori`, `judul`, `pengarang`, `penerbit`, `hal`, `gambar`, `harga`, `deskripsi`, `tanggal`, `tanggal_edit`) VALUES
(1, 3, 4, 'Sistem Operasi', 'Abdul Ghony', 'Abdol PRESS', '90', '20170223094621.jpg', '56000', 'Ingin lebih tau tentang Sistem Operasi? buku\r\nini mempelajari tentang Pengertian sistem informasi\r\ndan selengkap nya silahkan anda membeli buku ini', '2017-02-23', '0000-00-00'),
(2, 4, 4, 'Pendidikan Kewarganegaraan 12', 'Abdul Saleh', 'Abdoel PRESS', '80', '20170223095301.jpg', '80500', 'Perkuat karakter anak bangsa dengan pendidikan karakter PKN', '2017-02-23', '0000-00-00'),
(4, 2, 3, 'xxxxxxxx', 'xxxxx', 'xx', '123', '20170225045703.png', '20000', 'xxxxx', '2017-02-25', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id_cus` int(11) NOT NULL AUTO_INCREMENT,
  `nama_cus` varchar(40) NOT NULL,
  `email_cus` varchar(40) NOT NULL,
  `password_cus` varchar(40) NOT NULL,
  PRIMARY KEY (`id_cus`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_cus`, `nama_cus`, `email_cus`, `password_cus`) VALUES
(1, 'Pak Zen', 'ziedanalfahrizy@gmail.com', '12345'),
(9, 'fulan bin fulan', 'fulan@yahoo.co.id', 'fulan'),
(10, 'Zaki', 'zakiucrut@gmail.com', 'ucrut'),
(11, 'zuzu', 'zuzu@gmail.com', 'zuzu'),
(12, 'aha', 'aha@gmail.com', 'aha'),
(13, 'Muhammad Abdullah bin Sulaiman', 'alfa@gmail.com', 'alfa');

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE IF NOT EXISTS `katalog` (
  `id_katalog` int(11) NOT NULL AUTO_INCREMENT,
  `id_kategori` int(11) NOT NULL,
  `katalog` varchar(50) NOT NULL,
  PRIMARY KEY (`id_katalog`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`id_katalog`, `id_kategori`, `katalog`) VALUES
(1, 2, 'Komik'),
(2, 3, 'Novel'),
(3, 4, 'Informatika'),
(4, 4, 'LKS SMK');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE IF NOT EXISTS `kategori` (
  `id_kategori` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(40) NOT NULL,
  PRIMARY KEY (`id_kategori`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Dewasa'),
(2, 'Anak'),
(3, 'Remaja'),
(4, 'Pendidikan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_keranjang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_beli` varchar(100) NOT NULL,
  `id_cus` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `harga` varchar(12) NOT NULL,
  `total_harga` varchar(12) NOT NULL,
  `total_bayar` varchar(20) NOT NULL,
  `qty_total` varchar(10) NOT NULL,
  `status_beli` enum('order','lunas') NOT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE IF NOT EXISTS `pembelian` (
  `id_beli` int(11) NOT NULL AUTO_INCREMENT,
  `kode_beli` varchar(100) NOT NULL,
  `id_cus` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `harga` varchar(15) NOT NULL,
  `total_harga` varchar(15) NOT NULL,
  `total_bayar` varchar(15) NOT NULL,
  `qty_total` varchar(15) NOT NULL,
  PRIMARY KEY (`id_beli`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_beli`, `kode_beli`, `id_cus`, `id_buku`, `qty`, `harga`, `total_harga`, `total_bayar`, `qty_total`) VALUES
(16, '23131', 11, 2, '3', '80500', '241500', '', ''),
(17, '23131', 11, 1, '1', '56000', '56000', '', ''),
(18, '12786', 11, 1, '11', '56000', '616000', '', ''),
(19, '30870', 12, 2, '3', '80500', '241500', '', ''),
(20, '30870', 12, 3, '1', '90000', '90000', '', ''),
(21, '21850', 11, 2, '3', '80500', '241500', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `provinsi`
--

CREATE TABLE IF NOT EXISTS `provinsi` (
  `id_provinsi` int(11) NOT NULL AUTO_INCREMENT,
  `provinsi` varchar(30) NOT NULL,
  `tarif` varchar(15) NOT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `provinsi`
--

INSERT INTO `provinsi` (`id_provinsi`, `provinsi`, `tarif`) VALUES
(1, 'Jawa Timur', '11000'),
(2, 'Jawa Tengah', '12500'),
(3, 'Jawa Barat', '18000'),
(4, 'Kalimantan Barat', '48500');

-- --------------------------------------------------------

--
-- Table structure for table `selesai`
--

CREATE TABLE IF NOT EXISTS `selesai` (
  `kode_beli` varchar(100) NOT NULL,
  `id_cus` int(11) NOT NULL,
  `qty_total` varchar(10) NOT NULL,
  `bayar` varchar(15) NOT NULL,
  `total_bayar` varchar(15) NOT NULL,
  `tgl_order` text NOT NULL,
  `status_beli` enum('order','lunas') NOT NULL,
  `status_pengiriman` enum('belum dikirim','dikirim','diterima') NOT NULL,
  PRIMARY KEY (`kode_beli`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `selesai`
--

INSERT INTO `selesai` (`kode_beli`, `id_cus`, `qty_total`, `bayar`, `total_bayar`, `tgl_order`, `status_beli`, `status_pengiriman`) VALUES
('30870', 12, '1', '90000', '101000', '2017-02-25', 'lunas', 'diterima');

-- --------------------------------------------------------

--
-- Table structure for table `stok`
--

CREATE TABLE IF NOT EXISTS `stok` (
  `id_stok` int(11) NOT NULL AUTO_INCREMENT,
  `id_buku` int(11) NOT NULL,
  `stok` varchar(5) NOT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `stok`
--

INSERT INTO `stok` (`id_stok`, `id_buku`, `stok`) VALUES
(1, 1, '1'),
(2, 2, '23'),
(4, 4, '2');

-- --------------------------------------------------------

--
-- Table structure for table `superuser`
--

CREATE TABLE IF NOT EXISTS `superuser` (
  `id_su` int(11) NOT NULL AUTO_INCREMENT,
  `nama_su` varchar(40) NOT NULL,
  `email_su` varchar(40) NOT NULL,
  `password_su` varchar(40) NOT NULL,
  `level` enum('owner','admin') NOT NULL,
  PRIMARY KEY (`id_su`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `superuser`
--

INSERT INTO `superuser` (`id_su`, `nama_su`, `email_su`, `password_su`, `level`) VALUES
(1, 'Muhammad Abdullah', 'alfarizie4000@gmail.com', 'alfajunior20', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tujuan`
--

CREATE TABLE IF NOT EXISTS `tujuan` (
  `id_tujuan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_beli` varchar(110) NOT NULL,
  `nama_penerima` varchar(50) NOT NULL,
  `provinsi` varchar(30) NOT NULL,
  `kabupaten` varchar(25) NOT NULL,
  `kecamatan` varchar(25) NOT NULL,
  `kode_pos` varchar(5) NOT NULL,
  `desa` varchar(25) NOT NULL,
  `rw` varchar(3) NOT NULL,
  `rt` varchar(3) NOT NULL,
  `no_rumah` varchar(5) NOT NULL,
  `no_telp` varchar(12) NOT NULL,
  `tarif` varchar(15) NOT NULL,
  PRIMARY KEY (`id_tujuan`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tujuan`
--

INSERT INTO `tujuan` (`id_tujuan`, `kode_beli`, `nama_penerima`, `provinsi`, `kabupaten`, `kecamatan`, `kode_pos`, `desa`, `rw`, `rt`, `no_rumah`, `no_telp`, `tarif`) VALUES
(1, '2994', 'Atokillah', 'Jawa Tengah', 'xx', 'xxx', 'xxxx', 'xxxxx', '5', '6', '32', '082453456754', '12500'),
(2, '10472', 'Fulan', 'Jawa Tengah', 'xx', 'xxxx', 'xxxxx', 'xxxxxx', '2', '5', '27', '081252258465', '12500'),
(3, '21628', 'Fulan bin Fulan', 'Jawa Barat', 'ciamis', 'ciamos', '87654', 'cibadut', '9', '6', '24', '081234567678', '18000'),
(4, '19201', 'Zaki', 'Jawa Tengah', 'xx', 'xxx', 'xxx', 'xx', '6', '7', '43', '08123456634', '12500'),
(5, '27569', 'zakia', 'Kalimantan Barat', 'x', 'x', 'x', 'x', '6', '7', '25', '085676554123', '48500'),
(6, '21866', 'siti zulaikha', 'Jawa Barat', 'xx', 'xx', 'xx', 'xx', '6', '4', '47', '086576542341', '18000'),
(7, '23131', 'Siti Zulaikha', 'Jawa Tengah', 'xxx', 'xx', 'xx', 'xx', '6', '5', '76', '085678765345', '12500'),
(8, '12786', 'bang boby', 'Jawa Tengah', 'x', 'x', 'x', 'x', '4', '2', '12', '085853480591', '12500'),
(9, '30870', 'AHMAD', 'Jawa Timur', 'nganjuk', 'baron', '64394', 'jekek', '09', '02', '22', '085853480591', '11000');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
