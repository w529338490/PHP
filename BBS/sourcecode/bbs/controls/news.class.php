<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 新闻控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 17:07  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class News{
		/*
			新闻列表页
		*/
		public function index(){
			if(!$this->is_cached(null,$_SERVER['REQUEST_URI'])){
				//分区与板块
				$zone_board_list=D('board')->zone_board_list();//就是页面上的左边的板块导航下拉表
				$this->assign('zone_board_list',$zone_board_list);//分配导航下拉表
				$this->assign('title','新闻列表-'.TITLE);//分配标题
				//所有新闻
				$page=new Page(D('news')->total(),B_NEWS_LIST_NUM);
				$news=D('news')->all_news($page->limit);//得到指定条数的新闻列表
				$this->assign('fpage',$page->fpage(0,3,4,5,6));//分配分页条
				$this->assign('news',$news);//分配新闻列表
				$this->assign('nav_chain',D('news')->news_nav());//分配导航链
			}
			$this->display(null,$_SERVER['REQUEST_URI']);
		}
		
		/*
			新闻详情页
		*/
		public function info(){
			if(!$this->is_cached(null,$_SERVER['REQUEST_URI'])){
				$this->assign('nav_chain',D('news')->news_info_nav($_GET['nid']));//分配导航链
				$new_info=D('news')->news_info($_GET['nid']);//得到新闻详情
				$this->assign('new_info',$new_info);//分配新闻详情
				$this->assign('title',$new_info['title'].'-源代码');//分配标题			
			}
			$this->display(null,$_SERVER['REQUEST_URI']);
		}
	}