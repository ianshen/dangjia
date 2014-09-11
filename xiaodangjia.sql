-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 09 月 11 日 10:04
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `category`
--

INSERT INTO `category` (`id`, `group_id`, `store_id`, `level`, `pid`, `name`, `ename`, `desc`, `create_time`, `update_time`, `time_limit`, `days`, `start_time`, `end_time`, `status`, `order_way`, `deliver_desc`) VALUES
(3, 1, 5, 1, 0, '订午餐', 'dingwucan', '供人订午餐', 1395237337, 1395237337, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1, ''),
(4, 1, 0, 1, 0, '果蔬', 'guoshu', '订水果蔬菜', 1395323280, 1395323280, 1, '1,2,3,4,5', '11:00:00', '14:00:00', 1, 1, ''),
(5, 1, 5, 2, 3, '饺子', 'jiaozi', '饺子', 1395323445, 1395323445, 1, '1,2,3,4,5', '08:00:00', '11:00:00', 1, 1, ''),
(6, 1, 5, 2, 4, '水果', 'shuiguo', '订水果', 1395323656, 1395323656, 1, '1,2,3,4,5', '11:00:00', '14:00:00', 1, 1, ''),
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
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `ename`, `create_time`, `create_date`, `region_id`, `addr_desc_template`, `status`) VALUES
(1, '北辰泰岳大厦', 'beichentaiyue', 1395236134, '2014-03-19', 3, '1塔18层', 1),
(6, '明天第一城', 'mingtiandiyicheng', 1395236134, '2014-03-19', 3, '6号院3号楼2单元101', 1);

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
  `update_time` int(11) NOT NULL DEFAULT '0' COMMENT '更新时间',
  `total_cost` int(11) NOT NULL DEFAULT '0' COMMENT '订单总价',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `order`
--

INSERT INTO `order` (`id`, `user_id`, `user_name`, `user_tel`, `user_addr`, `create_time`, `update_time`, `total_cost`, `status`) VALUES
(1409046700019522, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409827000, 0, 55, 1),
(14090467227612456, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409827227, 0, 55, 1),
(14090539265324708, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409885665, 0, 105, 1),
(14090539314221428, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409885714, 1410246438, 105, 1),
(14090540525857777, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409886925, 0, 105, 1),
(14090555469207936, 13, '<scrip', '13436951435', '北辰泰岳大厦 ', 1409901869, 0, 105, 1),
(14090964474288082, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256474, 1410256474, 1, 1),
(14090964481619110, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256481, 1410256481, 2, 1),
(14090964485910406, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256485, 1410256485, 3, 1),
(14090964486755806, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256486, 1410256486, 4, 1),
(14090964487537581, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256487, 1410256487, 5, 1),
(14090964488142564, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256488, 1410256488, 6, 1),
(14090964492568008, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256492, 1410256492, 7, 1),
(14090964492970037, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256493, 1410256492, 9, 1),
(14090964494955260, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256494, 1410256494, 10, 1),
(14090964495605520, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256495, 1410256495, 11, 1),
(14090964496919199, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256496, 1410256496, 13, 1),
(14090964497154785, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256491, 1410256497, 12, 1),
(14090964497390581, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256497, 1410256497, 14, 1),
(14090964498815573, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256498, 1410256498, 15, 1),
(14090964499542076, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256499, 1410256499, 18, 1),
(14090964500110387, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256500, 1410256500, 16, 1),
(14090964500653070, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256502, 1410256500, 17, 1),
(14090964501100849, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256501, 1410256501, 19, 1),
(14090964508618079, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256508, 1410256508, 20, 1),
(14090964509140302, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256509, 1410256509, 21, 1),
(14090964509597993, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256511, 1410256509, 22, 1),
(14090964509950022, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256512, 1410256509, 267, 1),
(14090964510368188, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256513, 1410256510, 23, 1),
(14090964510673405, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256514, 1410256510, 24, 1),
(14090964516824533, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256516, 1410256516, 91, 1),
(14090964517284919, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256517, 1410256517, 26, 1),
(14090964517822319, 13, 'Ian', '13436951435', '北辰泰岳大厦 15层', 1410256518, 1410256517, 90, 1);

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
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- 转存表中的数据 `order_detail`
--

