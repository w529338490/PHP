<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 站内信管理控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2012-01-02 06:02  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Sms{
		/*
			显示站内信首页
		*/
		public function index(){
			$this->display();//显示模板
		}
		
		/*
			显示站内信列表并在站内信首页用Ajax加载
		*/
		public function sms_list(){
			debug();//关闭debug
			$this->assign("sms_list",D("sms")->sms_list($_SESSION['user_info']['id'],$fpage));
			//调用sms模型的sms_list方法,并将返回数据分配给模板
			$this->assign("fpage", $fpage);
			//分配分页信息到模板
			$this->display();
			//显示模板
		}
		
		/*
			显示站内信详情
		*/
		public function detail(){
			$this->assign("sms_detail",D("sms")->sms_detail($_GET['smsid']));
			//调用sms模型的sms_detail方法,并将数据分配到模板
			$this->assign("user",D("user")->user_info($_GET['send_uid']));
			//调用user模型的user_info方法,并将数据分配到模板
			$this->display();
			//显示模板
		}
		
		/*
			站内信发送方法
		*/
		public function dosend(){
			$state = D("sms")->sms_send($_POST['dst_id'],$_POST['src_id'],$_POST['content']);
			//调用sms模型的sms_send方法
			if($state){
				$this->success("发送成功!",1);
			}else{
				$this->error("发送失败!",1);
			}
		}
		
		/*
			删除站内信方法
		*/
		public function delsms(){
			if(D("sms")->delete($_GET['smsid'])){
			//执行删除短信方法
				$this->success("删除短信成功!",1);
			}else{
				$this->error("删除短信失败!",1);
			}
		}
		
		/*
			标记站内信为已读方法
		*/
		public function read(){
			D("sms")->where($_GET['smsid'])->update(array("is_read"=>"1"));
			//更改短信状态为已读
		}
		
		/*
			验证是否已成为好友
		*/
		public function is_friend(){
			$status=D("friend")->field("status")->where(array("fid"=>$_SESSION['user_info']['id'],"uid"=>$_POST['uid']))->find();
			//查询好友添加状态
			echo $status['status'];
			//输出状态
		}
		
		/*
			向用户打招呼方法
		*/
		public function sendhello(){
			$emotion = array(1=>"微笑",2=>"踩一下",3=>"握个手",4=>"加油",5=>"抛媚眼",6=>"拥抱",7=>"飞吻",8=>"挠痒痒",9=>"给一拳",10=>"电一下",11=>"依偎",12=>"拍拍肩膀",13=>"咬一口");
			//定义打招呼表情数组
			$_POST['ptime']=time();
			//获取打招呼时间
			$_POST['ip']=sprintf("%u",ip2long($_SERVER['REMOTE_ADDR']));
			//获取打招呼IP
			$_POST['sms_sort']="3";
			//定义短信类型为3
			$_POST['content']="<font color='green'><b>{$_SESSION['user_info']['name']}</b></font> 对您 <font color='green'><b>{$emotion[$_POST['hello_type']]}</b></font> , 并对您说 :<p/>{$_POST['content']}";
			//定义打招呼的文本格式
			if(D("sms")->insert()){
			//执行添加
				$this->success("发送成功!",0);
			}
		}
	}