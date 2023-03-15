/*
 Navicat Premium Data Transfer

 Source Server         : Linux xToff [Debian 9]
 Source Server Type    : MySQL
 Source Server Version : 100148
 Source Host           : 192.168.56.3:3306
 Source Schema         : web_dev_0323

 Target Server Type    : MySQL
 Target Server Version : 100148
 File Encoding         : 65001

 Date: 10/11/2022 08:04:29
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for t_menu
-- ----------------------------
DROP TABLE IF EXISTS `t_menu`;
CREATE TABLE `t_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_menu` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_menu
-- ----------------------------
INSERT INTO `t_menu` VALUES (1, 'HOME', 'index.php', 1, 0);
INSERT INTO `t_menu` VALUES (2, 'TDM 2019', 'index.php?to=tdm', 2, 0);
INSERT INTO `t_menu` VALUES (3, 'DIAPORAMA', 'index.php?to=diaporama', 3, 0);
INSERT INTO `t_menu` VALUES (4, 'MOSAIC', 'index.php?to=mosaic', 4, 0);
INSERT INTO `t_menu` VALUES (5, 'Sous Menu 1 TDM 2019', 'index.php?to=tdm&1', 1, 2);
INSERT INTO `t_menu` VALUES (6, 'Sous Menu 2 TDM 2019', 'index.php?to=tdm&1', 1, 2);
INSERT INTO `t_menu` VALUES (7, 'Sous Menu 3 TDM 2019', 'index.php?to=tdm&1', 1, 2);
INSERT INTO `t_menu` VALUES (8, 'Sous sous Menu 1 TDM', 'index.php?to=tdm&1', 1, 5);

-- ----------------------------
-- Table structure for t_mod
-- ----------------------------
DROP TABLE IF EXISTS `t_mod`;
CREATE TABLE `t_mod`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_mod
-- ----------------------------
INSERT INTO `t_mod` VALUES (1, 'home');
INSERT INTO `t_mod` VALUES (2, 'galerie');
INSERT INTO `t_mod` VALUES (3, 'upload');
INSERT INTO `t_mod` VALUES (4, 'user');
INSERT INTO `t_mod` VALUES (5, 'Pays');
INSERT INTO `t_mod` VALUES (6, 'ville');
INSERT INTO `t_mod` VALUES (7, 'module');

-- ----------------------------
-- Table structure for t_pays
-- ----------------------------
DROP TABLE IF EXISTS `t_pays`;
CREATE TABLE `t_pays`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_pays
-- ----------------------------
INSERT INTO `t_pays` VALUES (1, 'France');
INSERT INTO `t_pays` VALUES (2, 'USA');

-- ----------------------------
-- Table structure for t_photo
-- ----------------------------
DROP TABLE IF EXISTS `t_photo`;
CREATE TABLE `t_photo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `fichier` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `ordre` int(11) NULL DEFAULT NULL,
  `fk_user` int(11) NULL DEFAULT NULL,
  `r` int(11) NULL DEFAULT NULL,
  `g` int(11) NULL DEFAULT NULL,
  `b` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for t_user
-- ----------------------------
DROP TABLE IF EXISTS `t_user`;
CREATE TABLE `t_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `prenom` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `login` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `code_postal` int(11) NULL DEFAULT NULL,
  `fk_ville` int(11) NULL DEFAULT NULL,
  `fk_pays` int(11) NULL DEFAULT NULL,
  `isAdmin` int(11) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_user
-- ----------------------------
INSERT INTO `t_user` VALUES (1, 'Administrateur', 'Back Office', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'user1@mail.com', 'img_6368f1d017ff8.png', 'Rue User 1', 97000, 1, 1, 1);

-- ----------------------------
-- Table structure for t_user_mod
-- ----------------------------
DROP TABLE IF EXISTS `t_user_mod`;
CREATE TABLE `t_user_mod`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_user` int(11) NULL DEFAULT NULL,
  `fk_mod` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 129 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_user_mod
-- ----------------------------
INSERT INTO `t_user_mod` VALUES (122, 1, 1);
INSERT INTO `t_user_mod` VALUES (123, 1, 2);
INSERT INTO `t_user_mod` VALUES (124, 1, 3);
INSERT INTO `t_user_mod` VALUES (125, 1, 4);
INSERT INTO `t_user_mod` VALUES (126, 1, 5);
INSERT INTO `t_user_mod` VALUES (127, 1, 6);
INSERT INTO `t_user_mod` VALUES (128, 1, 7);

-- ----------------------------
-- Table structure for t_ville
-- ----------------------------
DROP TABLE IF EXISTS `t_ville`;
CREATE TABLE `t_ville`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `id`(`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of t_ville
-- ----------------------------
INSERT INTO `t_ville` VALUES (1, 'Saint-Denis');
INSERT INTO `t_ville` VALUES (3, 'Le Port');
INSERT INTO `t_ville` VALUES (4, 'Saint-Pierre');
INSERT INTO `t_ville` VALUES (6, 'La Tampon');

SET FOREIGN_KEY_CHECKS = 1;
