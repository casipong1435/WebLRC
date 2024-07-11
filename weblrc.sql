/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : weblrc

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-05-23 00:16:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for activities
-- ----------------------------
DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `activity` text NOT NULL,
  `log_time` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of activities
-- ----------------------------

-- ----------------------------
-- Table structure for books
-- ----------------------------
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `accession_number` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date_acquired` date NOT NULL,
  `author` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `edition` varchar(255) DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `extent` varchar(255) DEFAULT NULL,
  `funding_source` varchar(255) DEFAULT NULL,
  `purchase_price` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `publication_year` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `program` varchar(255) DEFAULT NULL,
  `course_code` varchar(255) DEFAULT NULL,
  `isbn` varchar(255) NOT NULL,
  `course_title` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`accession_number`)
) ENGINE=InnoDB AUTO_INCREMENT=7734 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of books
-- ----------------------------

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for genres
-- ----------------------------
DROP TABLE IF EXISTS `genres`;
CREATE TABLE `genres` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `genre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of genres
-- ----------------------------
INSERT INTO `genres` VALUES ('1', 'Filipiniana', null, null);
INSERT INTO `genres` VALUES ('2', 'General Reference', null, null);
INSERT INTO `genres` VALUES ('3', 'Fiction', null, null);
INSERT INTO `genres` VALUES ('4', 'Arts and Sciences', null, null);
INSERT INTO `genres` VALUES ('5', 'Criminology', null, null);
INSERT INTO `genres` VALUES ('6', 'Business', null, null);
INSERT INTO `genres` VALUES ('7', 'Computer Studies', null, null);
INSERT INTO `genres` VALUES ('8', 'Education', null, null);
INSERT INTO `genres` VALUES ('9', 'Midwifery', null, null);
INSERT INTO `genres` VALUES ('10', 'Special Collection', null, null);
INSERT INTO `genres` VALUES ('11', 'Bangko Sentral ng Pilipina (BSP)', null, null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('8', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('9', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('10', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('11', '2024_04_06_114041_create_books_table', '1');
INSERT INTO `migrations` VALUES ('12', '2024_04_17_021022_create_activities_table', '1');
INSERT INTO `migrations` VALUES ('13', '2024_04_18_045533_create_genres_table', '1');
INSERT INTO `migrations` VALUES ('14', '2024_04_18_053213_create_programs_table', '1');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for programs
-- ----------------------------
DROP TABLE IF EXISTS `programs`;
CREATE TABLE `programs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `program` varchar(255) NOT NULL,
  `program_title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of programs
-- ----------------------------
INSERT INTO `programs` VALUES ('1', 'BSBA-HRM', 'Bachelor of Science in Business Administration Major in Human Resource Management', null, null);
INSERT INTO `programs` VALUES ('2', 'BSBA-MM', 'Bachelor of Science in Business Administration Major in Marketing Management', null, null);
INSERT INTO `programs` VALUES ('3', 'BSOA', 'Bachelor of Science in Office Administration', null, null);
INSERT INTO `programs` VALUES ('4', 'BEED', 'Bachelor of Elementary Education', null, null);
INSERT INTO `programs` VALUES ('5', 'BSED-ENGLISH', 'Bachelor of Secondary Education Major in English', null, null);
INSERT INTO `programs` VALUES ('6', 'BSED-FILIPINO', 'Bachelor of Secondary Education Major in Filipino', null, null);
INSERT INTO `programs` VALUES ('7', 'BSED-MATH', 'Bachelor of Secondary Education Major in Math', null, null);
INSERT INTO `programs` VALUES ('8', 'BSED-SOCSTUD', 'Bachelor of Secondary Education Major in Social Studies', null, null);
INSERT INTO `programs` VALUES ('9', 'BS CRIM', 'Bachelor of Science in Criminology', null, null);
INSERT INTO `programs` VALUES ('10', 'BSISM', 'Bachelor of Science in Industrial Security Management', null, null);
INSERT INTO `programs` VALUES ('11', 'BSCS', 'Bachelor of Science in Computer Science', null, null);
INSERT INTO `programs` VALUES ('12', 'AB COMM', 'Bachelor of Arts in Communication', null, null);
INSERT INTO `programs` VALUES ('13', 'AB English', 'Bachelor of Arts in English Language', null, null);
INSERT INTO `programs` VALUES ('14', 'AB POLSCI', 'Bachelor of Arts in Political Science', null, null);
INSERT INTO `programs` VALUES ('15', 'GEN MID', 'Diploma in Midwifery', null, null);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'tcgc_lrc', null, null, '$2y$10$QG88GdIBWE6I.j.GXqZN.OySCFQIlxEiozDVSqBZ5GOK1Ns/SLgNW', null, '2024-05-22 16:12:29', '2024-05-22 16:12:29');
