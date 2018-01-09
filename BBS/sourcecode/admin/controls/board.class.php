<?php
	/*+------------------------------------------------+
	  | 版块管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Board{
		
		/**
		  * 默认显示所有的版块
		  */
		public function index(){
			$data=D("board")->where('parent_id=0')->r_select(array("board","id,name,master,display,img_path,order_num","parent_id",array("child_board","order_num asc")));
			foreach($data as &$rows){
				foreach($rows['child_board'] as &$cols){
					$tmp=D('user')->field('name')->find($cols['master']);
					$cols['master_name']=$tmp['name'];
				}
			}
			$this->assign('data',$data);
			$this->display();
		}
		
		/**
		  * 执行添加操作
		  */
		public function add(){
			debug();
			$val=$_GET;
			$board=D('board');
			$user=D('user');
			
			if(empty($val['name'])){
				return;
			}
			
			$info='true';
			$uid=$user->field('id')->where(array('name'=>$val['master']))->find();
			$val['master']=$uid['id'];
			if(empty($val['master']) || $val['master']<1){
				$val['master']=1;
			}
			

			$self_id=$board->insert($val);

			/* 如果不是父ID为0 的版块 */
			if($val['parent_id']!=0){
				$path=$board->field('path')->find($val['parent_id']);
				$path=$path['path'].','.$self_id;
				$board->update(array('id'=>$self_id,'path'=>$path));

				$data=$board->find($self_id);
				$tmp=$user->field('name,stand')->find($data['master']);

				/* 如果用户指定了版主
				 * 并且数据库里面有此用户
				 * 将此用户的身份 stand 改为 2 即版主
				 */
				if($tmp){
					if($tmp['stand']>2){
						$user->update(array('id'=>$data['master'],'stand'=>2));
					}
					$data['masterName']=$tmp['name'];
				}else{
					$data['masterName']='暂无';
				}
				
				echo json_encode($data);
			}else{
				$board->update(array('id'=>$self_id,'path'=>'0,'.$self_id));
				$data['id']=$self_id;
				$data['name']=$val['name'];
				echo json_encode($data);
			}
		}
		
		
		/**
		  * 执行删除操作
		  */
		public function del(){
			
			$state=1;
			$subject=D('subject');
			$board=D('board');
			$comment=D('comment');
			$user=D('user');

			$post=$_GET;

			$bids=$board->field('id,master')->select(array('path'=>'%'.$post['id'].'%'));


			/* 循环遍历 所有的版块 */
			foreach($bids as $row){
								
				$id_list=$subject->field('id')->select(array('bid'=>$row['id']));
				foreach($id_list as $id){
					$ids="'".$id['id']."',";
				}
				
				$ids=rtrim($ids,',');

				if($ids){

					/* 删除所有的帖子 */
					$comment->delete("sid in ({$ids})");
					/* 删除所有的主题 */
					$subject->delete("id in ({$ids})");
				}
				
				$num=$board->total(array('master'=>$row['master']));
				
				/* 如果用户只在此版块是版主，则将其删除 */
				if($num==1){
					$stand=$user->field('stand')->find($row['master']);
					if($stand['stand']==2){
						$user->update(array('id'=>$row['master'],'stand'=>3));
					}
				}

				$board->delete($row['id']);
			}
		
			$board->delete($post['id']);
			$this->redirect('board/index/status/1/mess/删除成功！');
		}
		
		/**
		  * 执行修改操作
		  */
		public function mod(){
			debug();
			$user=D('user');
			$board=D('board');
			$post=$_GET;
			$origin=$board->field('master')->find($post['id']);
			
			$uid=$user
					->where(array('name'=>$post['master']))
					->field('id,stand')
					->find();
					
			
			if($origin['master']!=$uid['id']){
				$num=$board->total(array('master'=>$origin['master']));
				/* 如果用户只在此版块是版主，则将其删除 */
				if($num==1){
					$stand=$user->field('stand')->find($origin['master']);
					if($stand['stand']==2){
						$user->update(array('id'=>$origin['master'],'stand'=>3));
					}
				}
			}
			if($uid['stand']>2){
				$user->update(array('id'=>$uid['id'],'stand'=>2));
			}
			
			$post['master']=$uid['id'];
			
			if($board->update($post)){
				echo "true";
			}else{
				echo "false";
			}
		}
	}
