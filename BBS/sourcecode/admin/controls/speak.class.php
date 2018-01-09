<?php
	/*+------------------------------------------------+
	  | 说说管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Speak{

		/**
		 * 显示符合条件的用户的说说
		 */
		public function index(){
			$user=D('user');
			$speak=D('speak')->select(array('uid'=>$this->get_ids()));
			foreach($speak as &$row){
				$tmp=$user->field('name')->find($row['uid']);
				$row['username']=$tmp['name'];
			}
			$this->assign('data',$speak);
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
		 * 删除指定的用户的说说
		 */
		public function del(){
			debug();

			D('speak_comm')->delete(array("sid"=>$_GET['id']));
				
			if(D('speak')->delete($_GET['id'])){
				echo "true";
			}else{
				echo "false";
			}

		}
	}
