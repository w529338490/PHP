<?php
	/*
		描述:首页控制器
		作者:范培
		最后修改时间:
	*/
	class Index{
		//首页展示
		public function index(){
			$sbj=D('subject');	//主题模型
			$user=D('user');	//用户模型
			$comm=D('comment');	//评论模型
			$news=D('news');	//新闻模型
			$log=D('log');		//日志模型
			$board=D('board');	//分区版块模型
			$flink=D('flink');	//友情链接模型
			$notice=D('notice');//公告模型
			
			$this->assign('title',"首页-".TITLE);
			$this->assign('keywords',KEYWORDS);
			$this->assign('desc',DESC);
			$this->assign('yesterday_sbj_num',$sbj->subj_day_num(1));		//昨日主题量
			$this->assign('today_sbj_num',$sbj->subj_day_num(0));			//今日主题量
			$this->assign('total_sbj_num',$sbj->subj_total_num());			//共有主题量
			$this->assign('total_comm_num',$comm->comm_total_num());		//共有帖子量(主题评论)
			$this->assign('user_total_num',$user->get_user_total_num());	//一共有多少个会员
			$this->assign('new_user',$user->get_new_user());				//最新注册用户
			$this->assign('hot_subj',$sbj->hot_sbj());						//热门主题
			$this->assign('new_subj',$sbj->top10());						//最新主题
			$this->assign('news',$news->top10());							//最新新闻
			$this->assign('log',$log->top10());								//最新日志
			$this->assign('notice',$notice->top10());						//最新公告
			$this->assign('board_list',$board->board_list());				//板块列表
			$this->assign('flink',$flink->field('name,site')->select());	//友情链接
			$this->assign('nav_chain',$board->index_nav());					//导航栏			
			$this->display();
		}
	}