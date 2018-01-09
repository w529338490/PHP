<?php
	class IndexAction extends Common {
		function index(){
			$GLOBALS["debug"]=0;
			$this->display();
		}	
		function menu(){
			$GLOBALS["debug"]=0;
			//查询数据库中是否保存数据记录分配菜单
			$foreground=D('foreground');
			$result=$foreground->where(array('fid'=>'1'))->field('operateNotes')->find();
			//P($result);
			$this->assign('operateNotes',$result['operateNotes']);
			//p($_SESSION);
			$this->assign('group',$_SESSION);
			$this->display();
		}
		function main(){
			$GLOBALS['debug']=0;
			$this->assign('PHP_version',phpversion());
			$apache=substr(apache_get_version(),0,13);
			$this->assign('group',$_SESSION);
			$user_num=D('user')->total();
			$times=time();
			$seaTimes=$times-(24*60*60);
			$review=D('review')->where('review_time >= '.$seaTimes.'')->total();
			//P($review);
			$this->assign('review',$review);
			$this->assign('user_num',$user_num);
			$this->assign('apache',$apache);
			$this->display();
		}
	}