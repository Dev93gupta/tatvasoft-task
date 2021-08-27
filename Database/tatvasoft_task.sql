/*
 Navicat Premium Data Transfer

 Source Server         : localhost_5_3306
 Source Server Type    : MySQL
 Source Server Version : 100410
 Source Host           : 127.0.0.1:3306
 Source Schema         : tatvasoft_task

 Target Server Type    : MySQL
 Target Server Version : 100410
 File Encoding         : 65001

 Date: 27/08/2021 19:48:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for registration
-- ----------------------------
DROP TABLE IF EXISTS `registration`;
CREATE TABLE `registration`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `confirm_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  `updated_date` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `updated_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of registration
-- ----------------------------
INSERT INTO `registration` VALUES (1, 'test', 'test', 'test@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2021-08-27 17:04:03', '2021-08-27 17:04:03', 0, 1);
INSERT INTO `registration` VALUES (2, 'test', 'test', 'second@user.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '7c4a8d09ca3762af61e59520943dc26494f8941b', '2021-08-27 17:07:39', NULL, 0, 1);
INSERT INTO `registration` VALUES (4, 'test', 'test', 'test@user.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '2021-08-27 17:12:21', NULL, 0, 1);

SET FOREIGN_KEY_CHECKS = 1;
