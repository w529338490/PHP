<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 留言管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-29 12:31  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Message{
		/*
			显示留言板首页
		*/
		public function index(){
			$this->display();//显示模板
		}
		
		/*
			显示留言板列表页面,并在首页用Ajax加载
		*/
		public function message(){
			debug();//防止debug信息干扰Ajax加载数据
			$suser = D("message");//调用message模型
			$this->assign("message_data",$suser->message_index($_GET['uid'],$fpage));
			//调用message模型的message_index方法,并将数据分配给模板
			$this->assign("fpage", $fpage);
			//将分页信息分配到模板
			$this->display();//显示模板
		}
		
		/*
			添加留言板内容方法
		*/
		public function insert_message(){
			debug();//防止debug信息干扰Ajax加载数据
			$_POST['ptime']=time();
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['SERVER_ADDR']));
			if(D("message")->insert()){//执行添加留言
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_MESS_REWARD);
				//增加积分
				echo S_MESS_REWARD;
				//输出积分奖励
			}
		}
		
		/*
			删除留言方法
		*/
		public function del_message(){
			echo D("message")->delete($_GET['mid']);
			//输出执行删除留言的影响行数
		}
	}