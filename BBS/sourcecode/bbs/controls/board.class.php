<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 板块控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 16:51  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Board{
		/*
			某个分区下的所有子版块列表
		*/
		public function index(){
			$board=D('board');	//板块模型
			$board_name=$board->board_name($_GET['zid']);//分区名
			$this->assign('title',$board_name.'-'.TITLE);//标题
			$this->assign('keywords',KEYWORDS);	//关键字
			$this->assign('desc',DESC);			//描述
			$zone_and_board=$board->zone_sub_board($_GET['zid']);//得到分区和子版块的详细信息
			$this->assign('zone',$zone_and_board[0]);//分配分区
			$this->assign('sub_board_list',$zone_and_board[1]);//分配子版块
			$this->assign('nav_chain',$board->zone_nav($_GET['zid']));//分配导航链
			$this->display();
		}
	}