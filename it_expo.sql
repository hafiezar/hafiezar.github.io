-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 12 Sep 2018 pada 02.51
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
-- Struktur dari tabel `moviex`
--

CREATE TABLE `moviex` (
  `userx_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Struktur dari tabel `posterx`
--

CREATE TABLE `posterx` (
  `userx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
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
  `sekolah` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `payment` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `webx`
--

CREATE TABLE `webx` (
  `userx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `moviex`
--
ALTER TABLE `moviex`
  ADD PRIMARY KEY (`userx_id`);

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
-- Indeks untuk tabel `posterx`
--
ALTER TABLE `posterx`
  ADD PRIMARY KEY (`userx_id`);

--
-- Indeks untuk tabel `userx`
--
ALTER TABLE `userx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indeks untuk tabel `webx`
--
ALTER TABLE `webx`
  ADD PRIMARY KEY (`userx_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

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
-- AUTO_INCREMENT untuk tabel `userx`
--
ALTER TABLE `userx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
