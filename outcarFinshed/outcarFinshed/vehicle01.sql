/*
 Navicat Premium Data Transfer

 Source Server         : wamp
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : localhost:3306
 Source Schema         : vehicle01

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 14/09/2019 18:06:21
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for vehicle_car
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_car`;
CREATE TABLE `vehicle_car`  (
  `carId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `carLicense` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contract` int(11) NOT NULL DEFAULT 123,
  `carState` int(2) NOT NULL DEFAULT 1,
  `delState` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`carId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 123457 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_car
-- ----------------------------
INSERT INTO `vehicle_car` VALUES (234, '粤A13548', 9431479, 1, 1);
INSERT INTO `vehicle_car` VALUES (1234, '粤A13546', 2717046, 1, 1);
INSERT INTO `vehicle_car` VALUES (13545, '粤A13545', 2580085, 1, 1);
INSERT INTO `vehicle_car` VALUES (123456, '粤A13547', 1106404, 1, 1);

-- ----------------------------
-- Table structure for vehicle_drivers
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_drivers`;
CREATE TABLE `vehicle_drivers`  (
  `driverId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `driverImg` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `driverName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `driverPhone` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123456789',
  `driverPwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '123',
  `applyDate` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '2019.9',
  `driverBlock` int(11) NOT NULL DEFAULT 1,
  `driverState` int(11) NOT NULL DEFAULT 0,
  `delState` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`driverId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_drivers
-- ----------------------------
INSERT INTO `vehicle_drivers` VALUES (8, 'headImg/279901.jpeg', '罗', '13680953654', 'e99a18c428cb38d5f260853678922e03', '1568019438', 1, 1, 1);
INSERT INTO `vehicle_drivers` VALUES (9, 'headImg/420001.jpeg', '文棵', '13680953653', '4297f44b13955235245b2497399d7a93', '1568020905', 1, 1, 1);
INSERT INTO `vehicle_drivers` VALUES (12, 'headImg/295131.jpeg', '鸿辉', '13680953650', 'e99a18c428cb38d5f260853678922e03', '1568107062', 1, 1, 1);

-- ----------------------------
-- Table structure for vehicle_goods
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_goods`;
CREATE TABLE `vehicle_goods`  (
  `goodId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `goodName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goodNum` int(10) UNSIGNED NOT NULL,
  `goodTrueNum` int(10) UNSIGNED NOT NULL,
  `goodSales` int(10) UNSIGNED NULL DEFAULT 0,
  `goodState` int(11) NOT NULL DEFAULT 1,
  `addTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `delState` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`goodId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_goods
-- ----------------------------
INSERT INTO `vehicle_goods` VALUES (1, '花生', 200, 199, 0, 1, '0', 0);
INSERT INTO `vehicle_goods` VALUES (3, '芒果', 400, 0, 399, 0, '0', 0);
INSERT INTO `vehicle_goods` VALUES (4, '香蕉', 56, 6, 58, 1, '0', 1);
INSERT INTO `vehicle_goods` VALUES (5, '草莓', 99, 97, 123, 1, '1567999344', 1);
INSERT INTO `vehicle_goods` VALUES (6, '芒果', 289, 189, 511, 1, '1567999547', 1);
INSERT INTO `vehicle_goods` VALUES (7, '核桃', 405, 385, 429, 1, '1568002986', 1);
INSERT INTO `vehicle_goods` VALUES (8, '牛奶罐', 38, 35, 62, 1, '1568007691', 1);
INSERT INTO `vehicle_goods` VALUES (9, '冰箱', 77, 75, 79, 1, '1568008182', 1);

-- ----------------------------
-- Table structure for vehicle_log
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_log`;
CREATE TABLE `vehicle_log`  (
  `logid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `userName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `roleName` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '司机',
  `Activity` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '喝茶',
  `ActivityD` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '广东省惠州市',
  `ActivityTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '2019',
  `ActivityState` int(2) NULL DEFAULT 1,
  `logIp` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `delState` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`logid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 213 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_log
-- ----------------------------
INSERT INTO `vehicle_log` VALUES (1, 'admin', '超级管理员', '添加管理员', '广东省惠州市', '1568103699', 1, '192.168.5.196', 1);
INSERT INTO `vehicle_log` VALUES (2, 'admin', '超级管理员', '添加管理员', '广东省惠州市', '1568103980', 1, '192.168.5.196', 1);
INSERT INTO `vehicle_log` VALUES (150, 'admin', '超级管理员', '删除订单', '广东省惠州市', '1568279598', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (151, 'admin', '超级管理员', '修改商品信息成功', '广东省惠州市', '1568279658', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (152, 'admin', '超级管理员', '增加订单信息', '广东省惠州市', '1568279669', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (153, 'admin', '超级管理员', '增加订单信息', '广东省惠州市', '1568280025', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (154, 'admin', '超级管理员', '增加订单信息', '广东省惠州市', '1568280060', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (155, 'admin', '超级管理员', '增加订单信息', '广东省惠州市', '1568280086', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (156, 'admin', '超级管理员', '增加订单信息', '广东省惠州市', '1568280203', 1, '192.168.5.159', 1);
INSERT INTO `vehicle_log` VALUES (172, 'admin', '超级管理员', '删除管理员', '广东省惠州市', '1568433630', 1, '192.168.56.1', 1);
INSERT INTO `vehicle_log` VALUES (173, 'admin', '超级管理员', '添加管理员', '广东省惠州市', '1568433804', 0, '192.168.56.1', 1);
INSERT INTO `vehicle_log` VALUES (189, 'admin', '超级管理员', '添加管理员', '广东省惠州市', '1568440426', 0, '192.168.56.1', 1);
INSERT INTO `vehicle_log` VALUES (190, 'admin', '超级管理员', '添加管理员', '广东省惠州市', '1568440532', 0, '192.168.56.1', 1);

-- ----------------------------
-- Table structure for vehicle_order
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_order`;
CREATE TABLE `vehicle_order`  (
  `orderId` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goodId` int(10) UNSIGNED NOT NULL,
  `carId` int(10) UNSIGNED NOT NULL,
  `driverId` int(10) UNSIGNED NULL DEFAULT 0,
  `orderNum` int(10) UNSIGNED NULL DEFAULT 0,
  `orderTiNum` int(10) UNSIGNED NULL DEFAULT 0,
  `createTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `beginTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `lastTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `destination` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `goodCount` int(10) UNSIGNED NOT NULL,
  `goodTrueCount` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `orderState` int(11) NOT NULL DEFAULT 0,
  `delState` int(2) NULL DEFAULT 1,
  `existState` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`orderId`) USING BTREE,
  INDEX `goodId`(`goodId`) USING BTREE,
  INDEX `carId`(`carId`) USING BTREE,
  CONSTRAINT `vehicle_order_ibfk_1` FOREIGN KEY (`goodId`) REFERENCES `vehicle_goods` (`goodId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `vehicle_order_ibfk_2` FOREIGN KEY (`carId`) REFERENCES `vehicle_car` (`carId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_order
-- ----------------------------
INSERT INTO `vehicle_order` VALUES ('2019091212179', 8, 234, NULL, 22388, 1148139, '1568285819', '1568347920', '0', '北京', 12, 0, 0, 1, 1);
INSERT INTO `vehicle_order` VALUES ('2019091215616', 4, 234, NULL, 19141, 1519882, '1568285109', '1568347920', '0', '河源', 12, 0, 0, 1, 1);
INSERT INTO `vehicle_order` VALUES ('2019091223171', 4, 234, 8, 43735, 907565, '1568286251', '1568347920', '1568453957', '海南', 1, 1, 2, 1, 1);
INSERT INTO `vehicle_order` VALUES ('2019091249408', 9, 234, NULL, 52833, 7636, '1568286021', '1568307660', '0', '河源', 1, 0, 0, 1, 1);
INSERT INTO `vehicle_order` VALUES ('2019091252412', 4, 1234, 8, 23454, 1176105, '1568286408', '1568307660', '1568286879', '北京', 1, 1, 2, 1, 1);
INSERT INTO `vehicle_order` VALUES ('201909127156', 4, 234, 12, 55666, 1478296, '1568285345', '1568866320', '1568452470', '北京', 12, 11, 2, 1, 1);
INSERT INTO `vehicle_order` VALUES ('201909129994', 9, 13545, 12, 37513, 417001, '1568285894', '1568347920', '0', '哈哈', 12, 11, 1, 1, 1);
INSERT INTO `vehicle_order` VALUES ('2019091454308', 4, 234, 12, 17450, 814299, '1568441079', '1568595660', '1568452915', '河南', 1, 0, 0, 1, 1);

-- ----------------------------
-- Table structure for vehicle_role
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_role`;
CREATE TABLE `vehicle_role`  (
  `roleId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `rootName` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'read',
  `addTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '2019.9',
  `updateTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '2019.9',
  `roleState` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  `delState` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`roleId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_role
-- ----------------------------
INSERT INTO `vehicle_role` VALUES (1, '超级管理员', 'add@edit@delete@user@good@driver@allFunction@allObject', '2019.9', '2019.9', '1', 1);
INSERT INTO `vehicle_role` VALUES (2, '经理', 'read@edit@delete@admin@good@log@logs', '2019.9', '2019.9', '1', 1);
INSERT INTO `vehicle_role` VALUES (3, '人事', '@', '2019.9', '1568440718', '0', 1);
INSERT INTO `vehicle_role` VALUES (4, '普通员工', '@', '2019.9', '2019.9', '1', 1);
INSERT INTO `vehicle_role` VALUES (7, '管理员', 'allFunction@allObject@', '2019.9', '2019.9', '1', 1);
INSERT INTO `vehicle_role` VALUES (9, '老师', 'allFunction@node@role@good@driver@order', '1567951860', '2019.9', '1', 1);
INSERT INTO `vehicle_role` VALUES (10, '学生', '@role@good@driver@order', '1567951874', '1568440685', '0', 1);
INSERT INTO `vehicle_role` VALUES (11, '人事部', '@add@edit', '1567992097', '1568439728', '0', 1);

-- ----------------------------
-- Table structure for vehicle_user
-- ----------------------------
DROP TABLE IF EXISTS `vehicle_user`;
CREATE TABLE `vehicle_user`  (
  `userId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `roleId` int(10) UNSIGNED NOT NULL,
  `userName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `userPwd` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '123456',
  `userImg` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `trueName` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `loginTime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `loginTimes` int(11) NULL DEFAULT 0,
  `loginState` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `loginIp` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0.0.0.0',
  `delState` int(2) NOT NULL DEFAULT 1,
  PRIMARY KEY (`userId`) USING BTREE,
  INDEX `roleId`(`roleId`) USING BTREE,
  CONSTRAINT `vehicle_user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `vehicle_role` (`roleId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of vehicle_user
-- ----------------------------
INSERT INTO `vehicle_user` VALUES (1, 1, 'admin', 'e99a18c428cb38d5f260853678922e03', 'headImg/1.jpeg', '大大', '1568454533', 22, '1', '192.168.56.1', 1);
INSERT INTO `vehicle_user` VALUES (2, 2, 'admin12', 'e99a18c428cb38d5f260853678922e03', 'headImg/28269timg (1).jpg', '黄卫平', '0', 0, '0', '0.0.0.0', 1);
INSERT INTO `vehicle_user` VALUES (3, 2, '你好呀', '4297f44b13955235245b2497399d7a93', 'headImg/54856timg.jpg', '你好呀', '0', 0, '0', '0.0.0.0', 0);
INSERT INTO `vehicle_user` VALUES (4, 7, 'faj4324', 'e99a18c428cb38d5f260853678922e03', 'headImg/196281.jpeg', '鸿辉', '0', 0, '1', '0.0.0.0', 1);
INSERT INTO `vehicle_user` VALUES (5, 3, 'root', 'e99a18c428cb38d5f260853678922e03', 'headImg/341251.jpeg', '灰灰', '0', 0, '1', '0.0.0.0', 1);
INSERT INTO `vehicle_user` VALUES (6, 3, 'ttttttt', 'e99a18c428cb38d5f260853678922e03', 'headImg/479141.jpeg', '坤亮', '1568103980', 0, '1', '192.168.5.196', 1);
INSERT INTO `vehicle_user` VALUES (7, 2, 'rooot', 'e99a18c428cb38d5f260853678922e03', 'headImg/424931.jpeg', '灰太狼', '1568163692', 1, '1', '192.168.5.129', 0);
INSERT INTO `vehicle_user` VALUES (8, 2, 'roooot', 'b7979cf34f0e8ce36a15e6fb8cb6733b', 'headImg/32378timg (1).jpg', '无名', '1568433858', 0, '0', '192.168.56.1', 0);
INSERT INTO `vehicle_user` VALUES (9, 2, '3131', '5464028132750fc3d9705f63c4804a09', 'headImg/54640timg (1).jpg', '发放', '1568433913', 0, '1', '192.168.56.1', 1);
INSERT INTO `vehicle_user` VALUES (10, 9, '123213123', 'f5bb0c8de146c67b44babbf4e6584cc0', 'headImg/31616timg (1).jpg', '五毛', '0', 0, '1', '0.0.0.0', 1);
INSERT INTO `vehicle_user` VALUES (11, 11, '123123', '572e634ed953cab490d880129a469ba9', 'headImg/37616timg (1).jpg', '黄', '0', 0, '1', '0.0.0.0', 1);

-- ----------------------------
-- View structure for view_c
-- ----------------------------
DROP VIEW IF EXISTS `view_c`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_c` AS select count(0) AS `count(*)` from `vehicle_order` `a` where ((`a`.`delState` = 1) and (`a`.`existState` = 1));

-- ----------------------------
-- View structure for view_c2
-- ----------------------------
DROP VIEW IF EXISTS `view_c2`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_c2` AS select `a`.`orderId` AS `orderId`,`a`.`driverId` AS `driverId`,sum((case when (`a`.`orderState` > 0) then 1 else 0 end)) AS `orderF`,sum((case `a`.`orderState` when '2' then 1 else 0 end)) AS `orderS`,sum(`a`.`goodCount`) AS `orderSale`,`a`.`delState` AS `delState` from (`vehicle_order` `a` join `vehicle_drivers` `b`) where ((`a`.`driverId` = `b`.`driverId`) and (`a`.`existState` = 1)) group by `a`.`driverId`;

-- ----------------------------
-- View structure for view_c3
-- ----------------------------
DROP VIEW IF EXISTS `view_c3`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_c3` AS select `view_c2`.`orderId` AS `orderId`,`view_c2`.`driverId` AS `driverId`,`view_c2`.`orderF` AS `orderF`,`view_c2`.`orderS` AS `orderS`,`view_c2`.`orderSale` AS `orderSale`,(((`view_c2`.`orderF` * 0.3) + (`view_c2`.`orderS` * 0.6)) + (`view_c2`.`orderSale` * 0.1)) AS `efficiency`,`view_c2`.`delState` AS `delState` from `view_c2`;

-- ----------------------------
-- View structure for view_count
-- ----------------------------
DROP VIEW IF EXISTS `view_count`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_count` AS select `vehicle_order`.`orderId` AS `orderId`,`vehicle_order`.`orderState` AS `orderState`,`vehicle_order`.`delState` AS `delState` from `vehicle_order` where (`vehicle_order`.`orderState` <> 0);

-- ----------------------------
-- View structure for view_order
-- ----------------------------
DROP VIEW IF EXISTS `view_order`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_order` AS select `b`.`orderId` AS `orderId`,`b`.`orderNum` AS `orderNum`,`b`.`orderTiNum` AS `orderTiNum`,`a`.`contract` AS `contract`,`a`.`carLicense` AS `carLicense`,`b`.`goodCount` AS `goodCount`,`b`.`createTime` AS `createTime`,`b`.`beginTime` AS `beginTime`,`b`.`orderState` AS `orderState`,`b`.`delState` AS `delState` from ((`vehicle_car` `a` join `vehicle_order` `b`) join `vehicle_goods` `c`) where ((`a`.`carId` = `b`.`carId`) and (`b`.`goodId` = `c`.`goodId`)) group by `b`.`orderId`;

-- ----------------------------
-- View structure for view_orders
-- ----------------------------
DROP VIEW IF EXISTS `view_orders`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_orders` AS select `b`.`orderId` AS `orderId`,`b`.`orderNum` AS `orderNum`,`a`.`carLicense` AS `carLicense`,`b`.`destination` AS `destination`,`c`.`goodName` AS `goodName`,`b`.`goodTrueCount` AS `goodTrueCount`,`b`.`beginTime` AS `beginTime`,`b`.`delState` AS `delState`,`b`.`existState` AS `existState`,`b`.`createTime` AS `createTime` from ((`vehicle_car` `a` join `vehicle_order` `b`) join `vehicle_goods` `c`) where ((`a`.`carId` = `b`.`carId`) and (`b`.`goodId` = `c`.`goodId`));

-- ----------------------------
-- View structure for view_ordert
-- ----------------------------
DROP VIEW IF EXISTS `view_ordert`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_ordert` AS select `a`.`orderId` AS `orderId`,`a`.`orderNum` AS `orderNum`,`a`.`orderTiNum` AS `orderTiNum`,`a`.`goodCount` AS `goodCount`,`a`.`goodTrueCount` AS `goodTrueCount`,`a`.`createTime` AS `createTime`,`a`.`beginTime` AS `beginTime`,`a`.`lastTime` AS `lastTime`,`a`.`carId` AS `carId`,`b`.`contract` AS `contract`,`b`.`carLicense` AS `carLicense`,`a`.`goodId` AS `goodId`,`c`.`goodName` AS `goodName`,`c`.`goodNum` AS `goodNum`,`c`.`goodTrueNum` AS `goodTrueNum`,`a`.`destination` AS `destination`,`a`.`orderState` AS `orderState`,`a`.`driverId` AS `driverId`,`a`.`delState` AS `delState`,`a`.`existState` AS `existState` from ((`vehicle_order` `a` join `vehicle_car` `b`) join `vehicle_goods` `c`) where ((`a`.`carId` = `b`.`carId`) and (`a`.`goodId` = `c`.`goodId`) and (`b`.`carState` = 1) and (`c`.`delState` = 1) and (`c`.`goodState` = 1) and (`c`.`delState` = 1) and (`a`.`existState` = 1) and (`a`.`delState` = 1));

-- ----------------------------
-- View structure for view_ordertt
-- ----------------------------
DROP VIEW IF EXISTS `view_ordertt`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_ordertt` AS select `b`.`orderId` AS `orderId`,`b`.`orderNum` AS `orderNum`,`b`.`orderTiNum` AS `orderTiNum`,`a`.`carLicense` AS `carLicense`,`b`.`destination` AS `destination`,`c`.`goodName` AS `goodName`,`b`.`goodTrueCount` AS `goodTrueCount`,`b`.`goodCount` AS `goodCount`,`b`.`beginTime` AS `beginTime`,`b`.`delState` AS `delState`,`b`.`existState` AS `existState`,`b`.`createTime` AS `createTime`,`b`.`carId` AS `carId`,`b`.`lastTime` AS `lastTime`,`b`.`orderState` AS `orderState`,`a`.`contract` AS `contract` from ((`vehicle_car` `a` join `vehicle_order` `b`) join `vehicle_goods` `c`) where ((`a`.`carId` = `b`.`carId`) and (`b`.`goodId` = `c`.`goodId`));

-- ----------------------------
-- View structure for view_orderu
-- ----------------------------
DROP VIEW IF EXISTS `view_orderu`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_orderu` AS select `b`.`orderId` AS `orderId`,`b`.`orderNum` AS `orderNum`,`b`.`orderTiNum` AS `orderTiNum`,`a`.`contract` AS `contract`,`a`.`carLicense` AS `carLicense`,`b`.`goodCount` AS `goodCount`,`b`.`createTime` AS `createTime`,`b`.`beginTime` AS `beginTime`,`b`.`orderState` AS `orderState`,`b`.`delState` AS `delState` from ((`vehicle_car` `a` join `vehicle_order` `b`) join `vehicle_goods` `c`) where ((`a`.`carId` = `b`.`carId`) and (`b`.`goodId` = `c`.`goodId`));

-- ----------------------------
-- View structure for view_user
-- ----------------------------
DROP VIEW IF EXISTS `view_user`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_user` AS select `b`.`userId` AS `userId`,`b`.`userName` AS `userName`,`b`.`userImg` AS `userImg`,`a`.`roleName` AS `roleName`,`b`.`loginTimes` AS `loginTimes`,`b`.`loginIp` AS `loginIp`,`b`.`loginTime` AS `loginTime`,`b`.`trueName` AS `trueName`,`b`.`loginState` AS `loginState`,`b`.`delState` AS `delState` from (`vehicle_role` `a` join `vehicle_user` `b`) where ((`a`.`roleId` = `b`.`roleId`) and (`a`.`delState` = 1) and (`b`.`delState` = 1) and (`a`.`roleState` = 1));

SET FOREIGN_KEY_CHECKS = 1;
