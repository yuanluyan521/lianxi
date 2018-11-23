/*
Navicat MySQL Data Transfer

Source Server         : 20180719
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : 1606c

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-23 18:59:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for scorelog
-- ----------------------------
DROP TABLE IF EXISTS `scorelog`;
CREATE TABLE `scorelog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `goods_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of scorelog
-- ----------------------------
INSERT INTO `scorelog` VALUES ('1', '1', '1', '10', '1540291675');
INSERT INTO `scorelog` VALUES ('2', '1', '1', '10', '1540291697');
INSERT INTO `scorelog` VALUES ('3', '1', '2', '20', '1540291708');
INSERT INTO `scorelog` VALUES ('4', '1', '3', '30', '1540291732');
INSERT INTO `scorelog` VALUES ('5', '1', '2', '20', '1540291757');
INSERT INTO `scorelog` VALUES ('6', '1', '1', '10', '1540292068');
INSERT INTO `scorelog` VALUES ('7', '1', '1', '10', '1540292136');
INSERT INTO `scorelog` VALUES ('8', '1', '1', '10', '1540292143');
