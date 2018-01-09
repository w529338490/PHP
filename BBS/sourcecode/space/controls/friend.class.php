<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 好友管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-28 20:48  										
	  +-----------------------------------------------------------------------------------------+
	*/
	
	class Friend{
		/*
			显示好友首页
		*/
		public function index(){
			$this->assign("fdata",D("friend")->friend_list($_GET['uid'],$fpage));
			//调用friend模型的好友列表方法,将返回的结果及分页信息分配给模板
			$this->assign("fpage", $fpage);//分配分页信息到模板
			$this->assign("total",D("user","bbs")->friend_num($_GET['uid']));
			//调用BBS应用下的好友总数方法,将返回的结果分配给模板
			$this->display();//显示模板
		}
		
		/*
			好友请求验证信息发送方法
		*/
		public function send(){
			$info = D("friend")->add_friend($_POST['uid'],$_POST['fid'],$_POST['content']);
			//调用friend模型的add_friend方法
			if($info){
				$this->success("发送请求成功,等待对方验证!",1);
			}else{
				$this->error("发送请求失败,请重试!",1);
			}
		}
		
		/*
			接受好友添加请求方法
		*/
		public function accept(){
			debug();//防止debug信息干扰Ajax加载数据
			$content="<b style='color:green' >{$_SESSION['user_info']['name']}</b>&nbsp;接受了您的好友请求!您已经成为 Ta 的好友!";//提示信息
			$ip = sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));//获取发表IP
			D("sms")->insert(array("src_id"=>$_SESSION['user_info']['id'],"dst_id"=>$_POST['send_uid'],"content"=>$content,"ptime"=>time(),"ip"=>$ip));
			//发送信息
			$_POST['ptime']=time();
			$_POST['uid']=$_POST['send_uid'];
			$_POST['fid']=$_SESSION['user_info']['id'];
			$_POST['status']="1";
			if(D("friend")->insert()){//执行添加好友
				echo "success";//输出信息!用于Ajax判断
			}else{
				echo "error";
			}
			
		}
		
		/*
			删除好友方法
		*/
		public function del_friend(){
			if(D("friend")->where(array("uid"=>$_SESSION['user_info']['id'],"fid"=>$_GET['uid']))->delete()){
			//执行删除好友方法
				$this->success("删除成功!",1);
			}
		}
		
		/*
			加好友进黑名单方法(好友双向删除)
		*/
		public function add_black(){
			if(D("friend")->where(array("uid"=>$_SESSION['user_info']['id'],"fid"=>$_GET['uid']))->delete() && D("friend")->where(array("fid"=>$_SESSION['user_info']['id'],"uid"=>$_GET['uid']))->delete()){
			//执行好友双向删除
			$this->success("已经将好友加入黑名单!",1);
			}
		}
	}