<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 公共模型
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:50   										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Pub{
		/*
			通过不同的表返回不同的前10
			@param1 string 表名(无前缀)
			@param2 array() 条件 默认无
		*/		
		public function top10($table,$where=array()){
			//如果是公告,那么条件就是合法的发表时间
			if($table=='notice'){
				$where=array('start_time <='=>time(),'stop_time >='=>time());
			}
			//其他表(主题表,新闻表,日志表)
			$obj=D($table)->field('id,title,uid')->limit(10)->order('ptime desc')->where($where)->select();
			//附件发表者的用户名
			foreach($obj as &$o){
				$user_name=D('user')->user_name($o['uid']);
				$o['user_name']=$user_name;
			}
			return $obj;
		}

		/*
			得到日志列表导航栏(日志搜索) 首页>>日志列表
			@return array()
		*/
		public function log_search_nav(){
			$nav=$this->index_nav();//首页
			$nav[]=array('url'=>B_APP.'/log/index','name'=>'日志列表');
			return $nav;
		}		
		
		/*
			得到主题列表导航栏(主题搜索) 首页>>主题列表
			@return array()
		*/
		public function subj_search_nav(){
			$nav=$this->index_nav();//首页
			$nav[]=array('url'=>B_APP.'/subject/search_subj_index','name'=>'主题列表');
			return $nav;
		}
		
		/*
			得到用户列表的导航链(用户搜索) 首页>>用户列表
			@return array()			
		*/
		public function user_nav(){
			$nav=$this->index_nav();//首页
			$nav[]=array('url'=>B_APP.'/user/index','name'=>'用户列表');
			return $nav;
		}
		
		/*
			得到公告详情的导航链  首页>>公告列表>>公告标题
			@param1 int 公告id
			@return array()
		*/
		public function notice_info_nav($ncid){
			$title=D('notice')->field('title')->where(array('id'=>$ncid))->find();//公告标题
			$nav=$this->notice_nav();//公告导航链
			$nav[]=array('url'=>B_APP.'/notice/info/ncid/'.$ncid,'name'=>mb_substr($title['title'],0,60,'utf-8'));
			return $nav;
		}
		
		/*
			得到公告列表的导航链	首页>>公告列表
			@return array()
		*/
		public function notice_nav(){
			$nav=$this->index_nav();//首页
			$nav[]=array('url'=>B_APP.'/notice/index','name'=>'公告列表');
			return $nav;
		}
		
		
		/*
			得到新闻详情页的导航链	首页>>新闻列表>>新闻标题
			@param1 int 新闻id
			@return array
		*/
		public function news_info_nav($nid){
			$nav=$this->news_nav();	//新闻导航链
			$title=D('news')->field('title')->where(array('id'=>$nid))->find();//新闻标题
			$nav[]=array('url'=>B_APP.'/news/info/nid/'.$nid,'name'=>mb_substr($title['title'],0,60,'utf-8'));
			return $nav;
		}
		
		/*
			得到新闻列表的导航链	首页>>新闻列表
			@return array()
		*/
		public function news_nav(){
			$news_nav=$this->index_nav();//首页
			$news_nav[]=array('url'=>B_APP.'/news','name'=>'新闻列表');
			return $news_nav;
		}
		
		/*
			得到主题详情页的导航链	首页>>分区名>>板块名>>主题名
			@param1 int 主题id
			@return array()
		*/
		public function subj_nav($sid){
			$subj_name=D('subject')->field('title')->where(array('id'=>$sid))->find();//主题名
			$bid=D('subject')->field('bid')->where(array('id'=>$sid))->find();	//板块id
			$subj_nav=$this->board_nav($bid['bid']);//板块导航链
			$subj_nav[]=array('url'=>B_APP.'/subject/info/sid/'.$sid,'name'=>mb_substr($subj_name['title'],0,55,'utf-8'));
			return $subj_nav;
		}
		
		/*
			得到板块的导航链	首页>>分区名>>板块名
			@param1 int 板块id
			@return array()
		*/
		public function board_nav($bid){
			$board=D('board');
			$name=$board->board_name($bid);//得到板块名
			$zid=$board->field('parent_id')->where(array('id'=>$bid))->find();//得到该板块分区id
			$board_nav=$this->zone_nav($zid['parent_id']);//分区导航链
			$board_nav[]=array('url'=>B_APP.'/subject/index/bid/'.$bid,'name'=>$board->board_name($bid));
			return $board_nav;
		}
		
		/*
			得到分区的导航链	首页>>分区名
			@param1 int 分区的id
			@return array()二维
		*/
		public function zone_nav($zid){
			$board=D('board');
			$name=$board->board_name($zid);//得到分区名
			$zone_nav=$this->index_nav();//首页
			$zone_nav[]=array('url'=>B_APP.'/board/index/zid/'.$zid,
							 'name'=>$board->board_name($zid)
							);
			return $zone_nav;
		}
		/*
			得到首页的导航栏 首页
			@return array()
		*/
		public function index_nav(){
			return array(array('url'=>B_APP,'name'=>'首页'));
		}
	}