-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 22 Jan 2025 pada 12.08
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
-- Database: `komik_store`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `komik`
--

CREATE TABLE `komik` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `genre` varchar(50) DEFAULT NULL,
  `harga` decimal(10,2) DEFAULT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `komik`
--

INSERT INTO `komik` (`id`, `judul`, `pengarang`, `genre`, `harga`, `stok`, `gambar`) VALUES
(1, 'Ticket Hero', 'RYU', 'Action', 45000.00, 20, 'uploads/gambar1.jpg'),
(3, '99+ Reinforced Wooden Stick', 'HONGSIL , JIPERY', 'Comedy', 60000.00, 10, 'uploads/gambar2.jpg'),
(4, 'GOOD/BAD FORTUNE', 'Ariel Duyung', 'Drama', 50000.00, 10, 'uploads/gambar3.jpg'),
(5, 'Iblis di Antara Kita', 'Nemo Nullus', 'Thriller', 70000.00, 15, 'uploads/gambar5.jpg'),
(6, 'WiraDelima', 'Qoni', 'Slice of Life', 30000.00, 40, 'uploads/gambar4.jpg'),
(7, 'Reality Quest', 'Joowoon Lee, Taesung', 'Action', 45000.00, 20, 'uploads/gambar6.jpg');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komik`
--
ALTER TABLE `komik`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komik`
--
ALTER TABLE `komik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
