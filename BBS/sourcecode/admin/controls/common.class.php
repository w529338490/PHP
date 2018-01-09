<?php
	/*+------------------------------------------------+
	  | 验证用户是否登录控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Common extends Action {
		/**
		  * 由于此方法是在执行其他方法之前执行的
		  * 所以在这里验证用户是否登录
		  * 如果没有登录就跳到登录界面
		  */
		function init(){
			//判断是否安装
			if(!file_exists('install/lock')){
				header('location:'.$GLOBALS['root'].'install.php');
			}
			
			if(empty($_SESSION['admin_login']) || $_SESSION['admin_login'] !==1){
				$this->redirect('login/index');
			}
			
		}		
	}