INSERT INTO `order_detail` (`id`, `order_id`, `good_id`, `good_name`, `amount`, `price`, `status`) VALUES
(1, 14090538696860596, 3, '', 1, 20, 1),
(2, 14090538696860596, 2, '', 2, 20, 1),
(3, 14090538696860596, 1, '', 3, 15, 1),
(4, 14090539265324708, 3, '', 1, 20, 1),
(5, 14090539265324708, 2, '', 2, 20, 1),
(6, 14090539265324708, 1, '', 3, 15, 1),
(7, 14090540525857777, 3, '牛肉大葱', 1, 20, 1),
(8, 14090540525857777, 2, '猪肉大葱', 2, 20, 1),
(9, 14090540525857777, 1, '韭菜鸡蛋', 3, 15, 1),
(10, 14090555469207936, 3, '牛肉大葱', 1, 20, 1),
(11, 14090555469207936, 2, '猪肉大葱', 2, 20, 1),
(12, 14090555469207936, 1, '韭菜鸡蛋', 3, 15, 1),
(13, 14090964474288082, 1, '韭菜鸡蛋', 2, 15, 1),
(14, 14090964474288082, 2, '猪肉大葱', 3, 20, 1),
(15, 14090964481619110, 1, '韭菜鸡蛋', 2, 15, 1),
(16, 14090964481619110, 2, '猪肉大葱', 3, 20, 1),
(17, 14090964485910406, 1, '韭菜鸡蛋', 2, 15, 1),
(18, 14090964485910406, 2, '猪肉大葱', 3, 20, 1),
(19, 14090964486755806, 1, '韭菜鸡蛋', 2, 15, 1),
(20, 14090964486755806, 2, '猪肉大葱', 3, 20, 1),
(21, 14090964487537581, 1, '韭菜鸡蛋', 2, 15, 1),
(22, 14090964487537581, 2, '猪肉大葱', 3, 20, 1),
(23, 14090964488142564, 1, '韭菜鸡蛋', 2, 15, 1),
(24, 14090964488142564, 2, '猪肉大葱', 3, 20, 1),
(25, 14090964492568008, 1, '韭菜鸡蛋', 2, 15, 1),
(26, 14090964492568008, 2, '猪肉大葱', 3, 20, 1),
(27, 14090964492970037, 1, '韭菜鸡蛋', 2, 15, 1),
(28, 14090964492970037, 2, '猪肉大葱', 3, 20, 1),
(29, 14090964494955260, 1, '韭菜鸡蛋', 2, 15, 1),
(30, 14090964494955260, 2, '猪肉大葱', 3, 20, 1),
(31, 14090964495605520, 1, '韭菜鸡蛋', 2, 15, 1),
(32, 14090964495605520, 2, '猪肉大葱', 3, 20, 1),
(33, 14090964496919199, 1, '韭菜鸡蛋', 2, 15, 1),
(34, 14090964496919199, 2, '猪肉大葱', 3, 20, 1),
(35, 14090964497154785, 1, '韭菜鸡蛋', 2, 15, 1),
(36, 14090964497154785, 2, '猪肉大葱', 3, 20, 1),
(37, 14090964497390581, 1, '韭菜鸡蛋', 2, 15, 1),
(38, 14090964497390581, 2, '猪肉大葱', 3, 20, 1),
(39, 14090964498815573, 1, '韭菜鸡蛋', 2, 15, 1),
(40, 14090964498815573, 2, '猪肉大葱', 3, 20, 1),
(41, 14090964499542076, 1, '韭菜鸡蛋', 2, 15, 1),
(42, 14090964499542076, 2, '猪肉大葱', 3, 20, 1),
(43, 14090964500110387, 1, '韭菜鸡蛋', 2, 15, 1),
(44, 14090964500110387, 2, '猪肉大葱', 3, 20, 1),
(45, 14090964500653070, 1, '韭菜鸡蛋', 2, 15, 1),
(46, 14090964500653070, 2, '猪肉大葱', 3, 20, 1),
(47, 14090964501100849, 1, '韭菜鸡蛋', 2, 15, 1),
(48, 14090964501100849, 2, '猪肉大葱', 3, 20, 1),
(49, 14090964508618079, 1, '韭菜鸡蛋', 2, 15, 1),
(50, 14090964508618079, 2, '猪肉大葱', 3, 20, 1),
(51, 14090964509140302, 1, '韭菜鸡蛋', 2, 15, 1),
(52, 14090964509140302, 2, '猪肉大葱', 3, 20, 1),
(53, 14090964509597993, 1, '韭菜鸡蛋', 2, 15, 1),
(54, 14090964509597993, 2, '猪肉大葱', 3, 20, 1),
(55, 14090964509950022, 1, '韭菜鸡蛋', 2, 15, 1),
(56, 14090964509950022, 2, '猪肉大葱', 3, 20, 1),
(57, 14090964510368188, 1, '韭菜鸡蛋', 2, 15, 1),
(58, 14090964510368188, 2, '猪肉大葱', 3, 20, 1),
(59, 14090964510673405, 1, '韭菜鸡蛋', 2, 15, 1),
(60, 14090964510673405, 2, '猪肉大葱', 3, 20, 1),
(61, 14090964516824533, 1, '韭菜鸡蛋', 2, 15, 1),
(62, 14090964516824533, 2, '猪肉大葱', 3, 20, 1),
(63, 14090964517284919, 1, '韭菜鸡蛋', 2, 15, 1),
(64, 14090964517284919, 2, '猪肉大葱', 3, 20, 1),
(65, 14090964517822319, 1, '韭菜鸡蛋', 2, 15, 1),
(66, 14090964517822319, 2, '猪肉大葱', 3, 20, 1);

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
  `desc` varchar(256) NOT NULL DEFAULT '' COMMENT '店铺描述',
  `city` int(10) NOT NULL DEFAULT '0' COMMENT '所属城市',
  `area` int(10) NOT NULL DEFAULT '0' COMMENT '所属地区',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `store`
