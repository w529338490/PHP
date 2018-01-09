<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 公告模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:49   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Notice extends Pub{
		/*
			返回最新前10条公告
			@return array(二维数组)
		*/
		public function top10(){
			return parent::top10('notice');
		}
		
		/*
			得到所有的公告的列表(附加公告发表者的用户名)
			@param string 限制条数
			@return array()
		*/
		public function all_notice($limit){
			$user=D('user');
			//公告的id,标题,发表时间,发表者的uid
			$notice=$this->field('id,uid,title,start_time')
							   ->where(array('start_time <='=>time(),'stop_time >='=>time()))
							   ->limit($limit)
							   ->select();
			//附加发表者的用户名
			foreach($notice as &$nc){
				$user_name=$user->user_name($nc['uid']);
				$nc['author']=$user_name;
			}
			return $notice;
		}
		
		/*
			得到指定公告的详情(外加发表者的用户名、等级、日志数、主题数、帖子数、签名修)
			@return array()
		*/
		public function info($ncid){
			$user=D('user');
			//公告的id,标题,内容,发表时间,发表者的uid
			$info=$this->field('id,uid,title,start_time,content')
							   ->where(array('start_time <='=>time(),'stop_time >='=>time(),'id'=>$ncid))
							   ->find();
			$user_name=$user->user_name($info['uid']);
			$info['author']=$user_name;	//发表者的用户名
			$info['level']=$user->get_level($info['uid']);//发表者的等级
			$info['log_num']=$user->log_num($info['uid']);//发表者的日志数量
			$info['subj_num']=$user->subj_num($info['uid']);//发表者的主题数量
			$info['comm_num']=$user->comm_num($info['uid']);//发表者的主题评论数量
			$info['sign']=$user->get_sign($info['uid']);	//发表者的签名
			$info['face_img']=$user->user_face($info['uid']);//发表者的头像路径
			return $info;
		}
	}