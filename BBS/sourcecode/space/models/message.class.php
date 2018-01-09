<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 留言板模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-27 08:01  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Message{
	
		/*
			得到用户空间的所有留言内容,留言会员,留言时间
			@param1 int 用户id
			@param2 obj 分页信息
			@return array
		*/
		public function message_index($uid,&$fpage){
			$total = D("user")->user_total($uid);
			//调用user模型的user_total方法
			$page=new ajaxPage($total['message_num'], S_MESSPZ);
			//实例化公共类ajaxPage
			$mdata = D("message")->field("id,uid,content,ptime,ip,mess_id")->limit($page->limit)->where(array('uid'=>$uid))->order("ptime desc")->select();
			$user=D("user");
			foreach($mdata as &$d){
				$user_info=$user->user_info($d['mess_id']);
				//调用user模型的user_info方法
				$d['mess_name']=$user_info['name'];
				//将用户名插入到数组中
				$d['mess_avar']=$user_info['face_path'];
				//将用户头像插入到数组中
			}
			$fpage=$page->fpage();
			//调用ajax分页对象的fpage方法
			return $mdata;
			//返回留言信息列表
		}
		
		/*
			得到用户留言总数
			@param1 int 用户ID
			@return int
		*/		
		
		public function message_num($uid){
			return D("message")->where(array("uid"=>$uid))->total();
			//返回留言总数
		}
	}