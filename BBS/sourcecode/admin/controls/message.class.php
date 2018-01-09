<?php
	/*+------------------------------------------------+
	  | 留言管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Message{

		/**
		 * 显示符合条件的用户的留言
		 */
		public function index(){
			$user=D('user');
			$message=D('message')->order("uid asc")->select(array('uid'=>$this->get_ids()));
			foreach($message as &$row){
				$tmp=$user->field('name')->find($row['uid']);
				$row['username']=$tmp['name'];
				$tmp=$user->field('name')->find($row['mess_id']);
				$row['messname']=$tmp['name'];
			}
			$this->assign('data',$message);
			$this->display();
		}

		/** 
		  * 得到所有符合条件的用户的ID号
		  */
		private function get_ids(){
			$post=$_GET;
			unset($post['a']);
			unset($post['m']);
			$list=D('user')->field('id,name as username')->select($post);

			$id=$username=array();
			foreach($list as $row){
				$id[]=$row['id'];
			}
			return $id;
		}

		/**
		 * 删除指定的用户的留言
		 */
		public function del(){
			debug();

			if(D('message')->delete($_GET['id'])){
				echo "true";
			}else{
				echo "false";
			}

		}
	}
