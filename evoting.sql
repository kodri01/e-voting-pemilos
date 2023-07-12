-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2023 at 12:57 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evoting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `idadmin` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`idadmin`, `username`, `password`) VALUES
(123, 'admin', '4297f44b13955235245b2497399d7a93');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `no_urut` int(11) NOT NULL,
  `nis` varchar(10) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `motto` varchar(200) NOT NULL,
  `counts` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`no_urut`, `nis`, `photo`, `name`, `class`, `motto`, `counts`) VALUES
(1, '12222', '12222.jpg', 'Andini Laraswati', 'kelas A', 'motto nya itu', 1),
(2, '12334', '12334.jpg', 'Jaka Tingkir', 'kelas B', 'Motto adalah motto dong', 3),
(3, '1231', '1231.jpg', 'Wahyu', 'Kelas B', 'Motto nya', 1),
(4, '1111', '1111', 'Bima Sakti', 'Kelas C', 'Motto nya', 0);

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `nis` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `class` varchar(10) NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  `tgl` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`nis`, `name`, `class`, `state`, `tgl`) VALUES
(1232, 'Yusuf', 'kelas A', 1, '2023-07-31'),
(1234, 'Dini', 'Kelas E', 0, '2023-01-01'),
(2311, 'Budi', 'Kelas B', 1, '2023-11-30'),
(2928, 'Ali Bidin', 'Kelas B', 1, '2023-12-31'),
(3333, 'Luluk', 'Kelas B', 1, '2023-12-31'),
(4231, 'Lili', 'kelas A', 1, '2023-07-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idadmin`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`no_urut`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`nis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
