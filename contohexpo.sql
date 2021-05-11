-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 11:32 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contohexpo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `no` int(10) NOT NULL,
  `no_user` int(10) NOT NULL,
  `no_loker` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `loker`
--

CREATE TABLE `loker` (
  `no` int(10) NOT NULL,
  `divisi` varchar(500) NOT NULL,
  `no_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loker`
--

INSERT INTO `loker` (`no`, `divisi`, `no_perusahaan`) VALUES
(1, 'Loker 1', 1),
(2, 'Loker 2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `no` int(10) NOT NULL,
  `nama_perusahaan` varchar(500) NOT NULL,
  `filefoto` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`no`, `nama_perusahaan`, `filefoto`) VALUES
(1, 'Perusahaan 1', 'APL.png'),
(2, 'Perusahaan 2', 'SIN.png');

-- --------------------------------------------------------

--
-- Table structure for table `requestforgot`
--

CREATE TABLE `requestforgot` (
  `no` int(10) NOT NULL,
  `email` varchar(500) NOT NULL,
  `kode` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `requestforgot`
--

INSERT INTO `requestforgot` (`no`, `email`, `kode`) VALUES
(28, 'stevanus18001@mail.unpad.ac.id', '$2y$10$MsVP9Kw47uWpxpdDire3VucY6maFNnPPPHctkHojzkLNko0ZhuMti'),
(33, 'stevanus162@gmail.com', '$2y$10$0.2pkKtkEONCKKbO.dTM0.83KAA4kEgVSpjuVPEWeKrsCVrW036GG');

-- --------------------------------------------------------

--
-- Table structure for table `tempuser`
--

CREATE TABLE `tempuser` (
  `no` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` int(11) NOT NULL,
  `kode` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tempuser`
--

INSERT INTO `tempuser` (`no`, `email`, `password`, `first_name`, `last_name`, `phone`, `gender`, `birth_date`, `role`, `kode`) VALUES
(61, 'stevanus162@gmail.com', '$2y$10$nIR5HxPVdCxWGZWxF3vCw.kratSI7rIdRU3.nRjQXPR2JQkLA6hEq', 'Stevanus Dennis', 'Wijaya', '085694871675', 'Male', '2001-12-15', 1, '$2y$10$mQ94ZVa.b9rIXVBRGBSq4u1Opj0Ncn74iUpJ30m6MgROLWO5Gso9a');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `no` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`no`, `email`, `password`, `first_name`, `last_name`, `phone`, `gender`, `birth_date`, `role`) VALUES
(9, 'stevanus18001@mail.unpad.ac.id', '$2y$10$NDQ9iKqFyzJuH41X/0zEhe0z4gjRlhVLxFm4DuIbf7f8X4I4IGKv6', 'Stevanus', 'Dennis', '085694871675', 'Male', '2001-12-15', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `loker`
--
ALTER TABLE `loker`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `requestforgot`
--
ALTER TABLE `requestforgot`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tempuser`
--
ALTER TABLE `tempuser`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`no`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `loker`
--
ALTER TABLE `loker`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `requestforgot`
--
ALTER TABLE `requestforgot`
  MODIFY `no` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tempuser`
--
ALTER TABLE `tempuser`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
