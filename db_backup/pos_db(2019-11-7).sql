/*
 Navicat Premium Data Transfer

 Source Server         : Local Server
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : pos_db

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 07/11/2019 06:16:19
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for checkups
-- ----------------------------
DROP TABLE IF EXISTS `checkups`;
CREATE TABLE `checkups`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `medical_record_id` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `poly_id` int(10) NULL DEFAULT NULL,
  `doctor_id` int(10) NULL DEFAULT NULL,
  `patient_id` int(10) NULL DEFAULT NULL,
  `date_in` datetime(0) NULL DEFAULT NULL,
  `complaint` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `line_number` int(10) NULL DEFAULT NULL,
  `flag` char(50) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of checkups
-- ----------------------------
INSERT INTO `checkups` VALUES (1, 'XIX.VII.XXIV.00001', 1, 1, 1, '2019-07-15 09:00:00', 'test', 8, 'diagnose', '2019-07-15 09:08:22', '2019-08-02 16:36:13');
INSERT INTO `checkups` VALUES (2, 'XIX.VIII.VII.00001', 1, 1, 1, '2019-08-05 08:00:00', 'Panas', 1, 'diagnose', '2019-08-07 16:55:40', '2019-08-07 17:35:34');
INSERT INTO `checkups` VALUES (3, 'XIX.VIII.VIII.00001', 4, 4, 2, '2019-08-08 15:32:00', 'Panas', 1, 'diagnose', '2019-08-08 15:33:19', '2019-08-08 15:34:15');
INSERT INTO `checkups` VALUES (4, 'XIX.VIII.VIII.00002', 2, 3, 2, '2019-08-13 12:00:00', 'demam', 1, 'diagnose', '2019-08-08 18:04:56', '2019-08-09 10:35:18');
INSERT INTO `checkups` VALUES (5, 'XIX.VIII.XI.00001', 2, 3, 2, '2019-08-13 10:00:00', 'panas', 2, 'diagnose', '2019-08-11 21:10:18', '2019-08-12 13:06:30');
INSERT INTO `checkups` VALUES (6, 'XIX.VIII.XII.00001', 2, 3, 2, '2019-08-13 09:03:00', 'sakit telinga', 3, 'inline', '2019-08-12 13:04:07', NULL);
INSERT INTO `checkups` VALUES (7, 'XIX.IX.XIII.00001', 1, 1, 2, '2019-09-13 13:26:00', 'sakit', 1, 'diagnose', '2019-09-13 13:27:04', '2019-09-13 13:27:46');
INSERT INTO `checkups` VALUES (8, 'XIX.IX.XIV.00001', 4, 4, 2, '2019-09-14 10:40:00', 'tipes', 1, 'finish', '2019-09-14 10:40:41', '2019-09-20 15:29:21');
INSERT INTO `checkups` VALUES (9, 'XIX.IX.XVI.00001', 1, 1, 2, '2019-09-16 08:39:00', 'cccc', 2, 'inline', '2019-09-16 08:39:40', '2019-09-16 17:33:41');
INSERT INTO `checkups` VALUES (11, 'XIX.IX.XIX.00001', 5, 5, 2, '2019-09-19 09:53:00', 'mboh', 1, 'inline', '2019-09-19 09:53:30', NULL);
INSERT INTO `checkups` VALUES (12, 'XIX.IX.XX.00001', 1, 1, 2, '2019-09-20 15:32:00', 'bb', 1, 'finish', '2019-09-20 15:32:44', '2019-09-20 15:34:06');
INSERT INTO `checkups` VALUES (13, 'XIX.IX.XXIV.00001', 1, 1, 2, '2019-09-24 16:43:00', 'vvv', 1, 'finish', '2019-09-24 16:44:11', '2019-09-24 16:45:09');
INSERT INTO `checkups` VALUES (14, 'XIX.IX.XXX.00001', 1, 1, 2, '2019-09-30 09:09:00', 'sakit', 1, 'finish', '2019-09-30 09:10:13', '2019-09-30 09:11:24');
INSERT INTO `checkups` VALUES (17, 'XIX.X.XXIV.00001', 1, 1, 2, '2019-10-24 20:59:00', 'f', 1, 'inline', '2019-10-24 21:00:01', '2019-10-25 00:00:10');
INSERT INTO `checkups` VALUES (18, 'XIX.X.XXV.00001', 1, 1, 2, '2019-10-25 00:01:00', 'cfbh', 1, 'inline', '2019-10-25 00:01:40', '2019-10-25 12:32:57');
INSERT INTO `checkups` VALUES (20, 'XIX.X.XXIX.00001', 5, 5, 2, '2019-10-29 05:37:00', 'fd', 1, 'diagnose', '2019-10-29 05:38:00', '2019-10-29 06:10:45');

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES (1, 'Kediri');
INSERT INTO `city` VALUES (2, 'Sidoarjo');
INSERT INTO `city` VALUES (3, 'Surabaya');
INSERT INTO `city` VALUES (4, 'Malang');
INSERT INTO `city` VALUES (5, 'Mojokerto');
INSERT INTO `city` VALUES (6, 'Jombang');

-- ----------------------------
-- Table structure for code_generator_parts
-- ----------------------------
DROP TABLE IF EXISTS `code_generator_parts`;
CREATE TABLE `code_generator_parts`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code_generator_id` int(10) NOT NULL,
  `code_part_order` int(2) NOT NULL,
  `code_part` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `code_unique` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `code_separator` char(8) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `code_format_kd`(`code_generator_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of code_generator_parts
-- ----------------------------
INSERT INTO `code_generator_parts` VALUES (17, 1, 0, 'yyyy', NULL, '.', '2019-07-24 14:09:34');
INSERT INTO `code_generator_parts` VALUES (18, 1, 1, 'mm', NULL, '.', '2019-07-24 14:09:34');
INSERT INTO `code_generator_parts` VALUES (19, 1, 2, 'dd', NULL, '.', '2019-07-24 14:09:34');
INSERT INTO `code_generator_parts` VALUES (20, 1, 3, 'urutan_angka', '00001', 'n', '2019-07-24 14:09:34');
INSERT INTO `code_generator_parts` VALUES (21, 2, 0, 'yy_roman', NULL, '.', '2019-07-24 15:23:56');
INSERT INTO `code_generator_parts` VALUES (22, 2, 1, 'mm_roman', NULL, '.', '2019-07-24 15:23:56');
INSERT INTO `code_generator_parts` VALUES (23, 2, 2, 'dd_roman', NULL, '.', '2019-07-24 15:23:56');
INSERT INTO `code_generator_parts` VALUES (24, 2, 3, 'urutan_angka', '00001', 'n', '2019-07-24 15:23:56');
INSERT INTO `code_generator_parts` VALUES (25, 3, 0, 'yy_roman', NULL, '.', '2019-07-24 15:40:10');
INSERT INTO `code_generator_parts` VALUES (26, 3, 1, 'mm_roman', NULL, '.', '2019-07-24 15:40:10');
INSERT INTO `code_generator_parts` VALUES (27, 3, 2, 'dd_roman', NULL, '.', '2019-07-24 15:40:10');
INSERT INTO `code_generator_parts` VALUES (28, 3, 3, 'urutan_angka', '001', 'n', '2019-07-24 15:40:10');
INSERT INTO `code_generator_parts` VALUES (29, 4, 0, 'yy', NULL, '.', '2019-07-24 15:40:49');
INSERT INTO `code_generator_parts` VALUES (30, 4, 1, 'mm', NULL, '.', '2019-07-24 15:40:49');
INSERT INTO `code_generator_parts` VALUES (31, 4, 2, 'dd', NULL, '.', '2019-07-24 15:40:49');
INSERT INTO `code_generator_parts` VALUES (32, 4, 3, 'urutan_angka', '0001', 'n', '2019-07-24 15:40:49');
INSERT INTO `code_generator_parts` VALUES (53, 8, 0, 'yyyy', NULL, '.', '2019-09-19 10:38:13');
INSERT INTO `code_generator_parts` VALUES (54, 8, 1, 'mm', NULL, '.', '2019-09-19 10:38:13');
INSERT INTO `code_generator_parts` VALUES (55, 8, 2, 'dd', NULL, '.', '2019-09-19 10:38:13');
INSERT INTO `code_generator_parts` VALUES (56, 8, 3, 'urutan_angka', '1', '.', '2019-09-19 10:38:13');
INSERT INTO `code_generator_parts` VALUES (57, 7, 0, 'yy', NULL, '.', '2019-09-19 11:00:50');
INSERT INTO `code_generator_parts` VALUES (58, 7, 1, 'mm', NULL, '.', '2019-09-19 11:00:50');
INSERT INTO `code_generator_parts` VALUES (59, 7, 2, 'dd', NULL, '.', '2019-09-19 11:00:50');
INSERT INTO `code_generator_parts` VALUES (60, 7, 3, 'urutan_angka', '1', 'n', '2019-09-19 11:00:50');
INSERT INTO `code_generator_parts` VALUES (61, 9, 0, 'yy_roman', NULL, '.', '2019-09-19 11:27:10');
INSERT INTO `code_generator_parts` VALUES (62, 9, 1, 'mm', NULL, '.', '2019-09-19 11:27:10');
INSERT INTO `code_generator_parts` VALUES (63, 9, 2, 'dd_roman', NULL, '.', '2019-09-19 11:27:10');
INSERT INTO `code_generator_parts` VALUES (64, 9, 3, 'urutan_angka', '01', 'n', '2019-09-19 11:27:10');
INSERT INTO `code_generator_parts` VALUES (65, 10, 0, 'yy_roman', NULL, '.', '2019-09-25 19:05:52');
INSERT INTO `code_generator_parts` VALUES (66, 10, 1, 'mm', NULL, '.', '2019-09-25 19:05:52');
INSERT INTO `code_generator_parts` VALUES (67, 10, 2, 'dd_roman', NULL, '.', '2019-09-25 19:05:52');
INSERT INTO `code_generator_parts` VALUES (68, 10, 3, 'urutan_angka', '001', 'n', '2019-09-25 19:05:52');
INSERT INTO `code_generator_parts` VALUES (73, 11, 0, 'yy', NULL, '.', '2019-09-26 16:20:39');
INSERT INTO `code_generator_parts` VALUES (74, 11, 1, 'mm', NULL, '.', '2019-09-26 16:20:39');
INSERT INTO `code_generator_parts` VALUES (75, 11, 2, 'dd', NULL, '.', '2019-09-26 16:20:39');
INSERT INTO `code_generator_parts` VALUES (76, 11, 3, 'urutan_angka', '01', 'n', '2019-09-26 16:20:39');

-- ----------------------------
-- Table structure for code_generators
-- ----------------------------
DROP TABLE IF EXISTS `code_generators`;
CREATE TABLE `code_generators`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `table` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `column` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `code_format` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `code_reset` char(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `created_at` timestamp(0) NOT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of code_generators
-- ----------------------------
INSERT INTO `code_generators` VALUES (1, 'Format Kode Pasien', 'patients', 'patient_code', 'yyyy.mm.dd.urutan_angka[00001]', 'year', '2019-07-24 13:05:08', '2019-07-24 14:09:34');
INSERT INTO `code_generators` VALUES (2, 'Format Kode Rekam Medik', 'checkups', 'medical_record_id', 'yy_roman.mm_roman.dd_roman.urutan_angka[00001]', 'day', '2019-07-24 15:23:56', '2019-07-24 15:23:56');
INSERT INTO `code_generators` VALUES (3, 'Format Code Dokter', 'doctors', 'doctor_id', 'yy_roman.mm_roman.dd_roman.urutan_angka[001]', 'year', '2019-07-24 15:40:10', '2019-07-24 15:40:10');
INSERT INTO `code_generators` VALUES (4, 'Format Code Pegawai', 'employees', 'employee_id', 'yy.mm.dd.urutan_angka[0001]', 'year', '2019-07-24 15:40:49', '2019-07-24 15:40:49');
INSERT INTO `code_generators` VALUES (7, 'Kode Supplier', 'supplier', 'supplier_code', 'yy.mm.dd.urutan_angka[1]', 'year', '2019-09-19 10:35:16', '2019-09-19 11:00:50');
INSERT INTO `code_generators` VALUES (8, 'No Retur', 'purchase_return', 'no_retur', 'yyyy.mm.dd.urutan_angka[1].', 'day', '2019-09-19 10:37:42', '2019-09-19 10:38:13');
INSERT INTO `code_generators` VALUES (9, 'No Faktur', 'purchase', 'no_faktur', 'yy_roman.mm.dd_roman.urutan_angka[01]', 'day', '2019-09-19 11:27:10', '2019-09-19 11:27:10');
INSERT INTO `code_generators` VALUES (10, 'No Faktur', 'drug_purchase', 'no_faktur', 'yy_roman.mm.dd_roman.urutan_angka[001]', 'day', '2019-09-25 19:05:52', '2019-09-25 19:05:52');
INSERT INTO `code_generators` VALUES (11, 'No Retur', 'sales_return', 'no_retur', 'yy.mm.dd.urutan_angka[01]', 'day', '2019-09-26 16:20:12', '2019-09-26 16:20:39');

-- ----------------------------
-- Table structure for customer
-- ----------------------------
DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `civilian_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `patient_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gender` char(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `place_of_birth` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_of_birth` date NULL DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `blood_type` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customer
-- ----------------------------
INSERT INTO `customer` VALUES (1, 6, '39061114575001', '2019.07.24.00001', 'test', 'male', 'test', 'test', 'Test', '1913-02-04', '564', NULL, 'a', '4ff33b9c68b1c70053f9107e41ab973c.jpg', '2019-07-11 11:12:23', '2019-08-07 17:49:01');
INSERT INTO `customer` VALUES (2, 7, '2019.8.8.00001', '2019.08.08.00002', 'noname', 'female', 'Sidoarjo', 'Islam', 'Sidoarjo', '1991-12-19', '0852', 'nn@mail.com', 'a', 'b3503b9c4d088875064e903ce321092c.jpg', '2019-08-08 08:33:20', '2019-08-21 12:23:31');
INSERT INTO `customer` VALUES (3, 11, '101010', '2019.11.05.00003', 'mawar merah', 'female', 'kediri', 'islam', 'kediri', '1991-12-19', '0852', 'mawar@gmail.com', 'a', '18eb069d26b07e7ce5fdd545bf8489b1.png', '2019-11-05 11:42:00', '2019-11-05 11:51:05');

-- ----------------------------
-- Table structure for daily_schedules
-- ----------------------------
DROP TABLE IF EXISTS `daily_schedules`;
CREATE TABLE `daily_schedules`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(10) NULL DEFAULT NULL,
  `poly_id` int(10) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `start_at` time(0) NULL DEFAULT NULL,
  `end_at` time(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1070 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of daily_schedules
-- ----------------------------
INSERT INTO `daily_schedules` VALUES (939, 3, 2, '2019-01-01', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (940, 1, 1, '2019-01-07', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (941, 3, 2, '2019-01-08', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (942, 1, 1, '2019-01-14', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (943, 3, 2, '2019-01-15', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (944, 1, 1, '2019-01-21', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (945, 3, 2, '2019-01-22', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (946, 1, 1, '2019-01-28', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (947, 3, 2, '2019-01-29', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (948, 1, 1, '2019-02-04', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (949, 3, 2, '2019-02-05', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (950, 1, 1, '2019-02-11', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (951, 3, 2, '2019-02-12', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (952, 1, 1, '2019-02-18', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (953, 3, 2, '2019-02-19', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (954, 1, 1, '2019-02-25', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (955, 3, 2, '2019-02-26', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (956, 1, 1, '2019-03-04', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (957, 3, 2, '2019-03-05', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (958, 1, 1, '2019-03-11', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (959, 3, 2, '2019-03-12', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (960, 1, 1, '2019-03-18', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (961, 3, 2, '2019-03-19', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (962, 1, 1, '2019-03-25', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (963, 3, 2, '2019-03-26', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (964, 1, 1, '2019-04-01', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (965, 3, 2, '2019-04-02', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (966, 1, 1, '2019-04-08', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (967, 3, 2, '2019-04-09', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (968, 1, 1, '2019-04-15', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (969, 3, 2, '2019-04-16', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (970, 1, 1, '2019-04-22', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (971, 3, 2, '2019-04-23', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (972, 1, 1, '2019-04-29', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (973, 3, 2, '2019-04-30', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (974, 1, 1, '2019-05-06', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (975, 3, 2, '2019-05-07', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (976, 1, 1, '2019-05-13', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (977, 3, 2, '2019-05-14', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (978, 1, 1, '2019-05-20', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (979, 3, 2, '2019-05-21', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (980, 1, 1, '2019-05-27', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (981, 3, 2, '2019-05-28', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (982, 1, 1, '2019-06-03', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (983, 3, 2, '2019-06-04', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (984, 1, 1, '2019-06-10', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (985, 3, 2, '2019-06-11', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (986, 1, 1, '2019-06-17', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (987, 3, 2, '2019-06-18', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (988, 1, 1, '2019-06-24', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (989, 3, 2, '2019-06-25', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (990, 1, 1, '2019-07-01', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (991, 3, 2, '2019-07-02', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (992, 1, 1, '2019-07-08', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (993, 3, 2, '2019-07-09', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (994, 1, 1, '2019-07-15', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (995, 3, 2, '2019-07-16', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (996, 1, 1, '2019-07-22', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (997, 3, 2, '2019-07-23', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (998, 1, 1, '2019-07-29', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (999, 3, 2, '2019-07-30', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1000, 1, 1, '2019-08-05', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1001, 3, 2, '2019-08-06', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1002, 1, 1, '2019-08-12', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1003, 3, 2, '2019-08-13', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1004, 1, 1, '2019-08-19', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1005, 3, 2, '2019-08-20', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1006, 1, 1, '2019-08-26', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1007, 3, 2, '2019-08-27', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1008, 1, 1, '2019-09-02', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1009, 3, 2, '2019-09-03', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1010, 1, 1, '2019-09-09', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1011, 3, 2, '2019-09-10', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1012, 1, 1, '2019-09-16', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1013, 3, 2, '2019-09-17', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1014, 1, 1, '2019-09-23', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1015, 3, 2, '2019-09-24', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1016, 1, 1, '2019-09-30', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1017, 3, 2, '2019-10-01', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1018, 1, 1, '2019-10-07', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1019, 3, 2, '2019-10-08', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1020, 1, 1, '2019-10-14', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1021, 3, 2, '2019-10-15', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1022, 1, 1, '2019-10-21', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1023, 3, 2, '2019-10-22', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1024, 1, 1, '2019-10-28', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1025, 3, 2, '2019-10-29', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1026, 1, 1, '2019-11-04', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1027, 3, 2, '2019-11-05', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1028, 1, 1, '2019-11-11', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1029, 3, 2, '2019-11-12', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1030, 1, 1, '2019-11-18', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1031, 3, 2, '2019-11-19', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1032, 1, 1, '2019-11-25', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1033, 3, 2, '2019-11-26', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1034, 1, 1, '2019-12-02', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1035, 3, 2, '2019-12-03', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1036, 1, 1, '2019-12-09', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1037, 3, 2, '2019-12-10', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1038, 1, 1, '2019-12-16', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1039, 3, 2, '2019-12-17', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1040, 1, 1, '2019-12-23', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1041, 3, 2, '2019-12-24', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1042, 1, 1, '2019-12-30', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1043, 3, 2, '2019-12-31', '08:00:00', '12:00:00', '2019-08-08 08:54:26', NULL);
INSERT INTO `daily_schedules` VALUES (1052, 4, 4, '2019-08-08', '12:00:00', '17:00:00', '2019-08-08 10:01:44', '2019-08-08 15:31:46');
INSERT INTO `daily_schedules` VALUES (1057, 4, 4, '2019-08-15', '15:30:48', '15:30:56', '2019-08-15 15:31:05', NULL);
INSERT INTO `daily_schedules` VALUES (1058, 4, 4, '2019-08-16', '09:40:30', '12:40:38', '2019-08-16 09:40:45', NULL);
INSERT INTO `daily_schedules` VALUES (1060, 3, 4, '2019-08-16', '10:00:00', '22:00:00', '2019-08-16 15:46:16', NULL);
INSERT INTO `daily_schedules` VALUES (1061, 1, 1, '2019-09-13', '13:00:00', '19:00:00', '2019-09-13 13:26:37', NULL);
INSERT INTO `daily_schedules` VALUES (1062, 3, 2, '2019-09-13', '15:00:00', '20:00:00', '2019-09-13 15:32:51', NULL);
INSERT INTO `daily_schedules` VALUES (1063, 4, 4, '2019-09-14', '09:00:00', '20:00:00', '2019-09-13 21:56:58', NULL);
INSERT INTO `daily_schedules` VALUES (1064, 5, 5, '2019-09-19', '09:50:00', '23:50:00', '2019-09-19 09:50:54', NULL);
INSERT INTO `daily_schedules` VALUES (1065, 1, 1, '2019-09-20', '15:32:00', '23:32:00', '2019-09-20 15:32:23', NULL);
INSERT INTO `daily_schedules` VALUES (1066, 1, 1, '2019-09-24', '16:43:00', '16:43:00', '2019-09-24 16:43:49', NULL);
INSERT INTO `daily_schedules` VALUES (1067, 1, 1, '2019-10-24', '10:55:00', '23:56:00', '2019-10-24 10:56:07', '2019-10-24 20:56:33');
INSERT INTO `daily_schedules` VALUES (1068, 1, 1, '2019-10-25', '00:01:00', '23:01:00', '2019-10-25 00:01:11', NULL);
INSERT INTO `daily_schedules` VALUES (1069, 5, 5, '2019-10-29', '05:28:00', '23:00:00', '2019-10-29 05:29:13', NULL);

-- ----------------------------
-- Table structure for diagnose_drugs
-- ----------------------------
DROP TABLE IF EXISTS `diagnose_drugs`;
CREATE TABLE `diagnose_drugs`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnose_id` int(10) NULL DEFAULT NULL,
  `drug_id` int(10) NULL DEFAULT NULL,
  `price` decimal(17, 2) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 63 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of diagnose_drugs
-- ----------------------------
INSERT INTO `diagnose_drugs` VALUES (16, 8, 2, 15000.00, 5, '2019-08-02 16:36:13');
INSERT INTO `diagnose_drugs` VALUES (17, 8, 3, 20000.00, 5, '2019-08-02 16:36:13');
INSERT INTO `diagnose_drugs` VALUES (18, 9, 3, 20000.00, 3, '2019-08-07 17:35:34');
INSERT INTO `diagnose_drugs` VALUES (19, 10, 3, 20000.00, 2, '2019-08-08 15:34:16');
INSERT INTO `diagnose_drugs` VALUES (24, 11, 2, 15000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (25, 11, 3, 20000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (26, 11, 4, 12500.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (27, 11, 5, 15000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (28, 11, 6, 20000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (29, 11, 7, 25000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (30, 11, 8, 30000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (31, 11, 9, 35000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (32, 11, 10, 40000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (33, 11, 11, 45000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (34, 11, 12, 50000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (35, 11, 13, 55000.00, 1, '2019-08-09 10:35:18');
INSERT INTO `diagnose_drugs` VALUES (49, 15, 13, 55000.00, 2, '2019-09-14 16:54:44');
INSERT INTO `diagnose_drugs` VALUES (50, 16, 7, 25000.00, 3, '2019-09-20 15:33:35');
INSERT INTO `diagnose_drugs` VALUES (51, 16, 11, 45000.00, 6, '2019-09-20 15:33:35');
INSERT INTO `diagnose_drugs` VALUES (52, 16, 9, 35000.00, 8, '2019-09-20 15:33:35');
INSERT INTO `diagnose_drugs` VALUES (62, 28, 6, 20000.00, 3, '2019-10-29 06:10:45');

-- ----------------------------
-- Table structure for diagnosedrug_sales
-- ----------------------------
DROP TABLE IF EXISTS `diagnosedrug_sales`;
CREATE TABLE `diagnosedrug_sales`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnose_id` int(10) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price` decimal(17, 2) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `subtotal` decimal(17, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of diagnosedrug_sales
-- ----------------------------
INSERT INTO `diagnosedrug_sales` VALUES (1, 8, 'Obat A', 'Obat A', 15000.00, 5, 75000.00, '2019-08-02 17:41:11');
INSERT INTO `diagnosedrug_sales` VALUES (2, 8, 'Obat B', 'Obat B', 20000.00, 1, 100000.00, '2019-08-02 17:41:11');
INSERT INTO `diagnosedrug_sales` VALUES (3, 9, 'Obat B', 'Obat B', 20000.00, 1, 60000.00, '2019-08-07 17:36:16');
INSERT INTO `diagnosedrug_sales` VALUES (4, 10, 'Obat B', 'Obat B', 20000.00, 1, 40000.00, '2019-08-08 15:35:00');
INSERT INTO `diagnosedrug_sales` VALUES (5, 10, 'periksa', 'periksa', 50000.00, 1, 50000.00, '2019-08-08 15:35:00');
INSERT INTO `diagnosedrug_sales` VALUES (6, 11, 'Obat A', 'Obat A', 15000.00, 1, 15000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (7, 11, 'Obat B', 'Obat B', 20000.00, 1, 20000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (8, 11, 'Obat C', 'Obat C', 12500.00, 1, 12500.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (9, 11, 'Obat D', 'Obat D', 15000.00, 1, 15000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (10, 11, 'Obat E', 'Obat E', 20000.00, 1, 20000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (11, 11, 'Obat F', 'Obat F', 25000.00, 1, 25000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (12, 11, 'Obat G', 'Obat G', 30000.00, 1, 30000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (13, 11, 'Obat H', 'Obat H', 35000.00, 1, 35000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (14, 11, 'Obat I', 'Obat I', 40000.00, 1, 40000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (15, 11, 'Obat J', 'Obat J', 45000.00, 1, 45000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (16, 11, 'Obat K', 'Obat K', 50000.00, 1, 50000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (17, 11, 'Obat L', 'Obat L', 55000.00, 1, 55000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (18, 11, 'periksa', 'periksa', 50000.00, 1, 50000.00, '2019-08-09 10:35:53');
INSERT INTO `diagnosedrug_sales` VALUES (19, 12, 'Obat A', 'Obat A', 15000.00, 1, 15000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (20, 12, 'Obat B', 'Obat B', 20000.00, 1, 20000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (21, 12, 'Obat C', 'Obat C', 12500.00, 1, 12500.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (22, 12, 'Obat D', 'Obat D', 15000.00, 1, 15000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (23, 12, 'Obat E', 'Obat E', 20000.00, 1, 20000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (24, 12, 'Obat F', 'Obat F', 25000.00, 1, 25000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (25, 12, 'Obat G', 'Obat G', 30000.00, 1, 30000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (26, 12, 'Obat H', 'Obat H', 35000.00, 1, 35000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (27, 12, 'Obat I', 'Obat I', 40000.00, 1, 40000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (28, 12, 'periksa', 'periksa', 50000.00, 1, 50000.00, '2019-08-12 13:06:56');
INSERT INTO `diagnosedrug_sales` VALUES (29, 13, 'Obat G', 'Obat G', 30000.00, 1, 30000.00, '2019-09-13 13:31:41');
INSERT INTO `diagnosedrug_sales` VALUES (30, 13, 'biaya dokter', 'biaya dokter', 50000.00, 1, 50000.00, '2019-09-13 13:31:41');
INSERT INTO `diagnosedrug_sales` VALUES (31, 15, 'Obat L', 'Obat L', 15000.00, 1, 15000.00, '2019-09-20 15:29:21');
INSERT INTO `diagnosedrug_sales` VALUES (32, 15, 'biaya dokter', 'biaya dokter', 55000.00, 2, 110000.00, '2019-09-20 15:29:21');
INSERT INTO `diagnosedrug_sales` VALUES (33, 16, 'Obat F', 'Obat F', 25000.00, 3, 75000.00, '2019-09-20 15:34:06');
INSERT INTO `diagnosedrug_sales` VALUES (34, 16, 'Obat J', 'Obat J', 45000.00, 6, 270000.00, '2019-09-20 15:34:06');
INSERT INTO `diagnosedrug_sales` VALUES (35, 16, 'Obat H', 'Obat H', 35000.00, 8, 280000.00, '2019-09-20 15:34:06');
INSERT INTO `diagnosedrug_sales` VALUES (36, 16, 'biaya dokter', 'biaya dokter', 50000.00, 1, 50000.00, '2019-09-20 15:34:06');
INSERT INTO `diagnosedrug_sales` VALUES (37, 17, 'Obat D', 'Obat D', 15000.00, 4, 60000.00, '2019-09-24 16:45:09');
INSERT INTO `diagnosedrug_sales` VALUES (38, 17, 'Obat J', 'Obat J', 45000.00, 6, 270000.00, '2019-09-24 16:45:09');
INSERT INTO `diagnosedrug_sales` VALUES (39, 18, 'Obat A', 'Obat A', 15000.00, 1, 15000.00, '2019-09-30 09:11:24');
INSERT INTO `diagnosedrug_sales` VALUES (40, 18, 'Obat H', 'Obat H', 35000.00, 1, 35000.00, '2019-09-30 09:11:24');
INSERT INTO `diagnosedrug_sales` VALUES (41, 18, 'biaya dokter', 'biaya dokter', 50000.00, 1, 50000.00, '2019-09-30 09:11:24');

-- ----------------------------
-- Table structure for diagnoses
-- ----------------------------
DROP TABLE IF EXISTS `diagnoses`;
CREATE TABLE `diagnoses`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_faktur_checkup` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `checkup_id` int(10) NULL DEFAULT NULL,
  `poly_id` int(10) NULL DEFAULT NULL,
  `doctor_id` int(10) NULL DEFAULT NULL,
  `patient_id` int(10) NULL DEFAULT NULL,
  `date_in` date NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `total_price` decimal(17, 2) NULL DEFAULT NULL,
  `flag` char(25) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of diagnoses
-- ----------------------------
INSERT INTO `diagnoses` VALUES (8, NULL, 1, 1, 1, 1, '2019-07-15', 'Haha berhasil', 175000.00, 'finish', '2019-07-22 17:52:50', '2019-08-02 17:41:11');
INSERT INTO `diagnoses` VALUES (9, NULL, 2, 1, 1, 1, '2019-08-05', 'Panas Tinggi', 60000.00, 'finish', '2019-08-07 17:35:34', '2019-08-07 17:36:16');
INSERT INTO `diagnoses` VALUES (10, NULL, 3, 4, 4, 2, '2019-08-08', 'selesai', 90000.00, 'finish', '2019-08-08 15:34:16', '2019-08-08 15:35:00');
INSERT INTO `diagnoses` VALUES (11, NULL, 4, 2, 3, 2, '2019-08-13', 'selesai', 412500.00, 'finish', '2019-08-08 18:06:03', '2019-08-09 10:35:53');
INSERT INTO `diagnoses` VALUES (12, NULL, 5, 2, 3, 2, '2019-08-13', 'sudah ada perubahan', 262500.00, 'finish', '2019-08-12 13:06:30', '2019-08-12 13:06:56');
INSERT INTO `diagnoses` VALUES (13, NULL, 7, 1, 1, 2, '2019-09-13', 'selesai', 80000.00, 'finish', '2019-09-13 13:27:47', '2019-09-13 13:31:41');
INSERT INTO `diagnoses` VALUES (15, NULL, 8, 4, 4, 2, '2019-09-14', 'selesai', 175000.00, 'finish', '2019-09-14 16:54:44', '2019-09-20 15:29:21');
INSERT INTO `diagnoses` VALUES (16, NULL, 12, 1, 1, 2, '2019-09-20', 'bbb', 675000.00, 'finish', '2019-09-20 15:33:35', '2019-09-20 15:34:06');
INSERT INTO `diagnoses` VALUES (17, NULL, 13, 1, 1, 2, '2019-09-24', 'vvv', 330000.00, 'finish', '2019-09-24 16:44:46', '2019-09-24 16:45:09');
INSERT INTO `diagnoses` VALUES (18, NULL, 14, 1, 1, 2, '2019-09-30', 'selesai', 100000.00, 'finish', '2019-09-30 09:10:52', '2019-09-30 09:11:24');
INSERT INTO `diagnoses` VALUES (28, 'XIX.10.XXIX.001', 20, 5, 5, 2, '2019-10-29', 'sss', 60000.00, 'diagnose', '2019-10-29 06:10:45', NULL);

-- ----------------------------
-- Table structure for doctors
-- ----------------------------
DROP TABLE IF EXISTS `doctors`;
CREATE TABLE `doctors`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `doctor_id` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gender` char(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of doctors
-- ----------------------------
INSERT INTO `doctors` VALUES (1, 4, 'XIX.VII.XXIV.001', 'Dr. Susan', 'female', 'Server', NULL, '2019-07-04 15:09:47', '2019-08-20 12:51:41');
INSERT INTO `doctors` VALUES (3, NULL, 'XIX.VII.XXIV.003', 'Dr. Suseno', 'male', 'Disana', NULL, '2019-07-22 16:41:18', NULL);
INSERT INTO `doctors` VALUES (4, 5, 'XIX.VIII.I.004', 'Drs. Susita', 'female', 'Nun Jauh Disana', NULL, '2019-08-01 13:04:30', NULL);
INSERT INTO `doctors` VALUES (5, 9, 'XIX.VIII.XIII.005', 'Dr. Ririn', 'female', 'Surabaya', 'db4ec6ce03bd6049a1336315bec6f829.jpg', '2019-08-13 23:39:28', NULL);

-- ----------------------------
-- Table structure for drug_purchase
-- ----------------------------
DROP TABLE IF EXISTS `drug_purchase`;
CREATE TABLE `drug_purchase`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `diagnose_id_purchase` int(10) NULL DEFAULT NULL,
  `patient_id` int(10) NULL DEFAULT NULL,
  `total_price` decimal(17, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 55 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of drug_purchase
-- ----------------------------
INSERT INTO `drug_purchase` VALUES (54, 'XIX.11.VII.001', NULL, 2, 50000.00, '2019-11-07 05:58:28', NULL);

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `employee_id` char(50) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gender` char(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (1, 10, '19.07.24.0001', 'Noname', 'male', 'Test', '2db29e1e462771b8432ef38d79217785.png', '2019-07-24 15:59:00', '2019-11-05 11:58:03');

-- ----------------------------
-- Table structure for fixed_schedules
-- ----------------------------
DROP TABLE IF EXISTS `fixed_schedules`;
CREATE TABLE `fixed_schedules`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `day_of_week` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `doctor_id` int(10) NULL DEFAULT NULL,
  `poly_id` int(10) NULL DEFAULT NULL,
  `start_at` time(0) NULL DEFAULT NULL,
  `end_at` time(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of fixed_schedules
-- ----------------------------
INSERT INTO `fixed_schedules` VALUES (1, '1', 1, 1, '08:00:00', '12:00:00', '2019-08-08 08:54:25');
INSERT INTO `fixed_schedules` VALUES (2, '2', 3, 2, '08:00:00', '12:00:00', '2019-08-08 08:54:25');

-- ----------------------------
-- Table structure for gudang
-- ----------------------------
DROP TABLE IF EXISTS `gudang`;
CREATE TABLE `gudang`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `barcode` char(13) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `type_id` int(10) NULL DEFAULT NULL,
  `sell_price` decimal(17, 2) NULL DEFAULT NULL,
  `purchase_price` decimal(17, 2) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gudang
-- ----------------------------
INSERT INTO `gudang` VALUES (2, '3800065711131', 'Barang A', 2, 15000.00, 10000.00, 'Ini Obat A', '2019-09-28 11:30:12', '2019-11-05 16:27:41');
INSERT INTO `gudang` VALUES (3, '3800065711132', 'Barang B', 3, 20000.00, 15000.00, 'Ini Obat B', '2019-07-17 12:17:26', '2019-11-04 19:31:28');
INSERT INTO `gudang` VALUES (4, '3800065711133', 'Barang C', 1, 12500.00, 10000.00, 'Ini Obat C', '2019-07-17 12:17:43', '2019-11-04 19:31:40');
INSERT INTO `gudang` VALUES (5, '3800065711134', 'Barang D', 2, 15000.00, 10000.00, 'Ini Obat D', '2019-08-09 10:28:25', '2019-11-04 19:31:51');
INSERT INTO `gudang` VALUES (6, '3800065711135', 'Barang E', 1, 20000.00, 15000.00, 'Ini Obat E', '2019-08-09 10:28:45', '2019-11-04 19:32:01');
INSERT INTO `gudang` VALUES (7, '3800065711136', 'Barang F', 2, 25000.00, 20000.00, 'Ini Obat F', '2019-08-09 10:29:22', '2019-11-04 19:32:12');
INSERT INTO `gudang` VALUES (8, '3800065711137', 'Barang G', 1, 30000.00, 25000.00, 'Ini Obat G', '2019-08-09 10:29:43', '2019-11-04 19:32:24');
INSERT INTO `gudang` VALUES (9, '3800065711138', 'Barang H', 2, 35000.00, 30000.00, 'Ini Obat H', '2019-08-09 10:29:57', '2019-11-04 19:32:36');
INSERT INTO `gudang` VALUES (10, '3800065711139', 'Barang I', 1, 40000.00, 35000.00, 'Ini Obat I', '2019-08-09 10:32:06', '2019-11-04 19:32:47');
INSERT INTO `gudang` VALUES (11, '3800065711140', 'Barang J', 2, 45000.00, 40000.00, 'Ini Obat J', '2019-08-09 10:32:31', '2019-11-04 19:33:10');
INSERT INTO `gudang` VALUES (12, '3800065711141', 'Barang K', 1, 50000.00, 45000.00, 'Ini Obat K', '2019-08-09 10:32:54', '2019-11-04 19:33:27');
INSERT INTO `gudang` VALUES (13, '3800065711142', 'Barang L', 2, 55000.00, 50000.00, 'Ini Obat K', '2019-08-09 10:33:27', '2019-11-04 19:33:45');
INSERT INTO `gudang` VALUES (14, '3800065711143', 'Barang M', 1, 60000.00, 55000.00, 'Ini Obat M', '2019-09-27 20:21:53', '2019-11-04 19:34:03');

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Barang', 'Barang Pecah Belah', '2019-08-06 16:06:28', '2019-08-07 09:50:28');

-- ----------------------------
-- Table structure for menu_privileges
-- ----------------------------
DROP TABLE IF EXISTS `menu_privileges`;
CREATE TABLE `menu_privileges`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `privilege_id` int(10) NULL DEFAULT NULL,
  `menu_id` int(10) NULL DEFAULT NULL,
  `create_access` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `read_access` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `update_access` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `delete_access` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 693 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu_privileges
-- ----------------------------
INSERT INTO `menu_privileges` VALUES (194, 5, 24, '1', '1', '1', '1', '2019-08-14 19:29:11');
INSERT INTO `menu_privileges` VALUES (195, 5, 26, '1', '1', '1', '1', '2019-08-14 19:29:11');
INSERT INTO `menu_privileges` VALUES (658, 2, 1, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (659, 2, 3, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (660, 2, 2, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (661, 2, 4, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (662, 2, 5, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (663, 2, 6, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (664, 2, 7, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (665, 2, 9, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (666, 2, 8, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (667, 2, 11, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (668, 2, 10, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (669, 2, 12, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (670, 2, 15, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (671, 2, 13, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (672, 2, 27, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (673, 2, 28, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (674, 2, 32, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (675, 2, 33, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (676, 2, 35, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (677, 2, 37, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (678, 2, 38, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (679, 2, 39, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (680, 2, 41, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (681, 2, 18, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (682, 2, 17, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (683, 2, 19, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (684, 2, 20, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (685, 2, 21, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (686, 2, 29, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (687, 2, 30, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (688, 2, 31, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (689, 2, 34, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (690, 2, 36, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (691, 2, 22, '1', '1', '1', '1', '2019-10-18 13:30:06');
INSERT INTO `menu_privileges` VALUES (692, 2, 16, '1', '1', '1', '1', '2019-10-18 13:30:06');

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `link` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `level` int(1) NULL DEFAULT NULL,
  `order` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `modul` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `is_global` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, NULL, 'home', 'home', 'Home', 'fa fa-home ', 0, '1', 'adminpanel', '1', '2019-07-25 12:22:33', NULL);
INSERT INTO `menus` VALUES (2, NULL, 'master', '#', 'Master', 'fa fa-user-circle-o ', 0, '2', 'adminpanel', '0', '2019-07-25 12:23:24', NULL);
INSERT INTO `menus` VALUES (3, 2, 'users', 'users', 'User', NULL, 1, '1', 'adminpanel', '0', '2019-07-25 12:26:00', NULL);
INSERT INTO `menus` VALUES (6, 2, 'employees', 'employees', 'Pegawai', NULL, 1, '4', 'adminpanel', '0', '2019-07-25 12:28:03', NULL);
INSERT INTO `menus` VALUES (13, NULL, 'pharmacy', '#', 'Transaksi', 'fa fa-shopping-cart', 0, '5', 'adminpanel', '0', '2019-07-25 12:36:07', NULL);
INSERT INTO `menus` VALUES (14, 13, 'drugs', 'drugs', 'Data Gudang', NULL, 1, '2', 'adminpanel', '0', '2019-07-25 12:36:28', NULL);
INSERT INTO `menus` VALUES (16, NULL, 'setting', '#', 'Setting', 'fa fa-cogs', 0, '6', 'adminpanel', '0', '2019-07-25 12:37:42', NULL);
INSERT INTO `menus` VALUES (17, 16, 'code_generator', '#', 'Kode Generator', NULL, 1, '1', 'adminpanel', '0', '2019-07-25 12:38:30', NULL);
INSERT INTO `menus` VALUES (20, 17, 'employees', 'employees', 'Pegawai', NULL, 2, '3', 'adminpanel', '0', '2019-07-25 12:39:56', NULL);
INSERT INTO `menus` VALUES (22, 16, 'privilege', 'privilege', 'Hak Akses', NULL, 1, '2', 'adminpanel', '0', '2019-07-26 12:46:44', NULL);
INSERT INTO `menus` VALUES (24, NULL, 'home', 'home', 'Home', 'fa fa-dashboard', 0, '1', 'patients', '1', '2019-08-12 21:22:53', NULL);
INSERT INTO `menus` VALUES (26, 8, 'booking_checkup', 'booking', 'Booking Checkup', 'fa fa-calendar', 0, '2', 'patients', '1', '2019-08-14 16:21:52', NULL);
INSERT INTO `menus` VALUES (27, 13, 'drug_purchase', 'drug_purchase', 'Penjualan', '', 1, '6', 'adminpanel', '0', '2019-09-14 10:35:35', NULL);
INSERT INTO `menus` VALUES (28, 13, 'supplier', 'supplier', 'Supplier', NULL, 1, '1', 'adminpanel', '0', '2019-09-18 13:23:26', NULL);
INSERT INTO `menus` VALUES (29, 17, 'supplier', 'supplier', 'Supplier', NULL, 2, '5', 'adminpanel', '0', '2019-09-19 10:21:55', NULL);
INSERT INTO `menus` VALUES (30, 17, 'purchase_return', 'purchase_return', 'Purchase Return', NULL, 2, '6', 'adminpanel', '0', '2019-09-19 10:23:22', NULL);
INSERT INTO `menus` VALUES (31, 17, 'purchase', 'purchase', 'purchase', NULL, 2, '7', 'adminpanel', '0', '2019-09-19 11:24:07', NULL);
INSERT INTO `menus` VALUES (32, 13, 'purchase', 'purchase', 'Pembelian', NULL, 1, '5', 'adminpanel', '0', '2019-09-19 13:34:08', NULL);
INSERT INTO `menus` VALUES (33, 13, 'purchase_return', 'purchase_return', 'Retur Pembelian', NULL, 1, '8', 'adminpanel', '0', '2019-09-24 23:52:12', NULL);
INSERT INTO `menus` VALUES (34, 17, 'drug_purchase', 'drug_purchase', 'Sales', NULL, 2, '8', 'adminpanel', '0', '2019-09-25 19:03:03', NULL);
INSERT INTO `menus` VALUES (35, 13, 'gudang', 'gudang', 'Gudang', NULL, 1, '3', 'adminpanel', '0', '2019-09-25 21:15:27', NULL);
INSERT INTO `menus` VALUES (36, 17, 'sales_return', 'sales_return', 'Sales Return', NULL, 2, '9', 'adminpanel', '0', '2019-09-26 16:18:14', NULL);
INSERT INTO `menus` VALUES (37, 13, 'sales_return', 'sales_return', 'Retur Penjualan', NULL, 1, '9', 'adminpanel', '0', '2019-09-26 16:23:57', NULL);
INSERT INTO `menus` VALUES (38, 13, 'type_drugs', 'type_drugs', 'Kategori', NULL, 1, '4', 'adminpanel', '0', '2019-09-28 06:11:54', NULL);
INSERT INTO `menus` VALUES (39, 13, 'mutasi', 'mutasi', 'Mutasi', NULL, 1, '10', 'adminpanel', '0', '2019-10-09 10:18:57', NULL);
INSERT INTO `menus` VALUES (40, 13, 'mutasi_jual', 'mutasi_jual', 'Mutasi Jual', NULL, 1, '11', 'adminpanel', '0', '2019-10-10 10:04:04', NULL);
INSERT INTO `menus` VALUES (41, 2, 'customer', 'customer', 'Customer', NULL, 1, '5', 'adminpanel', '0', '2019-11-05 09:34:50', NULL);

-- ----------------------------
-- Table structure for patients
-- ----------------------------
DROP TABLE IF EXISTS `patients`;
CREATE TABLE `patients`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `civilian_id` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `patient_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `gender` char(15) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `religion` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `place_of_birth` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `date_of_birth` date NULL DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `blood_type` char(5) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of patients
-- ----------------------------
INSERT INTO `patients` VALUES (1, 6, '39061114575001', '2019.07.24.00001', 'test', 'male', 'test', 'test', 'Test', '1913-02-04', '564', NULL, 'a', '4ff33b9c68b1c70053f9107e41ab973c.jpg', '2019-07-11 11:12:23', '2019-08-07 17:49:01');
INSERT INTO `patients` VALUES (2, 7, '2019.8.8.00001', '2019.08.08.00002', 'noname', 'female', 'Sidoarjo', 'Islam', 'Sidoarjo', '1991-12-19', '0852', 'nn@mail.com', 'a', 'b3503b9c4d088875064e903ce321092c.jpg', '2019-08-08 08:33:20', '2019-08-21 12:23:31');
INSERT INTO `patients` VALUES (3, 11, '101010', '2019.11.05.00003', 'mawar', 'female', 'kediri', 'islam', 'kediri', '1991-12-19', '0852', 'mawar@gmail.com', 'a', 'eb5891d21820fe6001accfc83e8cef2d.png', '2019-11-05 11:42:00', '2019-11-05 11:45:25');

-- ----------------------------
-- Table structure for polies
-- ----------------------------
DROP TABLE IF EXISTS `polies`;
CREATE TABLE `polies`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of polies
-- ----------------------------
INSERT INTO `polies` VALUES (1, 'Poli Anak', 'Ini adalah ruangan untuk periksa anak!', '2019-07-04 15:09:15', '2019-07-31 18:31:14');
INSERT INTO `polies` VALUES (2, 'Poli THT', 'Tukang Habisin Tahu', '2019-07-22 16:39:53', NULL);
INSERT INTO `polies` VALUES (3, 'Poli UHT', 'Susu Ultra UHT', '2019-07-22 16:40:07', NULL);
INSERT INTO `polies` VALUES (4, 'Poli Dewasa', 'Orang Dewasa', '2019-07-22 16:40:22', '2019-08-13 23:34:43');
INSERT INTO `polies` VALUES (5, 'Poli Kandungan', 'Melahirkan, Ibu Hamil', '2019-08-13 23:34:15', NULL);

-- ----------------------------
-- Table structure for privileges
-- ----------------------------
DROP TABLE IF EXISTS `privileges`;
CREATE TABLE `privileges`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `level` int(1) NULL DEFAULT NULL,
  `module` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of privileges
-- ----------------------------
INSERT INTO `privileges` VALUES (2, 'Developer', 0, 'adminpanel', '2019-07-25 14:21:47', '2019-08-12 17:18:44');
INSERT INTO `privileges` VALUES (3, 'Admin', 1, 'adminpanel', '2019-07-25 14:21:54', '2019-09-13 12:50:40');
INSERT INTO `privileges` VALUES (4, 'Employee', 2, NULL, '2019-07-25 14:22:00', NULL);
INSERT INTO `privileges` VALUES (5, 'Patient', 2, 'patients', '2019-07-25 14:22:06', '2019-08-12 17:19:20');

-- ----------------------------
-- Table structure for purchase
-- ----------------------------
DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `supplier_id` varchar(10) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `total_bayar` decimal(17, 0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase
-- ----------------------------
INSERT INTO `purchase` VALUES (39, 'XIX.11.VII.01', '19.09.20.2', 600000, '2019-11-07 05:57:50', NULL);

-- ----------------------------
-- Table structure for purchase_faktur
-- ----------------------------
DROP TABLE IF EXISTS `purchase_faktur`;
CREATE TABLE `purchase_faktur`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_purchase` int(10) NULL DEFAULT NULL,
  `drug_id` int(10) NULL DEFAULT NULL,
  `barcode` char(13) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price` decimal(17, 2) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `subtotal` decimal(17, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 132 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_faktur
-- ----------------------------
INSERT INTO `purchase_faktur` VALUES (127, 39, 2, '3800065711131', 'Barang A', 10000.00, 10, 100000.00, '2019-11-07 05:57:51');
INSERT INTO `purchase_faktur` VALUES (128, 39, 3, '3800065711132', 'Barang B', 15000.00, 10, 150000.00, '2019-11-07 05:57:51');
INSERT INTO `purchase_faktur` VALUES (129, 39, 4, '3800065711133', 'Barang C', 10000.00, 10, 100000.00, '2019-11-07 05:57:51');
INSERT INTO `purchase_faktur` VALUES (130, 39, 5, '3800065711134', 'Barang D', 10000.00, 10, 100000.00, '2019-11-07 05:57:51');
INSERT INTO `purchase_faktur` VALUES (131, 39, 6, '3800065711135', 'Barang E', 15000.00, 10, 150000.00, '2019-11-07 05:57:51');

-- ----------------------------
-- Table structure for purchase_return
-- ----------------------------
DROP TABLE IF EXISTS `purchase_return`;
CREATE TABLE `purchase_return`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_retur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `no_faktur_id` int(10) NULL DEFAULT NULL,
  `drug_id` int(10) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_return
-- ----------------------------
INSERT INTO `purchase_return` VALUES (10, '2019.11.07.1.', 39, 3, 1, 'Rusak', '2019-11-07 05:59:05', '2019-11-07 06:10:29');

-- ----------------------------
-- Table structure for purchasedrug_sales
-- ----------------------------
DROP TABLE IF EXISTS `purchasedrug_sales`;
CREATE TABLE `purchasedrug_sales`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `drugpurchase_id` int(10) NULL DEFAULT NULL,
  `drug_id` int(10) NULL DEFAULT NULL,
  `barcode` char(13) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `price` decimal(17, 2) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `subtotal` decimal(17, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 108 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchasedrug_sales
-- ----------------------------
INSERT INTO `purchasedrug_sales` VALUES (106, 54, 2, '3800065711131', 'Barang A', 15000.00, 2, 30000.00, '2019-11-07 05:58:28');
INSERT INTO `purchasedrug_sales` VALUES (107, 54, 3, '3800065711132', 'Barang B', 20000.00, 1, 20000.00, '2019-11-07 05:58:28');

-- ----------------------------
-- Table structure for sale
-- ----------------------------
DROP TABLE IF EXISTS `sale`;
CREATE TABLE `sale`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_faktur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `patient_id` int(10) NULL DEFAULT NULL,
  `date_in` datetime(0) NULL DEFAULT NULL,
  `selling_price` decimal(17, 2) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for sales_return
-- ----------------------------
DROP TABLE IF EXISTS `sales_return`;
CREATE TABLE `sales_return`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_retur` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `no_faktur_id` int(10) NULL DEFAULT NULL,
  `drug_id` int(10) NULL DEFAULT NULL,
  `quantity` int(10) NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_return
-- ----------------------------
INSERT INTO `sales_return` VALUES (4, '19.11.07.02', 54, 2, 1, 'kadaluarsa', '2019-11-07 06:08:49', '2019-11-07 06:09:19');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `supplier_code` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `city_id` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (5, '19.09.19.1', 'Agus', 'Jl. Sama aku, nikah sama dia', 1, '2019-09-19 11:04:48', '2019-09-19 13:28:03');
INSERT INTO `supplier` VALUES (7, '19.09.20.2', 'Budi', 'jl. pattimura', 2, '2019-09-20 07:43:52', NULL);
INSERT INTO `supplier` VALUES (10, '19.09.25.3', 'nn', 'jl. jalan', 3, '2019-09-25 03:02:26', NULL);

-- ----------------------------
-- Table structure for type_drugs
-- ----------------------------
DROP TABLE IF EXISTS `type_drugs`;
CREATE TABLE `type_drugs`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_drugs
-- ----------------------------
INSERT INTO `type_drugs` VALUES (1, 'Makanan', '2019-09-28 06:08:54', '2019-11-04 14:12:51');
INSERT INTO `type_drugs` VALUES (2, 'Minuman', '2019-09-28 06:08:56', '2019-11-04 14:13:07');
INSERT INTO `type_drugs` VALUES (3, 'Obat', '2019-09-28 06:35:43', '2019-11-04 14:13:29');

-- ----------------------------
-- Table structure for user_privileges
-- ----------------------------
DROP TABLE IF EXISTS `user_privileges`;
CREATE TABLE `user_privileges`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NULL DEFAULT NULL,
  `privilege_id` int(10) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user_privileges
-- ----------------------------
INSERT INTO `user_privileges` VALUES (1, 3, 3, '2019-07-26 12:55:15', '2019-07-26 13:14:45');
INSERT INTO `user_privileges` VALUES (3, 1, 2, '2019-07-26 13:13:38', '2019-07-26 13:14:32');
INSERT INTO `user_privileges` VALUES (4, 4, 4, '2019-07-31 14:45:06', '2019-08-20 12:51:40');
INSERT INTO `user_privileges` VALUES (5, 5, 4, '2019-08-01 13:04:30', NULL);
INSERT INTO `user_privileges` VALUES (6, 6, 5, '2019-08-01 21:50:32', '2019-08-07 17:49:01');
INSERT INTO `user_privileges` VALUES (7, 7, 5, '2019-08-08 08:33:20', '2019-08-21 12:23:31');
INSERT INTO `user_privileges` VALUES (8, 8, 3, '2019-08-13 23:32:42', NULL);
INSERT INTO `user_privileges` VALUES (9, 9, 2, '2019-08-13 23:39:28', NULL);
INSERT INTO `user_privileges` VALUES (10, 10, 4, '2019-11-05 09:12:07', '2019-11-05 11:58:03');
INSERT INTO `user_privileges` VALUES (11, 11, 5, '2019-11-05 11:41:59', '2019-11-05 11:51:05');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = latin1 COLLATE = latin1_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin', '$2y$12$OQ05G2OY0I0Uk9qdAEEINOMXe3MMjd/OoClBT6xyATQo4kZk0w/jW', 'Admin', '2019-06-24 23:05:12', '2019-07-26 13:14:32');
INSERT INTO `users` VALUES (3, 'admin_test', '$2y$12$tIzzpMrOxs1sjn5eAU6xb.tOt7cJ.mUzZt91BtdqrTBPPU7bmF8yC', 'Admin Test', '2019-06-30 22:06:57', '2019-07-26 13:14:45');
INSERT INTO `users` VALUES (10, 'noname', '$2y$12$KO0nEJFZhTnDKi5pEUF2BOtcZZJm49MR1XmG8qb2tXGW1zmhv77VW', 'Noname', '2019-11-05 09:12:07', '2019-11-05 11:58:03');
INSERT INTO `users` VALUES (11, 'mawar', '$2y$12$vEBNbUWr26tjHNiVk4wR.Omy5SPW7iEiNv0VP8Iuvb99hN/iJhQXO', 'mawar merah', '2019-11-05 11:41:59', '2019-11-05 11:51:05');

SET FOREIGN_KEY_CHECKS = 1;
