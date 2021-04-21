/*
Navicat MySQL Data Transfer

Source Server         : test
Source Server Version : 80016
Source Host           : localhost:3306
Source Database       : stum

Target Server Type    : MYSQL
Target Server Version : 80016
File Encoding         : 65001

Date: 2021-04-21 20:05:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `sno` char(12) NOT NULL,
  `sname` char(8) NOT NULL,
  `sex` enum('男','女') DEFAULT '男',
  `sbirthday` date DEFAULT NULL,
  `sdept` varchar(10) DEFAULT NULL,
  `smajor` varchar(20) DEFAULT NULL,
  `spolitic` char(5) DEFAULT NULL,
  `saddress` varchar(20) DEFAULT NULL,
  `sphone` char(12) DEFAULT NULL,
  `sphoto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('2015002', '222', '女', '1991-06-23', '数学学院', '数学分析', '党员', '上海', '135222', null);
INSERT INTO `students` VALUES ('2015003', '李小娥', '女', '1990-10-21', '外语学院', '日语', '团员', '北京', '135333', 'd:\\pic\\3.jpg');
INSERT INTO `students` VALUES ('2015004', '唐三藏', '男', '1989-01-05', '计算机学院', '软件工程', '党员', '上海', '135444', null);
INSERT INTO `students` VALUES ('2015005', '哪吒', '男', '1988-03-11', '数学学院', '数学建模', '团员', '北京', '135555', null);
INSERT INTO `students` VALUES ('2015006', '玉皇小帝', '男', '1988-07-10', '外语学院', '英语教育', '群众', '上海', '135666', null);
INSERT INTO `students` VALUES ('2015007', '刘惠友', '男', '1991-09-03', '设计学院', '园林设计', '群众', '广州', '135777', 'd:\\pic\\7.jpg');
INSERT INTO `students` VALUES ('2015008', '张惠妹', '女', '1992-12-10', '音乐学院', '音乐教育', '团员', '天津', '135888', null);
INSERT INTO `students` VALUES ('2015009', '张学友', '男', '1991-11-21', '音乐学院', '声乐器乐', '党员', '北京', '135999', null);
INSERT INTO `students` VALUES ('2015010', '刘亦菲', '女', '1992-05-31', '计算机学院', '网络技术', '民盟', '广州', '136111', null);
INSERT INTO `students` VALUES ('2015011', 'marry', '女', '1990-06-23', '计算机学院', '数字媒体', '群众', '上海', '159111', null);
INSERT INTO `students` VALUES ('2015012', 'lily', '女', '1990-06-25', '数学学院', '数学分析', '团员', '深圳', '188666', null);
DROP TRIGGER IF EXISTS `t_delete`;
DELIMITER ;;
CREATE TRIGGER `t_delete` AFTER DELETE ON `students` FOR EACH ROW begin 
delete from score where sno =old.sno;
end
;;
DELIMITER ;
