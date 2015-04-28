-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 02 月 16 日 08:33
-- 服务器版本: 5.1.33-community
-- PHP 版本: 5.2.9-2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: ``
--

-- --------------------------------------------------------

--
-- 表的结构 `sougou`
-- WARNING: 请注意保持与init.php保持一致
-- Define Database Structure.
-- It should be compactable with 'config.sql'.
--

CREATE TABLE IF NOT EXISTS `sougou` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(11) NOT NULL,
  `updatedAt` int(11) NOT NULL,
  `createdAt` int(11) NOT NULL,
  `replyCount` int(11) NOT NULL,

  `uid` char(8) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` varchar(2048) NOT NULL,

  `hide` tinyint(1) NOT NULL,
  `sage` tinyint(1) NOT NULL,
  `lock` tinyint(1) NOT NULL,
  `delete` tinyint(1) NOT NULL,

  `pwd` varchar(8) NOT NULL,
  `like` int(11) NOT NULL,
  `liker` varchar(252) NOT NULL,
  `dislike` int(11) NOT NULL,
  `disliker` varchar(252) NOT NULL,

  `recentReply00` int(11) NOT NULL,
  `recentReply01` int(11) NOT NULL,
  `recentReply02` int(11) NOT NULL,
  `recentReply03` int(11) NOT NULL,
  `recentReply04` int(11) NOT NULL,
  `recentReply05` int(11) NOT NULL,
  `recentReply06` int(11) NOT NULL,
  `recentReply07` int(11) NOT NULL,
  `recentReply08` int(11) NOT NULL,
  `recentReply09` int(11) NOT NULL,
  `recentReply10` int(11) NOT NULL,
  `recentReply11` int(11) NOT NULL,
  `recentReply12` int(11) NOT NULL,
  `recentReply13` int(11) NOT NULL,
  `recentReply14` int(11) NOT NULL,
  `recentReply15` int(11) NOT NULL,
  `recentReply16` int(11) NOT NULL,
  `recentReply17` int(11) NOT NULL,
  `recentReply18` int(11) NOT NULL,
  `recentReply19` int(11) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `sougou` ADD INDEX `id_updatedAt` (`id`, `updatedAt`) ;
--
-- 转存表中的数据 `sougou`
--

INSERT INTO `sougou` (
  `id`, `parent`, `updatedAt`, `createdAt`, `replyCount`, 
  `uid`, `name`, `email`, `title`, `image`, `content`, 
  `hide`, `sage`, `lock`, `delete`, `pwd`, `like`, `liker`, `dislike`, `disliker`, 
  `recentReply00`, `recentReply01`, `recentReply02`, `recentReply03`, `recentReply04`, 
  `recentReply05`, `recentReply06`, `recentReply07`, `recentReply08`, `recentReply09`, 
  `recentReply10`, `recentReply11`, `recentReply12`, `recentReply13`, `recentReply14`, 
  `recentReply15`, `recentReply16`, `recentReply17`, `recentReply18`, `recentReply19`
) VALUES (
  0, 2147483647, 0, 0, 0, 
  '00000000', '', '', '', '', '', 
  1, 1, 0, 0, '', 0, '', 0, '', 
  0, 0, 0, 0, 0, 
  0, 0, 0, 0, 0, 
  0, 0, 0, 0, 0, 
  0, 0, 0, 0, 0 
);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
