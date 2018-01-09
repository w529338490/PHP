<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 主题评论模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:48   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Comment{
		/*
			返回指定主题的所有评论(附加用户名,头像,等级,日志数量,主题数量,评论数量,签名)
			@param1 int 主题id
			@param2 string 限制数量
			@return array
		*/
		public function subj_all_comm($sid,$limit){
			//从主题评论表得到评论者uid,内容,时间
			$all_comm=$this->field('uid,content,ptime')
								  ->where(array('sid'=>$sid))
								  ->order('id asc')
								  ->limit($limit)
								  ->select();
			$user=D('user');
			//为该主题评论附加评论者的用户名、头像路径、等级、日志数量、主题数量、评论数量、签名
			foreach($all_comm as &$comm){
				$user_name=$user->user_name($comm['uid']);
				$comm['user_name']=$user_name;					//用户名
				$comm['user_face_img']=$user->user_face($comm['uid']);	//头像
				$comm['user_level']=$user->get_level($comm['uid']);		//等级
				$comm['user_log_num']=$user->log_num($comm['uid']);		//日志数量
				$comm['user_subj_num']=$user->subj_num($comm['uid']);	//主题数量
				$comm['user_comm_num']=$user->comm_num($comm['uid']);	//评论数量
				$comm['sign']=$user->get_sign($comm['uid']);			//签名
			}
			return $all_comm;
		}
		
		/*
			给某主题发表评论
			@param1 array
			@return boolean
		*/
		public function post_comment($comment){
			if($cid=$this->insert($comment)){
				return true;
			}
			return false;
		}
		
		/*
			得到今日的所有评论数
			@return int
		*/
		public function comm_today_num(){
			return $this->where(array('ptime >='=>mktime(0,0,0,date('m'),date('d'),date('Y'))))
							   ->total();
		}
		
		/*
			描述:得到所有的评论数
			@return int
		*/
		public function comm_total_num(){
			return $this->total();
		}
		
		/*
			根据主题id号得到此主题的评论数量
			@param1 int 主题id号
			@return int
		*/
		public function subj_comm_num($id){
			return $this->where(array('sid'=>$id))->total();
		}
		
		/*
			统计指定板块有多少个评论
			@param1 int 板块id
			@return int
		*/
		public function board_comm_num($id){
			//获取所有合法的主题id
			$subjs=D('subject')->field('id')->where(array('bid'=>$id,'ptype !='=>'0'))->select();
			$comm_num=0;
			//调用subj_comm_num()得到该主题的评论数量,进行叠加
			foreach($subjs as $sbj){
				$comm_num+=$this->subj_comm_num($sbj['id']);
			}
			return $comm_num;
		}		
	}