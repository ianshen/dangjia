-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 10 月 16 日 07:50
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xiaodangjia`
--

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `store_id` int(11) NOT NULL DEFAULT '0',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '分类层级，默认1级',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id，level1的pid为0',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `ename` varchar(32) NOT NULL DEFAULT '' COMMENT '分类拼音',
  `desc` varchar(256) NOT NULL DEFAULT '' COMMENT '说明文字',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `time_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否定时',
  `days` varchar(32) NOT NULL DEFAULT '' COMMENT '开启时设置,1,2,3,4,5,6,7（表示星期几开启）',
  `start_time` time NOT NULL DEFAULT '00:00:00' COMMENT '开始时间，time_limit为1时设置此值',
  `end_time` time NOT NULL DEFAULT '00:00:00' COMMENT '结束时间，time_limit为1时设置此值',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `order_way` tinyint(1) NOT NULL DEFAULT '0' COMMENT '此分类订单形式(1普通订单产生方式、2生成优惠码方式)',
  `deliver_desc` varchar(64) NOT NULL DEFAULT '' COMMENT '货物配送时间',
  PRIMARY KEY (`id`),
  KEY `group_id` (`group_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `group_id`, `store_id`, `level`, `pid`, `name`, `ename`, `desc`, `create_time`, `update_time`, `time_limit`, `days`, `start_time`, `end_time`, `status`, `order_way`, `deliver_desc`) VALUES
(3, 1, 0, 1, 0, '订午餐', 'dingwucan', '供人订午餐', 1395237337, 1395237337, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1, ''),
(4, 1, 0, 1, 0, '果蔬', 'guoshu', '订水果蔬菜', 1395323280, 1395323280, 1, '1,2,3,4,5', '11:00:00', '14:00:00', 1, 1, ''),
(5, 1, 5, 2, 3, '饺子', 'jiaozi', '饺子', 1395323445, 1413359937, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1, 'xxxxxxxxx'),
(7, 1, 6, 2, 4, '蔬菜', 'shucai', '订蔬菜', 1395323716, 1395323716, 1, '1,2,3,4,5', '13:00:00', '16:00:00', 1, 1, '');

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '商品名',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属分类',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '单价数量如：10元3个，这里就是10',
  `price_num` int(11) NOT NULL DEFAULT '1' COMMENT '单价数量如：10元3个，这里就是3',
  `price_unit` varchar(16) NOT NULL DEFAULT '' COMMENT '单位如：10元3个，这里就是个',
  `desc` varchar(128) NOT NULL DEFAULT '' COMMENT '商品描述',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建日期',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '商品顺序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `goods`
--

INSERT INTO `goods` (`id`, `name`, `category_id`, `price`, `price_num`, `price_unit`, `desc`, `create_time`, `create_date`, `order`, `status`) VALUES
(1, '韭菜鸡蛋', 5, 15, 15, '个', '韭菜鸡蛋饺子', 1397571915, '2014-04-15', 0, 1),
(2, '猪肉大葱', 5, 20, 15, '个', '猪肉大葱饺子', 1397571998, '2014-04-15', 0, 1),
(3, '牛肉大葱', 5, 20, 1, '份', '牛肉大葱饺子', 1397572588, '2014-04-15', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '名',
  `ename` varchar(32) NOT NULL DEFAULT '' COMMENT '拼音名',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL DEFAULT '0000-00-00',
  `region_id` int(11) NOT NULL DEFAULT '0' COMMENT '属所区域',
  `addr_desc_template` varchar(32) NOT NULL DEFAULT '' COMMENT '圈子的详细地址信息模板',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`) USING BTREE,
  KEY `id` (`id`) USING BTREE,
  KEY `region_id` (`region_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `ename`, `create_time`, `create_date`, `region_id`, `addr_desc_template`, `status`) VALUES
(1, '北辰泰岳大厦', 'beichentaiyue', 1395236134, '2014-03-19', 3, '1塔18层', 1),
(6, '明天第一城', 'mingtiandiyicheng', 1395236134, '2014-03-19', 3, '6号院3号楼2单元101', 1),
(8, '甜水园', 'tianshuiyuan', 1411460198, '2014-09-23', 3, '15层', 1);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) NOT NULL DEFAULT '0' COMMENT '订单号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '订单商品的品类',
  `user_name` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_tel` varchar(32) NOT NULL DEFAULT '' COMMENT '用户电话',
  `user_addr` varchar(64) NOT NULL DEFAULT '' COMMENT '地址',
  `message` varchar(128) NOT NULL DEFAULT '' COMMENT '订单留言',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '订单创建时间',
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '订单日期',
  `total_cost` int(11) NOT NULL DEFAULT '0' COMMENT '订单总价',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `user_id`, `category_id`, `user_name`, `user_tel`, `user_addr`, `message`, `create_time`, `update_time`, `create_date`, `total_cost`, `status`) VALUES
