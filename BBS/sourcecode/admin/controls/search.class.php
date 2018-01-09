<?php
	/*+------------------------------------------------+
	  | 搜索用户条件组合控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Search{

		/**
		 * 输出搜索用户界面
		 */
		public function index(){
			$this->display();
		}

		/**
		  * 组合、过滤搜索条件
		  */
		public function condition(){
			$post=$_POST ? $_POST : $_GET;
			$common=D('common');
			$where=$common->condition($post);
			$where=$common->deliver_condition($where);
			$where=str_replace('%','%25',$where);
			$this->redirect($post['operate'].'/index',$where);
		}

	}
