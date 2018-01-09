<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 公告控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:54  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Notice{
		/*
			公告列表
		*/
		public function index(){
			$notice=D('notice');//公告模型
			$board=D('board');//板块模型
			//分区与板块
			$zone_board_list=$board->zone_board_list();//页面上左边的分区与板块的下拉式导航栏
			$this->assign('zone_board_list',$zone_board_list);//分配下拉式导航栏
			$this->assign('title','公告列表-'.TITLE);//分配标题
			$this->assign('nav_chain',$notice->notice_nav());//分配公告导航链
			$page=new Page($notice->where(array('start_time <='=>time(),'stop_time >='=>time()))->total(),B_NOTICE_LIST_NUM);
			$this->assign('notice',$notice->all_notice($page->limit));//得到指定限制条数的公告
			$this->assign('fpage',$page->fpage(0,3,4,5,6));//分配分页条				
			$this->display(null,$_SERVER['REQUEST_URI']);
		}
		
		/*
			公告详情
		*/
		public function info(){
			if(!$this->is_cached(null,$_SERVER['REQUEST_URI'])){
				$notice=D('notice');//公告模型
				$this->assign('nav_chain',$notice->notice_info_nav($_GET['ncid']));//分配导航链
				$title=$notice->field('title')->where(array('id'=>$_GET['ncid']))->find();//得到标题
				$this->assign('info',$notice->info($_GET['ncid']));//分配公告详情
				$this->assign('title',$title['title'].'-'.TITLE);//分配标题			
			}
			$this->display(null,$_SERVER['REQUEST_URI']);
		}
	}