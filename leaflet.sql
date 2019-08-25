-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Agu 2019 pada 08.09
-- Versi server: 10.3.16-MariaDB
-- Versi PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leaflet`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ponpes`
--

CREATE TABLE `ponpes` (
  `Id` int(11) NOT NULL,
  `nspp` varchar(200) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `kec` varchar(255) DEFAULT NULL,
  `kabkota` varchar(255) DEFAULT NULL,
  `prov` varchar(255) DEFAULT NULL,
  `lat` float(9,7) DEFAULT NULL,
  `lng` float(9,6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ponpes`
--

INSERT INTO `ponpes` (`Id`, `nspp`, `tipe`, `nama`, `telp`, `alamat`, `kec`, `kabkota`, `prov`, `lat`, `lng`) VALUES
(3, '512033740003', 'salafiyah', 'PP Al Burhan Hidayatullah', '(024) 76484920', 'Jl. Raya Gedawang, Gedawang, Kec. Banyumanik, Kota Semarang, Jawa Tengah 50266', 'Banyumanik', 'Kota Semarang', 'Jawa Tengah', -7.0927119, 110.425911),
(4, '512033740074', 'kombinasi', 'PP Addainuriyah Dua (Pi)', '(024) 6713076', 'Jl. Sendang Utara No.38, Gemah, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50246', 'Pedurungan', 'Kota Semarang', 'Jawa Tengah', -7.0084810, 110.459435),
(5, '512033740078', 'salafiyah', 'PP Al Ibriz', '0896-1591-0988', 'Jl. Majapahit No.248, Gemah, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50246', 'Pedurungan', 'Kota Semarang', 'Jawa Tengah', -7.0057321, 110.454796),
(6, '512033740077', 'salafiyah', 'PP Al Hikmah', '(024) 6716657', 'Jl. Pesantren No.3, Pedurungan Lor, Kec. Pedurungan, Kota Semarang, Jawa Tengah 50192', 'Pedurungan', 'Kota Semarang', 'Jawa Tengah', -7.0148149, 110.484253),
(7, '512033740033', 'kombinasi', 'PP Riyadhul Ichlas', '(024) 70728401', 'Jl. Gebang Anom Raya No.10, Gebangsari, Kec. Genuk, Kota Semarang, Jawa Tengah 50117', 'Genuk', 'Kota Semarang', 'Jawa Tengah', -6.9634142, 110.469963),
(8, '512033740006', 'salafiyah', 'PP Az Zumroh', '0813-2506-0444', 'JL. Majapahit, RT. 04 RW. 01, Sawah Besar I, Gayamsari, Gayamsari, Semarang, Kota Semarang, Jawa Tengah 50248', 'Gayamsari', 'Kota Semarang', 'Jawa Tengah', -7.0016570, 110.449631),
(9, '512033740150', 'kombinasi', 'PP Al Hadir', '(024) 8664982', 'Mangkang Wetan, Tugu, Semarang City, Central Java 50156', 'Tugu', 'Kota Semarang', 'Jawa Tengah', -6.9668961, 110.309067),
(14, '522165200', 'kombinasi', 'PP Al itqon', '025022', 'Gondoriyo', 'gondoriyo', 'semarang', 'jawa tengah', -7.0199413, 110.349991);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `Id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  `ket` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`Id`, `username`, `password`, `level`, `ket`) VALUES
(1, 'admin', 'admin', 1, 'admin'),
(2, 'user', 'user', 2, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ponpes`
--
ALTER TABLE `ponpes`
  ADD PRIMARY KEY (`Id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `ponpes`
--
ALTER TABLE `ponpes`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
