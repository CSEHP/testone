# 创建数据库
CREATE DATABASE `myframe`;
USE `myframe`;

# 创建学生表
CREATE TABLE `student` (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '学生id',
  `name` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `gender` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '性别',
  `email` VARCHAR(128) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '手机号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

# 添加测试数据
INSERT INTO `student` VALUES
(1, 'Allen', '男', 'allen@myframe.test', '12300004567'),
(2, 'James', '男', 'james@myframe.test', '12311114567'),
(3, 'Rose', '女', 'rose@myframe.test', '12322224567'),
(4, 'Mary', '女', 'mary@myframe.test', '12333334567');

# 创建教师表
CREATE TABLE `teacher` (
  `id` INT UNSIGNED PRIMARY KEY AUTO_INCREMENT COMMENT '教师id',
  `name` VARCHAR(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `department` VARCHAR(32) NOT NULL DEFAULT '' COMMENT '学院',
  `email` VARCHAR(128) NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` VARCHAR(20) NOT NULL DEFAULT '' COMMENT '手机号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

# 添加测试数据
INSERT INTO `teacher` VALUES
(1, '张三', '计科', 'allen@myframe.test', '12300004567'),
(2, '李四', '机电', 'james@myframe.test', '12311114567'),
(3, '王二', '网工', 'rose@myframe.test', '12322224567')
