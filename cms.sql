/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : cms

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-03-08 10:11:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `cms_admin`
-- ----------------------------
DROP TABLE IF EXISTS `cms_admin`;
CREATE TABLE `cms_admin` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nickname` varchar(40) NOT NULL COMMENT '昵称',
  `avatar` varchar(200) NOT NULL COMMENT '头像',
  `create_time` int(11) NOT NULL,
  `last_login_time` int(11) NOT NULL COMMENT '最后登录时间',
  `last_login_out` int(11) NOT NULL COMMENT '最后退出时间',
  `role_id` int(11) NOT NULL COMMENT '角色id',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Records of cms_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_auth_group`
-- ----------------------------
DROP TABLE IF EXISTS `cms_auth_group`;
CREATE TABLE `cms_auth_group` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` char(80) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_auth_group
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_auth_group_access`
-- ----------------------------
DROP TABLE IF EXISTS `cms_auth_group_access`;
CREATE TABLE `cms_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  KEY `uid` (`uid`),
  KEY `group_id` (`group_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_auth_group_access
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_auth_rule`
-- ----------------------------
DROP TABLE IF EXISTS `cms_auth_rule`;
CREATE TABLE `cms_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `condition` char(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_auth_rule
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_category`
-- ----------------------------
DROP TABLE IF EXISTS `cms_category`;
CREATE TABLE `cms_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '类别组id',
  `name` varchar(100) NOT NULL COMMENT '名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_enable` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `delete_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='类别表';

-- ----------------------------
-- Records of cms_category
-- ----------------------------
INSERT INTO `cms_category` VALUES ('1', '0', '文章', '1', '0', '0', '0');

-- ----------------------------
-- Table structure for `cms_log_admin`
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_admin`;
CREATE TABLE `cms_log_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(10) unsigned NOT NULL COMMENT '管理员uid',
  `ip` varchar(50) NOT NULL COMMENT '当前ip地址',
  `create_time` int(10) unsigned NOT NULL COMMENT '登录时间',
  `url` varchar(100) NOT NULL COMMENT '当前控制器/方法',
  `log` text NOT NULL COMMENT '日志内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of cms_log_admin
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_log_user`
-- ----------------------------
DROP TABLE IF EXISTS `cms_log_user`;
CREATE TABLE `cms_log_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `uid` int(10) unsigned NOT NULL COMMENT '用户id',
  `status` tinyint(4) NOT NULL COMMENT '状态：1成功，-1失败,0仅仅提示',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建时间',
  `log` text NOT NULL COMMENT '日志内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='用户日志表，专门记录用户的踪迹。';

-- ----------------------------
-- Records of cms_log_user
-- ----------------------------

-- ----------------------------
-- Table structure for `cms_menu`
-- ----------------------------
DROP TABLE IF EXISTS `cms_menu`;
CREATE TABLE `cms_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL COMMENT '父id',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `url` varchar(100) NOT NULL COMMENT '访问地址',
  `icon` varchar(100) NOT NULL COMMENT '图标',
  `sort` int(11) NOT NULL COMMENT '排序',
  `delete_time` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of cms_menu
-- ----------------------------
INSERT INTO `cms_menu` VALUES ('1', '0', '主页', '', 'layui-icon-home', '100', '1537334810');
INSERT INTO `cms_menu` VALUES ('2', '0', '会员管理', '', 'layui-icon-user', '20', '0');
INSERT INTO `cms_menu` VALUES ('3', '0', '财务管理', '', 'layui-icon-dollar', '18', '0');
INSERT INTO `cms_menu` VALUES ('4', '0', '商品管理', '', 'layui-icon-cart', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('6', '0', '消息管理', '', 'layui-icon-chat', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('7', '0', '新闻管理', '', 'layui-icon-list', '0', '1536127471');
INSERT INTO `cms_menu` VALUES ('125', '0', '数据库管理', '', 'layui-icon-template-1', '0', '1551099594');
INSERT INTO `cms_menu` VALUES ('9', '0', '设置', '', 'layui-icon-set', '0', '0');
INSERT INTO `cms_menu` VALUES ('10', '0', '日志管理', '', 'layui-icon-read', '0', '0');
INSERT INTO `cms_menu` VALUES ('11', '0', '权限管理', '', 'layui-icon-vercode', '0', '0');
INSERT INTO `cms_menu` VALUES ('13', '1', '控制台', 'console', '', '0', '1537334810');
INSERT INTO `cms_menu` VALUES ('14', '2', '会员列表', 'userList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('15', '3', '账户余额', 'record/balanceList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('16', '3', '账户明细', 'record/walletRecordList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('17', '3', '投资单明细', 'record/invest/investList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('18', '3', '转账明细', 'record/transfer', '', '0', '1551174432');
INSERT INTO `cms_menu` VALUES ('19', '3', '兑换明细', 'record/change', '', '0', '1551174427');
INSERT INTO `cms_menu` VALUES ('20', '3', '期释放明细', 'finance/phaseRelease', '', '0', '1533807867');
INSERT INTO `cms_menu` VALUES ('21', '3', '期利息明细', 'finance/phaseInterest', '', '0', '1533807877');
INSERT INTO `cms_menu` VALUES ('22', '3', '直推奖 明细', 'record/direct', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('23', '3', '跨平台转账明细', 'finance/apiTransfer', '', '0', '1533807854');
INSERT INTO `cms_menu` VALUES ('24', '4', '商品列表', 'goods/goodsList', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('25', '4', '添加商品', 'goods/addGoods', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('26', '4', '商品模型', 'goods/goodsModel', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('29', '4', '订单列表', 'goodsOrder/orderList', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('30', '6', '公告列表', 'notice/index', '', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('31', '6', '发布公告', 'notice/create', '', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('32', '6', '私信列表', 'message/index', '', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('34', '7', '新闻列表', 'news/newList', '', '0', '1536127471');
INSERT INTO `cms_menu` VALUES ('35', '7', '发布新闻', 'news/addNews', '', '0', '1536127471');
INSERT INTO `cms_menu` VALUES ('36', '11', '后台管理员', 'admin/adminList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('38', '11', '增加管理员', 'admin/addAdmin', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('39', '9', '变量配置', 'admin/variable/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('40', '9', '类别设置', 'admin/category/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('53', '4', '商品规格', 'goods/goodsAttributeList', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('42', '10', '会员日志', 'log/userLog', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('43', '10', '会员登录日志', 'log/userLoginLogList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('44', '10', '管理员日志', 'admin/logAdmin', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('52', '9', '修改密码', 'adminSet/updatePwd', '', '0', '1550637248');
INSERT INTO `cms_menu` VALUES ('46', '10', '管理员登录日志', 'log/adminLoginLogList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('47', '11', '角色列表', 'rules/roleList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('48', '11', '添加角色', 'rules/addRole', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('49', '11', '编辑权限', 'rules/authList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('50', '11', '添加权限', 'rules/addRules', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('51', '9', '菜单设置', 'admin/menu/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('56', '0', '市场管理', '', 'layui-icon-cart', '1', '0');
INSERT INTO `cms_menu` VALUES ('55', '0', '测试添加', '', '', '0', '1533174094');
INSERT INTO `cms_menu` VALUES ('57', '56', '市场订单', 'record/market/marketList', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('58', '56', '进行中订单', 'record/market/marketOrder', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('59', '56', '买单交易中', 'buyTrading', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('60', '56', '卖单交易中', 'sellTrading', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('61', '56', '买单已完成', 'buyComplete', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('62', '56', '卖单已完成', 'sellComplete', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('63', '56', '买单已取消', 'buyCancel', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('64', '56', '卖单已取消', 'sellCancel', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('65', '56', '申述中订单', 'complaint', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('66', '56', '已取消挂单', 'cancelMarket', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('67', '56', '全部挂单', 'allMarket', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('68', '56', '全部订单', 'allOrder', '', '0', '1533808636');
INSERT INTO `cms_menu` VALUES ('69', '3', '投资单列表', 'investList', '', '0', '1533807845');
INSERT INTO `cms_menu` VALUES ('70', '9', '发布认购设置', '', '', '0', '1533807915');
INSERT INTO `cms_menu` VALUES ('71', '3', '虚拟币转出', 'virtualCurrency', '', '0', '1533807837');
INSERT INTO `cms_menu` VALUES ('72', '4', '商品类别', 'goodsType', '', '0', '1545115149');
INSERT INTO `cms_menu` VALUES ('76', '73', '完成买', 'entrustCompleteBuy', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('75', '73', '委托卖', 'entrustSell', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('77', '73', '完成记录', 'entrust/complete', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('78', '73', '委托撤销', 'entrustCancel', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('73', '0', '委托交易', '', 'layui-icon-list', '19', '1544147917');
INSERT INTO `cms_menu` VALUES ('74', '73', '委托管理', 'entrust/index', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('82', '9', '行情设置', 'quotationSet', '', '0', '1551256116');
INSERT INTO `cms_menu` VALUES ('80', '6', '工单管理', 'feedbackList', '', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('81', '6', '发送消息', 'message/addMessage', '', '0', '1545101009');
INSERT INTO `cms_menu` VALUES ('83', '9', '异常检测', '', '', '0', '1533971538');
INSERT INTO `cms_menu` VALUES ('84', '3', '钱包检测', 'selfInspectionSystem/response', '', '0', '1535460749');
INSERT INTO `cms_menu` VALUES ('85', '3', '充值导入', 'importExcel', '', '-1', '1537439950');
INSERT INTO `cms_menu` VALUES ('86', '90', '支付方式配置', 'set/paySet/select', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('87', '90', '钱包设置', 'set/walletSet', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('88', '90', '投资级别设置', 'investSetList', '', '0', '1546067796');
INSERT INTO `cms_menu` VALUES ('89', '90', '领导奖比例配置', 'leaderSet', '', '0', '1544147880');
INSERT INTO `cms_menu` VALUES ('90', '0', '财务设置', '', 'layui-icon-set', '0', '0');
INSERT INTO `cms_menu` VALUES ('91', '90', '保险钱包比例配置', 'SafeWalletSet', '', '0', '1544147888');
INSERT INTO `cms_menu` VALUES ('92', '3', '静态利息明细', 'record/interest', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('93', '2', '业绩管理', 'results/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('94', '2', '实名认证', 'record/realName/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('95', '0', '充值管理', '', 'layui-icon-rmb', '17', '1551094436');
INSERT INTO `cms_menu` VALUES ('96', '0', '提现管理', '', '', '0', '1535460763');
INSERT INTO `cms_menu` VALUES ('97', '95', '充值订单', 'recharge/list', '', '0', '1551094436');
INSERT INTO `cms_menu` VALUES ('98', '95', '充值进行中', 'recharge/dispose', '', '0', '1551094436');
INSERT INTO `cms_menu` VALUES ('99', '95', '充值已完成', 'recharge/complete', '', '0', '1551094436');
INSERT INTO `cms_menu` VALUES ('100', '3', 'VIP奖明细', 'record/vipAward', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('101', '95', '充值申述中', 'recharge/complaint', '', '0', '1551094436');
INSERT INTO `cms_menu` VALUES ('102', '95', '充值已取消', 'recharge/cancel', '', '0', '1551094436');
INSERT INTO `cms_menu` VALUES ('103', '0', '提现管理', '', 'layui-icon-dollar', '16', '1551094441');
INSERT INTO `cms_menu` VALUES ('104', '103', '提现待匹配', 'withdrawal/index', '', '0', '1551094441');
INSERT INTO `cms_menu` VALUES ('105', '103', '提现进行中', 'withdrawal/dispose', '', '0', '1551094441');
INSERT INTO `cms_menu` VALUES ('106', '103', '提币订单', 'withdrawal/list', '', '0', '1551094441');
INSERT INTO `cms_menu` VALUES ('107', '103', '提现申述中', 'withdrawal/complaint', '', '0', '1551094441');
INSERT INTO `cms_menu` VALUES ('108', '103', '提现已取消', 'withdrawal/cancel', '', '0', '1551094441');
INSERT INTO `cms_menu` VALUES ('109', '90', '会员职位设置', 'positionSet', '', '0', '1544147896');
INSERT INTO `cms_menu` VALUES ('110', '3', '动态利息明细', 'record/dynamic', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('111', '73', '委托卖单', 'entrustSellStock', '', '0', '1544147917');
INSERT INTO `cms_menu` VALUES ('112', '3', '委托挂卖配置', '', '', '0', '1537499698');
INSERT INTO `cms_menu` VALUES ('113', '90', '委托交易配置', 'entrustSet/index', '', '0', '1544147874');
INSERT INTO `cms_menu` VALUES ('114', '0', '拆分管理', '', '', '0', '1539150688');
INSERT INTO `cms_menu` VALUES ('115', '114', '拆分记录', 'breakUp/index', '', '0', '1539150688');
INSERT INTO `cms_menu` VALUES ('116', '114', '执行拆分', 'breakUp/split', '', '0', '1539150688');
INSERT INTO `cms_menu` VALUES ('117', '90', '提现设置', 'withdrawSet/index', '', '0', '1547804151');
INSERT INTO `cms_menu` VALUES ('118', '0', '文章管理', '', 'layui-icon-read', '0', '0');
INSERT INTO `cms_menu` VALUES ('119', '118', '文章列表', 'article/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('120', '118', '文章类型', 'articleType/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('121', '9', '网站设置', 'webSet', '', '0', '1546605518');
INSERT INTO `cms_menu` VALUES ('122', '90', '交易市场', 'marketSet/index', '', '0', '123456');
INSERT INTO `cms_menu` VALUES ('123', '14', '会员详情', 'user/detail', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('124', '30', '公告详情', 'notice/read', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('126', '125', '数据库文件', 'backupView', '', '0', '1551099594');
INSERT INTO `cms_menu` VALUES ('127', '0', '工单系统', '', 'layui-icon-tabs', '0', '1547186590');
INSERT INTO `cms_menu` VALUES ('128', '127', '工单管理', 'workOrder/index', '', '0', '1547186590');
INSERT INTO `cms_menu` VALUES ('129', '90', '签到设置', 'signIn/index', '', '0', '1551160058');
INSERT INTO `cms_menu` VALUES ('130', '3', '签到明细 ', 'record/signIn/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('131', '90', '抽奖设置', 'set/drawSet/index', '', '0', '1550637162');
INSERT INTO `cms_menu` VALUES ('132', '2', '排行榜', 'rankList/index', '', '0', '1550642903');
INSERT INTO `cms_menu` VALUES ('133', '118', '多语言设置', 'lang/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('134', '0', '任务管理', '', 'layui-icon-layer', '0', '1546058478');
INSERT INTO `cms_menu` VALUES ('135', '134', '任务列表', 'achievement/index', '', '0', '1546058478');
INSERT INTO `cms_menu` VALUES ('136', '3', '释放明细', 'release/releaseRecord', '', '0', '1551077911');
INSERT INTO `cms_menu` VALUES ('137', '3', '分红明细', 'release/shareOutBounsRecord', '', '0', '1551077917');
INSERT INTO `cms_menu` VALUES ('138', '90', 'VIP等级设置', 'set/levelSet', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('139', '90', '期数管理', 'set/periodSet', '', '0', '1551160074');
INSERT INTO `cms_menu` VALUES ('140', '2', '会员宠物级别', 'userLevel', '', '0', '1550642898');
INSERT INTO `cms_menu` VALUES ('141', '3', '转盘中奖记录', 'record/rotaryTable', '', '0', '1550637212');
INSERT INTO `cms_menu` VALUES ('142', '3', '宝箱记录', 'record/openBox', '', '0', '1550637207');
INSERT INTO `cms_menu` VALUES ('143', '9', '宠物外形', 'set/petSet/index', '', '0', '1550637182');
INSERT INTO `cms_menu` VALUES ('144', '9', '宠物性格', 'set/petCharacter/index', '', '0', '1550637188');
INSERT INTO `cms_menu` VALUES ('145', '0', '成就管理', '', 'layui-icon-app', '0', '1550667867');
INSERT INTO `cms_menu` VALUES ('146', '145', '成就类型', 'set/achievementType/index', '', '0', '1550667867');
INSERT INTO `cms_menu` VALUES ('147', '145', '成就任务', 'set/achievement/index', '', '0', '1550667867');
INSERT INTO `cms_menu` VALUES ('148', '145', '成就完成记录', 'record/achievementRecord', '', '0', '1550667867');
INSERT INTO `cms_menu` VALUES ('149', '90', '代数奖设置', 'set/algebraAward/index', '', '0', '1551079394');
INSERT INTO `cms_menu` VALUES ('150', '90', '竞猜期数', 'set/guessPeriod', '', '0', '1550637153');
INSERT INTO `cms_menu` VALUES ('151', '90', '区块猜谜', 'set/guessingPeriod', '', '0', '1550637146');
INSERT INTO `cms_menu` VALUES ('152', '3', '区块猜谜', 'record/guessing', '', '0', '1550637203');
INSERT INTO `cms_menu` VALUES ('153', '90', '区块算法', 'set/guessBlockPeriod', '', '0', '1550637136');
INSERT INTO `cms_menu` VALUES ('155', '0', '物品管理', '', 'layui-icon-component', '0', '0');
INSERT INTO `cms_menu` VALUES ('156', '155', '物品设置', 'set/items/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('157', '155', '背包管理', 'record/backpack', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('160', '90', '后台收款方式', 'set/adminPay/select', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('161', '3', '代数奖明细', 'record/algebra', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('162', '56', '新人买单', 'record/Neworder/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('163', '2', '会员收款地址', 'record/userpay/index', '', '0', '0');
INSERT INTO `cms_menu` VALUES ('164', '2', '反馈管理', 'record/feedback/index', '', '0', '0');

-- ----------------------------
-- Table structure for `cms_variable_set`
-- ----------------------------
DROP TABLE IF EXISTS `cms_variable_set`;
CREATE TABLE `cms_variable_set` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `key` varchar(100) NOT NULL COMMENT '标识',
  `value` varchar(1000) NOT NULL COMMENT '值',
  `type_id` int(11) NOT NULL COMMENT '类型id',
  `sort` int(11) NOT NULL COMMENT '排序',
  `is_enable` int(11) NOT NULL COMMENT '是否启用,1true,0false',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `delete_time` int(11) NOT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='变量配置表';

-- ----------------------------
-- Records of cms_variable_set
-- ----------------------------

-- ----------------------------
-- Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of migrations
-- ----------------------------
