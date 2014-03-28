-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 03 月 28 日 03:39
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
  `desc` varchar(512) NOT NULL DEFAULT '' COMMENT '说明文字',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `time_limit` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否定时',
  `days` varchar(32) NOT NULL DEFAULT '' COMMENT '开启时设置,1,2,3,4,5,6,7（表示星期几开启）',
  `start_time` time NOT NULL DEFAULT '00:00:00' COMMENT '开始时间，time_limit为1时设置此值',
  `end_time` time NOT NULL DEFAULT '00:00:00' COMMENT '结束时间，time_limit为1时设置此值',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `order_way` tinyint(1) NOT NULL DEFAULT '0' COMMENT '此分类订单形式(1普通订单产生方式、2生成优惠码方式)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `group_id`, `store_id`, `level`, `pid`, `name`, `ename`, `desc`, `create_time`, `update_time`, `time_limit`, `days`, `start_time`, `end_time`, `status`, `order_way`) VALUES
(3, 1, 5, 1, 0, '订午餐', 'dingwucan', '供人订午餐', 1395237337, 1395237337, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1),
(4, 1, 0, 1, 0, '果蔬', 'guoshu', '订水果蔬菜', 1395323280, 1395323280, 1, '1,2,3,4,5', '11:00:00', '14:00:00', 1, 1),
(5, 1, 5, 2, 3, '饺子', 'jiaozi', '饺子', 1395323445, 1395323445, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1),
(6, 1, 5, 2, 4, '水果', 'shuiguo', '订水果', 1395323656, 1395323656, 1, '1,2,3,4,5', '11:00:00', '14:00:00', 1, 1),
(7, 1, 6, 2, 4, '蔬菜', 'shucai', '订蔬菜', 1395323716, 1395323716, 1, '1,2,3,4,5', '13:00:00', '16:00:00', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '商品名',
  `category_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属分类',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `desc` varchar(128) NOT NULL DEFAULT '' COMMENT '商品描述',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '创建日期',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '商品顺序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `ename`, `create_time`, `create_date`, `region_id`, `status`) VALUES
(1, '北辰泰岳大厦', 'beichentaiyue', 0, '0000-00-00', 0, 0),
(6, '明天第一城', 'mingtiandiyicheng', 1395236134, '2014-03-19', 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) NOT NULL DEFAULT '0' COMMENT '订单号',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `user_name` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_tel` varchar(32) NOT NULL DEFAULT '' COMMENT '用户电话',
  `user_addr` varchar(64) NOT NULL DEFAULT '' COMMENT '地址',
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '订单创建时间',
  `total_cost` int(11) NOT NULL DEFAULT '0' COMMENT '订单总价',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '商品数量',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `order_detail`
--

CREATE TABLE IF NOT EXISTS `order_detail` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL DEFAULT '0' COMMENT '订单号',
  `good_id` int(11) NOT NULL DEFAULT '0' COMMENT '商品id',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '数量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '单价',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  UNIQUE KEY `uni_code` (`ename`)
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
  `create_time` int(11) NOT NULL DEFAULT '0' COMMENT '入驻时间',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT '入驻日期',
  `contact` varchar(16) DEFAULT '' COMMENT '联系人',
  `tel` varchar(32) DEFAULT '' COMMENT '联系电话',
  `addr` varchar(64) NOT NULL DEFAULT '' COMMENT '店铺详细地址',
  `city` int(10) NOT NULL DEFAULT '0' COMMENT '所属城市',
  `area` int(10) NOT NULL DEFAULT '0' COMMENT '所属地区',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `name`, `ename`, `create_time`, `create_date`, `contact`, `tel`, `addr`, `city`, `area`, `status`) VALUES
(5, '店铺1', 'dian1', 1395232865, '2014-03-19', '联系人1', '联系电话1', '明天第一城', 1, 1, 1),
(6, '店铺2', 'dian2', 1395236063, '2014-03-19', '联系人2', '联系电话2', '明天第一城', 1, 2, 1),
(7, '店铺3', 'dian3', 1395236084, '2014-03-19', '联系人3', '联系电话3', '明天第一城', 1, 2, 1),
(8, 'aaa', 'aaa', 0, '0000-00-00', '', '', '', 0, 0, 1),
(9, 'aaa', 'aaa', 0, '0000-00-00', '', '', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `passwd` char(32) NOT NULL DEFAULT '',
  `tel` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(128) NOT NULL DEFAULT '',
  `create_time` int(11) NOT NULL DEFAULT '0',
  `update_time` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `passwd`, `tel`, `email`, `create_time`, `update_time`, `status`) VALUES
(3, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 2014, 0, 0),
(4, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 0, 0, 0),
(5, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 0, 0, 0),
(6, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 0, 0, 0),
(7, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 0, 0, 0),
(8, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户',
  `group_id` int(11) NOT NULL DEFAULT '0' COMMENT '群组',
  `detail` varchar(128) NOT NULL DEFAULT '' COMMENT '用户在群组的具体信息，详细地址',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
