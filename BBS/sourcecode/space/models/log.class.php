<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 日志模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2012-12-29 09:09  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Log{	
		/*
			得到用户日志的评论列表
			@param1 int 日志id
			@return array
		*/
		public function logc_list($lid){
			$ldata = D("log_comm")->field("id,uid,content,ptime,ip")->select(array("lid"=>$lid));
			$user = D("user");
			foreach($ldata as &$l){
				$user_info=$user->user_info($l['uid']);
				//调用user模型的user_info方法
				$l['face_path']=$user_info['face_path'];
				//将用户头像插入到数组中
				$l['name']=$user_info['name'];
				//将用户名插入到数组中
			}
			return $ldata;
			//返回日志评论列表详情
		}
	
		/*
			得到用户日志的评论总数
			@param1 int 日志id
			@return int
		*/
		public function logc_total($lid){
			return D("log_comm")->where(array("lid"=>$lid))->total();
			//返回日志评论总数
		}
		
		/*
			通过用户ID获取日志列表详情及日志的评论总数
			@param1 int 用户id
			@return array
		*/
		public function loglist($uid,&$fpage){
			$total = D("user")->user_total($uid);
			$page=new ajaxPage($total['log_num'], S_LOGPZ);
			//实例化公共类ajaxPage
			$log = D("log")->field("id,title,content,ptime,click_num,ip")->order("ptime desc")->limit($page->limit)->where(array("uid"=>$uid))->select();
			foreach($log as &$log_data){
				$log_total = $this->logc_total($log_data['id']);
				//调用logc_total方法
				$log_data['ctotal']=$log_total;
				//将日志评论总数插入到数组中
			}
			$fpage=$page->fpage();
			//调用ajax分页对象的fpage方法
			return $log;
			//返回日志详情
		}
	}	
