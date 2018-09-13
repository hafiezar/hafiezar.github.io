-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 03:53 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.1.18

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
-- Table structure for table `moviex`
--

CREATE TABLE `moviex` (
  `userx_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `networkx`
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
-- Table structure for table `network_optionx`
--

CREATE TABLE `network_optionx` (
  `id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `is_true` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `network_questionx`
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
-- Table structure for table `posterx`
--

CREATE TABLE `posterx` (
  `userx_id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `userx`
--

CREATE TABLE `userx` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `sekolah` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userx`
--

INSERT INTO `userx` (`id`, `email`, `password`, `token`, `nama`, `sekolah`, `jurusan`, `tanggal_lahir`, `payment`, `created_at`) VALUES
(1, 'aku@gmail.com', 'secret', NULL, 'aan', 'sma13', 'IPA', NULL, 'cash', '2018-09-12 13:32:37'),
(2, 'aku2@gmail.com', 'secret', NULL, 'aan2', 'sma13', 'IPA', '2018-09-10', 'cash', '2018-09-12 13:33:46'),
(3, 'aku3@gmail.com', '$2y$10$JCb1B1RGXPCvAKdL2h5jSOOSo72ecdVtP71wIrUA9/FLQE2yFHvwG', NULL, 'aan3', 'sma13', 'IPA', '2018-09-10', 'cash', '2018-09-12 13:35:30'),
(4, 'aku4@gmail.com', '$2y$10$rQ.FX3p/dyjsEy0n96FtaOrIkgmisIJuTERyxYLHeaD8T7Hfx0dgq', NULL, 'aan4', 'sma13', 'IPA', '2018-09-10', 'cash', '2018-09-12 13:36:44'),
(8, 'aku5@gmail.com', '$2y$10$dBedtF3puEAnWO4Ourq8kea4IBCqkNnFSUy7rqq6xoOs.aDlSTmk.', NULL, 'aan5', 'sma13', 'IPA', '2018-09-10', 'cash', '2018-09-12 13:44:16'),
(10, 'aku6@gmail.com', '$2y$10$dZPEzspKZgml11F2A05wd.L62KPAAPn6yCb.wJWUrYBdJ2ceWHA8G', NULL, 'aan5', 'sma13', 'IPA', '2018-09-10', 'cash', '2018-09-12 13:48:47');

-- --------------------------------------------------------

--
-- Table structure for table `webx`
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
-- Indexes for table `moviex`
--
ALTER TABLE `moviex`
  ADD PRIMARY KEY (`userx_id`);

--
-- Indexes for table `networkx`
--
ALTER TABLE `networkx`
  ADD PRIMARY KEY (`userx_id`,`questionx_id`) USING BTREE;

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
-- Indexes for table `posterx`
--
ALTER TABLE `posterx`
  ADD PRIMARY KEY (`userx_id`);

--
-- Indexes for table `userx`
--
ALTER TABLE `userx`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`) USING BTREE;

--
-- Indexes for table `webx`
--
ALTER TABLE `webx`
  ADD PRIMARY KEY (`userx_id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
-- AUTO_INCREMENT for table `userx`
--
ALTER TABLE `userx`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
