-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 11:19 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bogajaba_pricelist`
--
CREATE DATABASE IF NOT EXISTS `bogajaba_pricelist` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bogajaba_pricelist`;

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `judul` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `judul`, `keterangan`) VALUES
(7, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `alamat` text DEFAULT NULL,
  `tlp` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `alamat`, `tlp`, `email`) VALUES
(1, 'test', '082', 'a@a.com');

-- --------------------------------------------------------

--
-- Stand-in structure for view `priceuom`
-- (See below for the actual view)
--
CREATE TABLE `priceuom` (
`code` varchar(10)
,`desc` varchar(255)
,`uomafter` varchar(255)
,`conversion` float
,`size` float
,`price` decimal(10,0)
,`priceuom` double
);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `copyright` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmstconversion`
--

CREATE TABLE `tmstconversion` (
  `id` smallint(6) NOT NULL,
  `uombefore` tinyint(4) DEFAULT NULL,
  `uomafter` tinyint(4) DEFAULT NULL,
  `conversion` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstconversion`
--

INSERT INTO `tmstconversion` (`id`, `uombefore`, `uomafter`, `conversion`) VALUES
(1, 1, 2, 100),
(0, 0, 0, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `tmstitem`
--

CREATE TABLE `tmstitem` (
  `id` int(11) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstitem`
--

INSERT INTO `tmstitem` (`id`, `code`, `desc`) VALUES
(1, '1001', 'Test'),
(2, '1002', 'Baru'),
(0, 'A001', 'ABC Sambal / Chilli Sauce');

-- --------------------------------------------------------

--
-- Table structure for table `tmstpackaging`
--

CREATE TABLE `tmstpackaging` (
  `id` tinyint(4) NOT NULL,
  `packaging` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstpackaging`
--

INSERT INTO `tmstpackaging` (`id`, `packaging`) VALUES
(1, 'Dus'),
(2, 'Pack');

-- --------------------------------------------------------

--
-- Table structure for table `tmstpricefnb`
--

CREATE TABLE `tmstpricefnb` (
  `id` bigint(20) NOT NULL,
  `iditem` int(11) DEFAULT NULL,
  `convert` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstpricefnb`
--

INSERT INTO `tmstpricefnb` (`id`, `iditem`, `convert`) VALUES
(3, 1, 1),
(0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmstpricefnb_log`
--

CREATE TABLE `tmstpricefnb_log` (
  `id` bigint(20) NOT NULL,
  `iditem` int(11) DEFAULT NULL,
  `convert` tinyint(4) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `daterecord` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstpricefnb_log`
--

INSERT INTO `tmstpricefnb_log` (`id`, `iditem`, `convert`, `user`, `aksi`, `daterecord`) VALUES
(1, 1, 1, 'admin', 'INSERT', '2018-11-16 09:08:15'),
(2, 2, 0, 'admin', 'UPDATE', '2018-11-16 09:08:45'),
(3, 2, 0, 'admin', 'UPDATE', '2018-11-16 09:08:57'),
(4, 2, 1, 'admin', 'INSERT', '2018-11-16 09:21:00'),
(5, 2, 1, 'admin', 'DELETE', '2018-11-16 09:21:22'),
(6, 1, 1, 'admin', 'INSERT', '2018-11-16 13:20:40'),
(0, 0, 0, 'margaretha', 'INSERT', '2018-11-29 11:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `tmstpricelist`
--

CREATE TABLE `tmstpricelist` (
  `id` bigint(20) NOT NULL,
  `iditem` int(11) DEFAULT NULL,
  `packaging` tinyint(4) DEFAULT NULL,
  `uom` tinyint(4) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `source` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstpricelist`
--

INSERT INTO `tmstpricelist` (`id`, `iditem`, `packaging`, `uom`, `size`, `price`, `source`) VALUES
(1, 1, 1, 1, 10, '10000', 1),
(0, 0, 1, 0, 5, '100000', 1),
(0, 0, 0, 0, 1, '11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tmstpricelist_log`
--

CREATE TABLE `tmstpricelist_log` (
  `id` bigint(20) NOT NULL,
  `iditem` int(11) DEFAULT NULL,
  `packaging` tinyint(4) DEFAULT NULL,
  `uom` tinyint(4) DEFAULT NULL,
  `size` float DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `source` tinyint(4) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `aksi` varchar(50) DEFAULT NULL,
  `daterecord` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstpricelist_log`
--

INSERT INTO `tmstpricelist_log` (`id`, `iditem`, `packaging`, `uom`, `size`, `price`, `source`, `user`, `aksi`, `daterecord`) VALUES
(1, 1, 1, 1, 10, '10000', 1, 'admin', 'INSERT', '2018-11-16 00:00:00'),
(2, 12, 2, 1, 10, '10000', 1, 'admin', 'INSERT', '2018-11-16 02:44:55'),
(3, 13, 1, 1, 12, '100001', 1, 'admin', 'INSERT', '0000-00-00 00:00:00'),
(4, 11, 1, 1, 10, '10000', 1, 'admin', 'INSERT', '2018-11-16 02:47:22'),
(5, 13, 1, 1, 12, '100001', 1, 'admin', 'INSERT', '2018-11-16 08:50:31'),
(6, 131, 0, 0, 12, '100001', 0, 'admin', 'UPDATE', '2018-11-16 08:53:34'),
(7, 131212, 0, 0, 12, '100001', 0, 'admin', 'UPDATE', '2018-11-16 08:53:56'),
(8, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'DELETE', '2018-11-16 08:54:27'),
(9, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'DELETE', '2018-11-16 08:55:19'),
(10, 11, NULL, NULL, NULL, NULL, NULL, 'admin', 'DELETE', '2018-11-16 08:59:44'),
(11, 12, 2, 1, 10, '10000', 1, 'admin', 'DELETE', '2018-11-16 09:01:22'),
(0, 0, 1, 0, 5, '100000', 1, 'margaretha', 'INSERT', '2018-11-29 11:17:31'),
(0, 0, 0, 0, 1, '11', 0, 'margaretha', 'INSERT', '2018-11-29 11:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `tmstsource`
--

CREATE TABLE `tmstsource` (
  `id` tinyint(4) NOT NULL,
  `source` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstsource`
--

INSERT INTO `tmstsource` (`id`, `source`) VALUES
(1, 'Gudang HO');

-- --------------------------------------------------------

--
-- Table structure for table `tmstuom`
--

CREATE TABLE `tmstuom` (
  `id` tinyint(4) NOT NULL,
  `uom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmstuom`
--

INSERT INTO `tmstuom` (`id`, `uom`) VALUES
(1, 'Liter'),
(2, 'Mili Liter'),
(0, 'GRAM'),
(0, 'KILOGRAM');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('Admin','User','SuperAdmin') DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `pp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `nama`, `pp`) VALUES
(1, 'admin', '9222e8edf1c3f65d9d87590914012f35e4676f0e', 'SuperAdmin', 'System Administrator', 'an.png'),
(4, 'budi', '9222e8edf1c3f65d9d87590914012f35e4676f0e', 'SuperAdmin', 'Budi Priyo Utomo', 'an.png'),
(8, 'melinda', '028e83f11889f3781e3ba639fbc73bb52587b11c', 'Admin', 'Melinda Liyoto', 'an.png'),
(15, 'topan', 'faefb7b3061b21ae30a4960072df6ca2b1c44c62', 'SuperAdmin', 'Asep Topan Suryadi', 'an.png'),
(16, 'hendry', '4d9a204788320c6534dfd690ea9ee224a5488b5b', 'User', 'Hendry Gunadi', 'an.png'),
(17, 'jerni', '9c6755e1543d0f8d7d41c39e0770c8f021776327', 'User', 'Jerni Mulyani', 'an.png'),
(19, 'dessy', '6e069d577f7248ed41060e8e223d726ee122772c', 'User', 'Dessy Lestari', 'an.png'),
(20, 'kiki', '93556d2ebdd0750658ec85f4d255ce17c1c1f761', 'User', 'Kiki Adji Nurahman', 'an.png'),
(21, 'marco', '869ae3068ae0ef96631d96ddd84cbd4692d0e4bb', 'User', 'Asep Komarudin', 'an.png'),
(23, 'margaretha', 'f588caeece37eadf36b6c9f58eb0a849cc20764d', 'SuperAdmin', 'Margaretha', 'an.png'),
(37, 'ivan', '8bb8bb2f284a352ed5e4f9c7b86af87c47487079', 'User', 'Ivan Saputra', 'an.png'),
(38, 'evy', '80071ff3d1ecb68f8ed245428d7f540783bc1a67', 'Admin', 'Evy Anita', 'an.png'),
(39, 'feller', '80071ff3d1ecb68f8ed245428d7f540783bc1a67', 'Admin', 'Feller Lokanata', 'an.png');

-- --------------------------------------------------------

--
-- Structure for view `priceuom`
--
DROP TABLE IF EXISTS `priceuom`;

CREATE ALGORITHM=UNDEFINED DEFINER=`bogajabarco`@`localhost` SQL SECURITY DEFINER VIEW `priceuom`  AS SELECT `tmstitem`.`code` AS `code`, `tmstitem`.`desc` AS `desc`, `tmstuom`.`uom` AS `uomafter`, `tmstconversion`.`conversion` AS `conversion`, `tmstpricelist`.`size` AS `size`, `tmstpricelist`.`price` AS `price`, `tmstpricelist`.`price`/ `tmstpricelist`.`size` / `tmstconversion`.`conversion` AS `priceuom` FROM ((((`tmstitem` join `tmstpricefnb`) join `tmstconversion`) join `tmstpricelist`) join `tmstuom`) WHERE `tmstitem`.`id` = `tmstpricefnb`.`iditem` AND `tmstconversion`.`id` = `tmstpricefnb`.`convert` AND `tmstpricelist`.`iditem` = `tmstitem`.`id` AND `tmstuom`.`id` = `tmstconversion`.`uomafter` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
