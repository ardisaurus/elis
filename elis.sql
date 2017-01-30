-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2016 at 05:29 AM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `elis`
--

-- --------------------------------------------------------

--
-- Table structure for table `rom7`
--

CREATE TABLE IF NOT EXISTS `rom7` (
  `kode` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `baik` int(10) DEFAULT NULL,
  `ringan` int(10) DEFAULT NULL,
  `berat` int(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `rom7`
--

INSERT INTO `rom7` (`kode`, `nama`, `tgl`, `jumlah`, `baik`, `ringan`, `berat`, `foto`) VALUES
(1, 'Erlenmeyer', '2015-07-17', 15, 15, 0, 0, 'b6cd3144084e1fe989bff8cec5475991.jpg'),
(2, 'Labu destilasi', '2015-07-16', 12, 0, 12, 0, '3725a7bd6c82943a0aace1e733f78bb0.jpg'),
(3, 'Gelas Beaker', '2015-07-15', 8, 0, 0, 8, 'bbf204fa10102c31ef786ec1aab2f49a.jpg'),
(4, 'Corong gelas', '2015-07-22', 6, 2, 2, 2, '9f53f1923949d7568df74db9bcff9afd.jpg'),
(5, 'Corong bucher', '2015-07-17', 17, 5, 7, 5, 'c016cc9183524b5feaab319f5eeb1f91.jpg'),
(6, 'Corong pisah', '2015-07-08', 18, 6, 6, 6, 'f5030270cad74ff5a9de30d1388f46da.jpg'),
(7, 'Labu leher panjang', '2015-07-23', 9, 3, 3, 3, '6e5d0a241bfdf07daa00fd0bc13b81b6.jpg'),
(8, 'Gelas Ukur', '2015-07-21', 12, 10, 2, 0, 'b8c04491fef6f00528cfaa1945abe27b.jpg'),
(9, 'Kondensor', '2015-07-09', 20, 10, 5, 5, '6afb332d521d684996e028bb69f8738c.jpg'),
(10, 'Pipet tetes', '2015-07-14', 17, 2, 6, 9, '8aab3851d2e0c4ab6ed0e07ff92bc137.jpg'),
(11, 'Tabung reaksi', '2015-07-23', 10, 2, 8, 0, 'ea392bd3fde755bc56ae2be5a4068a60.jpg'),
(12, 'Kawat nikrom', '2014-06-11', 14, 4, 7, 3, '2469e1808d2b10dc01bb5af5573a949b.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rom8`
--

CREATE TABLE IF NOT EXISTS `rom8` (
  `kode` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `baik` int(10) DEFAULT NULL,
  `ringan` int(10) DEFAULT NULL,
  `berat` int(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `rom8`
--

INSERT INTO `rom8` (`kode`, `nama`, `tgl`, `jumlah`, `baik`, `ringan`, `berat`, `foto`) VALUES
(1, 'Desikator', '2015-07-16', 8, 2, 1, 5, '26857dc41e33eb8d6a6bada45006437c.jpg'),
(2, 'Indikator universal', '2015-07-09', 17, 7, 10, 0, '84afa9faba804194b5ba4703459977ef.jpg'),
(3, 'Kertas saring', '2015-07-09', 8, 8, 0, 0, 'aaf69d5f8fc27695e678a315fdc1172c.jpg'),
(4, 'Mortal dan pastle', '2015-07-22', 6, 2, 2, 2, '8b53283363c1363b9cd489f8f1a884f5.jpg'),
(5, 'Krusibel', '2015-07-17', 9, 6, 2, 1, '2adcad301b82a4a2d128e468a99a5a4e.jpg'),
(6, 'Evaporating dish', '2016-07-15', 10, 6, 1, 3, 'eaa0ac2962696cb4de5d44912d2363d1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rom9`
--

CREATE TABLE IF NOT EXISTS `rom9` (
  `kode` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `baik` int(10) DEFAULT NULL,
  `ringan` int(10) DEFAULT NULL,
  `berat` int(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rom10`
--

CREATE TABLE IF NOT EXISTS `rom10` (
  `kode` int(5) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `tgl` date DEFAULT NULL,
  `jumlah` int(10) DEFAULT NULL,
  `baik` int(10) DEFAULT NULL,
  `ringan` int(10) DEFAULT NULL,
  `berat` int(10) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ruang`
--

CREATE TABLE IF NOT EXISTS `ruang` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ruang`
--

INSERT INTO `ruang` (`id`, `nama`) VALUES
(7, 'Lab Kimia Gamma'),
(8, 'Lab Kimia Omega'),
(9, 'Lab Kimia Beta'),
(10, 'Lab Kimia Heksa');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `email` varchar(60) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_hp` varchar(12) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`email`, `nama`, `password`, `jenis_kelamin`, `tgl_lahir`, `no_hp`) VALUES
('kosaki@onodera.com', 'Kosaki Onodera', '0192023a7bbd73250516f069df18b500', 'p', '2014-06-11', '08574444222');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
