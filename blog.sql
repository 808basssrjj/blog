/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50726
Source Host           : localhost:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50726
File Encoding         : 65001

Date: 2020-10-08 15:50:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for b_article
-- ----------------------------
DROP TABLE IF EXISTS `b_article`;
CREATE TABLE `b_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_title` varchar(20) NOT NULL,
  `a_content` text NOT NULL,
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `a_author` varchar(10) NOT NULL,
  `a_time` int(10) unsigned NOT NULL,
  `a_status` tinyint(4) DEFAULT '1' COMMENT '1表示草稿，2表示公开，3表示隐藏',
  `a_toped` tinyint(4) DEFAULT '1' COMMENT '1表示不置顶，2表示置顶',
  `a_img` varchar(50) DEFAULT NULL,
  `a_img_thumb` varchar(50) DEFAULT NULL,
  `a_is_delete` tinyint(4) DEFAULT '0' COMMENT '0表示正常，1表示已删除',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_article
-- ----------------------------
INSERT INTO `b_article` VALUES ('3', '信条', '好看', '8', '5', 'admin', '1601963875', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('4', '致命魔术', '好看', '8', '5', 'admin', '1601964035', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('5', '记忆碎片', '好看', '8', '5', 'admin', '1601964072', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('6', '海贼王', '好看', '8', '3', 'xiaowang', '1601964186', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('7', '盗梦空间', 'good good', '8', '5', 'admin', '1601965552', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('8', '进击的巨人', '12月最后一季', '9', '5', 'admin', '1601984825', '2', '2', '', null, '0');
INSERT INTO `b_article` VALUES ('12', '一拳超人', 'aaaaa', '9', '5', 'admin', '1601988220', '2', '2', null, null, '0');
INSERT INTO `b_article` VALUES ('11', '火影忍者', 'aaaa', '9', '5', 'admin', '1601988024', '3', '2', null, null, '0');
INSERT INTO `b_article` VALUES ('13', '复仇者联盟', '钢铁侠', '8', '5', 'admin', '1601988335', '2', '1', null, null, '0');
INSERT INTO `b_article` VALUES ('14', '美国队长', '啊', '8', '5', 'admin', '1601988455', '2', '1', null, null, '0');
INSERT INTO `b_article` VALUES ('15', '蜘蛛侠', 'xcfd', '8', '5', 'admin', '1601988579', '2', '2', null, null, '0');
INSERT INTO `b_article` VALUES ('16', '蜘蛛侠', '猪猪', '8', '5', 'admin', '1601989188', '2', '2', null, null, '0');
INSERT INTO `b_article` VALUES ('17', '绿巨人', '山东分公司', '8', '5', 'admin', '1601989282', '2', '2', 'image20201006210122KAEALA.jpg', 'thumb_image20201006210122KAEALA.jpg', '0');
INSERT INTO `b_article` VALUES ('23', '死神', '死神', '9', '5', 'admin', '1602054867', '2', '2', '20201007151427AUOZCG.jpeg', 'thumb_20201007151427AUOZCG.jpeg', '0');
INSERT INTO `b_article` VALUES ('19', 'MVC思想', 'MVC就是控制器模型视图', '6', '5', 'admin', '1602034069', '2', '2', 'image20201007092749XCBKKY.jpeg', 'thumb_20201007151427AUOZCG.jpeg', '0');
INSERT INTO `b_article` VALUES ('22', '东京喰种', '金木', '9', '5', 'admin', '1602038401', '2', '1', 'image20201007092749XCBKKY.jpeg', 'thumb_20201007104001YQNDLA.jpg', '0');
INSERT INTO `b_article` VALUES ('24', 'smarty模板技术', 'smarty模板技术', '7', '5', 'admin', '1602058176', '2', '2', '20201007160936ULWMYZ.jpg', 'thumb_20201007160936ULWMYZ.jpg', '0');

-- ----------------------------
-- Table structure for b_category
-- ----------------------------
DROP TABLE IF EXISTS `b_category`;
CREATE TABLE `b_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(10) NOT NULL,
  `c_sort` int(10) unsigned DEFAULT '0',
  `c_parent_id` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `c_name` (`c_name`,`c_parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_category
-- ----------------------------
INSERT INTO `b_category` VALUES ('1', 'IT技术', '0', '0');
INSERT INTO `b_category` VALUES ('2', '电子商务', '0', '0');
INSERT INTO `b_category` VALUES ('8', ' 电影 ', '9', '0');
INSERT INTO `b_category` VALUES ('4', 'PHP', '0', '1');
INSERT INTO `b_category` VALUES ('5', '面向对象', '12', '4');
INSERT INTO `b_category` VALUES ('6', 'MVC思想', '0', '4');
INSERT INTO `b_category` VALUES ('7', 'smarty模板技术', '11', '4');
INSERT INTO `b_category` VALUES ('9', '动漫', '1', '0');

-- ----------------------------
-- Table structure for b_comment
-- ----------------------------
DROP TABLE IF EXISTS `b_comment`;
CREATE TABLE `b_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `c_comment` varchar(50) NOT NULL,
  `c_time` int(10) unsigned NOT NULL,
  `u_id` int(10) unsigned NOT NULL,
  `a_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_comment
-- ----------------------------
INSERT INTO `b_comment` VALUES ('2', '真的好看', '1602075820', '6', '23');

-- ----------------------------
-- Table structure for b_user
-- ----------------------------
DROP TABLE IF EXISTS `b_user`;
CREATE TABLE `b_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_username` varchar(10) NOT NULL,
  `u_password` char(32) NOT NULL,
  `u_reg_time` int(10) unsigned NOT NULL,
  `u_is_admin` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0代表普通用户，1代表管理员',
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_username` (`u_username`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of b_user
-- ----------------------------
INSERT INTO `b_user` VALUES ('5', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1601902249', '1');
INSERT INTO `b_user` VALUES ('8', '索隆', 'e10adc3949ba59abbe56e057f20f883e', '1602072800', '0');
