-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Feb 2025 pada 10.51
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
(1, 'Ticket Hero', 'RYU', 'Action', 55000.00, 13, 'uploads/gambar1.jpg'),
(3, '99+ Reinforced Wooden Stick', 'HONGSIL , JIPERY', 'Comedy', 60000.00, 0, 'uploads/gambar2.jpg'),
(4, 'GOOD/BAD FORTUNE', 'Ariel Duyung', 'Drama', 50000.00, 0, 'uploads/gambar3.jpg'),
(5, 'Iblis di Antara Kita', 'Nemo Nullus', 'Thriller', 70000.00, 12, 'uploads/gambar5.jpg'),
(6, 'WiraDelima', 'Qoni', 'Slice of Life', 30000.00, 38, 'uploads/gambar4.jpg'),
(7, 'Reality Quest', 'Joowoon Lee, Taesung', 'Action', 65000.00, 16, 'uploads/gambar6.jpg'),
(8, 'Study Group', 'Hyungwuk Shin, Seungyeon Ryu', 'Action', 55000.00, 20, 'uploads/gambar7.jpg'),
(9, 'The Real Lesson', 'CHAE YONGTAEK, HAN GARAM', 'Action', 60000.00, 22, 'uploads/gambar8.jpg'),
(10, 'Player', 'JSP, SSAMBA', 'Fantasy', 45000.00, 30, 'uploads/gambar9.jpg'),
(11, 'LOOKISM', 'Taejoon Park', 'Action', 60000.00, 18, 'uploads/gambar10.jpg'),
(12, 'Si Juki: LIKA LIKU ANAK KOS', 'Faza Meonk', 'Comedy', 30000.00, 30, 'gambar11.jpg'),
(13, 'Kisah Usil Si Juki Kecil', 'Faza Meonk', 'Comedy', 30000.00, 29, 'gambar12.jpg'),
(14, 'Nostalgia Ramadhan Si Juki Kecil', 'Faza Meonk', 'Comedy', 30000.00, 28, 'gambar13.jpg'),
(15, 'GLOOMY SUNDAY', 'fankycon', 'Horror', 45000.00, 23, 'gambar14.jpg'),
(16, 'Their Story', 'Egimugia', 'Slice of Life', 25000.00, 20, 'gambar15.jpg'),
(17, 'The Second Marriage', 'Alphatart, HereLee', 'Action', 40000.00, 15, 'gambar16.jpg'),
(18, 'Pasutri Gaje', 'Annisa Nisfihani', 'Lokal', 35000.00, 25, 'gambar17.jpg'),
(19, 'Tahilalats', 'Tahilalats Team', 'Comedy', 40000.00, 29, 'gambar18.jpg'),
(20, 'Aku dan Para Mantan', 'HADA, smilingsun', 'Webnovel', 25000.00, 20, 'gambar19.jpg'),
(21, 'Shotgun Boy', 'Kimcarnby, Redbrush ', 'Thriller', 25000.00, 25, 'gambar20.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembeli`
--

CREATE TABLE `pembeli` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pembeli`
--

INSERT INTO `pembeli` (`id`, `nama`, `email`, `alamat`) VALUES
(3, 'Fauzi', 'gaissuai@gmail.com', 'Argomulyo'),
(4, 'Agung', 'setyonugroho2007@gmail.com', 'Bawen'),
(5, 'Kefas', 'martenusspp@gmail.com', 'Salatiga'),
(6, 'Luky', 'lukyrevan@gmail.com', 'Getasan'),
(7, 'revan', 'revan123@gmail.com', 'Getasan'),
(8, 'windah', 'windahbersaudara@gmail.com', 'Jakarta'),
(9, 'Alfachri', 'alfachri1010@gmail.com', 'Solo'),
(10, 'Ilham', 'ilham001@gmail.com', 'Surabaya'),
(12, 'Azka', 'azkarasyadan@gmail.com', 'Bawen'),
(13, 'Wawan', 'wawan12@gmail.com', 'Boyolali\r\n'),
(14, 'Amel', 'ameliafirda@gmail.com', 'Salatiga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjual`
--

CREATE TABLE `penjual` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(15) NOT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penjual`
--

INSERT INTO `penjual` (`id`, `nama`, `no_telepon`, `alamat`) VALUES
(1, 'Roziq', '085326878281', 'Tuntang'),
(3, 'Hakim', '08127472462', 'Tingkir'),
(4, 'Alpin', '0835474547', 'Tengaran'),
(5, 'Adit', '0812343422', 'Semarang'),
(6, 'Rafael', '0846327722', 'Salatiga\r\n');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_komik` int(11) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `id_penjual` int(11) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_komik`, `id_pembeli`, `id_penjual`, `tanggal`, `jumlah`, `total_harga`) VALUES
(3, 1, 3, 1, '2025-02-20 08:09:01', 1, 55000),
(4, 14, 5, 1, '2025-02-20 08:09:30', 2, 60000),
(5, 11, 6, 5, '2025-02-20 08:09:50', 2, 120000),
(6, 9, 10, 6, '2025-02-20 08:10:08', 1, 60000),
(7, 19, 13, 1, '2025-02-20 08:11:36', 1, 40000),
(8, 15, 8, 1, '2025-02-20 08:15:13', 1, 45000),
(9, 7, 6, 1, '2025-02-20 08:45:05', 1, 65000),
(10, 8, 8, 5, '2025-02-20 13:00:50', 2, 110000),
(11, 9, 7, 5, '2025-02-20 13:01:39', 1, 60000),
(12, 3, 3, 1, '2025-02-20 13:04:31', 7, 420000),
(13, 1, 3, 1, '2025-02-20 13:05:28', 1, 55000),
(14, 4, 3, 1, '2025-02-20 00:00:00', 1, 50000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'hakim', 'hakim10106@gmail.com', '$2y$10$xRdHheAfZlk/3cwe7vFCZuIPig3TzrM6CiaeOxqzuzecUKiaN0VJ6', 'user', '2025-01-08 13:23:17'),
(3, 'verixch', 'gaissuai@gmail.com', '$2y$10$97A6bsKkn.52vaK/grQGhONmA.HgncINmln07YQGrVP2bK2k9kSM6', 'admin', '2025-01-08 13:25:22'),
(4, 'alpinas', 'alpinasfaj@gmail.com', '$2y$10$BMscMb8ZlqZkryuxy/wjBee3/FMp4Sba6sjYNvqiollaMot2mjyuW', 'user', '2025-01-09 00:47:35'),
(5, 'Kefas', 'martenusspp@gmail.com', '$2y$10$pA//eMweYYInwx2xOjHZP.UtXew9XhpHg0xXdJ0GU6st6XeIAnsra', 'user', '2025-01-09 07:00:08'),
(6, 'Roziq', 'maftukhindar@gmail.com', '$2y$10$zvAbdIdwwTqlkcxgcwv6dONDjDBUNK7WN.30CJ.6v9Zy9AIATyU.O', 'user', '2025-01-09 07:44:40'),
(7, 'Luky', 'lukyrevan@gmail.com', '$2y$10$FpZ.8E0gA/5lMOepmc3lOOLlpTNMo7kWOUojU99FyQ4zCzghJ6N3W', 'user', '2025-01-09 07:45:54'),
(9, 'admin', 'verixkomik@gmail.com', '$2y$10$q8Nrtwkh4r1c.rcItCB.seQrvsSSjXceWwlUodns3SOOiA.fv65yW', 'admin', '2025-01-11 11:37:11'),
(14, 'Karyawan', 'karyawanverix@gmail.com', '$2y$10$I1rI/.ILbtBPH05oyLt6zeK/WNGouQrN3ZmuewMjQ3q6dogqkdy16', 'karyawan', '2025-01-16 01:20:34'),
(15, 'agung', 'agung@gmail.com', '$2y$10$oIEmBY96Pgz8svTPDb1iY.RMtus8lNClLee0bzQJNXSP8UyJdGYYC', 'user', '2025-01-16 01:30:12'),
(16, 'azka', 'azkarasyadan@gmail.com', '$2y$10$w9jabA2VUvatSD9xoYBu8.wqPUGxkbEnBP98yqbAxkKDwkXj3F0k6', 'user', '2025-02-18 03:46:31'),
(17, 'wawan', 'wawan12@gmail.com', '$2y$10$xxEDEmxRjLQAhgpCzuMicOo1FBYbCKdC8h4ouCjgpPvgeqK0LVw3i', 'user', '2025-02-19 01:34:09'),
(18, 'Nopal', 'nopalcl@gmail.com', 'nopal123', 'user', '2025-02-19 06:49:00'),
(19, 'Brian', 'brianazmi@gmail.com', 'brian123', 'user', '2025-02-19 06:49:37'),
(20, 'Karyawan 1', 'karyawan1@gmail.com', 'karyawan123', 'karyawan', '2025-02-20 06:00:05'),
(21, 'Bambang', 'bambang123@gmail.com', '$2y$10$RZczzYqFIKLTgQRxOuQMKeHiqxFuMKx5dbe50.5QocCuqoVyvjGuq', 'user', '2025-02-20 06:02:21');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `komik`
--
ALTER TABLE `komik`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_telepon` (`no_telepon`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_komik` (`id_komik`),
  ADD KEY `id_pembeli` (`id_pembeli`),
  ADD KEY `id_penjual` (`id_penjual`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `komik`
--
ALTER TABLE `komik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pembeli`
--
ALTER TABLE `pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `penjual`
--
ALTER TABLE `penjual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_komik`) REFERENCES `komik` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_pembeli`) REFERENCES `pembeli` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_penjual`) REFERENCES `penjual` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
