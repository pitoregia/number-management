-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Des 2023 pada 08.10
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

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
-- Struktur dari tabel `bot_token`
--

CREATE TABLE `bot_token` (
  `bot_id` int(11) NOT NULL,
  `telegram_bot_token` varchar(50) NOT NULL,
  `group_chat_id` varchar(50) NOT NULL,
  `message` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `bot_token`
--

INSERT INTO `bot_token` (`bot_id`, `telegram_bot_token`, `group_chat_id`, `message`) VALUES
(1, '6693643442:AAHnF3Q7_pfoUN5pT4NXxkrFcOjKWbKvJFQ', '@testing5421', 'Testing'),
(2, '6883561327:AAEA_nAK0C2HQFry8VTwyeA5TeassFhi8Rk', '@test54422', 'testing 2');

-- --------------------------------------------------------

--
-- Struktur dari tabel `dropdown_items`
--

CREATE TABLE `dropdown_items` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `dropdown_items`
--

INSERT INTO `dropdown_items` (`id`, `category`, `name`) VALUES
(1, 'device', 'Device 1'),
(2, 'device', 'Device 2'),
(3, 'device', 'Device 3'),
(4, 'pic', 'John'),
(5, 'pic', 'Bob'),
(6, 'pic', 'Alice'),
(7, 'current_application', 'App 1'),
(8, 'current_application', 'App 2'),
(9, 'current_application', 'App 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission`
--

CREATE TABLE `permission` (
  `permission_id` varchar(15) NOT NULL,
  `permission_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permission`
--

INSERT INTO `permission` (`permission_id`, `permission_name`) VALUES
('edit_number', 'Edit Number'),
('edit_user', 'Edit User');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_permission`
--

CREATE TABLE `role_permission` (
  `role_id` int(11) NOT NULL,
  `permission_id` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `role_permission`
--

INSERT INTO `role_permission` (`role_id`, `permission_id`) VALUES
(1, 'edit_number'),
(1, 'edit_user');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tnumber`
--

CREATE TABLE `tnumber` (
  `id` int(11) NOT NULL,
  `nomor_telp` varchar(15) NOT NULL,
  `tanggal_aktif` date NOT NULL,
  `tanggal_expired` date NOT NULL,
  `status` varchar(50) NOT NULL,
  `wa_status` varchar(15) NOT NULL,
  `scanned` varchar(15) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `tanggal_simpan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `device_id` int(11) DEFAULT NULL,
  `pic_id` int(11) DEFAULT NULL,
  `current_application_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tnumber`
--

INSERT INTO `tnumber` (`id`, `nomor_telp`, `tanggal_aktif`, `tanggal_expired`, `status`, `wa_status`, `scanned`, `deskripsi`, `tanggal_simpan`, `device_id`, `pic_id`, `current_application_id`) VALUES
(2, '0895155272238', '2023-12-01', '2023-12-31', 'HIDUP', 'AVAILABLE', 'SCANNED', 'Testing', '2023-12-19 01:50:40', 1, 4, 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `role`, `name`, `role_id`) VALUES
(1, 'admin', 'd41d8cd98f00b204e9800998ecf8427e', 'ADMIN', 'Admin', 1),
(2, 'user', 'ee11cbb19052e40b07aac0ca060c23ee', 'USER', 'User', 2),
(3, 'esa', '80ad0b9fa48a74fe86a9c8ee665d96bb', 'ADMIN', 'Mahesa Danuarta', 1),
(4, 'joko', '9ba0009aa81e794e628a04b51eaf7d7f', 'USER', 'Raihan Revi', 2);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `bot_token`
--
ALTER TABLE `bot_token`
  ADD PRIMARY KEY (`bot_id`);

--
-- Indeks untuk tabel `dropdown_items`
--
ALTER TABLE `dropdown_items`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indeks untuk tabel `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indeks untuk tabel `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indeks untuk tabel `tnumber`
--
ALTER TABLE `tnumber`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `pic_id` (`pic_id`),
  ADD KEY `current_application_id` (`current_application_id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `bot_token`
--
ALTER TABLE `bot_token`
  MODIFY `bot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `dropdown_items`
--
ALTER TABLE `dropdown_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `tnumber`
--
ALTER TABLE `tnumber`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `role_permission`
--
ALTER TABLE `role_permission`
  ADD CONSTRAINT `role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`permission_id`);

--
-- Ketidakleluasaan untuk tabel `tnumber`
--
ALTER TABLE `tnumber`
  ADD CONSTRAINT `tnumber_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `dropdown_items` (`id`),
  ADD CONSTRAINT `tnumber_ibfk_2` FOREIGN KEY (`pic_id`) REFERENCES `dropdown_items` (`id`),
  ADD CONSTRAINT `tnumber_ibfk_3` FOREIGN KEY (`current_application_id`) REFERENCES `dropdown_items` (`id`);

--
-- Ketidakleluasaan untuk tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
