/*
Navicat MySQL Data Transfer

Source Server         : 20180719
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : 1606c

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-10-23 18:59:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for goods
-- ----------------------------
DROP TABLE IF EXISTS `goods`;
CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(22) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT '0' COMMENT '兑换此商品需要扣除的积分',
  `stock` int(11) DEFAULT '100' COMMENT '商品库存',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of goods
-- ----------------------------
INSERT INTO `goods` VALUES ('1', '华为手机', 'uploads/1.jpg', '10', '95');
INSERT INTO `goods` VALUES ('2', '三星手机', 'uploads/2.jpg', '20', '98');
INSERT INTO `goods` VALUES ('3', '小米手机', 'uploads/3.jpg', '30', '99');
