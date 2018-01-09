<?php
	/*+------------------------------------------------+
	  | 网站的基本配置控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	*/
	
	class Set{
		/**
		  *得到网站的基本信息
		  *显示模板
		  */
		public function index(){
			$this->assign('data',D('set')->getBase());
			$this->display();
		}
		
		/**
		  * 输出论坛设置模板
		  */
		public function bbs(){
			$this->assign('data',D('set')->getBbs());
			$this->display();
		}
		
		/**
		  * 输出空间设置模板
		  */
		public function space(){
			$this->assign('data',D('set')->getSpace());
			$this->display();
		}
		/**
		  * 修改配置信息
		  */
		public function mod(){
			if($_POST['type']==1){
				$url="set/index/";
			}elseif($_POST['type']==2){
				$url="set/bbs/";
			}elseif($_POST['type']==3){
				$url="set/space/";
			}
			$set=D('set');
			if($set->modify()){
				$this->redirect($url.'status/1/mess/修改成功！');
			}else{
				$this->redirect($url.'status/2/mess/'.$set->error);
			}
		}
		
		/**
		  * 清除缓存
		  */
		public function clear_cache(){
			if(D('set')->clear_cache()){
				$this->redirect("set/index/status/1/mess/缓存已清空！");
			}else{
				$this->redirect("set/index/status/2/mess/清空缓存出错！");
			}
		}
		
		/**
		  * 数据库优化
		  */
		public function optimize(){
			D('set')->optimize();
			$this->redirect("set/index/status/1/mess/数据库优化成功！");
		}
	}