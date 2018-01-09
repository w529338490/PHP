-- MySQL dump 10.11
--
-- Host: localhost    Database: brophp
-- ------------------------------------------------------
-- Server version	5.0.51b-community-nt-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bro_stu`
--

DROP TABLE IF EXISTS `bro_stu`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `bro_stu` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_cat`
--

DROP TABLE IF EXISTS `d36_cat`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_cat` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `pid` smallint(5) unsigned NOT NULL default '0',
  `path` varchar(100) NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`path`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_collect`
--

DROP TABLE IF EXISTS `d36_collect`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_collect` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`,`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_color`
--

DROP TABLE IF EXISTS `d36_color`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_color` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `cname` varchar(40) NOT NULL,
  `cvalue` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_comment`
--

DROP TABLE IF EXISTS `d36_comment`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_comment` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `point` tinyint(4) NOT NULL default '5',
  `content` varchar(255) NOT NULL default '',
  `uname` varchar(40) NOT NULL default '',
  `uid` int(11) NOT NULL,
  `addtime` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`uid`,`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_gp`
--

DROP TABLE IF EXISTS `d36_gp`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_gp` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `pcid` smallint(6) NOT NULL,
  `gpic` varchar(40) NOT NULL,
  `stime` int(11) NOT NULL,
  `etime` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`stime`,`etime`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_notice`
--

DROP TABLE IF EXISTS `d36_notice`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_notice` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tid` int(11) NOT NULL,
  `sid` smallint(6) NOT NULL,
  `ncont` varchar(100) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_odetail`
--

DROP TABLE IF EXISTS `d36_odetail`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_odetail` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `psize` varchar(10) NOT NULL,
  `cid` smallint(6) NOT NULL,
  `pname` varchar(40) NOT NULL default '',
  `num` smallint(6) NOT NULL default '0',
  `pprice` double(8,2) NOT NULL default '0.00',
  PRIMARY KEY  (`id`),
  KEY `oid` (`oid`,`pid`,`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_orders`
--

DROP TABLE IF EXISTS `d36_orders`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_orders` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `linkman` varchar(50) NOT NULL,
  `total` int(11) NOT NULL default '0',
  `oaddress` varchar(40) NOT NULL default '',
  `telephone` varchar(15) NOT NULL,
  `code` int(6) default NULL,
  `ostate` tinyint(4) NOT NULL default '0',
  `rtime` int(11) NOT NULL,
  `btime` int(11) default NULL,
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`,`ostate`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_pdetail`
--

DROP TABLE IF EXISTS `d36_pdetail`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_pdetail` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `cid` smallint(6) NOT NULL,
  `size` varchar(10) NOT NULL,
  `number` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`cid`,`size`,`number`)
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_pic`
--

DROP TABLE IF EXISTS `d36_pic`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_pic` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `picname` varchar(40) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_product`
--

DROP TABLE IF EXISTS `d36_product`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_product` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `name` varchar(40) NOT NULL default '',
  `price` double(8,2) NOT NULL default '0.00',
  `discount` varchar(5) NOT NULL,
  `ptime` int(11) NOT NULL default '0',
  `mpic` char(50) NOT NULL default '',
  `typeid` smallint(6) NOT NULL,
  `styleid` smallint(6) NOT NULL,
  `intro` varchar(255) NOT NULL default '',
  `pstate` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `name` (`name`,`price`,`mpic`,`typeid`,`styleid`,`pstate`,`ptime`,`discount`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_return`
--

DROP TABLE IF EXISTS `d36_return`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_return` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `oid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `rstate` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `oid` (`oid`,`pid`,`rstate`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_shopcar`
--

DROP TABLE IF EXISTS `d36_shopcar`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_shopcar` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `pnum` smallint(6) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `uid` (`uid`,`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_style`
--

DROP TABLE IF EXISTS `d36_style`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_style` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sname` varchar(40) NOT NULL,
  `sdetail` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_type`
--

DROP TABLE IF EXISTS `d36_type`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_type` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `tname` varchar(40) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(20) NOT NULL default '',
  `tpic` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`,`tname`,`path`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `d36_user`
--

DROP TABLE IF EXISTS `d36_user`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `d36_user` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `username` varchar(40) NOT NULL default '',
  `password` char(32) NOT NULL default '',
  `phone` varchar(15) NOT NULL default '',
  `address` varchar(40) NOT NULL default '',
  `upoint` int(8) NOT NULL default '0',
  `allow_1` tinyint(4) NOT NULL default '1',
  `allow_2` tinyint(4) NOT NULL default '0',
  `allow_3` tinyint(4) NOT NULL default '0',
  `allow_4` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `username` (`username`,`password`,`allow_1`,`allow_2`,`allow_3`,`allow_4`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2012-02-16 12:18:19
