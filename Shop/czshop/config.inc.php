<?php
	define("DEBUG", 0);				      //开启调试模式 1 开启 0 关闭
	define("DRIVER","pdo");				      //数据库的驱动，本系统支持pdo(默认)和mysqli两种
	define("DSN", "mysql:host=localhost;dbname=brophp"); //如果使用PDO可以使用，不使用则默认连接MySQL
	define("HOST", "localhost");			      //数据库主机
	define("USER", "root");                               //数据库用户名
	//define("PASS", "kaka22hao");                            //数据库密码
	define("PASS", "xingjie"); 	
	//define("PASS", "8418155");
	define("DBNAME","brophp");			      //数据库名
	define("TABPREFIX", "d36_");                           //数据表前缀
	define("CSTART", 1);                                  //缓存开关 1开启，0为关闭
	define("CTIME", 60*2);                          //缓存时间
	define("TPLPREFIX", "htm");                           //模板文件的后缀名
	define("TPLSTYLE", "default");                        //默认模板存放的目录

	//$memServers = array("localhost", 11211);	     //使用memcache服务器
	/*
	如果有多台memcache服务器可以使用二维数组
	$memServers = array(
			array("www.lampbrother.net", '11211'),
			array("www.brophp.com", '11211'),
			...
		);
	*/
		/* *
		 * 配置文件
		 * 版本：3.2
		 * 日期：2011-03-25
		 * 说明：
		 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
		 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。
			
		 * 提示：如何获取安全校验码和合作身份者id
		 * 1.用您的签约支付宝账号登录支付宝网站(www.alipay.com)
		 * 2.点击“商家服务”(https://b.alipay.com/order/myorder.htm)
		 * 3.点击“查询合作者身份(pid)”、“查询安全校验码(key)”
			
		 * 安全校验码查看时，输入支付密码后，页面呈灰色的现象，怎么办？
		 * 解决方法：
		 * 1、检查浏览器配置，不让浏览器做弹框屏蔽设置
		 * 2、更换浏览器或电脑，重新登录查询。
		 */
		 
		//↓↓↓↓↓↓↓↓↓↓请在这里配置您的基本信息↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
		//合作身份者id，以2088开头的16位纯数字
		$aliapy_config['partner']      = '2088002739868735';

		//安全检验码，以数字和字母组成的32位字符
		$aliapy_config['key']          = '9pi24efbn1wfpin2nw2t0doebkd9yhyn';

		//签约支付宝账号或卖家支付宝帐户
		$aliapy_config['seller_email'] = 'liwenkai@liwenkai.com';

		//页面跳转同步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		//return_url的域名不能写成http://localhost/create_direct_pay_by_user_php_utf8/return_url.php ，否则会导致return_url执行无效
		$aliapy_config['return_url']   = 'http://127.0.0.1/alipay/return_url.php';

		//服务器异步通知页面路径，要用 http://格式的完整路径，不允许加?id=123这类自定义参数
		$aliapy_config['notify_url']   = 'http://www.buqiu.com/alipay/notify_url.php';

		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑


		//签名方式 不需修改
		$aliapy_config['sign_type']    = 'MD5';

		//字符编码格式 目前支持 gbk 或 utf-8
		$aliapy_config['input_charset']= 'utf-8';

		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$aliapy_config['transport']    = 'http';
	
