<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 搜索控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:54  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Search{
		/*
			搜索,根据不同类型,跳转到不同的控制器里
		*/
		public function search(){
			switch($_POST['search_type']){
				case '1':
					$this->redirect('subject/search_subj_index',"keyword/{$_POST['keyword']}/search_type/{$_POST['search_type']}");
					break;
				case '2':
					$this->redirect('user/index',"keyword/{$_POST['keyword']}/search_type/{$_POST['search_type']}");
					break;
				default:
					$this->redirect('log/index',"keyword/{$_POST['keyword']}/search_type/{$_POST['search_type']}");
					break;
			}
		}
	}