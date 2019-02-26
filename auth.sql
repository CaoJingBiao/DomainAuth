-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2019-02-19 16:09:43
-- 服务器版本： 5.5.57-log
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `auth`
--

-- --------------------------------------------------------

--
-- 表的结构 `sq_authorize`
--

CREATE TABLE IF NOT EXISTS `sq_authorize` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL COMMENT '使用者名称',
  `domain` varchar(255) NOT NULL COMMENT '网站域名',
  `ip` varchar(255) NOT NULL COMMENT '网站IP',
  `qq` varchar(255) NOT NULL COMMENT '用户QQ',
  `tel` varchar(255) NOT NULL COMMENT '用户手机',
  `time` varchar(255) NOT NULL COMMENT '授权到期时间',
  `version` varchar(255) NOT NULL COMMENT '产品版本号',
  `ip_qh` int(1) NOT NULL COMMENT '0-域名授权，1-ip和域名双重',
  `yumi` int(1) NOT NULL COMMENT '0-单域名，1-泛域名',
  `p_id` int(10) NOT NULL COMMENT '产品id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sq_daoban`
--

CREATE TABLE IF NOT EXISTS `sq_daoban` (
  `id` int(10) unsigned NOT NULL,
  `domain` varchar(255) NOT NULL COMMENT '盗版域名',
  `time` varchar(255) NOT NULL COMMENT '盗版请求授权情况时间',
  `ip` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sq_kami`
--

CREATE TABLE IF NOT EXISTS `sq_kami` (
  `id` int(10) unsigned NOT NULL,
  `km` text NOT NULL COMMENT '卡密',
  `time` varchar(255) NOT NULL COMMENT '卡密时长',
  `ctime` varchar(255) NOT NULL COMMENT '卡密生成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `sq_kamilog`
--

CREATE TABLE IF NOT EXISTS `sq_kamilog` (
  `id` int(10) unsigned NOT NULL,
  `domain` varchar(255) NOT NULL COMMENT '使用卡密授权的域名',
  `km` varchar(255) NOT NULL COMMENT '卡密',
  `time` varchar(255) NOT NULL COMMENT '授权时长',
  `usetime` varchar(255) NOT NULL COMMENT '卡密激活的时间'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_kamilog`
--

INSERT INTO `sq_kamilog` (`id`, `domain`, `km`, `time`, `usetime`) VALUES
(1, 'pan.hostfans.cn', 'JzbYRDPfeOHRvAL9Clky', '1', '1540906279'),
(2, 'md.hostfans.cn', 'jOIXH9azEeIkpI6yCAsJ', '1', '1540909126'),
(3, 'wiki.caoshi.wang', 'N0H22sOgUgDuLoamPnQH', '2', '1540969191'),
(4, 'bookfans.cn', 'xLWiLt7HxR6DyyFEwH8R', '1', '1540969345');

-- --------------------------------------------------------

--
-- 表的结构 `sq_message`
--

CREATE TABLE IF NOT EXISTS `sq_message` (
  `id` int(10) unsigned NOT NULL,
  `message_1` text NOT NULL,
  `message_2` text NOT NULL,
  `message_3` text NOT NULL,
  `message_0` text NOT NULL,
  `message_4` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_message`
--

INSERT INTO `sq_message` (`id`, `message_1`, `message_2`, `message_3`, `message_0`, `message_4`) VALUES
(1, '域名被阻止，请联系授权商QQ：592155709', '授权已经到期，请联系授权商QQ：592155709', 'IP验证异常，请联系授权商QQ：592155709', '远程验证失败，请检查本地网络!', '只接受域名授权！');

-- --------------------------------------------------------

--
-- 表的结构 `sq_products`
--

CREATE TABLE IF NOT EXISTS `sq_products` (
  `id` int(10) unsigned NOT NULL,
  `cp` varchar(255) NOT NULL COMMENT '产品名称',
  `ms` varchar(255) NOT NULL COMMENT '产品描述',
  `time` varchar(255) NOT NULL COMMENT '产品添加时间'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_products`
--

INSERT INTO `sq_products` (`id`, `cp`, `ms`, `time`) VALUES
(1, '自助授权', '前台用户自助授权分类项目', '1540970407');

-- --------------------------------------------------------

--
-- 表的结构 `sq_selfhelp`
--

CREATE TABLE IF NOT EXISTS `sq_selfhelp` (
  `id` int(10) unsigned NOT NULL,
  `prompt` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `qq` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_selfhelp`
--

INSERT INTO `sq_selfhelp` (`id`, `prompt`, `website`, `qq`) VALUES
(1, '卡密购买！如果库存不足！请联系站长授权QQ：592155709', 'http://www.hostfans.cn', '592155709');

-- --------------------------------------------------------

--
-- 表的结构 `sq_site`
--

CREATE TABLE IF NOT EXISTS `sq_site` (
  `id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `yxtime` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_site`
--

INSERT INTO `sq_site` (`id`, `title`, `yxtime`, `copyright`, `route`) VALUES
(1, 'PHP授权系统', '1538323200', 'Hostfans.cn.', '/static/');

-- --------------------------------------------------------

--
-- 表的结构 `sq_user`
--

CREATE TABLE IF NOT EXISTS `sq_user` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `sq_user`
--

INSERT INTO `sq_user` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', 'f6a1f1ff1d8fe973da5bee9228d50680', 'admin@admin.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sq_authorize`
--
ALTER TABLE `sq_authorize`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `domain` (`domain`);

--
-- Indexes for table `sq_daoban`
--
ALTER TABLE `sq_daoban`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_kami`
--
ALTER TABLE `sq_kami`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_kamilog`
--
ALTER TABLE `sq_kamilog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_message`
--
ALTER TABLE `sq_message`
  ADD UNIQUE KEY `ID` (`id`);

--
-- Indexes for table `sq_products`
--
ALTER TABLE `sq_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_selfhelp`
--
ALTER TABLE `sq_selfhelp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_site`
--
ALTER TABLE `sq_site`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sq_user`
--
ALTER TABLE `sq_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sq_authorize`
--
ALTER TABLE `sq_authorize`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sq_daoban`
--
ALTER TABLE `sq_daoban`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sq_kami`
--
ALTER TABLE `sq_kami`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sq_kamilog`
--
ALTER TABLE `sq_kamilog`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sq_message`
--
ALTER TABLE `sq_message`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sq_products`
--
ALTER TABLE `sq_products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sq_selfhelp`
--
ALTER TABLE `sq_selfhelp`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sq_site`
--
ALTER TABLE `sq_site`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sq_user`
--
ALTER TABLE `sq_user`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
