<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 说说管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-22 02:03  										
	  +-----------------------------------------------------------------------------------------+
	*/

	class Speak{
	
		/*
			显示index模板,其他内容用Ajax加载
		*/
		public function index(){
			$this->display();
			//显示模板
		}
		
		/*
			添加说说方法,并给用户增加相应的积分
		*/
		public function insert(){
			debug();//关闭debug
			$_POST['ptime']=time();
			//获取添加说说时间
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取客户端IP地址
			if(D("speak")->insert()){//执行添加
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_SPEAK_REWARD);
				//调用bbs应用的user模型的add_grade方法
				echo S_SPEAK_REWARD;
				//输出奖励积分
			}
		}
		
		/*
			显示说说列表,并用Ajax分页控制
		*/
		public function speak(){
			$sdata = D("speak")->speak_list($_GET['uid'],$fpage);
			//调用speak模型的speak_list方法
			$this->assign("sdata",$sdata);
			//将数据分配给模板
			$this->assign("fpage", $fpage);
			//将分页信息分配给模板
			$this->display();
			//显示模板
		}
		
		/*
			删除说说,并且删除说说的回复
		*/
		public function sdel(){
			if(D("speak")->delete($_GET['sid'])){//执行删除说说
				D("speak_comm")->delete(array("sid"=>$_GET['sid']));
				//执行删除说说的所有回复
			}
		}
		
		/*
			删除说说的回复
		*/
		public function del(){
			D("speak_comm")->delete($_GET['cid']);
			//删除说说的单条回复
		}
		
		/*
			添加说说的回复
		*/
		public function insert_c(){
			debug();//关闭debug
			$_POST['ptime']=time();
			//获取当前时间
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取发表回复的客户端IP地址
			if(D("speak_comm")->insert()){
			//执行添加
				D("user","bbs")->add_grade($_SESSION['user_info']['id'],S_SPEAK_REWARD);
				//调用bbs应用下的user模型的add_grade方法
				echo S_SPEAK_REWARD;
				//输出奖励积分
			}
		}
	}