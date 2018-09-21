/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100133
 Source Host           : localhost:3306
 Source Schema         : it_expo5

 Target Server Type    : MySQL
 Target Server Version : 100133
 File Encoding         : 65001

 Date: 21/09/2018 22:38:02
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for eventx
-- ----------------------------
DROP TABLE IF EXISTS `eventx`;
CREATE TABLE `eventx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `mahasiswa_po` int(11) NOT NULL,
  `mahasiswa_ots` int(11) NOT NULL,
  `umum_po` int(11) NOT NULL,
  `umum_ots` int(11) NOT NULL,
  `phase_1` datetime(0) NOT NULL,
  `phase_2` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of eventx
-- ----------------------------
INSERT INTO `eventx` VALUES (1, 'Networking', 30000, 80000, 30000, 80000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (2, 'Desain Web', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (3, 'Poster', 50000, 0, 50000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (4, 'Short Movie', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (5, 'E-Sport', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (6, 'Seminar', 40000, 45000, 45000, 50000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (7, 'Workshop UI/UX', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (8, 'Workshop Guru TIK', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- ----------------------------
-- Table structure for eventx_detail
-- ----------------------------
DROP TABLE IF EXISTS `eventx_detail`;
CREATE TABLE `eventx_detail`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eventx_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of eventx_detail
-- ----------------------------
INSERT INTO `eventx_detail` VALUES (1, 2, 'Technical Meeting', '27 Oktober 2018');
INSERT INTO `eventx_detail` VALUES (2, 2, 'Kompetisi (Online)', '28 - 31 Oktober 2018');
INSERT INTO `eventx_detail` VALUES (3, 2, 'Presentasi', '29 November 2018');
INSERT INTO `eventx_detail` VALUES (4, 1, 'Kisi-Kisi Penyisihan', '5 November 2018');
INSERT INTO `eventx_detail` VALUES (5, 1, 'Babak Penyisihan (Online)', '10 November 2018');
INSERT INTO `eventx_detail` VALUES (6, 1, 'Pengumuman Babak Penyisihan', '14 November 2018');
INSERT INTO `eventx_detail` VALUES (7, 1, 'Technical Meeting', '27 November 2018');
INSERT INTO `eventx_detail` VALUES (8, 1, 'Babak Final (Onsite)', '28 November 2018');
INSERT INTO `eventx_detail` VALUES (9, 3, 'Pengumpulan Karya', '15 November 2018');
INSERT INTO `eventx_detail` VALUES (10, 3, 'Pengumuman', '29 November 2018');
INSERT INTO `eventx_detail` VALUES (11, 4, 'Pengumpulan Film Gelombang I', '1 - 8 November 2018');
INSERT INTO `eventx_detail` VALUES (12, 4, 'Pengumpulan Film Gelombang II', '9 - 15 November 2018');
INSERT INTO `eventx_detail` VALUES (13, 4, 'Pengumuman', '22 November 2018');
INSERT INTO `eventx_detail` VALUES (14, 4, 'Presentasi', '29 November 2018');
INSERT INTO `eventx_detail` VALUES (15, 7, 'Pendaftaran', '23 September - 13 Oktober 2018');
INSERT INTO `eventx_detail` VALUES (16, 7, 'Workshop', '20 - 21 Oktober 2018');
INSERT INTO `eventx_detail` VALUES (17, 6, 'Pendaftaran', '29 Oktober - 22 November 2018');
INSERT INTO `eventx_detail` VALUES (18, 6, 'Seminar Dan Expo', '29 November 2018');
INSERT INTO `eventx_detail` VALUES (19, 5, 'Penyisihan', '19 - 26 November 2018');
INSERT INTO `eventx_detail` VALUES (20, 5, 'Perempat Final', '27 November 2018');
INSERT INTO `eventx_detail` VALUES (21, 5, 'Semi Final', '28 November 2018');
INSERT INTO `eventx_detail` VALUES (22, 5, 'Final', '29 November 2018');

-- ----------------------------
-- Table structure for network_optionx
-- ----------------------------
DROP TABLE IF EXISTS `network_optionx`;
CREATE TABLE `network_optionx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `questionx_id` int(11) NOT NULL,
  `options` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_true` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for network_questionx
-- ----------------------------
DROP TABLE IF EXISTS `network_questionx`;
CREATE TABLE `network_questionx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` enum('options','essay','file') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `question` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `download_file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for networkx
-- ----------------------------
DROP TABLE IF EXISTS `networkx`;
CREATE TABLE `networkx`  (
  `userx_eventx_id` int(11) NOT NULL,
  `questionx_id` int(11) NOT NULL,
  `answer` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`userx_eventx_id`, `questionx_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for submitx
-- ----------------------------
DROP TABLE IF EXISTS `submitx`;
CREATE TABLE `submitx`  (
  `userx_eventx_id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`userx_eventx_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for teams
-- ----------------------------
DROP TABLE IF EXISTS `teams`;
CREATE TABLE `teams`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `team_member` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of teams
-- ----------------------------
INSERT INTO `teams` VALUES (1, 1, 4, '1');
INSERT INTO `teams` VALUES (2, 1, 4, '2');
INSERT INTO `teams` VALUES (3, 1, 4, '3');
INSERT INTO `teams` VALUES (4, 1, 4, '4');
INSERT INTO `teams` VALUES (5, 1, 4, '5');
INSERT INTO `teams` VALUES (6, 1, 4, '6');
INSERT INTO `teams` VALUES (7, 1, 4, '7');
INSERT INTO `teams` VALUES (8, 1, 4, '8');
INSERT INTO `teams` VALUES (9, 1, 4, '9');
INSERT INTO `teams` VALUES (10, 1, 5, 'tak');
INSERT INTO `teams` VALUES (11, 1, 5, 'bisa');
INSERT INTO `teams` VALUES (12, 1, 5, 'diantara');
INSERT INTO `teams` VALUES (13, 1, 5, 'gg');
INSERT INTO `teams` VALUES (14, 1, 5, 'wp');
INSERT INTO `teams` VALUES (15, 1, 5, 'team');

-- ----------------------------
-- Table structure for userx
-- ----------------------------
DROP TABLE IF EXISTS `userx`;
CREATE TABLE `userx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `is_mahasiswa` int(11) NOT NULL,
  `instansi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kontak` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_verified` int(11) NOT NULL,
  `file_ktm` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `foto` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token_verifikasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `verified_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userx
-- ----------------------------
INSERT INTO `userx` VALUES (1, 'aan', '2018-01-01', 1, 'sma13', '08568056801', 'aangohan2@gmail.com', '$2y$10$C8JgcPNi5RJrPAWvKHbrHOT9FmC00P5F4UCdNv5km8UyWbZOUTbx6', 1, '', '', 'YWFuZ29oYW4yQGdtYWlsLmNvbWl0M3hwbzIwMTg=', '', '2018-09-21 06:14:03', '2018-09-21 06:15:17');

-- ----------------------------
-- Table structure for userx_eventx
-- ----------------------------
DROP TABLE IF EXISTS `userx_eventx`;
CREATE TABLE `userx_eventx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `registration_code` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_team` int(11) NOT NULL,
  `team_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ign` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bukti_bayar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_status` enum('not_paid','wait_verified','paid') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `paid_at` datetime(0) NOT NULL,
  `is_delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `registration_code`(`registration_code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userx_eventx
-- ----------------------------
INSERT INTO `userx_eventx` VALUES (21, 1, 2, '00001', 0, '', '', '', 'not_paid', '2018-09-21 04:44:39', '0000-00-00 00:00:00', '0');
INSERT INTO `userx_eventx` VALUES (22, 1, 6, '00022', 0, '', '', '', 'paid', '2018-09-21 04:44:39', '2018-09-21 04:44:39', '0');

SET FOREIGN_KEY_CHECKS = 1;
