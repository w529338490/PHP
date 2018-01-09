<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 初始化控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-25 10:30 										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Common extends Action{
		/*
			本应用初始化方法
		*/
		public function init(){
			if(!file_exists('install/lock')){
				header('location:'.B_ROOT.'/install.php');//如果程序未安装则调转到安装界面
			}
			$data = D("user")->field("id,name,true_name,grade_num,stand,sex,birthday,birth_add,live_add,hobby,marriage,pal_aim,face_path")->find($_GET['uid']);
			$this->assign("user_h",$data);//查询用户详细信息分配给模板
			$this->assign('sms_num',D('user','bbs')->sms_num());//获取用户的短信数量
			
			//排除恶意URL注入uid,不存在跳转404页面
			if($_GET['uid'] && !(D("user")->where(array("id"=>$_GET['uid']))->find())){
				$this->redirect("pub/error404");
			}
		}		
	}