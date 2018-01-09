<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 用户模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-27 03:10  										
	  +-----------------------------------------------------------------------------------------+
	*/
	
	Class User{
		/*
			得到用户的id和用户名和头像
			@param1 int 用户的id号
			@return 一维数组
		*/
		public function user_info($uid){
			return D('user')->field('id,name,face_path')->find($uid);
			//返回用户的相关信息
		}
		
		/*
			得到用户详情
			@param1 int 用户的id号
			@return 一维数组
		*/
		public function user_detail($uid){
			$data = D("user")->field("id,name,email,sign,true_name,reg_time,last_time,grade_num,stand,sex,birthday,birth_add,live_add,hobby,marriage,pal_aim,face_path,last_ip")->find($_GET['uid']);
			//查询用户的详细信息
			$sex=array(0=>"保密",1=>"男",2=>"女");
			//定义性别列表数组
			$data['sex']=$sex[$data['sex']];
			$user = D("user","bbs");
			//调用bbs应用的user模型
			$data['birth_add'] = $user->get_address($data['birth_add']);
			//调用bbs应用的user模型的get_address方法
			$data['live_add'] = $user->get_address($data['live_add']);
			//调用bbs应用的user模型的get_address方法
			return $data;
			//返回用户信息
		}
		
		/*
			得到用户的所有统计
			@param1 int 用户的id号
			@return 一维数组
		*/
		public function user_total($uid){
			$user = D("user","bbs");
			//调用bbs下的user模型
			$total['friend_num'] = $user->friend_num($_GET['uid']);
			//调用好友总数方法
			$total['log_num'] = $user->log_num($_GET['uid']);
			//调用日志总数方法
			$total['album_num'] = $user->album_num($_GET['uid']);
			//调用好相册总数方法
			$total['subj_num'] = $user->subj_num($_GET['uid']);
			//调用主题总数方法
			$total['guest_num'] = $user->guest_num($_GET['uid']);
			//调用访客总数方法
			$total['message_num'] = D("message")->message_num($_GET['uid']);
			//调用留言总数方法
			$total['speak_num']=D("speak")->total(array("uid"=>$uid));
			//调用说说总数方法
			return $total;
			//返回所有统计值
		}
		
		/*
			得到用户空间的访客列表
			@param1 int 用户id
			@return array
		*/
		public function v_list($uid){
			$vdata = D("guest")->field("guest_id,vtime")->where(array("uid"=>$uid))->limit(S_GUEST_INDEX)->select();
			foreach($vdata as &$v){
				$user_info = $this->user_info($v['guest_id']);
				//调用user模型的user_info方法
				$v['vname']=$user_info['name'];
				//将用户名插入到数组中
				$v['face']=$user_info['face_path'];
				//将用户头像插入到数组中
			}
			return $vdata;
		}
		
		/*
			刷新用户的SESSION
			@param1 int 用户ID
		*/	
		public function flush_session($uid){
			$user_info=D("user")->field("name,true_name,email,sex,birthday,birth_add,live_add,hobby,marriage,pal_aim,grade_num,face_path,sign")->find($uid);
			//查询用户的详细信息
			$user_info=array_merge($_SESSION['user_info'],$user_info);
			//合并覆盖session数组
			$_SESSION['user_info']=$user_info;
			//更新session
		}
		
	}