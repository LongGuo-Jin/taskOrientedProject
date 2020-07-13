/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : barkrz

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2020-06-30 15:15:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `failed_jobs`
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('2', '2019_08_19_000000_create_failed_jobs_table', '1');
INSERT INTO `migrations` VALUES ('16', '2020_06_04_175819_create_pets_table', '2');
INSERT INTO `migrations` VALUES ('17', '2020_06_10_122454_create_owners_table', '2');

-- ----------------------------
-- Table structure for `owners`
-- ----------------------------
DROP TABLE IF EXISTS `owners`;
CREATE TABLE `owners` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `pet_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `owners_pet_id_foreign` (`pet_id`),
  CONSTRAINT `owners_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of owners
-- ----------------------------
INSERT INTO `owners` VALUES ('3', '9', 'Xiao Zhe', '+13050740124', '2020-06-10 15:45:26', '2020-06-12 19:19:12');
INSERT INTO `owners` VALUES ('109', '8', 'Zhen', '1234567', '2020-06-12 18:36:40', '2020-06-12 18:51:01');
INSERT INTO `owners` VALUES ('113', '8', 'asd', '221121221', '2020-06-12 18:45:21', '2020-06-12 18:51:01');
INSERT INTO `owners` VALUES ('119', '9', 'Zhen', 'sdaf', '2020-06-12 19:19:12', '2020-06-12 19:19:12');
INSERT INTO `owners` VALUES ('120', '10', 'Xiao Zhe', '+13050740124', '2020-06-22 12:12:00', '2020-06-22 12:12:00');
INSERT INTO `owners` VALUES ('121', '10', 'Xiao Zhen', '+13050740124', '2020-06-22 12:12:00', '2020-06-22 12:12:00');
INSERT INTO `owners` VALUES ('122', '10', 'Yang', '+13050740124', '2020-06-22 12:12:00', '2020-06-22 12:12:00');

-- ----------------------------
-- Table structure for `pets`
-- ----------------------------
DROP TABLE IF EXISTS `pets`;
CREATE TABLE `pets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `breed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `medicalCondition` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `temperament` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `neutered` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of pets
-- ----------------------------
INSERT INTO `pets` VALUES ('8', 'Max', 'male', 'http://192.168.6.162/barkrz-backend/storage/app/pets/061220200248495ee2ed11e5e1a.jpeg', 'Dog', 'Alameda Street Los Angeles', '2018', '12 lbs', 'hunter', null, 'neutered', '2020-06-10 15:11:48', '2020-06-12 02:48:49');
INSERT INTO `pets` VALUES ('9', 'Mimu', 'female', 'http://192.168.6.162/barkrz-backend/storage/app/pets/061220201856295ee3cfdd02617.jpeg', 'Cat', 'assa', '2017', '14 lbs', 'Wolf', null, 'unneutered', '2020-06-10 15:45:26', '2020-06-12 18:56:29');
INSERT INTO `pets` VALUES ('10', 'Science', 'male', 'http://192.168.6.162/barkrz-backend/storage/app/pets/062220201212005ef0a010c386e.jpeg', 'Dalmition', 'Alameda Street Los Angeles', '2020', '14 lbs', 'Great', '10101101', 'Neutered', '2020-06-22 12:12:00', '2020-06-22 12:12:00');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'xiao zhe', 'mgeagle75@gmail.com', null, '$2y$10$Vk2qsvaIrkuLGPbqXgAXcukEe4C6Yk1daegxujnC6MoZLyaAlpRwa', null, '2020-06-04 13:15:49', '2020-06-10 17:46:16');
INSERT INTO `users` VALUES ('44', ' ', 'angel@gmail.com', null, '$2y$10$eClBTbhV0w2KCiv3OLO42en1Gr.EDGhHdzaSNgSvZjKaRYHM47Ix2', null, '2020-06-10 17:42:51', '2020-06-22 12:10:33');
