<?php
	/*+------------------------------------------------+
	  | 主题管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Subject{
		public $where=array();
		/**
		  *	显示模板
		  */
		public function index(){
			$this->where['ptype <> ']=0;
			$data=$this->get_subject();
			$this->assign('fpage',$data['fpage']);
			$this->assign('subject',$data['data']);
			$this->assign('condition',$data['condition']);
			$this->assign('board',$data['board']);
			$this->display();
		}
		
		/**
		  *	得到符合条件的主题
		  * @return array 符合条件的主题数组
		  */
		private function get_subject(){
			$condition=$this->deliver_condition();
			
			$user_tab=D('user');
			$board=D('board');
			$comment=D('comment', 'bbs');
			$subject=D('subject');
			$page=new Page($subject->total($this->where), 12,$condition);
			$data=$subject->where($this->where)->limit($page->limit)->order('id desc')->select();
			foreach($data as &$val){
				$user_tmp=$user_tab->field('id,name')->find($val['uid']);
				$board_tmp=$board->field('name')->find($val['bid']);
				$val['user_name']=$user_tmp['name'];
				$val['board_name']=$board_tmp['name'];
				$val['comment_total']=$comment->subj_comm_num($val['id']);
			}
			return array('fpage'=>$page->fpage(0,4,5,6),'data'=>$data,'condition'=>$condition,'board'=>$this->parent_board());
		}
		
		/**
		  *  得到所有的顶级版块
		  */
		public function parent_board(){
			return D('board')->order('order_num asc')->select(array("parent_id"=>0,"display"=>1));
		}

		/**
		  *	组合延续的条件
		  * @return 组合后的延续条件
		  */
		public function deliver_condition(){
			return D('common')->deliver_condition($this->where);
		}

		/**
		  * 搜索方法
		  */
		public function search(){
		
			if(count($_POST)){
				$post=$_POST;
			}else{
				$post=$_GET;
			}
			if(!empty($post['title']) && $post['title'] != "请输入搜索关键字")	$where['title']='%'.$post['title'].'%';
			if($post['ptime']!=0){
				switch($post['ptime']){
					case 1 :	$time = 0;	break;
					case 2 : 	$time = 7;	break;
					case 3 :	$time = 30;	break;
				}
				$tmp=D("subject")->get_where_time($time);
				$keys=array_keys($tmp);
				$values=array_values($tmp);
				$where[$keys[0]]=$values[0];
			}
			if(!empty($post['name'])){
				$arr_tmp=D('user')->field('id')->select(array("name"=>"%{$post['name']}%"));
				for($i=0;$i<count($arr_tmp);$i++){
					$where['uid'].=$arr_tmp[$i]['id'].',';
				}
				$where['uid']=rtrim($where['uid'],',');
			}
			if($post['bid']>0){
				$where['bid']=$post['bid'];
			}
			if($post['ptype']!=''){
				$where['ptype']=$post['ptype'];
			}

			$this->where=$where;
			$data=$this->get_subject();
			$this->assign('fpage',$data['fpage']);
			$this->assign('subject',$data['data']);
			$this->assign('condition',$data['condition']);
			$this->assign('board',$data['board']);
			$this->display('index');
		}
		/**
		  * 删除方法
		  */
		public function del(){
			$subject=D('subject');
			$comment=D('comment');
			
			$comment->delete(array('sid'=>$_GET['id']));
			
			if($subject->delete($_GET['id'])){
				unset($_GET['id']);
				$this->redirect('subject/index','/status/1/mess/删除成功！'.$this->deliver_condition());
			}else{
				$this->redirect('subject/index','/status/2/mess/删除失败！'.$this->deliver_condition());
			}
		}

		/**
		 * 屏蔽帖子
		 */
		public function hidden(){

			$subject=D('subject');
			$id=explode(',',$_GET['id']);
			$arr=array();
			for($i=0;$i<count($id);$i++){
				$subject->update(array('id'=>$id[$i],'ptype'=>0));
			}
			$this->redirect('subject/index','/status/1/mess/操作成功！'.$this->deliver_condition());
			
		}

		/**
		 * 取消屏蔽帖子
		 */
		public function hidden_cancel(){

			$subject=D('subject');
			$id=explode(',',$_GET['id']);
			$arr=array();
			for($i=0;$i<count($id);$i++){
				$subject->update(array('id'=>$id[$i],'ptype'=>4));
			}
			$this->redirect('subject/index','/status/1/mess/操作成功！'.$this->deliver_condition());
		}

		/*
		 * 得到所有的子版块
		 */
		public function children_board(){
			debug();
			$parent_id=$_GET['bid'] ? $_GET['bid'] : 1;
			$tmp=D('board')->order('order_num asc')->select(array('parent_id'=>$parent_id,"display"=>1));
			echo json_encode($tmp);
		}
	}
