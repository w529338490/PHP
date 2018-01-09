<?php
	/*+------------------------------------------------+
	  | 等级管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)						
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */
	class Level{
		
		/* 存放等级表 */
		public $level;
		
		/**
		  * 构造方法.
		  * 给成员属性 level 赋初始值
		  */
		public function __construct(){
			$this->level=D('level');
		}
		
		/**
		  * 默认显示所有的等级信息 
		  */
		public function index(){
			$this->assign('data',$this->level->order("mini asc")->select());
			$this->display();
		}
	
		/**
		 * 执行修改(添加的也在此判断添加了)
		 * 		 
		 */
		public function modify(){
			debug();
			$error=1;
			$i=0;
			/* 循环将值赋给 post(要更新的) 和add(新添加的) */
			foreach($_POST as $k=>$row){
				foreach($row as $key=>$col){
					if($k=='mini'){
						$post[$key]['mini']=$col;
						$post[$key]['id']=$key;
					}elseif($k=='name'){
						$post[$key]['name']=$col;
						$post[$key]['id']=$key;
					}elseif($k=='add_name'){
						$add[$key]['name']=$col;
					}elseif($k=='add_mini'){
						$add[$key]['mini']=$col;
					}
				}
				
				/* 如果有值就循环更新等级表 */
				if(count($post)){
					foreach($post as $kk=>$vv){
						$this->level->update($post[$kk]);
					}	
				}
			}
			
			/* 如果用户有添加新用户，就执行添加！ */
			foreach($add as $a){
			
				if(!($this->level->insert($a))){
					$error=2;
				}
			}
			
			$data=$this->level->order('mini asc')->select();
			for($i=1;$i<count($data);$i++){
				$data[$i-1]['maxi']=$data[$i]['mini']-1;
			}
			$data[0]['mini']=0;
			$data[count($data)-1]['maxi']=999999999;
			
			for($i=0;$i<count($data);$i++){
				$this->level->update($data[$i]);
			}
			if($error===1){
				$mess="修改成功！";
			}else{
				$mess="修改失败！";
			}
			$this->redirect('index','/status/'.$error.'/mess/'.$mess);
			
		}
		
		/**
		  * 执行删除
		  */
		public function del(){
			debug();
		
			if($this->level->delete($_GET['id'])){
				$data=$this->level->order('mini asc')->select();
				for($i=1;$i<count($data);$i++){
					$data[$i-1]['maxi']=$data[$i]['mini']-1;
				}
				$data[0]['mini']=0;

				/* 将最大的一个等级的最大值 改为 999999999 */
				$data[count($data)-1]['maxi']=999999999;
				
				for($i=0;$i<count($data);$i++){
					$this->level->update($data[$i]);
				}
				echo 'true';
			}else{
				echo 'false';
			}		
		}  
		
	}
