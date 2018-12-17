/*
 Navicat MySQL Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50547
 Source Host           : localhost:3306
 Source Schema         : poster

 Target Server Type    : MySQL
 Target Server Version : 50547
 File Encoding         : 65001

 Date: 06/12/2018 15:48:44
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for yl_activities
-- ----------------------------
DROP TABLE IF EXISTS `yl_activities`;
CREATE TABLE `yl_activities`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `starttime` date NOT NULL COMMENT '开始时间',
  `endtime` date NOT NULL COMMENT '结束时间',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '活动详情',
  `qrcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '二维码',
  `online` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1表示上线，2表示下线',
  `addtime` datetime NOT NULL COMMENT '添加时间',
  `updatetime` datetime NOT NULL COMMENT '编辑时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '活动表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_activities
-- ----------------------------
INSERT INTO `yl_activities` VALUES (1, '每日活动', '2018-11-15', '2018-12-28', '欢迎参加！', NULL, 1, '2018-11-15 10:53:57', '2018-12-04 17:59:36');
INSERT INTO `yl_activities` VALUES (2, '测试一个新的活动', '2018-12-04', '2018-12-30', '测试一个新的活动测试一个新的活动测试一个新的活动测试一个新的活动测试一个新的活动测试一个新的活动', NULL, 1, '2018-12-04 17:54:02', '2018-12-04 17:54:02');

-- ----------------------------
-- Table structure for yl_activity_poster
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_poster`;
CREATE TABLE `yl_activity_poster`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `activity_id` int(10) NULL DEFAULT NULL COMMENT '所属活动',
  `category_id` smallint(10) NULL DEFAULT 0 COMMENT '海报类型',
  `category_size` tinyint(4) NULL DEFAULT 1 COMMENT '海报尺寸 （4:3 16:9）',
  `background_id` int(10) NULL DEFAULT 0 COMMENT '系统海报背景图',
  `background_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '作者海报背景图',
  `activity_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动主图',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '代理人',
  `worknumber` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '工号',
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '手机号',
  `wechat` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '微信号',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  `status` tinyint(4) NULL DEFAULT 0 COMMENT '状态',
  `poster_image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '海报生成图片',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '活动海报制作信息' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_activity_poster
-- ----------------------------
INSERT INTO `yl_activity_poster` VALUES (12, 1, 4, 1, 0, '17', '13', '张三三', '321456', '13650012345', '1356543212', '2018-12-04 11:27:57', 0, '/upload/saveimg/15440037094652.png');
INSERT INTO `yl_activity_poster` VALUES (13, 2, 1, 2, 3, '', '18', '李莉', '1c22', '133333333', '134343434', '2018-12-05 11:27:12', 0, '/upload/saveimg/15439808723640.png');
INSERT INTO `yl_activity_poster` VALUES (14, 1, 2, 2, 5, '', '19', '杨炎', '555555', '13663232131', '6666666', '2018-12-05 14:37:26', 0, '/upload/saveimg/15439918497160.png');
INSERT INTO `yl_activity_poster` VALUES (15, 2, 3, 1, 1, NULL, '20', NULL, '1211111', '15252525252', '心动', '2018-12-05 15:26:26', 0, '/upload/saveimg/15439948755782.png');

-- ----------------------------
-- Table structure for yl_activity_poster_1
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_poster_1`;
CREATE TABLE `yl_activity_poster_1`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `poster_id` int(10) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动主题',
  `start_time` date NULL DEFAULT NULL COMMENT '活动时间',
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动地址',
  `price` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动价格',
  `number` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动人数',
  `brief` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '活动简介',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `poster_id`(`poster_id`) USING BTREE,
  CONSTRAINT `poster_id` FOREIGN KEY (`poster_id`) REFERENCES `yl_activity_poster` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '主拓活动关联表表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_activity_poster_1
-- ----------------------------
INSERT INTO `yl_activity_poster_1` VALUES (7, 13, '周末冬天户外游戏', '2018-12-06', '河北省唐山市', '200元', '5人', '安全第一，团结就是力量。永远是许诺糯米玉女木木木木6孔哦。', '2018-12-05 11:27:12');

-- ----------------------------
-- Table structure for yl_activity_poster_2
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_poster_2`;
CREATE TABLE `yl_activity_poster_2`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `poster_id` int(10) NULL DEFAULT NULL,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创说会名称',
  `start_time` date NULL DEFAULT NULL COMMENT '创说会时间',
  `address` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创说会地址',
  `lecturer` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '讲师名称',
  `brief` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '讲师简介',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `poster_id`(`poster_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '创说会关联表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_activity_poster_2
-- ----------------------------
INSERT INTO `yl_activity_poster_2` VALUES (4, 14, '2018年元旦节日', '2018-12-05', '上海黄浦区', '李李立', '千万人突出的发射点发生的发生的反对法的规范的韩国突然太夫人官方', '2018-12-05 14:37:26');

-- ----------------------------
-- Table structure for yl_activity_poster_3
-- ----------------------------
DROP TABLE IF EXISTS `yl_activity_poster_3`;
CREATE TABLE `yl_activity_poster_3`  (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `poster_id` int(10) NULL DEFAULT NULL,
  `brief` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '简介',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  `uname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '姓名',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `poster_id`(`poster_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '个人荣誉关联表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_activity_poster_3
-- ----------------------------
INSERT INTO `yl_activity_poster_3` VALUES (2, 15, '给付也可以咯恶心替您秃头模具哭咯得聚聚咯哦他咯我饿看看我。', '2018-12-05 15:26:26', '网易邮箱');

-- ----------------------------
-- Table structure for yl_admin
-- ----------------------------
DROP TABLE IF EXISTS `yl_admin`;
CREATE TABLE `yl_admin`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名',
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱',
  `reg_ip` int(11) NOT NULL DEFAULT 0 COMMENT '创建或注册IP',
  `last_login_time` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `last_login_ip` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录IP',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '用户状态 1正常 0禁用',
  `created_at` int(11) NOT NULL COMMENT '创建或注册时间',
  `updated_at` int(11) NOT NULL COMMENT '更新时间',
  `user_type` tinyint(4) NULL DEFAULT 0 COMMENT '类型',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_admin
-- ----------------------------
INSERT INTO `yl_admin` VALUES (1, 'manage', 'SbSY36BLw3V2lU-GB7ZAzCVJKDFx82IJ', '$2y$13$0UVcG.mXF6Og0rnjfwJd2.wixT2gdn.wDO9rN44jGtIGc6JvBqR7i', '1404322390@qq.com', 2130706433, 1543825084, -1062731730, 1, 1482305564, 1543825084, 1);
INSERT INTO `yl_admin` VALUES (2, 'admin', 'TcBAK9e0fO-CzSBVfdMupMtr5GCkYyAO', '$2y$13$8YHjrtbBQP1thZD/oXvqAOI/G4bFs8N24vjy9kJFjc7OLZMvbndS6', 'admin@163.com', 2130706433, 1544004335, 2130706433, 1, 1527734902, 1544004335, 0);
INSERT INTO `yl_admin` VALUES (3, 'test123', 'wQg2PkTzCyavIn8O6o9gl3P1fp8BzKqJ', '$2y$13$aqnxi32m2r0g/geSj7EUleB4tCVUU88Eebfu0V2RGNKdgHU7UyijW', 'test123@163.com', 2130706433, 1544004056, 2130706433, 1, 1542178817, 1544004056, 0);

-- ----------------------------
-- Table structure for yl_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `yl_admin_log`;
CREATE TABLE `yl_admin_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '日志ID',
  `type` smallint(2) NOT NULL DEFAULT 1 COMMENT '日志类型',
  `controller` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '方法',
  `url` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '请求地址',
  `index` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '数据标识',
  `params` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '请求参数',
  `created_at` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `created_id` int(11) NOT NULL DEFAULT 0 COMMENT '创建用户',
  `created_ip` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '创建人IP',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `admin_id`(`created_id`) USING BTREE COMMENT '管理员'
) ENGINE = InnoDB AUTO_INCREMENT = 453 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = '管理员信息表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for yl_api_user
-- ----------------------------
DROP TABLE IF EXISTS `yl_api_user`;
CREATE TABLE `yl_api_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `access_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'restful请求token',
  `allowance` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'restful剩余的允许的请求数',
  `allowance_updated_at` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'restful请求的UNIX时间戳数',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_api_user
-- ----------------------------
INSERT INTO `yl_api_user` VALUES (2, 'test', 'CzSBVfdMupMtr5GCkYyAO', '$2y$13$7CWCMkB02/IRdgjuee8EpOo9gr1cafpHhZ0X0i5ccwunQwDzgWYZq', NULL, 'test@qq.com', 10, 1510297202, 1541236138, 'UVRaKb-hTZ_c_xEhkjvoANO7wKPDZXVf_1541236138', 99, 1538203321);

-- ----------------------------
-- Table structure for yl_articles
-- ----------------------------
DROP TABLE IF EXISTS `yl_articles`;
CREATE TABLE `yl_articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `title_second` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `title_alias` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '别名 ',
  `images` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图片',
  `author` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '作者',
  `template` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模板',
  `catalog_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0 COMMENT '分类',
  `intro` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '摘要',
  `seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `seo_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'SEO描述',
  `seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'SEO关键字',
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `copy_from` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '来源',
  `copy_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '来源url',
  `redirect_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '跳转URL',
  `tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'tags',
  `view_count` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT '查看次数',
  `commend` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N' COMMENT '推荐',
  `top_line` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'N' COMMENT '头条',
  `last_update_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '最后更新时间',
  `sort_desc` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `status_is` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '录入时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '内容管理' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for yl_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `yl_auth_assignment`;
CREATE TABLE `yl_auth_assignment`  (
  `item_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`item_name`, `user_id`) USING BTREE,
  CONSTRAINT `yl_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_auth_assignment
-- ----------------------------
INSERT INTO `yl_auth_assignment` VALUES ('admin', '2', 1542177257);
INSERT INTO `yl_auth_assignment` VALUES ('administors', '1', 1484712737);
INSERT INTO `yl_auth_assignment` VALUES ('editor', '3', 1542178825);

-- ----------------------------
-- Table structure for yl_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `yl_auth_item`;
CREATE TABLE `yl_auth_item`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `rule_name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE,
  INDEX `rule_name`(`rule_name`) USING BTREE,
  INDEX `type`(`type`) USING BTREE,
  CONSTRAINT `yl_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `yl_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_auth_item
-- ----------------------------
INSERT INTO `yl_auth_item` VALUES ('activities/create', 2, '', 'activities/create', NULL, 1542189890, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('activities/delete', 2, '', 'activities/delete', NULL, 1542189890, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('activities/index', 2, '', 'activities/index', NULL, 1542189890, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('activities/update', 2, '', 'activities/update', NULL, 1542189890, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('activities/view', 2, '', 'activities/view', NULL, 1542189890, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('activity-poster/delete', 2, '', 'activity-poster/delete', NULL, 1543825829, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('activity-poster/index', 2, '', 'activity-poster/index', NULL, 1543825829, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('activity-poster/view', 2, '', 'activity-poster/view', NULL, 1543825829, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('admin', 1, '网站管理员', NULL, NULL, 1484712712, 1542177231);
INSERT INTO `yl_auth_item` VALUES ('admin-log/delete', 2, '', 'admin-log/delete', NULL, 1533871262, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('admin-log/index', 2, '', 'admin-log/index', NULL, 1533871261, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('admin-log/view', 2, '', 'admin-log/view', NULL, 1533871261, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('admin/auth', 2, '', 'admin/auth', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('admin/create', 2, '', 'admin/create', NULL, 1484734191, 1543825850);
INSERT INTO `yl_auth_item` VALUES ('admin/delete', 2, '', 'admin/delete', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('admin/index', 2, '', 'admin/index', NULL, 1484734191, 1543825850);
INSERT INTO `yl_auth_item` VALUES ('admin/set', 2, '', 'admin/set', NULL, 1533871260, 1543825850);
INSERT INTO `yl_auth_item` VALUES ('admin/update', 2, '', 'admin/update', NULL, 1484734191, 1543825850);
INSERT INTO `yl_auth_item` VALUES ('administors', 1, '授权所有权限', NULL, NULL, 1484712662, 1484712662);
INSERT INTO `yl_auth_item` VALUES ('articles/create', 2, '', 'articles/create', NULL, 1537241769, 1542182419);
INSERT INTO `yl_auth_item` VALUES ('articles/delete', 2, '', 'articles/delete', NULL, 1537241770, 1542182419);
INSERT INTO `yl_auth_item` VALUES ('articles/index', 2, '', 'articles/index', NULL, 1537240890, 1542182419);
INSERT INTO `yl_auth_item` VALUES ('articles/update', 2, '', 'articles/update', NULL, 1537241769, 1542182419);
INSERT INTO `yl_auth_item` VALUES ('articles/view', 2, '', 'articles/view', NULL, 1537245474, 1542182419);
INSERT INTO `yl_auth_item` VALUES ('articles/views', 2, '', 'articles/views', NULL, 1537241769, 1537241769);
INSERT INTO `yl_auth_item` VALUES ('backgroundimage/create', 2, '', 'backgroundimage/create', NULL, 1542182072, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('backgroundimage/delete', 2, '', 'backgroundimage/delete', NULL, 1542182073, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('backgroundimage/index', 2, '', 'backgroundimage/index', NULL, 1542182072, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('backgroundimage/update', 2, '', 'backgroundimage/update', NULL, 1542182072, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('backgroundimage/view', 2, '', 'backgroundimage/view', NULL, 1542182401, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('category/create', 2, '', 'category/create', NULL, 1533871374, 1543825828);
INSERT INTO `yl_auth_item` VALUES ('category/delete', 2, '', 'category/delete', NULL, 1533871374, 1543825828);
INSERT INTO `yl_auth_item` VALUES ('category/index', 2, '', 'category/index', NULL, 1533871374, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('category/set', 2, '', 'category/set', NULL, 1533871262, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('category/update', 2, '', 'category/update', NULL, 1533871374, 1544004041);
INSERT INTO `yl_auth_item` VALUES ('config/attachment', 2, '', 'config/attachment', NULL, 1484734191, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('config/basic', 2, '', 'config/basic', NULL, 1484734191, 1543825850);
INSERT INTO `yl_auth_item` VALUES ('config/send-mail', 2, '', 'config/send-mail', NULL, 1484734191, 1543825824);
INSERT INTO `yl_auth_item` VALUES ('database/export', 2, '', 'database/export', NULL, 1484734305, 1543825830);
INSERT INTO `yl_auth_item` VALUES ('dic/default/index', 2, '', 'dic/default/index', NULL, 1533871260, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('editor', 1, '网站编辑', NULL, NULL, 1542178735, 1542178735);
INSERT INTO `yl_auth_item` VALUES ('gallery/create', 2, '', 'gallery/create', NULL, 1535092909, 1543825831);
INSERT INTO `yl_auth_item` VALUES ('gallery/delete', 2, '', 'gallery/delete', NULL, 1535092910, 1543825831);
INSERT INTO `yl_auth_item` VALUES ('gallery/index', 2, '', 'gallery/index', NULL, 1535092909, 1543825831);
INSERT INTO `yl_auth_item` VALUES ('gallery/update', 2, '', 'gallery/update', NULL, 1535092910, 1543825831);
INSERT INTO `yl_auth_item` VALUES ('gallery/view', 2, '', 'gallery/view', NULL, 1535092910, 1543825831);
INSERT INTO `yl_auth_item` VALUES ('gii/default/index', 2, '', 'gii/default/index', NULL, 1533871259, 1543825824);
INSERT INTO `yl_auth_item` VALUES ('index/index', 2, '', 'index/index', NULL, 1484734191, 1544004040);
INSERT INTO `yl_auth_item` VALUES ('index/set', 2, '', 'index/set', NULL, 1533882894, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('link/create', 2, '', 'link/create', NULL, 1533873932, 1543825853);
INSERT INTO `yl_auth_item` VALUES ('link/delete', 2, '', 'link/delete', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('link/index', 2, '', 'link/index', NULL, 1533871386, 1543825853);
INSERT INTO `yl_auth_item` VALUES ('link/update', 2, '', 'link/update', NULL, 1533873932, 1543825853);
INSERT INTO `yl_auth_item` VALUES ('link/view', 2, '', 'link/view', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('menu/create', 2, '', 'menu/create', NULL, 1484734191, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('menu/delete', 2, '', 'menu/delete', NULL, 1484734191, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('menu/index', 2, '', 'menu/index', NULL, 1484734191, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('menu/update', 2, '', 'menu/update', NULL, 1484734191, 1543825825);
INSERT INTO `yl_auth_item` VALUES ('page/create', 2, '', 'page/create', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('page/delete', 2, '', 'page/delete', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('page/index', 2, '', 'page/index', NULL, 1533871386, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('page/update', 2, '', 'page/update', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('page/view', 2, '', 'page/view', NULL, 1533873932, 1543825854);
INSERT INTO `yl_auth_item` VALUES ('role/auth', 2, '', 'role/auth', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('role/create', 2, '', 'role/create', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('role/delete', 2, '', 'role/delete', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('role/index', 2, '', 'role/index', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('role/update', 2, '', 'role/update', NULL, 1484734191, 1543825851);
INSERT INTO `yl_auth_item` VALUES ('upload-files/delete', 2, '', 'upload-files/delete', NULL, 1543572039, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('upload-files/index', 2, '', 'upload-files/index', NULL, 1543572039, 1544004042);
INSERT INTO `yl_auth_item` VALUES ('uploadfiles/delete', 2, '', 'uploadfiles/delete', NULL, 1543571807, 1543571826);
INSERT INTO `yl_auth_item` VALUES ('uploadfiles/index', 2, '', 'uploadfiles/index', NULL, 1543571807, 1543571826);
INSERT INTO `yl_auth_item` VALUES ('user/add', 2, '', 'user/add', NULL, 1533871415, 1533873933);
INSERT INTO `yl_auth_item` VALUES ('user/create', 2, '', 'user/create', NULL, 1533874065, 1543825830);
INSERT INTO `yl_auth_item` VALUES ('user/delete', 2, '', 'user/delete', NULL, 1533871415, 1543825830);
INSERT INTO `yl_auth_item` VALUES ('user/index', 2, '', 'user/index', NULL, 1533871415, 1543825830);
INSERT INTO `yl_auth_item` VALUES ('user/update', 2, '', 'user/update', NULL, 1533871415, 1543825830);
INSERT INTO `yl_auth_item` VALUES ('user/view', 2, '', 'user/view', NULL, 1533874065, 1543825830);

-- ----------------------------
-- Table structure for yl_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `yl_auth_item_child`;
CREATE TABLE `yl_auth_item_child`  (
  `parent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `child` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`parent`, `child`) USING BTREE,
  INDEX `child`(`child`) USING BTREE,
  CONSTRAINT `yl_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yl_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yl_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_auth_item_child
-- ----------------------------
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activities/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activities/create');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activities/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activities/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activities/delete');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activities/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activities/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activities/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activities/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activities/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activities/update');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activities/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activities/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activities/view');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activities/view');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activity-poster/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activity-poster/delete');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activity-poster/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activity-poster/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activity-poster/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activity-poster/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'activity-poster/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'activity-poster/view');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'activity-poster/view');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin-log/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin-log/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin-log/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin-log/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin-log/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin-log/view');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/auth');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/auth');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/set');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/set');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'admin/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'admin/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'backgroundimage/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'backgroundimage/create');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'backgroundimage/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'backgroundimage/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'backgroundimage/delete');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'backgroundimage/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'backgroundimage/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'backgroundimage/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'backgroundimage/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'backgroundimage/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'backgroundimage/update');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'backgroundimage/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'backgroundimage/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'backgroundimage/view');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'backgroundimage/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'category/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'category/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'category/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'category/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'category/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'category/set');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'category/set');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'category/set');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'category/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'category/update');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'category/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'config/attachment');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'config/basic');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'config/basic');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'config/send-mail');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'database/export');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'dic/default/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gallery/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gallery/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gallery/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gallery/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gallery/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'gii/default/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'index/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'index/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'index/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'index/set');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'index/set');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'index/set');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'link/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'link/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'link/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'link/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'link/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'link/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'link/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'link/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'link/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'link/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'menu/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'menu/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'menu/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'menu/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'page/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'page/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'page/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'page/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'page/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'page/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'page/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'page/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'page/view');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'page/view');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'role/auth');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'role/auth');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'role/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'role/create');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'role/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'role/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'role/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'role/index');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'role/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'role/update');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'upload-files/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'upload-files/delete');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'upload-files/delete');
INSERT INTO `yl_auth_item_child` VALUES ('admin', 'upload-files/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'upload-files/index');
INSERT INTO `yl_auth_item_child` VALUES ('editor', 'upload-files/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'user/create');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'user/delete');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'user/index');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'user/update');
INSERT INTO `yl_auth_item_child` VALUES ('administors', 'user/view');

-- ----------------------------
-- Table structure for yl_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `yl_auth_rule`;
CREATE TABLE `yl_auth_rule`  (
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `created_at` int(11) NULL DEFAULT NULL,
  `updated_at` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_auth_rule
-- ----------------------------
INSERT INTO `yl_auth_rule` VALUES ('', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:0:\"\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1533871262;}', 1484734191, 1533871262);
INSERT INTO `yl_auth_rule` VALUES ('activities/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"activities/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542189890;s:9:\"updatedAt\";i:1544004040;}', 1542189890, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('activities/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"activities/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542189890;s:9:\"updatedAt\";i:1544004040;}', 1542189890, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('activities/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"activities/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542189890;s:9:\"updatedAt\";i:1544004040;}', 1542189890, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('activities/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"activities/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542189890;s:9:\"updatedAt\";i:1544004040;}', 1542189890, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('activities/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"activities/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542189890;s:9:\"updatedAt\";i:1544004040;}', 1542189890, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('activity-poster/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:22:\"activity-poster/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543825829;s:9:\"updatedAt\";i:1544004042;}', 1543825829, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('activity-poster/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:21:\"activity-poster/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543825829;s:9:\"updatedAt\";i:1544004042;}', 1543825829, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('activity-poster/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:20:\"activity-poster/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543825829;s:9:\"updatedAt\";i:1544004042;}', 1543825829, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('admin-log/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"admin-log/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871262;s:9:\"updatedAt\";i:1543825851;}', 1533871262, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('admin-log/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"admin-log/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871261;s:9:\"updatedAt\";i:1543825851;}', 1533871261, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('admin-log/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"admin-log/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871261;s:9:\"updatedAt\";i:1543825851;}', 1533871261, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('admin/auth', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"admin/auth\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825850;}', 1484734191, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('admin/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825850;}', 1484734191, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('admin/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('admin/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"admin/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825850;}', 1484734191, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('admin/set', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"admin/set\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871260;s:9:\"updatedAt\";i:1543825850;}', 1533871260, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('admin/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"admin/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825850;}', 1484734191, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('articles/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"articles/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537241769;s:9:\"updatedAt\";i:1542182419;}', 1537241769, 1542182419);
INSERT INTO `yl_auth_rule` VALUES ('articles/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"articles/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537241769;s:9:\"updatedAt\";i:1542182419;}', 1537241769, 1542182419);
INSERT INTO `yl_auth_rule` VALUES ('articles/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"articles/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537240890;s:9:\"updatedAt\";i:1542182419;}', 1537240890, 1542182419);
INSERT INTO `yl_auth_rule` VALUES ('articles/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"articles/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537241769;s:9:\"updatedAt\";i:1542182419;}', 1537241769, 1542182419);
INSERT INTO `yl_auth_rule` VALUES ('articles/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:13:\"articles/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537245474;s:9:\"updatedAt\";i:1542182419;}', 1537245474, 1542182419);
INSERT INTO `yl_auth_rule` VALUES ('articles/views', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"articles/views\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1537241769;s:9:\"updatedAt\";i:1537241769;}', 1537241769, 1537241769);
INSERT INTO `yl_auth_rule` VALUES ('backgroundimage/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:22:\"backgroundimage/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542182072;s:9:\"updatedAt\";i:1544004041;}', 1542182072, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('backgroundimage/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:22:\"backgroundimage/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542182072;s:9:\"updatedAt\";i:1544004041;}', 1542182072, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('backgroundimage/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:21:\"backgroundimage/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542182072;s:9:\"updatedAt\";i:1544004041;}', 1542182072, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('backgroundimage/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:22:\"backgroundimage/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542182072;s:9:\"updatedAt\";i:1544004041;}', 1542182072, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('backgroundimage/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:20:\"backgroundimage/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1542182401;s:9:\"updatedAt\";i:1544004041;}', 1542182401, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('category/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"category/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871374;s:9:\"updatedAt\";i:1543825828;}', 1533871374, 1543825828);
INSERT INTO `yl_auth_rule` VALUES ('category/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"category/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871374;s:9:\"updatedAt\";i:1543825828;}', 1533871374, 1543825828);
INSERT INTO `yl_auth_rule` VALUES ('category/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"category/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871374;s:9:\"updatedAt\";i:1544004041;}', 1533871374, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('category/set', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"category/set\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871262;s:9:\"updatedAt\";i:1544004040;}', 1533871262, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('category/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"category/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871374;s:9:\"updatedAt\";i:1544004041;}', 1533871374, 1544004041);
INSERT INTO `yl_auth_rule` VALUES ('config/attachment', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"config/attachment\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825824;}', 1484734191, 1543825824);
INSERT INTO `yl_auth_rule` VALUES ('config/basic', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"config/basic\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825850;}', 1484734191, 1543825850);
INSERT INTO `yl_auth_rule` VALUES ('config/send-mail', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:16:\"config/send-mail\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825824;}', 1484734191, 1543825824);
INSERT INTO `yl_auth_rule` VALUES ('database/export', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:15:\"database/export\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734305;s:9:\"updatedAt\";i:1543825830;}', 1484734305, 1543825830);
INSERT INTO `yl_auth_rule` VALUES ('dic/default/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"dic/default/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871260;s:9:\"updatedAt\";i:1543825825;}', 1533871260, 1543825825);
INSERT INTO `yl_auth_rule` VALUES ('gallery/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"gallery/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1535092909;s:9:\"updatedAt\";i:1543825831;}', 1535092909, 1543825831);
INSERT INTO `yl_auth_rule` VALUES ('gallery/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"gallery/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1535092910;s:9:\"updatedAt\";i:1543825831;}', 1535092910, 1543825831);
INSERT INTO `yl_auth_rule` VALUES ('gallery/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:13:\"gallery/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1535092909;s:9:\"updatedAt\";i:1543825831;}', 1535092909, 1543825831);
INSERT INTO `yl_auth_rule` VALUES ('gallery/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:14:\"gallery/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1535092909;s:9:\"updatedAt\";i:1543825831;}', 1535092909, 1543825831);
INSERT INTO `yl_auth_rule` VALUES ('gallery/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:12:\"gallery/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1535092910;s:9:\"updatedAt\";i:1543825831;}', 1535092910, 1543825831);
INSERT INTO `yl_auth_rule` VALUES ('gii/default/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"gii/default/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871259;s:9:\"updatedAt\";i:1543825824;}', 1533871259, 1543825824);
INSERT INTO `yl_auth_rule` VALUES ('index/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"index/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1544004040;}', 1484734191, 1544004040);
INSERT INTO `yl_auth_rule` VALUES ('index/set', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"index/set\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533882894;s:9:\"updatedAt\";i:1544004042;}', 1533882894, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('link/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"link/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873931;s:9:\"updatedAt\";i:1543825853;}', 1533873931, 1543825853);
INSERT INTO `yl_auth_rule` VALUES ('link/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"link/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825854;}', 1533873932, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('link/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"link/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871386;s:9:\"updatedAt\";i:1543825853;}', 1533871386, 1543825853);
INSERT INTO `yl_auth_rule` VALUES ('link/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"link/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825853;}', 1533873932, 1543825853);
INSERT INTO `yl_auth_rule` VALUES ('link/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"link/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825853;}', 1533873932, 1543825853);
INSERT INTO `yl_auth_rule` VALUES ('menu/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825825;}', 1484734191, 1543825825);
INSERT INTO `yl_auth_rule` VALUES ('menu/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825825;}', 1484734191, 1543825825);
INSERT INTO `yl_auth_rule` VALUES ('menu/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"menu/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825825;}', 1484734191, 1543825825);
INSERT INTO `yl_auth_rule` VALUES ('menu/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"menu/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825825;}', 1484734191, 1543825825);
INSERT INTO `yl_auth_rule` VALUES ('page/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"page/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825854;}', 1533873932, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('page/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"page/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825854;}', 1533873932, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('page/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"page/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871386;s:9:\"updatedAt\";i:1543825854;}', 1533871386, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('page/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"page/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825854;}', 1533873932, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('page/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"page/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533873932;s:9:\"updatedAt\";i:1543825854;}', 1533873932, 1543825854);
INSERT INTO `yl_auth_rule` VALUES ('role/auth', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"role/auth\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('role/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('role/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('role/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"role/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('role/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"role/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1484734191;s:9:\"updatedAt\";i:1543825851;}', 1484734191, 1543825851);
INSERT INTO `yl_auth_rule` VALUES ('upload-files/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:19:\"upload-files/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543572039;s:9:\"updatedAt\";i:1544004042;}', 1543572039, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('upload-files/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:18:\"upload-files/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543572039;s:9:\"updatedAt\";i:1544004042;}', 1543572039, 1544004042);
INSERT INTO `yl_auth_rule` VALUES ('uploadfiles/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:18:\"uploadfiles/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543571807;s:9:\"updatedAt\";i:1543571826;}', 1543571807, 1543571826);
INSERT INTO `yl_auth_rule` VALUES ('uploadfiles/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:17:\"uploadfiles/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1543571807;s:9:\"updatedAt\";i:1543571826;}', 1543571807, 1543571826);
INSERT INTO `yl_auth_rule` VALUES ('user/add', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:8:\"user/add\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871415;s:9:\"updatedAt\";i:1533873933;}', 1533871415, 1533873933);
INSERT INTO `yl_auth_rule` VALUES ('user/create', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"user/create\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533874065;s:9:\"updatedAt\";i:1543825830;}', 1533874065, 1543825830);
INSERT INTO `yl_auth_rule` VALUES ('user/delete', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"user/delete\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871415;s:9:\"updatedAt\";i:1543825830;}', 1533871415, 1543825830);
INSERT INTO `yl_auth_rule` VALUES ('user/index', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:10:\"user/index\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871415;s:9:\"updatedAt\";i:1543825829;}', 1533871415, 1543825829);
INSERT INTO `yl_auth_rule` VALUES ('user/update', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:11:\"user/update\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533871415;s:9:\"updatedAt\";i:1543825830;}', 1533871415, 1543825830);
INSERT INTO `yl_auth_rule` VALUES ('user/view', 'O:23:\"backend\\models\\AuthRule\":4:{s:4:\"name\";s:9:\"user/view\";s:30:\"\0backend\\models\\AuthRule\0_rule\";r:1;s:9:\"createdAt\";i:1533874065;s:9:\"updatedAt\";i:1543825830;}', 1533874065, 1543825830);

-- ----------------------------
-- Table structure for yl_backgroundimage
-- ----------------------------
DROP TABLE IF EXISTS `yl_backgroundimage`;
CREATE TABLE `yl_backgroundimage`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `attach_small_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '小图',
  `attach_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '链接图片',
  `attach_size` tinyint(4) NULL DEFAULT 2 COMMENT '尺寸（1代表4:3 2代表16:9）',
  `status_is` tinyint(4) NOT NULL DEFAULT 0 COMMENT '显示状态( 0否1是)',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '录入时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '背景图片' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_backgroundimage
-- ----------------------------
INSERT INTO `yl_backgroundimage` VALUES (1, '测试背景图片', 1, NULL, 'upload/background/6fde048230bda394b16a6df5ffda770f.jpg', 1, 1, 1542182115);
INSERT INTO `yl_backgroundimage` VALUES (2, '测试背景图片2', 1, NULL, 'upload/background/8c678954df11bcb8469f66d516c6a5ca.png', 1, 1, 1543384155);
INSERT INTO `yl_backgroundimage` VALUES (3, '拓展活动111', 2, NULL, 'upload/background/cce87524eec92c5e53c654d898d8a74a.png', 2, 1, 1543384191);
INSERT INTO `yl_backgroundimage` VALUES (4, '个人荣誉背景图', 4, NULL, 'upload/background/463cd8fa14e6a17f2e526fd62344060b.png', 2, 1, 1543564965);
INSERT INTO `yl_backgroundimage` VALUES (5, '创说会的背景图001', 5, NULL, 'upload/background/0595c499d1ae62975100af66694bc9f3.png', 2, 1, 1543991619);

-- ----------------------------
-- Table structure for yl_category
-- ----------------------------
DROP TABLE IF EXISTS `yl_category`;
CREATE TABLE `yl_category`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '栏目名称',
  `pid` int(10) NULL DEFAULT 0 COMMENT '父级',
  `display` tinyint(2) NULL DEFAULT 1 COMMENT '栏目显示',
  `seo_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SEO栏目标题',
  `seo_keywords` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SEO栏目关键字',
  `seo_description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'SEO栏目描述',
  `images` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '栏目图片',
  `sort` smallint(5) NULL DEFAULT 0 COMMENT '排序',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  `updatetime` datetime NULL DEFAULT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_category
-- ----------------------------
INSERT INTO `yl_category` VALUES (1, '主拓活动', 0, 1, '', '', '', '', 1, '2018-11-14 17:25:49', NULL);
INSERT INTO `yl_category` VALUES (2, '创说会', 0, 1, '', '', '', '', 2, '2018-11-14 17:26:07', NULL);
INSERT INTO `yl_category` VALUES (3, '个人荣誉', 0, 1, '', '', '', '', 3, '2018-11-14 17:26:25', NULL);
INSERT INTO `yl_category` VALUES (4, '荣誉贴纸', 0, 1, '', '', '', '', 4, '2018-11-22 12:45:11', NULL);

-- ----------------------------
-- Table structure for yl_config
-- ----------------------------
DROP TABLE IF EXISTS `yl_config`;
CREATE TABLE `yl_config`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `keyid` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `data` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `keyid`(`keyid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_config
-- ----------------------------
INSERT INTO `yl_config` VALUES (1, 'basic', '', '{\"sitename\":\"\\u6d77\\u62a5\\u5236\\u4f5c\",\"url\":\"http:\\/\\/192.168.0.46:8011\",\"logo\":\"\\/statics\\/themes\\/admin\\/images\\/logo.png\",\"seo_keywords\":\"\\u6d77\\u62a5\\u5236\\u4f5c\",\"seo_description\":\"\\u6d77\\u62a5\\u5236\\u4f5c\",\"copyright\":\"CopyRight\\u00a92018 \\u6d77\\u62a5\\u751f\\u6210\\u5668 Inc.\",\"icp\":\"\\u4eacICP\\u5907130sadfsaf33158\",\"statcode\":\"\",\"close\":\"0\",\"close_reason\":\"\\u7ad9\\u70b9\\u5347\\u7ea7\\u4e2d, \\u8bf7\\u7a0d\\u540e\\u8bbf\\u95ee!\"}');
INSERT INTO `yl_config` VALUES (2, 'sendmail', '', '{\"mail_type\":\"0\",\"smtp_server\":\"smtp.qq.com\",\"smtp_port\":\"25\",\"auth\":\"1\",\"openssl\":\"1\",\"smtp_user\":\"771405950\",\"smtp_pwd\":\"qiaoBo1989122\",\"send_email\":\"771405950@qq.com\",\"nickname\":\"\\u8fb9\\u8d70\\u8fb9\\u4e54\",\"sign\":\"<hr \\/>\\r\\n\\u90ae\\u4ef6\\u7b7e\\u540d\\uff1a\\u6b22\\u8fce\\u8bbf\\u95ee <a href=\\\"http:\\/\\/www.test-yii2cms.com\\\" target=\\\"_blank\\\">Yii2 CMS<\\/a>\"}');
INSERT INTO `yl_config` VALUES (3, 'attachment', '', '{\"attachment_size\":\"2048\",\"attachment_suffix\":\"jpg|jpeg|gif|bmp|png\",\"watermark_enable\":\"1\",\"watermark_pos\":\"0\",\"watermark_text\":\"Yii2 CMS\"}');

-- ----------------------------
-- Table structure for yl_gallery
-- ----------------------------
DROP TABLE IF EXISTS `yl_gallery`;
CREATE TABLE `yl_gallery`  (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '标题',
  `thumb` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '封面图',
  `describe` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '简介',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '内容',
  `addtime` datetime NULL DEFAULT NULL COMMENT '添加时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `title`(`title`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '图集表' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for yl_gallery_item
-- ----------------------------
DROP TABLE IF EXISTS `yl_gallery_item`;
CREATE TABLE `yl_gallery_item`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '图集',
  `introduce` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '描述',
  `files` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片',
  `listorder` smallint(4) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `listorder`(`listorder`) USING BTREE,
  INDEX `item`(`item`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '图库图片' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for yl_link
-- ----------------------------
DROP TABLE IF EXISTS `yl_link`;
CREATE TABLE `yl_link`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `site_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '名称',
  `site_url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '链接地址',
  `sort_order` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `click_count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '点击次数',
  `link_type` enum('image','txt') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'txt' COMMENT '链接类型',
  `attach_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '链接图片',
  `status_is` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '显示状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '录入时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '友情链接' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for yl_menu
-- ----------------------------
DROP TABLE IF EXISTS `yl_menu`;
CREATE TABLE `yl_menu`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `url` varchar(60) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `icon_style` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `display` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `sort` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 75 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_menu
-- ----------------------------
INSERT INTO `yl_menu` VALUES (1, 0, '我的面板', 'index/index', 'fa-home', 1, 1);
INSERT INTO `yl_menu` VALUES (2, 0, '站点设置', 'config/basic', 'fa-cogs', 1, 2);
INSERT INTO `yl_menu` VALUES (3, 0, '管理员设置', 'admin/set', 'fa-user', 1, 3);
INSERT INTO `yl_menu` VALUES (4, 0, '内容设置', 'category/set', 'fa-edit', 1, 4);
INSERT INTO `yl_menu` VALUES (5, 0, '用户设置', 'user/index', 'fa-users', 1, 5);
INSERT INTO `yl_menu` VALUES (6, 0, '数据库设置', 'database/export', 'fa-hdd-o', 1, 8);
INSERT INTO `yl_menu` VALUES (7, 0, '界面设置', '', 'fa-picture-o', 1, 7);
INSERT INTO `yl_menu` VALUES (8, 1, '系统信息', 'index/index', 'fa-inbox', 1, 0);
INSERT INTO `yl_menu` VALUES (9, 2, '站点配置', 'config/basic', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (10, 2, '后台菜单管理', 'menu/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (11, 3, '管理员管理', 'admin/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (12, 3, '角色管理', 'role/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (13, 4, '活动管理', 'activities/index', 'fa-list-alt', 1, 0);
INSERT INTO `yl_menu` VALUES (14, 4, '栏目管理', 'category/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (15, 55, '友情链接', 'link/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (16, 5, '用户管理', 'user/index', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (17, 6, '数据库管理', 'database/export', 'fa-th-list', 1, 0);
INSERT INTO `yl_menu` VALUES (18, 7, '主题管理', '', '', 1, 0);
INSERT INTO `yl_menu` VALUES (19, 7, '模板管理', '', '', 1, 0);
INSERT INTO `yl_menu` VALUES (20, 9, '基本配置', 'config/basic', '', 1, 0);
INSERT INTO `yl_menu` VALUES (21, 9, '邮箱配置', 'config/send-mail', '', 1, 0);
INSERT INTO `yl_menu` VALUES (22, 9, '附件配置', 'config/attachment', '', 1, 0);
INSERT INTO `yl_menu` VALUES (23, 10, '添加菜单', 'menu/create', '', 1, 0);
INSERT INTO `yl_menu` VALUES (24, 10, '更新', 'menu/update', '', 1, 0);
INSERT INTO `yl_menu` VALUES (25, 10, '删除', 'menu/delete', '', 1, 0);
INSERT INTO `yl_menu` VALUES (26, 11, '添加', 'admin/create', '', 1, 0);
INSERT INTO `yl_menu` VALUES (27, 11, '更新', 'admin/update', '', 1, 0);
INSERT INTO `yl_menu` VALUES (28, 11, '授权', 'admin/auth', '', 1, 0);
INSERT INTO `yl_menu` VALUES (29, 11, '删除', 'admin/delete', '', 1, 0);
INSERT INTO `yl_menu` VALUES (30, 12, '添加', 'role/create', '', 1, 0);
INSERT INTO `yl_menu` VALUES (31, 12, '更新', 'role/update', '', 1, 0);
INSERT INTO `yl_menu` VALUES (32, 12, '授权', 'role/auth', '', 1, 0);
INSERT INTO `yl_menu` VALUES (33, 12, '删除', 'role/delete', '', 1, 0);
INSERT INTO `yl_menu` VALUES (34, 14, '添加栏目', 'category/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (35, 14, '更新栏目', 'category/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (36, 14, '删除栏目', 'category/delete', '', 1, 3);
INSERT INTO `yl_menu` VALUES (37, 16, '添加', 'user/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (38, 16, '更新', 'user/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (39, 16, '删除', 'user/delete', '', 1, 4);
INSERT INTO `yl_menu` VALUES (40, 1, 'GII', 'gii/default/index', 'fa-th-list', 1, 2);
INSERT INTO `yl_menu` VALUES (41, 55, '单页管理', 'page/index', 'fa-th-list', 1, 3);
INSERT INTO `yl_menu` VALUES (42, 3, '管理员日志', 'admin-log/index', 'fa-th-list', 1, 3);
INSERT INTO `yl_menu` VALUES (43, 42, '查看', 'admin-log/view', '', 1, 1);
INSERT INTO `yl_menu` VALUES (44, 42, '删除', 'admin-log/delete', '', 1, 2);
INSERT INTO `yl_menu` VALUES (45, 2, '系统字典', 'dic/default/index', 'fa-book', 1, 3);
INSERT INTO `yl_menu` VALUES (46, 15, '添加', 'link/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (47, 15, '更新', 'link/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (48, 15, '查看', 'link/view', '', 1, 3);
INSERT INTO `yl_menu` VALUES (49, 15, '删除', 'link/delete', '', 1, 4);
INSERT INTO `yl_menu` VALUES (50, 41, '添加', 'page/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (51, 41, '更新', 'page/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (52, 41, '查看', 'page/view', '', 1, 3);
INSERT INTO `yl_menu` VALUES (53, 41, '删除', 'page/delete', '', 1, 4);
INSERT INTO `yl_menu` VALUES (54, 16, '查看', 'user/view', '', 1, 3);
INSERT INTO `yl_menu` VALUES (55, 0, '扩展管理', 'index/set', 'fa-list-alt', 1, 6);
INSERT INTO `yl_menu` VALUES (56, 55, '图集管理', 'gallery/index', 'fa-list-alt', 1, 3);
INSERT INTO `yl_menu` VALUES (57, 56, '添加', 'gallery/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (58, 56, '更新', 'gallery/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (59, 56, '查看', 'gallery/view', '', 1, 3);
INSERT INTO `yl_menu` VALUES (60, 56, '删除', 'gallery/delete', '', 1, 4);
INSERT INTO `yl_menu` VALUES (61, 13, '添加', 'activities/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (62, 13, '更新', 'activities/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (63, 13, '查看', 'activities/view', '', 1, 3);
INSERT INTO `yl_menu` VALUES (64, 13, '删除', 'activities/delete', '', 1, 4);
INSERT INTO `yl_menu` VALUES (65, 4, '背景图片管理', 'backgroundimage/index', 'fa-list-alt', 1, 3);
INSERT INTO `yl_menu` VALUES (66, 65, '添加', 'backgroundimage/create', '', 1, 1);
INSERT INTO `yl_menu` VALUES (67, 65, '更新', 'backgroundimage/update', '', 1, 2);
INSERT INTO `yl_menu` VALUES (68, 65, '删除', 'backgroundimage/delete', '', 1, 3);
INSERT INTO `yl_menu` VALUES (69, 65, '查看', 'backgroundimage/view', '', 1, 4);
INSERT INTO `yl_menu` VALUES (70, 55, '附件管理', 'upload-files/index', 'fa-th-list', 1, 3);
INSERT INTO `yl_menu` VALUES (71, 70, '删除', 'upload-files/delete', '', 1, 1);
INSERT INTO `yl_menu` VALUES (72, 4, '海报制作管理', 'activity-poster/index', 'fa-list-alt', 1, 4);
INSERT INTO `yl_menu` VALUES (73, 72, '查看', 'activity-poster/view', '', 1, 1);
INSERT INTO `yl_menu` VALUES (74, 72, '删除', 'activity-poster/delete', '', 1, 2);

-- ----------------------------
-- Table structure for yl_migration
-- ----------------------------
DROP TABLE IF EXISTS `yl_migration`;
CREATE TABLE `yl_migration`  (
  `version` varchar(180) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `apply_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_migration
-- ----------------------------
INSERT INTO `yl_migration` VALUES ('m000000_000000_base', 1482231528);
INSERT INTO `yl_migration` VALUES ('m130524_201442_init', 1482231534);

-- ----------------------------
-- Table structure for yl_page
-- ----------------------------
DROP TABLE IF EXISTS `yl_page`;
CREATE TABLE `yl_page`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标题',
  `title_second` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `title_alias` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '标签',
  `marking` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '唯一标识',
  `intro` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '简单描述',
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '内容',
  `seo_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'SEO标题',
  `seo_keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'SEO KEYWORDS',
  `seo_description` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'SEO DESCRIPTION',
  `sort_order` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '排序',
  `view_count` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '查看次数',
  `status_is` enum('Y','N') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Y' COMMENT '状态',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `marking`(`marking`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '单页' ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for yl_session
-- ----------------------------
DROP TABLE IF EXISTS `yl_session`;
CREATE TABLE `yl_session`  (
  `id` char(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `expire` int(11) NULL DEFAULT NULL,
  `data` blob NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_session
-- ----------------------------
INSERT INTO `yl_session` VALUES ('a8ilmk7v9ea538r57e0quf5bu6', 1544000686, 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2232223B71725F74696D655F62656E63687C613A313A7B733A31323A2261667465725F656E636F6465223B643A313534333939393232312E353131343931313B7D);
INSERT INTO `yl_session` VALUES ('ah580p4qhvgniq46a77btce9o4', 1544000760, 0x5F5F666C6173687C613A303A7B7D);
INSERT INTO `yl_session` VALUES ('m6bs8dp50btmf1o5nckgcr0os5', 1544000540, 0x5F5F666C6173687C613A303A7B7D5F5F72657475726E55726C7C733A31303A222F61646D696E2E706870223B);
INSERT INTO `yl_session` VALUES ('nedr4kfncog9mj07enkfbhv1g2', 1544078105, 0x5F5F666C6173687C613A303A7B7D5F5F69647C733A313A2232223B71725F74696D655F62656E63687C613A313A7B733A31323A2261667465725F656E636F6465223B643A313534343037363634322E343536353435313B7D);

-- ----------------------------
-- Table structure for yl_system_dic
-- ----------------------------
DROP TABLE IF EXISTS `yl_system_dic`;
CREATE TABLE `yl_system_dic`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `status` int(1) NULL DEFAULT 1,
  `sort` int(2) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `pid`(`pid`) USING BTREE,
  CONSTRAINT `yl_system_dic_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `yl_system_dic` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统字典表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_system_dic
-- ----------------------------
INSERT INTO `yl_system_dic` VALUES (1, NULL, '基础状态', 'base_status', 1, 0);
INSERT INTO `yl_system_dic` VALUES (2, 1, '是', '1', 1, 0);
INSERT INTO `yl_system_dic` VALUES (3, 1, '否', '0', 1, 0);
INSERT INTO `yl_system_dic` VALUES (4, NULL, '操作状态', 'do_status', 1, 0);
INSERT INTO `yl_system_dic` VALUES (5, 4, '启用', '1', 1, 0);
INSERT INTO `yl_system_dic` VALUES (6, 4, '禁用', '0', 1, 0);

-- ----------------------------
-- Table structure for yl_upload_files
-- ----------------------------
DROP TABLE IF EXISTS `yl_upload_files`;
CREATE TABLE `yl_upload_files`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `save_path` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '保存路径',
  `save_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '保存文件名不带路径',
  `create_time` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '上传时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '附件' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of yl_upload_files
-- ----------------------------
INSERT INTO `yl_upload_files` VALUES (13, 'upload/upload_files/fbfc0d6709691be76a2586b824ea79df2.png', '', 1543994556);
INSERT INTO `yl_upload_files` VALUES (17, 'upload/upload_files/924bcae6f103ee2cca7b534e09d5f148.png', '', 1543820390);
INSERT INTO `yl_upload_files` VALUES (18, 'upload/upload_files/9c25532f092ccf26f93bb8a330dbf79d.jpg', '', 1543980263);
INSERT INTO `yl_upload_files` VALUES (19, 'upload/upload_files/69351fa2e1373f95559f8ec074b9b782.png', '', 1543991670);
INSERT INTO `yl_upload_files` VALUES (20, 'upload/upload_files/fbfc0d6709691be76a2586b824ea79df.jpg', '', 1543994756);

-- ----------------------------
-- Table structure for yl_user
-- ----------------------------
DROP TABLE IF EXISTS `yl_user`;
CREATE TABLE `yl_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '用户表' ROW_FORMAT = Compact;

-- ----------------------------
-- Procedure structure for my_insert
-- ----------------------------
DROP PROCEDURE IF EXISTS `my_insert`;
delimiter ;;
CREATE PROCEDURE `my_insert`()
BEGIN
   DECLARE n int DEFAULT 1;
        loopname:LOOP
            INSERT INTO `person`(`fname`,`lname`,`age`,`sex`,`addtime`) VALUES ('涨', '三', n+10,'男', Now());
            SET n=n+1;
        IF n=10000000 THEN
            LEAVE loopname;
        END IF;
        END LOOP loopname;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
