<?php
	define("DEBUG","0");				      				//开启调试模式 1 开启 0 关闭
	define("DRIVER","pdo");				      				//数据库的驱动，本系统支持pdo(默认)和mysqli两种
	//define("DSN", "mysql:host=localhost;dbname=brophp"); 	//如果使用PDO可以使用，不使用则默认连接MySQL
	define("HOST","localhost");			      			//数据库主机
	define("USER","root");                               	//数据库用户名
	define("PASS","");                       //数据库密码
	define("DBNAME","sourcecode");			      					//数据库名
	define("TABPREFIX","sc_");                           	//数据表前缀
	define("CTIME","3600");                          		//缓存时间
	define("TPLPREFIX", "tpl");                           	//模板文件的后缀名
	define("TPLSTYLE", "default");                        	//默认模板存放的目录
	
	//$如果有多台memcache服务器可以使用 多个数组
	/*$memServers=array(array("localhost",11211));*/
	
	
	
	/*以下为网站配置,勿动哈*/
	//网站公共配置
	define("TITLE","源代码");								//网站标题
	define("KEYWORDS","Linux、Apache、MySQL、PHP、关键字fdskjafdsslkjfd");	//网站关键字
	define("DESC","lamp技术论坛，描述,fsdalkfdsfdsa");					//网站简述
	define("LOGINREWARD","2");								//登陆奖励，即登录加分
	define("LOGO","logo.png");								//设置logo
	
	//BBS配置
	define("B_SUBJECTPZ","10");								//主题页大小
	define("B_COMMENTPZ","5");								//帖子页大小	
	define("B_HOT_NUM","10");								//回复多少才算火热?(*)
	define("B_SUBJECT_REWARD","50");						//发表主题奖励
	define("B_COMMENT","100");								//发表帖子奖励
	define("B_SUBJECT_TOP","500");							//主题被置顶加分(*)
	define("B_SUBJECT_ESS","100");							//主题被加精加分(*)
	define("B_SUBJECT_RECOM","300");						//主题被推荐加分(*)
	define("PUBLISH_INTERVAL_SUBJECT","5");					//发表主题间隔的时间(*)
	define("PUBLISH_INTERVAL_COMMENT","5");					//发表帖子的间隔时间(*)
	define('B_NEWS_LIST_NUM',"10");							//新闻每页显示数目(*)
	define('B_NOTICE_LIST_NUM',"10");						//公告每页显示数目(*)
	define("USERLISTNUM","24");								//用户列表的个数(用户导航栏)
	
	//空间配置
	
	
	
	define("S_LOG_INDEX","3");								//空间首页日志显示 条
	define("S_MESS_INDEX","3");								//空间首页留言显示 条
	define("S_FRIEND_INDEX","9");							//空间首页好友显示 个
	define("S_GUEST_INDEX","9");							//空间首页访客显示 个
	
	define("S_SPEAKPZ","5"); 								//说说页大小
	define("S_LOGPZ","9");									//空间日志页大小
	define("S_FRIENDPZ","9");								//空间好友页大小
	define("S_MESSPZ","5");									//空间留言板页大小
	define("S_SMSPZ","9");									//空间站内信页大小

	
	define("S_SPEAK_REWARD","500");							//发表说说奖励
	define("S_LOG_REWARD","2");								//发布日志奖励
	define("S_LOGC_REWARD","2");							//日志回复奖励
	define("S_PHOALBUM_REWARD","2");						//创建相册奖励
	define("S_MESS_REWARD","2");							//留言奖励
	define("S_MODFACE_REWARD","8");							//修改头像奖励
