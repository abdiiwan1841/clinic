-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Sep 2020 pada 05.01
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
-- Struktur dari tabel `pasien`
--

CREATE TABLE `pasien` (
  `MR_Code` varchar(50) NOT NULL,
  `Patient_FName` varchar(100) NOT NULL,
  `Patient_LName` varchar(50) NOT NULL,
  `Patient_IC` varchar(50) NOT NULL,
  `Patient_DOB` varchar(50) NOT NULL,
  `Patient_Country` varchar(50) NOT NULL,
  `Patient_Prov` varchar(50) NOT NULL,
  `Patient_City` varchar(50) NOT NULL,
  `Patient_kec` varchar(50) NOT NULL,
  `Patient_Address` varchar(255) NOT NULL,
  `Patient_Phone` varchar(20) NOT NULL,
  `Patient_Mobile` varchar(20) NOT NULL,
  `Patient_Sex` varchar(20) NOT NULL,
  `Patient_Religion` varchar(128) NOT NULL,
  `Patient_desc` varchar(255) NOT NULL,
  `Patient_Email` varchar(255) NOT NULL,
  `Patient_Special` varchar(100) NOT NULL,
  `Patient_Type` varchar(500) DEFAULT NULL,
  `Patient_Complete` varchar(1) NOT NULL,
  `Patient_BPJSNo` varchar(100) NOT NULL,
  `Patient_Status` varchar(100) NOT NULL,
  `Patient_Job` varchar(100) NOT NULL,
  `Patient_Company` varchar(100) NOT NULL,
  `Patient_Education` varchar(100) NOT NULL,
  `date_created` varchar(100) NOT NULL,
  `date_modified` varchar(100) NOT NULL,
  `created_by` varchar(100) NOT NULL,
  `modified_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`MR_Code`, `Patient_FName`, `Patient_LName`, `Patient_IC`, `Patient_DOB`, `Patient_Country`, `Patient_Prov`, `Patient_City`, `Patient_kec`, `Patient_Address`, `Patient_Phone`, `Patient_Mobile`, `Patient_Sex`, `Patient_Religion`, `Patient_desc`, `Patient_Email`, `Patient_Special`, `Patient_Type`, `Patient_Complete`, `Patient_BPJSNo`, `Patient_Status`, `Patient_Job`, `Patient_Company`, `Patient_Education`, `date_created`, `date_modified`, `created_by`, `modified_by`) VALUES
('00000001', 'Al', 'Azmi', '1111321777461', '1996-07-11', 'Indonesia', 'Sumatera Utara', 'Medan', 'Medan Kota', 'JL. Jala IX No.17', '081774124643', '081774124643', 'Laki-laki', 'Islam', '-', 'amialazmi@gmail.com', '0', NULL, '', '1113623442', 'Belum Menikah', 'Belum/ Tidak Bekerja', 'BungsuDev', '', '2020-09-10 14:44:43', '2020-09-10 17:20:11', 'admin', 'admin'),
('00000002', '1', '1', '1', '0001-01-01', 'Indonesia', 'Sumatera Utara', 'Medan', 'Medan Kota', '111', '1', '1', 'Laki-laki', 'Islam', '1', '1', '1', 'Hepatitis B', '', '1', 'Belum Menikah', 'Pensiunan', '1', 'S1', '2020-09-10 17:07:38', '2020-09-10 17:07:38', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`MR_Code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
