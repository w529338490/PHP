<?php
	/*+------------------------------------------------+
	  | 用户管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)						
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class User{
	
		/**
		  * 输出搜索用户界面
		  */
		public function index(){
			$this->display();
		}
		
		/**
		  * 显示符合条件的所有用户
		  */
		public function show(){
		
			/* 如果 POST里有值就从POST里面取，没有就从GET 里面取值 */
			if($_POST){
				$post=$_POST;
			}else{
				$post=$_GET;
			}
			$where=D('common')->condition($post);
			
			if(!empty($where)){
				$list=D('user')->field('id,name')->select($where);
				$this->assign('deliver_condition',D('common')->deliver_condition($where));
				$this->assign('province',D('province')->select());
				if(empty($list)){
					$list="";
				}
				$this->assign('list',$list);
			}
			$this->display();
		}
		
		/**
		  * 更新用户的资料
		  */
		public function mod(){
			$post=array();
			$state=true;
			foreach($_POST as $key=>$row){
				if($row!=''){
					$post[$key]=$row;
				}
			}
			if($post['pass']=='******'){
				unset($post['pass']);
			}else{
				$post['pass']=md5($post['pass']);
			}
			
			/* 主题的状态 */
			if($post['state']==0){
				
				/* 将用户所有的主题改为禁用 */
				D('subject')->where(array('uid'=>$post['id']))->update(array('ptype'=>0));
				
			}elseif($post['state']==1){
			
				/* 将用户所有的主题改为普通 */
				D('subject')->where(array('uid'=>$post['id']))->update(array('ptype'=>4));
			}
			$post['last_ip']=sprintf('%u',ip2long($post['last_ip']));
			$post['birth_add']=$post['birth_province'].','.$post['brith_city'];
			$post['live_add']=$post['live_province'].','.$post['live_city'];
			/* 匹配最后登录时间 */
			$pattern='/([\d]{4})\-([\d]{2})\-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})/';
			preg_match($pattern,$post['last_time'],$time);
			$post['last_time']=mktime($time[4],$time[5],$time[6],$time[2],$time[3],$time[1]);
			
			/* 匹配出生日期 */
			$pattern='/([\d]{4})\-([\d]{2})\-([\d]{2})/';
			if(preg_match($pattern,$post['birthday'],$time)){
				$post['birthday']=mktime(0,0,0,$time[2],$time[3],$time[1]);
			}else{
				unset($post['birthday']);
			}
			
			if(!(D('user')->update($post))){
				$state=false;
			}
			if($state){
				$this->redirect('user/show/status/1/mess/修改用户成功！/uid/'.$post['id'].$post['deliver_condition']);
			}else{
				$this->redirect('user/show/status/2/mess/修改用户失败！/uid/'.$post['id'].$post['deliver_condition']);
			}
		}
		/**
		  * 得到一个用户的全部信息
		  */
		public function get_user(){
			debug();
			$user=D('user')->find($_GET['id']);
			$user['last_ip']=long2ip($user['last_ip']);
			
			$user['birth_province']=strrev(ltrim(strstr(strrev($user['birth_add']),','),','));
			$user['birth_city']=ltrim(strstr($user['birth_add'],','),',');
			$user['live_province']=strrev(ltrim(strstr(strrev($user['live_add']),','),','));
			$user['live_city']=ltrim(strstr($user['live_add'],','),',');
			$user['last_time']=date("Y-m-d H:i:s",$user['last_time']);
			$user['birthday']=date("Y-m-d",$user['birthday']);
			echo json_encode($user);
		}
		
		/**
		  * 得到城市
		  */
		public function get_city(){
			debug();
			$city=D('city')->order('sort asc')->field('id,name')->select(array('pid'=>$_GET['id']));
			echo json_encode($city);
		}
		
		/**
		  * 输出添加用户界面
		  */
		public function add(){
			
			$this->display();
		}
		
		/**
		  * 执行添加操作
		  */
		public function addition(){
			$_POST['pass']=md5($_POST['pass']);
			if(D('user')->insert()){
				$this->redirect('user/add/status/1/mess/添加用户成功！');
			}else{
				$this->redirect('user/add/status/2/mess/添加用户失败！');
			}
		}
		
	}
