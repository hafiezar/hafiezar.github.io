-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 17 Sep 2018 pada 08.11
-- Versi server: 10.1.32-MariaDB
-- Versi PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `it_expo`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventx`
--

CREATE TABLE `eventx` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mahasiswa_po` int(11) NOT NULL,
  `mahasiswa_ots` int(11) NOT NULL,
  `umum_po` int(11) NOT NULL,
  `umum_ots` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventx`
--

INSERT INTO `eventx` (`id`, `name`, `mahasiswa_po`, `mahasiswa_ots`, `umum_po`, `umum_ots`) VALUES
(1, 'Networking', 30000, 80000, 30000, 80000),
(2, 'Web Design', 100000, 0, 100000, 0),
(3, 'Poster', 50000, 0, 50000, 0),
(4, 'Short Movie', 100000, 0, 100000, 0),
(5, 'E-Sport', 200000, 0, 200000, 0),
(6, 'Seminar', 40000, 45000, 45000, 50000),
(7, 'Workshop UI/UX', 200000, 0, 200000, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `networkx`
--

CREATE TABLE `networkx` (
  `userx_id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `network_optionx`
--

CREATE TABLE `network_optionx` (
  `id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `is_true` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `network_questionx`
--

CREATE TABLE `network_questionx` (
  `id` int(11) NOT NULL,
  `type` enum('options','essay','file') NOT NULL,
  `question` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL,
  `download_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `submitx`
--

CREATE TABLE `submitx` (
  `id` int(11) NOT NULL,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx`
--

CREATE TABLE `userx` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `is_mahasiswa` int(11) NOT NULL,
  `file_ktm` varchar(255) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `verified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx_eventx`
--

CREATE TABLE `userx_eventx` (
  `id` int(11) NOT NULL,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `is_team` int(11) NOT NULL,
  `leader` varchar(255) NOT NULL,
  `ign` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `eventx`
--
ALTER TABLE `eventx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `networkx`
--
ALTER TABLE `networkx`
  ADD PRIMARY KEY (`userx_id`,`questionx_id`) USING BTREE;

--
-- Indeks untuk tabel `network_optionx`
--
ALTER TABLE `network_optionx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `network_questionx`
--
ALTER TABLE `network_questionx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `submitx`
--
ALTER TABLE `submitx`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `userx`
--
ALTER TABLE `userx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indeks untuk tabel `userx_eventx`
--
ALTER TABLE `userx_eventx`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `eventx`
--
ALTER TABLE `eventx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `network_optionx`
--
ALTER TABLE `network_optionx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `network_questionx`
--
ALTER TABLE `network_questionx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `submitx`
--
ALTER TABLE `submitx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `userx`
--
ALTER TABLE `userx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `userx_eventx`
--
ALTER TABLE `userx_eventx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
