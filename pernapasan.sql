-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pernapasan`
--

-- --------------------------------------------------------

--
-- Table structure for table `diagnosa`
--

CREATE TABLE `diagnosa` (
  `iddiagnosa` int(15) NOT NULL,
  `kode_diagnosa` varchar(25) NOT NULL,
  `nama_diagnosa` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnosa`
--

INSERT INTO `diagnosa` (`iddiagnosa`, `kode_diagnosa`, `nama_diagnosa`, `deskripsi`) VALUES
(3, 'P1', 'Ambeyen', 'aduh sakit pantat'),
(4, 'P2', 'Sesak Napas', 'sesak karena ditinggal kamuuu eaaa'),
(5, 'P3', 'Kurang Oksigen', 'Kurang oksigen dapat menyababkan rindu');

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `iddiagnosa` int(11) NOT NULL,
  `kode_gejala` varchar(20) NOT NULL,
  `nama_gejala` varchar(50) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`idgejala`, `iddiagnosa`, `kode_gejala`, `nama_gejala`, `bobot`) VALUES
(2, 3, 'G1', 'Susah Duduk', 0.5),
(3, 5, 'G2', 'Gk bisa napas tanpamuu ', 1),
(4, 4, 'G3', 'Gk tau deh, males mikir', 0.5);

-- --------------------------------------------------------

--
-- Table structure for table `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `idhasil` int(10) NOT NULL,
  `iduser` int(10) NOT NULL,
  `bobot_bayes` double NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usia` int(35) NOT NULL,
  `hsl_bayes` varchar(45) NOT NULL,
  `bobot_cf` double NOT NULL,
  `hsl_cf` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `bobot` double NOT NULL,
  `kode_jawaban` varchar(20) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `bobot`, `kode_jawaban`, `jawaban`) VALUES
(1, 1, 'SS', 'Sangat Sering'),
(2, 0.8, 'S', 'Sering'),
(3, 0.6, 'J', 'Jarang'),
(4, 0.4, 'SJ', 'Sangat Jarang'),
(5, 0, 'TP', 'Tidak Pernah'),
(6, 0.1, 'SB', 'Sangat Bosan');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `idpertanyaan` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL,
  `kode_pertanyaan` varchar(11) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`idpertanyaan`, `idgejala`, `kode_pertanyaan`, `pertanyaan`) VALUES
(4, 3, 'pt2', 'Seberapa sering anda tidak bisa bernapas tanpa saya?'),
(5, 2, 'pt1', 'Seberapa pantas kau untuk ku tunggu? Nanananananana nanana hoo oo'),
(7, 2, 'pt4', 'Apakah anda ingin mencoba duduk namun takut meletus balon hijau?');

-- --------------------------------------------------------

--
-- Table structure for table `solusi`
--

CREATE TABLE `solusi` (
  `idsolusi` int(11) NOT NULL,
  `iddiagnosa` int(11) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` char(2) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `jk`, `email`, `level`) VALUES
(1, 'kamu', '$2y$10$19sMF4MAYY67XbYhrzPcaeHic7y/tFJ/U49ZMo8zOTQaiFCqD7Bju', 'aku', 'L', 'aku123@gmail.com', 'admin'),
(3, 'nura', '1234', 'Nuraenii', 'P', 'nuraaa@gmail.com', 'admin'),
(8, 'umc', '$2y$10$YfKRn8nRZ9R7nIIUeiQZj.SSb.m2OvCl1Ou2dJpEFl5', 'enur', 'L', 'sagacsa@gmail.com', 'admin'),
(9, 'nurr', '$2y$10$HPnuY30VYVTe9ET37fQOmeXj3nbdw31BvW7yeWpKiCQ', 'Nur Aeni', 'P', 'nurraeni@gmail.com', 'user'),
(10, 'aenur', '$2y$10$ad/pV4MsO9WxBp8Fl9Zjrezq0f2tmTbO1Qe9N6fpG/oYhWf.bKF1m', 'NUR AENI 01', 'P', 'nurraeni@gmail.com', 'user'),
(11, 'nuraeni', '$2y$10$yWoq9eZTdAJiMftUybojWudbRY9YUEVByf9F.VRBdOu8Q.DVQt3i6', 'Aeni Nur ', 'P', 'nuraeni@gmail.com', 'user'),
(18, 'eka', '$2y$10$MLui6ZeLOLU8nV18050h3.TuDhYtd3Yg0KRB/LMYDgcQuhSnP0gEe', 'Eka Nurseva S', 'P', 'ekanursevas@gmail.com', 'user'),
(19, 'ens', '$2y$10$DRjjIIQHbTyZ9lPeIJO7QeQD7V82qxK.1YXbMkddEPAnsbB/0q28K', 'Eka Nurseva Ens', 'P', 'ekanursevas@gmail.com', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`iddiagnosa`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`),
  ADD KEY `iddiagnosa` (`iddiagnosa`);

--
-- Indexes for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD PRIMARY KEY (`idhasil`),
  ADD UNIQUE KEY `iduser` (`iduser`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`idpertanyaan`),
  ADD KEY `idgejala` (`idgejala`);

--
-- Indexes for table `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`idsolusi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `iddiagnosa` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `idhasil` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `idpertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `solusi`
--
ALTER TABLE `solusi`
  MODIFY `idsolusi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD CONSTRAINT `hasil_diagnosa_ibfk_1` FOREIGN KEY (`idhasil`) REFERENCES `user` (`iduser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