(14101361046264430, 11, 5, '哈哈', '13436951431', '北辰泰岳大厦 ', 'aaaaaaaa', 1413190646, 1413190646, '2014-10-14', 35, 1),
(14101361087385527, 13, 5, 'alert(''x'')', '13436951433', '北辰泰岳大厦 1塔15层', 'bbbbbbb', 1413190687, 1413190687, '2014-10-14', 55, 1),
(14101361100117550, 13, 5, 'alert(''x'')', '13436951433', '北辰泰岳大厦 1塔15层', 'cccccccc', 1413190700, 1413190700, '2014-10-14', 55, 1);

-- --------------------------------------------------------

--
-- 表的结构 `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '订单号',
  `good_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `good_name` varchar(32) NOT NULL DEFAULT '',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '单价',
  `price_desc` varchar(32) NOT NULL DEFAULT '' COMMENT '价格描述如：￥20（15个）',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=108 ;

--
-- 转存表中的数据 `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `good_id`, `good_name`, `amount`, `price`, `price_desc`, `status`) VALUES
(101, 14101361046264430, 1, '韭菜鸡蛋', 1, 15, '15(15个)', 1),
(102, 14101361046264430, 2, '猪肉大葱', 1, 20, '20(15个)', 1),
(103, 14101361087385527, 1, '韭菜鸡蛋', 1, 15, '15(15个)', 1),
(104, 14101361087385527, 3, '牛肉大葱', 1, 20, '20(1份)', 1),
(105, 14101361087385527, 2, '猪肉大葱', 1, 20, '20(15个)', 1),
(106, 14101361100117550, 1, '韭菜鸡蛋', 1, 15, '15(15个)', 1),
(107, 14101361100117550, 2, '猪肉大葱', 2, 20, '20(15个)', 1);

-- --------------------------------------------------------

--
-- 表的结构 `region`
--

CREATE TABLE IF NOT EXISTS `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `ename` varchar(32) NOT NULL DEFAULT '',
  `code` varchar(16) NOT NULL DEFAULT '' COMMENT '邮编',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '等级(城市、区县)',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级id',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `region`
--

INSERT INTO `region` (`id`, `name`, `ename`, `code`, `level`, `pid`, `status`) VALUES
(1, '北京', 'beijing', '100000', 0, 0, 1),
(2, '上海', 'shanghai', '200000', 0, 0, 1),
(3, '朝阳', 'chaoyang', '100000', 0, 1, 1),
(4, '海淀', 'haidian', '100000', 0, 1, 4);

-- --------------------------------------------------------

