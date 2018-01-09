<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 日志控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 17:03  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Log{
		/*
			日志列表
		*/
		public function index(){
			$log=D('log');	//日志模型
			$user=D('user');//用户模型
			$where=array();	//数组式的where条件初始化
			$url_where='';	//url式的where条件初始化
			if(!empty($_GET['keyword'])){
				$where['title']='%'.$_GET['keyword'].'%';//标题关键字
				$where=array('content'=>"%{$_GET['keyword']}%");//内容关键字
				$url_where="/keyword/{$_GET['keyword']}/search_type/{$_GET['search_type']}";//关键字和搜索类型
			}
			$page=new Page($log->where($where)->total(),S_LOG_INDEX,$url_where);
			//搜索的出来的日志有id,标题,内容,时间,点击量,用户id
			$log_list=$log->field('id,uid,title,content,ptime,click_num')
						  ->where($where)
						  ->order('ptime desc')
						  ->limit($page->limit)
						  ->select();
			//附件日志的回复量,发表者的用户名
			foreach($log_list as &$lg){
				$user_name=$user->user_name($lg['uid']);//得到发表者的用户名
				$lg['comm_num']=D('log','space')->logc_total($lg['id']);//得到日志的回复量
				$lg['author']=$user_name;
			}
			$this->assign('title','日志列表-'.TITLE);//分配标题
			$this->assign('nav_chain',D('pub')->log_search_nav());//分配导航链
			$this->assign('log_list',$log_list);//分配日志列表
			$this->assign('fpage',$page->fpage(0,3,4,5,6));//分配哦分页条
			$this->display();
		}
	}