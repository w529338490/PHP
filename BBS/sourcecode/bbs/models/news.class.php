<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 新闻模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:49   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class News extends Pub{
		/*
			返回前十条的最新新闻
			@return array(二维数组)
		*/
		public function top10(){
			return parent::top10('news');
		}
		
		/*
			返回所有的新闻列表
			@param1 string 限制条数
			@return array()
		*/
		public function all_news($limit){
			//得到新闻的id,发表新闻的用户uid,时间
			$news=$this->field('id,uid,title,ptime')->limit($limit)->select();
			$user=D('user');
			//为新闻附加发表者的用户名
			foreach($news as &$n){
				$user_name=$user->user_name($n['uid']);
				$n['user_name']=$user_name;
			}
			return $news;
		}
		
		/*
			返回新闻详情(发布者用户名、等级、日志数量、主题数量、帖子数量、签名秀、头像)
			@param1 int 新闻id
			@return array() 
		*/
		public function news_info($nid){
			$user=D('user');
			//新闻的id,新闻标题,新闻内容,新闻的发表者的uid
			$info=$this->field('id,title,ptime,content,uid')->where(array('id'=>$nid))->find();
			$user_name=$user->user_name($info['uid']);
			$info['author']=$user_name;//新闻的发表者的用户名
			$info['level']=$user->get_level($info['uid']);//新闻发表者的等级
			$info['log_num']=$user->log_num($info['uid']);//新闻发表者的日志数量
			$info['subj_num']=$user->subj_num($info['uid']);//新闻发表者的主题数量
			$info['comm_num']=$user->comm_num($info['uid']);//新闻发表者的主题评论数量
			$info['sign']=$user->get_sign($info['uid']);	//新闻发表者的签名秀
			$info['face_img']=$user->user_face($info['uid']);//新闻发表者的头像路径
			return $info;
		}
	}
