<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 好友控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:58  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Friend{
		/*
			添加好友
		*/
		public function add_friend(){
			$friend=D('Friend','space');	//好友模型(space应用的)
			if($friend->add_friend($_SESSION['user_info']['id'],$_POST['f_uid'],$_POST['content'])){
				$this->success('发送"添加好友请求"成功!',2);
			}else{
				$this->error('发送"添加好友请求"失败!',2);
			}
		}
	}
?>