-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2020 pada 04.57
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan_obat`
--

CREATE TABLE `satuan_obat` (
  `kode_satuan_obat` int(11) NOT NULL,
  `nama_satuan_obat` longtext NOT NULL,
  `status` enum('Aktif','Tidak Aktif') NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan_obat`
--

INSERT INTO `satuan_obat` (`kode_satuan_obat`, `nama_satuan_obat`, `status`, `created_date`) VALUES
(11, 'Kapsul', 'Aktif', '2020-09-10 09:27:21'),
(12, 'Box', 'Aktif', '2020-09-10 09:27:29'),
(13, 'Pack', 'Aktif', '2020-09-10 09:27:36'),
(14, 'Tablet', 'Aktif', '2020-09-10 09:27:42'),
(15, 'Tube', 'Aktif', '2020-09-10 09:27:48'),
(16, 'Strip', 'Aktif', '2020-09-10 09:27:55'),
(17, 'Botol', 'Aktif', '2020-09-10 09:28:01'),
(18, 'Pcs', 'Aktif', '2020-09-10 09:28:09');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `satuan_obat`
--
ALTER TABLE `satuan_obat`
  ADD PRIMARY KEY (`kode_satuan_obat`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `satuan_obat`
--
ALTER TABLE `satuan_obat`
  MODIFY `kode_satuan_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
