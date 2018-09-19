-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 19 Sep 2018 pada 23.17
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
-- Database: `itexpo_2018`
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
  `umum_ots` int(11) NOT NULL,
  `phase_1` datetime NOT NULL,
  `phase_2` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventx`
--

INSERT INTO `eventx` (`id`, `name`, `mahasiswa_po`, `mahasiswa_ots`, `umum_po`, `umum_ots`, `phase_1`, `phase_2`) VALUES
(1, 'Networking', 30000, 80000, 30000, 80000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Desain Web', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Poster', 50000, 0, 50000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Short Movie', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'E-Sport', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Seminar', 40000, 45000, 45000, 50000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Workshop UI/UX', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Workshop Guru TIK', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventx_detail`
--

CREATE TABLE `eventx_detail` (
  `id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventx_detail`
--

INSERT INTO `eventx_detail` (`id`, `eventx_id`, `title`, `description`) VALUES
(1, 2, 'Technical Meeting', '27 Oktober 2018'),
(2, 2, 'Kompetisi (Online)', '28 - 31 Oktober 2018'),
(3, 2, 'Presentasi', '29 November 2018'),
(4, 1, 'Kisi-Kisi Penyisihan', '5 November 2018'),
(5, 1, 'Babak Penyisihan (Online)', '10 November 2018'),
(6, 1, 'Pengumuman Babak Penyisihan', '14 November 2018'),
(7, 1, 'Technical Meeting', '27 November 2018'),
(8, 1, 'Babak Final (Onsite)', '28 November 2018'),
(9, 3, 'Pengumpulan Karya', '15 November 2018'),
(10, 3, 'Pengumuman', '29 November 2018'),
(11, 4, 'Pengumpulan Film Gelombang I', '1 - 8 November 2018'),
(12, 4, 'Pengumpulan Film Gelombang II', '9 - 15 November 2018'),
(13, 4, 'Pengumuman', '22 November 2018'),
(14, 4, 'Presentasi', '29 November 2018'),
(15, 7, 'Pendaftaran', '23 September - 13 Oktober 2018'),
(16, 7, 'Workshop', '20 - 21 Oktober 2018'),
(17, 6, 'Pendaftaran', '29 Oktober - 22 November 2018'),
(18, 6, 'Seminar Dan Expo', '29 November 2018'),
(19, 5, 'Penyisihan', '19 - 26 November 2018'),
(20, 5, 'Perempat Final', '27 November 2018'),
(21, 5, 'Semi Final', '28 November 2018'),
(22, 5, 'Final', '29 November 2018');

-- --------------------------------------------------------

--
-- Struktur dari tabel `networkx`
--

CREATE TABLE `networkx` (
  `userx_eventx_id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `answer` text NOT NULL,
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
  `options` varchar(255) NOT NULL,
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
  `userx_eventx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `teams`
--

CREATE TABLE `teams` (
  `id` int(11) NOT NULL,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `team_member` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `teams`
--

INSERT INTO `teams` (`id`, `userx_id`, `eventx_id`, `team_member`) VALUES
(1, 1, 4, '1'),
(2, 1, 4, '2'),
(3, 1, 4, '3'),
(4, 1, 4, '4'),
(5, 1, 4, '5'),
(6, 1, 4, '6'),
(7, 1, 4, '7'),
(8, 1, 4, '8'),
(9, 1, 4, '9'),
(10, 1, 5, 'tak'),
(11, 1, 5, 'bisa'),
(12, 1, 5, 'diantara'),
(13, 1, 5, 'gg'),
(14, 1, 5, 'wp'),
(15, 1, 5, 'team');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx`
--

CREATE TABLE `userx` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `is_mahasiswa` int(11) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `kontak` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_verified` int(11) NOT NULL,
  `file_ktm` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_verifikasi` varchar(255) NOT NULL,
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
  `registration_code` varchar(5) NOT NULL,
  `is_team` int(11) NOT NULL,
  `team_name` varchar(255) NOT NULL,
  `ign` varchar(255) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `payment_status` enum('not_paid','wait_verified','paid') NOT NULL,
  `created_at` datetime NOT NULL,
  `paid_at` datetime NOT NULL
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
-- Indeks untuk tabel `eventx_detail`
--
ALTER TABLE `eventx_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `networkx`
--
ALTER TABLE `networkx`
  ADD PRIMARY KEY (`userx_eventx_id`,`questionx_id`) USING BTREE;

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
  ADD PRIMARY KEY (`userx_eventx_id`);

--
-- Indeks untuk tabel `teams`
--
ALTER TABLE `teams`
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_code` (`registration_code`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `eventx`
--
ALTER TABLE `eventx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `eventx_detail`
--
ALTER TABLE `eventx_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `userx_eventx_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
