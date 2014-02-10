-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 02 月 10 日 15:01
-- 服务器版本: 5.5.8
-- PHP 版本: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `xiaodangjia`
--

-- --------------------------------------------------------

--
-- 表的结构 `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '商品名',
  `store_id` int(11) NOT NULL DEFAULT '0' COMMENT '所属店铺',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '价格',
  `good_type` int(11) NOT NULL DEFAULT '0' COMMENT '商品分类（默认无为0）',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_date` date NOT NULL DEFAULT '0000-00-00',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '商品顺序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `goods`
--


-- --------------------------------------------------------

--
-- 表的结构 `goods_type`
--

CREATE TABLE IF NOT EXISTS `goods_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '类型名',
  `store_id` int(11) NOT NULL DEFAULT '0',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_date` date NOT NULL DEFAULT '0000-00-00',
  `order` int(11) NOT NULL DEFAULT '1' COMMENT '分类的排序',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `goods_type`
--


-- --------------------------------------------------------

--
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '名',
  `ename` varchar(32) NOT NULL DEFAULT '' COMMENT '拼音名',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_date` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ename` (`ename`) USING BTREE,
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `ename`, `create_time`, `create_date`, `status`) VALUES
(1, '北辰泰岳大厦', 'beichentaiyue', '0000-00-00 00:00:00', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `group_store`
--

CREATE TABLE IF NOT EXISTS `group_store` (
  `group_id` int(11) NOT NULL DEFAULT '0',
  `store_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`,`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `group_store`
--

INSERT INTO `group_store` (`group_id`, `store_id`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- 表的结构 `store`
--

CREATE TABLE IF NOT EXISTS `store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '',
  `ename` varchar(32) NOT NULL DEFAULT '',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_date` date NOT NULL DEFAULT '0000-00-00',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `name`, `ename`, `create_time`, `create_date`, `status`) VALUES
(1, 'aaa', 'bbb', '0000-00-00 00:00:00', '0000-00-00', 1),
(2, 'ccc', 'ddd', '0000-00-00 00:00:00', '0000-00-00', 1),
(3, 'eee', 'fff', '0000-00-00 00:00:00', '0000-00-00', 0);

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
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `update_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100000 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `passwd`, `tel`, `email`, `create_time`, `update_time`, `status`) VALUES
(1, 'aaa', '47bce5c74f589f4867dbd57e9ca9f808', '', '', '2014-02-10 16:32:03', '0000-00-00 00:00:00', 0),
(3, 'ian', 'a71a448d3d8474653e831749b8e71fcc', '', '', '2014-02-10 16:32:03', '0000-00-00 00:00:00', 0);
