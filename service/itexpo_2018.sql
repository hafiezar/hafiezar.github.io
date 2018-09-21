-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 21 Sep 2018 pada 16.03
-- Versi Server: 5.5.47-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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

CREATE TABLE IF NOT EXISTS `eventx` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mahasiswa_po` int(11) NOT NULL,
  `mahasiswa_ots` int(11) NOT NULL,
  `umum_po` int(11) NOT NULL,
  `umum_ots` int(11) NOT NULL,
  `phase_1` datetime NOT NULL,
  `phase_2` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `eventx`
--

INSERT INTO `eventx` (`id`, `name`, `mahasiswa_po`, `mahasiswa_ots`, `umum_po`, `umum_ots`, `phase_1`, `phase_2`) VALUES
(1, 'Networking', 30000, 80000, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Desain Web', 100000, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Poster', 50000, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Short Movie', 100000, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'E-Sport', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Seminar', 40000, 50000, 45000, 50000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Workshop UI/UX', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Workshop Guru TIK', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `eventx_detail`
--

CREATE TABLE IF NOT EXISTS `eventx_detail` (
  `id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `networkx` (
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

CREATE TABLE IF NOT EXISTS `network_optionx` (
  `id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `options` varchar(255) NOT NULL,
  `is_true` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `network_questionx`
--

CREATE TABLE IF NOT EXISTS `network_questionx` (
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

CREATE TABLE IF NOT EXISTS `submitx` (
  `userx_eventx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `team_member` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx`
--

CREATE TABLE IF NOT EXISTS `userx` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `status_akun` enum('pelajar','mahasiswa','umum') NOT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `userx`
--

INSERT INTO `userx` (`id`, `nama`, `tanggal_lahir`, `status_akun`, `instansi`, `kontak`, `email`, `password`, `is_verified`, `file_ktm`, `foto`, `token`, `token_verifikasi`, `created_at`, `verified_at`) VALUES
(1, 'Dandy Maulana', '1998-09-23', 'pelajar', 'Universitas Negeri Jakarta', '082139230782', 'dandymau223@gmail.com', '$2y$10$yn6.OpeuigptrbECyLZkr.aFMoPAf3DOLFg2J.QLaSFW2MmFd8TeS', 1, '', '', 'ZGFuZHltYXUyMjNAZ21haWwuY29taXQzeHBvMjAxOA==', '', '2018-09-20 06:04:58', '0000-00-00 00:00:00'),
(3, 'Muhammad Rayhan Haroki', '1995-01-04', 'pelajar', 'UNJ', '085691055777', 'rayhan.kin@gmail.com', '$2y$10$UAdj.G74.zJdiydqgo0HAOCe6zxdYV2IDIM2DfCA8REaiusuo86uO', 0, '', '', '', 'cmF5aGFuLmtpbkBnbWFpbC5jb21pdDN4cG8yMDE4VmVyaWZpa2FzaQ==', '2018-09-20 11:08:11', '0000-00-00 00:00:00'),
(15, 'Insan Rizky', '1995-11-02', 'pelajar', 'Universitas Indonesia', '087741114505', 'insansan9@gmail.com', '$2y$10$kkuqXnEC8XBbPbXaa.7Uwe4WjTbqNeg6szsCGbs7JucBJqkhUzRAm', 1, '', 'http://localhost/hafiezar.github.io/service/uploads/foto/4c0ffe327bd1eea9.png', 'aW5zYW5zYW45QGdtYWlsLmNvbWl0M3hwbzIwMTg=', '', '2018-09-21 12:24:51', '2018-09-21 12:28:25'),
(17, 'Swardiantara Silalahi', '1997-09-30', 'pelajar', 'UNJ', '081316486786', 'swardyantara@gmail.com', '$2y$10$ots8uVzoFps/N/rhrYM2e.jG1WqYsLu9MbbNPx0kIMXxtuk/0GSta', 1, '123', '', '', '', '2018-09-21 12:39:46', '2018-09-21 12:40:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `userx_eventx`
--

CREATE TABLE IF NOT EXISTS `userx_eventx` (
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
  `paid_at` datetime NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `userx_eventx`
--

INSERT INTO `userx_eventx` (`id`, `userx_id`, `eventx_id`, `registration_code`, `is_team`, `team_name`, `ign`, `bukti_bayar`, `payment_status`, `created_at`, `paid_at`, `is_delete`) VALUES
(1, 17, 1, '00001', 0, '', '', '', 'not_paid', '2018-09-21 01:25:04', '0000-00-00 00:00:00', '0'),
(2, 17, 2, '00002', 0, '', '', '', 'not_paid', '2018-09-21 01:25:47', '0000-00-00 00:00:00', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eventx`
--
ALTER TABLE `eventx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventx_detail`
--
ALTER TABLE `eventx_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `networkx`
--
ALTER TABLE `networkx`
  ADD PRIMARY KEY (`userx_eventx_id`,`questionx_id`) USING BTREE;

--
-- Indexes for table `network_optionx`
--
ALTER TABLE `network_optionx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network_questionx`
--
ALTER TABLE `network_questionx`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submitx`
--
ALTER TABLE `submitx`
  ADD PRIMARY KEY (`userx_eventx_id`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userx`
--
ALTER TABLE `userx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `userx_eventx`
--
ALTER TABLE `userx_eventx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `registration_code` (`registration_code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eventx`
--
ALTER TABLE `eventx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `eventx_detail`
--
ALTER TABLE `eventx_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `network_optionx`
--
ALTER TABLE `network_optionx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `network_questionx`
--
ALTER TABLE `network_questionx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `submitx`
--
ALTER TABLE `submitx`
  MODIFY `userx_eventx_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userx`
--
ALTER TABLE `userx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `userx_eventx`
--
ALTER TABLE `userx_eventx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
