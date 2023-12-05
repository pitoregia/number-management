-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 05, 2023 at 03:14 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbnumber`
--

-- --------------------------------------------------------

--
-- Table structure for table `tnumber`
--

CREATE TABLE `tnumber` (
  `id` int(11) NOT NULL,
  `nomor_telp` varchar(15) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal_aktif` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `tanggal_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tnumber`
--

INSERT INTO `tnumber` (`id`, `nomor_telp`, `deskripsi`, `status`, `tanggal_aktif`, `tanggal_expired`, `tanggal_simpan`) VALUES
(1, '85733947500', 'Direct testing', 'Hidup', '2023-12-01', '2023-12-30', '2023-12-04 04:46:31'),
(2, '88813276642', 'nox', 'Tenggang', '2023-11-30', '2023-12-21', '2023-12-04 04:46:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `name`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Admin'),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'User'),
(3, 'esa', '80ad0b9fa48a74fe86a9c8ee665d96bb', 'admin', 'Mahesa Danuarta'),
(4, 'joko', '9ba0009aa81e794e628a04b51eaf7d7f', 'user', 'Raihan Revi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tnumber`
--
ALTER TABLE `tnumber`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tnumber`
--
ALTER TABLE `tnumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
