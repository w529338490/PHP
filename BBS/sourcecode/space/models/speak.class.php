<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 说说模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-27 00:50  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Speak{
		
		/*
			得到用户说说的回复内容和回复人id,回复时间,回复ip
			@param1 int 说说的id号
			@return 二维数组
		*/
		public function speak_comm($sid){
			return D('speak_comm')->field('id,uid,content,ptime,ip')->order("ptime desc")->select(array("sid"=>$sid));
			//返回说说的回复内容
		}
		
		/*
			得到用户说说列表及回复列表(包括说说内容,说说时间,回复人用户名,回复时间,回复ip,回复内容)
			@param1 int 用户id
			@return array
		*/
		public function speak_list($uid,&$fpage){
			$total = D("user")->user_total($uid);
			$page=new ajaxPage($total['speak_num'], S_SPEAKPZ);
			//实例化公共类ajaxPage
			$sdata = D("speak")->field("id,content,ptime,ip")->order("ptime desc")->limit($page->limit)->select(array("uid"=>$uid));
			$user=D("user");
			foreach($sdata as &$s){
				$speak_comm=$this->speak_comm($s['id']);
				//调用speak_comm方法
				if(count($speak_comm)>0){
					$s['c_content']=$speak_comm;
					foreach($s['c_content'] as &$u){
						$user_info=$user->user_info($u['uid']);
						//调用user模型的user_info方法
						$u['cuname']=$user_info['name'];
						//将用户名插入到数组中
					}
				}					
			}
			$fpage=$page->fpage();
			//调用ajax分页对象的fpage方法
			return $sdata;
			//返回说说列表内容
		}
		
	}