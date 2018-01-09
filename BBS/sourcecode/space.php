<?php
	/**
	 * 单一入口文件
	 */
	define("CSTART","0");           //缓存开关 1开启，0为关闭
	define("BROPHP", "./brophp/");  //框架源文件的位置
	define("APP", "./space");       //设置当前应用的目录
	define('MAXWIDTH',100);			//设置照片最大高度
	define('MAXHEIGHT',100);		//设置照片最大宽度
	require_once(BROPHP.'/brophp.php'); //加载框架的入口文件