/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 100133
 Source Host           : localhost:3306
 Source Schema         : it_expo4

 Target Server Type    : MySQL
 Target Server Version : 100133
 File Encoding         : 65001

 Date: 18/09/2018 18:47:19
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
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of eventx
-- ----------------------------
INSERT INTO `eventx` VALUES (1, 'Networking', 30000, 80000, 30000, 80000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (2, 'Web Design', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (3, 'Poster', 50000, 0, 50000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (4, 'Short Movie', 100000, 0, 100000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (5, 'E-Sport', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (6, 'Seminar', 40000, 45000, 45000, 50000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `eventx` VALUES (7, 'Workshop UI/UX', 200000, 0, 200000, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `token_verifikasi` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `verified_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userx
-- ----------------------------
INSERT INTO `userx` VALUES (7, 'aan', '2018-01-01', 1, 'sma13', '08568056801', 'moctarafendi@gmail.com', '$2y$10$2FV6ZqyiAbWq6TjlPb3CrexYN6bp/n9VVFAWSbI6lJGneJ6T.cgTu', 1, '', 'bW9jdGFyYWZlbmRpQGdtYWlsLmNvbWl0M3hwbzIwMTg=', '', '2018-09-18 06:52:21', '0000-00-00 00:00:00');
INSERT INTO `userx` VALUES (18, 'aan', '2018-01-01', 1, 'sma13', '08568056801', 'aangohan2@gmail.com', '$2y$10$Hc3rkwaBh8/.M1Bvu9sfgeIOyX9L40TZvzWRX9C1rbaYLFi0TFvJu', 1, 'sffdsgdsg', '', '', '2018-09-18 01:46:39', '2018-09-18 01:46:54');

-- ----------------------------
-- Table structure for userx_eventx
-- ----------------------------
DROP TABLE IF EXISTS `userx_eventx`;
CREATE TABLE `userx_eventx`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userx_id` int(11) NOT NULL,
  `eventx_id` int(11) NOT NULL,
  `is_team` int(11) NOT NULL,
  `team_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `team_member_1` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `team_member_2` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `team_member_3` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `team_member_4` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `ign` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `bukti_bayar` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `payment_status` enum('not_paid','wait_verified','paid') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime(0) NOT NULL,
  `paid_at` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of userx_eventx
-- ----------------------------
INSERT INTO `userx_eventx` VALUES (13, 7, 7, 0, '', '', '', '', '', '', '', 'not_paid', '2018-09-18 01:44:14', '0000-00-00 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
