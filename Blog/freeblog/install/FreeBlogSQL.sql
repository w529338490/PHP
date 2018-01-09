SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
CREATE TABLE `free_album` (
  `id` smallint(5) NOT NULL auto_increment,
  `pid` smallint(5) NOT NULL,
  `album_path` varchar(100) NOT NULL,
  `album_title` varchar(200) NOT NULL,
  `album_description` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_article` (
  `uid` int(5) NOT NULL,
  `aid` int(10) unsigned NOT NULL auto_increment,
  `article_title` varchar(50) NOT NULL,
  `article_content` text NOT NULL,
  `article_author` varchar(15) NOT NULL,
  `article_authority` tinyint(4) NOT NULL,
  `article_review` tinyint(4) NOT NULL,
  `article_action` tinyint(4) NOT NULL default '1',
  `article_time` int(11) NOT NULL,
  `article_month` varchar(20) NOT NULL default '2011/11',
  `article_category` varchar(20) NOT NULL,
  `pic` varchar(60) NOT NULL default '0',
  PRIMARY KEY  (`aid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户文章表' AUTO_INCREMENT=2 ;
CREATE TABLE `free_category` (
  `subAction` char(10) NOT NULL default 'Y',
  `cid` int(11) NOT NULL auto_increment,
  `pid` int(11) NOT NULL,
  `path` char(50) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_content` varchar(100) NOT NULL,
  `category_total` int(11) NOT NULL,
  `category_time` int(11) NOT NULL,
  PRIMARY KEY  (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_flink` (
  `id` tinyint(6) NOT NULL auto_increment,
  `link_name` varchar(60) NOT NULL,
  `link_description` varchar(100) NOT NULL,
  `link_url` varchar(80) NOT NULL,
  `link_image` varchar(150) NOT NULL,
  `link_target` varchar(20) NOT NULL,
  `link_body` varchar(30) NOT NULL,
  `link_body_email` varchar(60) NOT NULL,
  `link_time` int(10) NOT NULL,
  `disable` tinyint(3) NOT NULL,
  `oder` tinyint(6) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_foreground` (
  `fid` int(10) unsigned NOT NULL auto_increment,
  `foreGround_title` varchar(50) NOT NULL,
  `foreGround_logo` varchar(50) default '1',
  `foreGround_email` varchar(50) NOT NULL,
  `foreGround_subtitle` varchar(50) character set ucs2 NOT NULL,
  `saveUploadData` tinyint(4) NOT NULL default '1',
  `operateNotes` tinyint(4) NOT NULL default '1',
  `offPassword` char(20) NOT NULL,
  `webState` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
CREATE TABLE `free_image` (
  `id` mediumint(8) NOT NULL auto_increment,
  `pid` mediumint(8) NOT NULL,
  `up_author` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(160) NOT NULL default '0',
  `mktime` int(10) NOT NULL default '0',
  `name` varchar(100) NOT NULL default '0',
  `postid` mediumint(8) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_oper` (
  `id` tinyint(4) NOT NULL,
  `shield_name` tinyint(4) NOT NULL default '0',
  `single_del_user` tinyint(4) NOT NULL default '0',
  `multi_del_user` tinyint(4) NOT NULL default '0',
  `edit_userinfo` tinyint(4) NOT NULL default '0',
  `del_article_group` tinyint(4) NOT NULL default '0',
  `edit_article_group` tinyint(4) NOT NULL default '0',
  `issue_article` tinyint(4) NOT NULL default '0',
  `article_edit` tinyint(4) NOT NULL default '0',
  `recyle_article` tinyint(4) NOT NULL default '0',
  `single_del_userinfo` tinyint(4) NOT NULL default '0',
  `add_user_group` tinyint(4) NOT NULL default '0',
  `del_user_group` tinyint(4) NOT NULL default '0',
  `edit_user_group` tinyint(4) NOT NULL default '0',
  `add_image` tinyint(4) NOT NULL default '0',
  `single_del_image` tinyint(4) NOT NULL default '0',
  `multi_del_image` tinyint(4) NOT NULL default '0',
  `attachment_image` tinyint(4) NOT NULL default '0',
  `add_photo_album` tinyint(4) NOT NULL default '0',
  `del_photo_album` tinyint(4) NOT NULL default '0',
  `edit_photo_album` tinyint(4) NOT NULL default '0',
  `edit_title` tinyint(4) NOT NULL default '0',
  `edit_subtitle` tinyint(4) NOT NULL default '0',
  `edit_admin_email` tinyint(4) NOT NULL default '0',
  `save_upload_file` tinyint(4) NOT NULL default '0',
  `webstat` tinyint(4) NOT NULL default '0',
  `import_data_file` tinyint(4) NOT NULL default '0',
  `clear_data_file` tinyint(4) NOT NULL default '0',
  `excel_save` tinyint(4) NOT NULL default '0',
  `txt_save` tinyint(4) NOT NULL default '0',
  `del_oper` tinyint(4) NOT NULL default '0',
  `save_oper` tinyint(4) NOT NULL default '0',
  `view_oper` tinyint(4) NOT NULL default '0',
  `templ_start` tinyint(4) NOT NULL default '0',
  `templ_upload` tinyint(4) NOT NULL default '0',
  `templ_del` tinyint(4) NOT NULL default '0',
  `add_flink` tinyint(4) NOT NULL default '0',
  `sort_flink` tinyint(4) NOT NULL default '0',
  `single_del_flink` tinyint(4) NOT NULL default '0',
  `multi_del_flink` tinyint(4) NOT NULL default '0',
  `edit_flink` tinyint(4) NOT NULL default '0',
  `add_user` tinyint(4) NOT NULL default '0',
  `clear_recyle_article` tinyint(4) NOT NULL default '0',
  `add_atricle_group` tinyint(4) NOT NULL default '0',
  `edit_image` tinyint(4) NOT NULL default '0',
  `multi_del_article` tinyint(4) NOT NULL default '0',
  `restore_article` tinyint(4) NOT NULL default '0',
  `multi_restore_article` tinyint(4) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_estonian_ci;
CREATE TABLE `free_opernote` (
  `oid` int(5) unsigned NOT NULL auto_increment,
  `operType` varchar(50) NOT NULL,
  `operDeta` varchar(200) NOT NULL,
  `operTime` int(11) NOT NULL,
  `oname` varchar(20) NOT NULL,
  PRIMARY KEY  (`oid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
CREATE TABLE `free_rereview` (
  `aid` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `rrid` int(11) NOT NULL auto_increment,
  `rtime` int(11) NOT NULL,
  `rrname` char(50) NOT NULL,
  `rremail` varchar(50) NOT NULL,
  `rrwebsite` varchar(50) NOT NULL,
  `rrcontent` text NOT NULL,
  PRIMARY KEY  (`rrid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_review` (
  `aid` int(5) NOT NULL,
  `rid` int(5) unsigned NOT NULL auto_increment,
  `path` varchar(100) NOT NULL default '0',
  `review_email` varchar(50) NOT NULL,
  `review_name` char(50) NOT NULL default 'lgzhyan',
  `review_website` char(50) NOT NULL default 'www.google.com',
  `review_content` text NOT NULL,
  `review_action` tinyint(4) NOT NULL default '1',
  `review_time` int(11) NOT NULL,
  `ip` varchar(15) NOT NULL,
  PRIMARY KEY  (`rid`),
  KEY `ip` (`ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
CREATE TABLE `free_tool` (
  `lid` tinyint(5) NOT NULL,
  `left_bar` varchar(30) NOT NULL,
  `rid` tinyint(5) NOT NULL,
  `right_bar` varchar(30) character set ucs2 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `free_tool` VALUES (0, 'a_category_list', 0, 'a_comment_list');
INSERT INTO `free_tool` VALUES (1, 'a_time_list', 1, 'u_populer_list');
INSERT INTO `free_tool` VALUES (2, '', 2, '');
INSERT INTO `free_tool` VALUES (3, '', 3, '');
INSERT INTO `free_tool` VALUES (4, '', 4, '');
INSERT INTO `free_tool` VALUES (5, '', 5, '');
INSERT INTO `free_tool` VALUES (6, '', 6, '');
CREATE TABLE `free_user` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment,
  `user_username` char(25) NOT NULL,
  `user_password` char(32) NOT NULL,
  `user_onlinestatus` int(10) NOT NULL default '0',
  `user_email` varchar(100) NOT NULL,
  `user_mktime` int(10) NOT NULL,
  `user_sex` tinyint(1) NOT NULL,
  `user_ip` char(15) NOT NULL,
  `gid` mediumint(4) NOT NULL default '2',
  `user_lock` tinyint(1) NOT NULL default '0',
  `user_pic` varchar(45) NOT NULL default '0',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;
CREATE TABLE `free_user_group` (
  `gid` mediumint(8) unsigned NOT NULL auto_increment,
  `group_name` varchar(20) NOT NULL,
  `group_description` varchar(150) NOT NULL,
  `group_muser` tinyint(2) NOT NULL default '0',
  `group_mweb` tinyint(2) NOT NULL default '0',
  `group_marticle` tinyint(2) NOT NULL default '0',
  `group_mimage` tinyint(2) NOT NULL default '0',
  `group_sendarticle` tinyint(2) NOT NULL default '0',
  `group_sendcomment` tinyint(2) NOT NULL default '0',
  `group_sendmessage` tinyint(2) NOT NULL default '0',
  PRIMARY KEY  (`gid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