--

INSERT INTO `store` (`id`, `name`, `ename`, `create_time`, `create_date`, `contact`, `tel`, `addr`, `desc`, `city`, `area`, `status`) VALUES
(5, '店铺1', 'dian1', 1395232865, '2014-03-19', '联系人1', '联系电话1', '明天第一城', '', 1, 1, 1),
(6, '店铺2', 'dian2', 1395236063, '2014-03-19', '联系人2', '联系电话2', '明天第一城', '', 1, 2, 1),
(7, '店铺3', 'dian3', 1395236084, '2014-03-19', '联系人3', '联系电话3', '明天第一城', '', 1, 2, 1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `name`, `passwd`, `mobile`, `email`, `create_time`, `update_time`, `status`) VALUES
(11, '', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951433', 'test1@126.com', 1397444811, 1397444811, 1),
(12, '', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951439', 'test2@126.com', 1397444839, 1397444839, 1),
(13, '<script>alert(''x'');</script>', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951435', 'test3@126.com', 1397480095, 1408524389, 1),
(14, '', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951434', 'test4@126.com', 1397480588, 1397480588, 1),
(15, '', '55dcfd7f49dbc71b5fe90d199851ee89', '13436951436', 'test5@126.com', 1397480629, 1397480629, 1);

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
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`, `detail`, `linkman`, `mobile`, `status`) VALUES
(11, 1, '15层', '', '', 1),
(11, 6, '6号院3号楼', '', '', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
