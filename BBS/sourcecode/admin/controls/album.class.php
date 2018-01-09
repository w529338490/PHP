<?php
	/*+------------------------------------------------+
	  | 相册管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-17 20:00								
	  +------------------------------------------------+
	 */
	class Album{

		/**
		 * 显示符合条件的用户的相册
		 */
		public function index(){
			$user=D('user');
			$album=D('album')->select(array('uid'=>$this->get_ids()));
			foreach($album as &$row){
				$tmp=$user->field('name')->find($row['uid']);
				$row['username']=$tmp['name'];
			}
			$this->assign('data',$album);
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
		 * 删除指定的用户的相册
		 */
		public function del_album(){
			debug();
			if(D('album')->del($_GET['id'])){
				echo 'true';
			}else{
				echo 'false';
			}
		}
	}