--
-- 表的结构 `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '店铺名',
  `ename` varchar(32) NOT NULL DEFAULT '' COMMENT '店铺名称拼音',
  `passwd` char(32) NOT NULL DEFAULT '' COMMENT '密码',
  `secret` varchar(64) NOT NULL DEFAULT '' COMMENT '凭证UUID',
  `contact` varchar(16) NOT NULL DEFAULT '' COMMENT '联系人',
  `tel` varchar(32) NOT NULL DEFAULT '' COMMENT '联系电话',
  `addr` varchar(64) NOT NULL DEFAULT '' COMMENT '店铺详细地址',
  `desc` varchar(256) NOT NULL DEFAULT '' COMMENT '店铺描述',
  `city` int(10) NOT NULL DEFAULT '0' COMMENT '所属城市',
  `area` int(10) NOT NULL DEFAULT '0' COMMENT '所属地区',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '入驻时间',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '入驻日期',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `name`, `ename`, `passwd`, `secret`, `contact`, `tel`, `addr`, `desc`, `city`, `area`, `create_time`, `update_time`, `create_date`, `status`) VALUES
(5, '店铺1', 'dian1', '55dcfd7f49dbc71b5fe90d199851ee89', '0e6915b9-43c3-11e4-aa07-206a8a319380', '联系人1', '联系电话1', '明天第一城', '明天第', 1, 1, 1395232865, 1411723611, '2014-03-19', 1),
(6, '店铺2', 'dian2', '55dcfd7f49dbc71b5fe90d199851ee89', '1743259e-43c3-11e4-aa07-206a8a319380', '联系人2', '联系电话2', '明天第一城', '明天第', 1, 2, 1395236063, 0, '2014-03-19', 1),
(7, '店铺3', 'dian3', '55dcfd7f49dbc71b5fe90d199851ee89', '1e1fd431-43c3-11e4-aa07-206a8a319380', '联系人3', '联系电话3', '明天第一城', '明天第', 1, 2, 1395236084, 0, '2014-03-19', 1);

-- --------------------------------------------------------

--
-- 表的结构 `store_category`
--

CREATE TABLE IF NOT EXISTS `store_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '分类名称',
  `desc` varchar(256) NOT NULL DEFAULT '' COMMENT '说明文字',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `order` tinyint(1) NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `store_category`
--

INSERT INTO `store_category` (`id`, `store_id`, `name`, `desc`, `create_time`, `update_time`, `order`, `status`) VALUES
(3, 5, '盖饭', '', 1395237337, 1395237337, 1, 1),
(4, 5, '炒菜', '', 1395323280, 1395323280, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `store_goods`
--

CREATE TABLE IF NOT EXISTS `store_goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '商品名',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `store_cate_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属分类',
  `price` varchar(64) NOT NULL DEFAULT '0' COMMENT '价格如：10元3个',
  `desc` varchar(128) NOT NULL DEFAULT '' COMMENT '商品描述',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '商品顺序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `passwd` char(32) NOT NULL DEFAULT '',
  `mobile` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`) USING HASH,
  KEY `mobile` (`mobile`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `passwd`, `mobile`, `email`, `create_time`, `update_time`, `status`) VALUES
(11, '哈哈', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951431', 'test1@126.com', 1397444811, 1413015318, 1),
(13, 'alert(''x'')', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951433', 'test3@126.com', 1397480095, 1411030793, 1),
(17, '', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951432', 'test2@126.com', 1410852095, 1410852095, 1),
(18, '', '55dcfd7f49dbc71b5fe90d199851ee89', '', 'test4@126.com', 1410853546, 1410853546, 1),
(19, '', '66353c24a2ba3b00870a13575a9a33f7', '', 'test5@126.com', 1411031378, 1411031975, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `detail` varchar(128) NOT NULL DEFAULT '' COMMENT '用户在群组的具体信息，详细地址',
  `linkman` varchar(32) NOT NULL DEFAULT '' COMMENT '在当前圈子内的联系人，非必须',
  `mobile` varchar(32) NOT NULL DEFAULT '' COMMENT '在当前圈子内的联系电话，非必须',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`, `detail`, `linkman`, `mobile`, `status`) VALUES
(13, 1, '1塔15层', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
