-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Agu 2023 pada 17.07
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

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
-- Struktur dari tabel `diagnosa`
--

CREATE TABLE `diagnosa` (
  `iddiagnosa` int(11) NOT NULL,
  `kode_diagnosa` varchar(25) NOT NULL,
  `nama_diagnosa` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `diagnosa`
--

INSERT INTO `diagnosa` (`iddiagnosa`, `kode_diagnosa`, `nama_diagnosa`, `deskripsi`) VALUES
(1, 'A', 'Asma', 'Asma........'),
(2, 'B', 'Bronkitis', 'Bronkitis merupakan........'),
(3, 'T', 'Tuberkulosis', 'Tuberkulosis ..........'),
(4, 'P', 'Pneumonia', 'Pneumonia......'),
(5, 'IN', 'Influenza', 'Influenza........'),
(6, 'I', 'ISPA', 'ISPA..........');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gejala`
--

CREATE TABLE `gejala` (
  `idgejala` int(11) NOT NULL,
  `iddiagnosa` int(11) NOT NULL,
  `kode_gejala` varchar(20) NOT NULL,
  `nama_gejala` varchar(100) NOT NULL,
  `bobot` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `gejala`
--

INSERT INTO `gejala` (`idgejala`, `iddiagnosa`, `kode_gejala`, `nama_gejala`, `bobot`) VALUES
(1, 2, 'B1', 'Batuk berdahak/kering', 1),
(3, 2, 'B2', 'Sakit tenggorokan', 0.5),
(4, 1, 'A1', 'Batuk', 1),
(5, 1, 'A2', 'Sesak napas', 1),
(6, 1, 'A3', 'Mengi', 1),
(7, 2, 'B3', 'Nyeri dada', 0.5),
(8, 3, 'T1', 'Demam', 1),
(9, 3, 'T2', 'Nyeri dada', 0.5),
(10, 3, 'T3', 'Batuk darah/lender', 0.2),
(11, 3, 'T4', 'Kelelahan', 1),
(12, 3, 'T5', 'Panas dingin', 1),
(13, 3, 'T6', 'Batuk selama 2 minggu lebih', 1),
(14, 3, 'T7', 'Nafsu makan menurun', 1),
(15, 3, 'T8', 'Berkeringan di malam hari', 1),
(16, 3, 'T9', 'Penurunan berat badan', 1),
(17, 4, 'P1', 'Sesak napas', 0.5),
(18, 4, 'P2', 'Batuk berdahak/kering', 0.8),
(19, 4, 'P3', 'Demam', 1),
(20, 4, 'P4', 'Menggigil', 0.5),
(21, 4, 'P5', 'Nyeri dada', 0.5),
(22, 5, 'IN1', 'Demam', 0.7),
(23, 5, 'IN2', 'Lemas', 1),
(24, 5, 'IN3', 'Hidung meler/tersumbat', 1),
(25, 6, 'I1', 'Batuk', 1),
(26, 6, 'I2', 'Demam', 0.8),
(27, 6, 'I3', 'Bernapas cepat', 0.4),
(28, 6, 'I4', 'Warna kebiruan akibat kurang oksigen', 0.2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil_diagnosa`
--

CREATE TABLE `hasil_diagnosa` (
  `idhasil` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cf_asma` double NOT NULL,
  `bayes_asma` double NOT NULL,
  `cf_bronkitis` double NOT NULL,
  `bayes_bronkitis` double NOT NULL,
  `cf_tuberkulosis` double NOT NULL,
  `bayes_tuberkulosis` double NOT NULL,
  `fc_pneumonia` double NOT NULL,
  `bayes_pneumonia` double NOT NULL,
  `cf_influenza` double NOT NULL,
  `bayes_influenza` double NOT NULL,
  `cf_ispa` double NOT NULL,
  `bayes_ispa` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hasil_diagnosa`
--

INSERT INTO `hasil_diagnosa` (`idhasil`, `iduser`, `tanggal`, `cf_asma`, `bayes_asma`, `cf_bronkitis`, `bayes_bronkitis`, `cf_tuberkulosis`, `bayes_tuberkulosis`, `fc_pneumonia`, `bayes_pneumonia`, `cf_influenza`, `bayes_influenza`, `cf_ispa`, `bayes_ispa`) VALUES
(1, 18, '2023-08-15 15:03:10', 0, 0, 20, 50, 100, 95.71, 84.4, 78, 100, 92.22, 66, 66),
(2, 18, '2023-08-15 15:07:23', 70, 100, 61.6, 75, 99.8, 94.62, 86.94, 81.41, 90.82, 90.75, 73.6, 63.33);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jawaban`
--

CREATE TABLE `jawaban` (
  `idjawaban` int(11) NOT NULL,
  `bobot` double NOT NULL,
  `kode_jawaban` varchar(20) NOT NULL,
  `jawaban` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jawaban`
--

INSERT INTO `jawaban` (`idjawaban`, `bobot`, `kode_jawaban`, `jawaban`) VALUES
(1, 1, 'SS', 'Sangat Sering'),
(2, 0.7, 'S', 'Sering'),
(3, 0.4, 'J', 'Jarang'),
(5, 0, 'TP', 'Tidak Pernah');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `idpertanyaan` int(11) NOT NULL,
  `idgejala` int(11) NOT NULL,
  `kode_pertanyaan` varchar(11) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `solusi`
--

CREATE TABLE `solusi` (
  `idsolusi` int(11) NOT NULL,
  `iddiagnosa` int(11) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `solusi`
--

INSERT INTO `solusi` (`idsolusi`, `iddiagnosa`, `solusi`) VALUES
(2, 5, 'Solusi atau pengobatannya dengan diberikan obat flu atau pelega hidung, obat demam dan multivitamin'),
(3, 4, 'Solusi atau pengobatannya adalah diberikan antibiotic, obat sesak nafas, obat batuk, obat demam dan obat anti nyeri'),
(4, 3, 'Solusi atau pengobatannya adalah obat demam, obat anti nyeri, obat batuk, multivitamin, dan penambah nafsu makan'),
(5, 2, 'Solusi atau pengobatannya dengan meminum obat batuk atau obat Pereda nyeri '),
(6, 1, 'Solusi atau pengobatannya dengan obat pelega (reliever) dan pengontrol (controller)'),
(7, 6, 'Solusi atau pengobatannya diberikan obat batuk, obat demam, dan oksigen');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jk` char(2) NOT NULL,
  `email` varchar(40) NOT NULL,
  `level` varchar(10) NOT NULL,
  `foto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`iduser`, `username`, `password`, `nama`, `jk`, `email`, `level`, `foto`) VALUES
(1, 'kamu', '$2y$10$19sMF4MAYY67XbYhrzPcaeHic7y/tFJ/U49ZMo8zOTQaiFCqD7Bju', 'aku', 'L', 'aku123@gmail.com', 'admin', 'admin.png'),
(3, 'nura', '1234', 'Nuraenii', 'P', 'nuraaa@gmail.com', 'admin', 'admin.png'),
(8, 'umc', '$2y$10$YfKRn8nRZ9R7nIIUeiQZj.SSb.m2OvCl1Ou2dJpEFl5', 'enur', 'L', 'sagacsa@gmail.com', 'admin', 'admin.png'),
(9, 'nurr', '$2y$10$HPnuY30VYVTe9ET37fQOmeXj3nbdw31BvW7yeWpKiCQ', 'Nur Aeni', 'P', 'nurraeni@gmail.com', 'user', 'admin.png'),
(10, 'aenur', '$2y$10$ad/pV4MsO9WxBp8Fl9Zjrezq0f2tmTbO1Qe9N6fpG/oYhWf.bKF1m', 'NUR AENI 01', 'P', 'nurraeni@gmail.com', 'user', 'admin.png'),
(11, 'nuraeni', '$2y$10$yWoq9eZTdAJiMftUybojWudbRY9YUEVByf9F.VRBdOu8Q.DVQt3i6', 'Aeni Nur ', 'P', 'nuraeni@gmail.com', 'user', 'admin.png'),
(18, 'eka', '$2y$10$MLui6ZeLOLU8nV18050h3.TuDhYtd3Yg0KRB/LMYDgcQuhSnP0gEe', 'Eka Nurseva S', 'P', 'ekanursevas@gmail.com', 'user', 'admin.png'),
(19, 'ens', '$2y$10$DRjjIIQHbTyZ9lPeIJO7QeQD7V82qxK.1YXbMkddEPAnsbB/0q28K', 'Eka Nurseva Ens', 'P', 'ekanursevas@gmail.com', 'admin', 'admin.png'),
(22, 'fillah21', '$2y$10$PqedqaY/q7U8QmhkZTeV.Ov9AV7nn5sA..65RIL7/rXgPcNaagLP.', 'Fillah Zaki Alhaqi', 'L', 'fillah.alhaqi11@gmail.com', 'admin', 'admin.png');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `diagnosa`
--
ALTER TABLE `diagnosa`
  ADD PRIMARY KEY (`iddiagnosa`);

--
-- Indeks untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`idgejala`),
  ADD KEY `iddiagnosa` (`iddiagnosa`);

--
-- Indeks untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD PRIMARY KEY (`idhasil`),
  ADD KEY `iduser` (`iduser`);

--
-- Indeks untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`idjawaban`);

--
-- Indeks untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`idpertanyaan`),
  ADD KEY `idgejala` (`idgejala`);

--
-- Indeks untuk tabel `solusi`
--
ALTER TABLE `solusi`
  ADD PRIMARY KEY (`idsolusi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `diagnosa`
--
ALTER TABLE `diagnosa`
  MODIFY `iddiagnosa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `gejala`
--
ALTER TABLE `gejala`
  MODIFY `idgejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  MODIFY `idhasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `idjawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `idpertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `solusi`
--
ALTER TABLE `solusi`
  MODIFY `idsolusi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gejala`
--
ALTER TABLE `gejala`
  ADD CONSTRAINT `gejala_ibfk_1` FOREIGN KEY (`iddiagnosa`) REFERENCES `diagnosa` (`iddiagnosa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `hasil_diagnosa`
--
ALTER TABLE `hasil_diagnosa`
  ADD CONSTRAINT `hasil_diagnosa_ibfk_1` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
