<?php
	/*+------------------------------------------------+
	  | 公告管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	*/

	class Notice{
		
		/**
		  * 默认显示，公告列表
		  */
		public function index(){
			$notice=D('notice');
			$user=D('user');
			$data=$notice->field("id,uid,title,ptime,start_time,stop_time")->order("id desc")->select();
			
			foreach($data as &$row){
				$user_name=$user->field('name')->find($row['uid']);
				$row['author']=$user_name['name'];
				//未开始的
				if($row['start_time']>time()){
					$row['status']=1;
				//已结束的
				}
				if($row['stop_time']<time()){
					$row['status']=2;
				}
			}
			$this->assign('data',$data);
			$this->display();
		}
		
		/**
		  * 输出添加公告界面
		  */
		public function add(){
			
			$this->assign('time',date('Y-m-d 00:00:00'));	
			$this->display();
		}
		
		/**
		  * 执行添加公告
		  */
		public function addition(){
			$_POST['uid']=$_SESSION['user_info']['id'];
			$this->transition();
			if(D('notice')->insert()){
				$this->redirect('add','status/1/mess/添加成功！');
			}else{
				$this->redirect('add','status/2/mess/添加失败！');
			}
		}

		/**
		  * 输出修改公告界面
		  */
		public function mod(){
			$data=D('notice')->find($_GET['id']);
			
			$start_time=date('Y-m-d H:i:s',$data['start_time']);
			$stop_time=date('Y-m-d H:i:s',$data['stop_time']);
			$this->assign('start_time',$start_time);
			$this->assign('stop_time',$stop_time);
			$this->assign('data',$data);
			$this->display();
		}
		
		/**
		  * 执行修改公告
		  */
		public function modify(){
			$this->transition(0);
			if(D('notice')->update()){
				$this->redirect('notice/index/status/1/mess/修改成功！');
			}else{
				$this->redirect('notice/mod/id/'.$_POST['id'].'/status/2/mess/修改失败！');
			}
		}
		
		/**
		  * 执行删除公告
		  */
		public function del(){
			if($_GET['id']){
				$id=$_GET['id'];
			}elseif($_POST){
				$id=$_POST['select'];
			}
			if(D('notice')->delete($id)){
				$this->redirect('notice/index/status/1/mess/成功删除'.count($id).'个公告！');
			}else{
				$this->redirect('notice/index/status/2/mess/删除公告失败！');
			}
		}
		
		/* 
		 * 将如 2012-01-14 15:04:00 转换成相应的时间截
		 */
		private function transition($operate=1){
			if($operate===1){
				$_POST['ptime']=time();
			}
			$pattern='/([\d]{4})\-([\d]{2})\-([\d]{2}) ([\d]{2}):([\d]{2}):([\d]{2})/';
			preg_match($pattern,$_POST['start_time'],$time);
			$_POST['start_time']=mktime($time[4],$time[5],$time[6],$time[2],$time[3],$time[1]);
			preg_match($pattern,$_POST['stop_time'],$time);
			$_POST['stop_time']=mktime($time[4],$time[5],$time[6],$time[2],$time[3],$time[1]);
		}
	}
