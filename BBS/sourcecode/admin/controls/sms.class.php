<?php
	/*+------------------------------------------------+
	  | 站内信管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */

	class Sms{

		/**
		  * 显示符合条件的所有用户
		  */
		public function index(){

			debug();
			$post=$_GET;
			unset($post['a']);
			unset($post['m']);
			$sms=D('sms');

			$users=D('user')->field('id,name')->select($post);
			foreach($users as &$row){
				$row['send']=$sms->total(array("src_id"=>$row['id']));
				$row['receive']=$sms->total(array("dst_id"=>$row['id']));
				
			}
			$this->assign('users',$users);
			$this->display();

		}

		
		/**
		  * 显示该用户的所有站内信
		  */
		public function show(){
			$user=D('user');
			$send=D('sms')->select(array("src_id"=>$_GET['id']));
			foreach($send as &$row){
				$row['ptime']=date('Y-m-d',$row['ptime']);
				$row['ip']=long2ip($row['ip']);
				$tmp=$user->field('name')->find($row['dst_id']);
				$row['dst_name']=$tmp['name'];
			}
			
			$receive=D('sms')->select(array('dst_id'=>$_GET['id']));
			foreach($receive as &$row){
				$row['ptime']=date('Y-m-d',$row['ptime']);
				$row['ip']=long2ip($row['ip']);
				$tmp=$user->field('name')->find($row['src_id']);
				$row['src_name']=$tmp['name'];
			}
			
			$this->assign('receive',$receive);
			$this->assign('send',$send);
			$this->display();
		}
		
		
		
		/**
		  *	组合延续的条件
		  * @return 组合后的延续条件
		  */
		public function deliver_condition($where=''){
			// 如果用户没有输入条件就从延续的GET 里面提取条件
			if(empty($where)){
				foreach($_GET as $key=>$val){
					if($key!='a' && $key!='m'){
						$condition.="/{$key}/{$val}";
					}
				}
			}else{
				foreach($where as $key=>$val){
					$condition.="/{$key}/{$val}";
				}
			}
			return $condition;
		}
		
		/**
		  * 执行删除操作
		  */
		public function del(){
			$post=$_POST?$_POST:$_GET;
			if(D('sms')->delete($post['del'])){
				$this->redirect('show','status/1/mess/删除成功！/id/'.$post['uid']);
			}else{
				$this->redirect('show','status/2/mess/删除失败！/id/'.$post['uid']);
			}
		}
		/**
		  * 输出添加用户界面
		  */
		public function add(){
			
			$this->display();
		}
		
		/**
		  * 执行添加操作
		  */
		public function addition(){
			$post=$_POST?$_POST:$_GET;
			$ids=rtrim($post['dst_ids'],',');
			if($ids=='*'){
				$tmp=D('user')->field('id')->select();
				$ids=array();
				foreach($tmp as $row){
					$ids[]=$row['id'];
				}
			}
			if(!is_array($ids)){
				$ids=explode(',',$ids);
			}
			$sms=D('sms');
			foreach($ids as $id){
				$arr=array();
				$arr['src_id']=$_SESSION['user_info']['id'];
				$arr['dst_id']=$id;
				$arr['content']=$post['content'];
				$arr['ptime']=time();
				if(!($sms->insert($arr))){
					$this->redirect('add','state/2/mess/发送失败！');
				}
			}
			$this->redirect('add','state/1/mess/发送成功');
		}
		
	}
