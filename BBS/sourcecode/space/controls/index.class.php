<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 首页管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-20 20:48  										
	  +-----------------------------------------------------------------------------------------+
	*/

	class Index {
		/*
			首页各个栏目的显示(调用模型的相关模型)
		*/
		public function index(){
			if(empty($_GET['uid']) && $_SESSION['user_info']['id']){
				header("location:".B_APP."/index/index/uid/{$_SESSION['user_info']['id']}");
				//如果uid为空,则直接跳转到当前登录用户空间首页
			}
			$speak = D("speak")->field("id,content")->order("ptime desc")->select(array("uid"=>$_GET['uid']));
			//查询说说信息列表
			$this->assign("user",D("user")->user_detail($_GET['uid']));
			//调用user模型的user_detail方法
			$this->assign("total",D("user")->user_total($_GET['uid']));
			//调用user模型的user_total方法
			$this->assign("log",D("log")->loglist($_GET['uid']));
			//调用log模型的loglist方法
			$this->assign("speak",$speak);
			//将说说信息列表分配到模板
			$this->assign("s_log_index",S_LOG_INDEX);
			//将配置文件的首页日志显示数常量分配给模板
			$this->assign("fdata",D("friend")->friend_list($_GET['uid']));
			//将好友列表信息分配给模板
			$this->assign("s_friend_index",S_FRIEND_INDEX);
			//将配置文件的首页好友显示数常量分配给模板
			$this->assign("vdata",D("user")->v_list($_GET['uid']));
			//调用user模型的v_list方法,将返回值分配给模板
			$this->assign("s_guest_index",S_GUEST_INDEX);
			////将配置文件的首页访客显示数常量分配给模板
			$this->assign("user_info",D("user")->user_info($_SESSION['fid']));
			//调用user模型的user_info方法
			$this->display();//显示模板
		}
		
		/*
			添加留言方法
		*/
		public function insert_message(){
			debug();//防止debug信息干扰Ajax加载数据
			$_POST['ptime']=time();//获取留言时间
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取留言人IP
			D("message")->insert();//执行添加留言
			D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_MESS_REWARD);
			//调用bbs的user模型的add_grade方法
			echo S_MESS_REWARD;//输出奖励积分
		}
		
		/*
			显示留言列表
		*/
		public function message(){
			debug();//防止debug信息干扰Ajax加载数据
			$suser = D("message");//调用message模型
			$this->assign("mdata",$suser->message_index($_GET['uid']));
			//调用message模型的message_index方法,将返回值分配到模板
			$this->assign("s_mess_index",S_MESS_INDEX);
			//将配置文件首页留言数常量分配到模板
			$this->display();//显示模板
		}
		
		/*
			添加访客信息
		*/
		public function visite(){
			$guest = D("guest");//操作guest数据表
			if($_SESSION['home_login']==1){
				if($_SESSION['user_info']['id']!=$_GET['uid']){
				//判断当前访问空间是否不是自己的空间
					if($guest->field("id")->where(array("guest_id"=>$_SESSION['user_info']['id'],"uid"=>$_GET['uid']))->select()){
					//若不是则判断当前登录用户是否访问过此用户	
						$guest->where(array("guest_id"=>$_SESSION['user_info']['id'],"uid"=>$_GET['uid']))->update(array("vtime"=>time()));
						//若访问过更改访问时间
					}else{
						//若没有访问过,添加访问信息
						$guest->insert(array("uid"=>$_GET['uid'],"guest_id"=>$_SESSION['user_info']['id'],"vtime"=>time()));
					}
				}
			}else{
				return false;//若用户未登录返回假
			}
			return true;//否则返回真
		}
		
		/*
			输出验证码
		*/
		public function code(){
			echo new Vcode();//输出验证码
		}
	}