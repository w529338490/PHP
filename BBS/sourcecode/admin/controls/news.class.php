<?php
	/*+------------------------------------------------+
	  | 新闻管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */

	class News{
		
		/**
		  * 默认显示，新闻列表
		  */
		public function index(){
			$news=D('news');
			$user=D('user');
			$page=new Page($news->total(),10);
			$data=$news->limit($page->limit)->field("id,uid,title,ptime")->select();
			
			foreach($data as &$row){
				$user_name=$user->field('name')->find($row['uid']);
				$row['author']=$user_name['name'];
			}
			
			$this->assign('fpage',$page->fpage());
			$this->assign('data',$data);
			$this->display();
		}
		
		/**
		  * 输出添加新闻界面
		  */
		public function add(){
			$this->display();
		}
		
		/**
		  * 执行添加新闻
		  */
		public function addition(){
			$_POST['uid']=$_SESSION['user_info']['id'];
			$_POST['ptime']=time();
			$_POST['ip']=D('common')->ip_to_long();
			if(D('news')->insert()){
				$this->redirect('add','status/1/mess/添加成功！');
			}else{
				$this->redirect('add','status/2/mess/添加失败！');
			}
		}
		
		/**
		  * 输出修改新闻界面
		  */
		public function mod(){
			$data=D('news')->find($_GET['id']);
			$this->assign('data',$data);
			$this->display();
		}
		
		/**
		  * 执行修改新闻
		  */
		public function modify(){
			if(D('news')->update()){
				$this->redirect('index','status/1/mess/修改成功！');
			}else{
				$this->redirect('mod','status/2/mess/修改失败！');
			}
		}
		
		/**
		  * 执行删除新闻
		  */
		public function del(){
			$id=explode(',',$_GET['id']);
			if(D('news')->delete($id)){
				$this->redirect('index','status/1/mess/成功删除！'.count($id).'条新闻！');
			}else{
				$this->redirect('index','status/2/mess/删除失败！');
			}
		}
		
	}
