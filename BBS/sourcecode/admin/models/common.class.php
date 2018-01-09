<?php
	/**
	  * 常用功能
	  * @author 杜承斌
	  */
	class Common{
		
		public $where=array();
		/**
		  * 组合用户的搜索条件
		  */
		public function condition($post=array()){
			
			if(!empty($post['id'])){
				$this->where['id']=$post['id'];
				return $this->where;
			}
			
			if(!empty($post['name'])){
				$this->where['name']='%'.$post['name'].'%';
			}
			if(!empty($post['email'])) $this->where['email']=$post['email'];
			/* 如果用户选了具体哪一天 所注册的 */
			if(!empty($post['reg_time'])){
				$pattern='/([\d]{4})\-([\d]{2})\-([\d]{2})/';
				preg_match($pattern,$post['reg_time'],$time);
				$this->where['reg_time >=']=mktime(0,0,0,$time[2],$time[3],$time[1]);
				$this->where['reg_time <']=mktime(0,0,0,$time[2],$time[3]+1,$time[1]);
			}elseif($post['reg_day']!='' && $post['reg_day']!='请选择'){
				$tmp=D('subject')->get_where_time($post['reg_day']);
				$this->where['reg_time >=']=$tmp['ptime >='];
			}
			if(!empty($post['email'])){
				$this->where['email']="%{$post['email']}%";
			}
			
		
			/* 如果用户先了最后登录的天数*/
			if(!empty($post['last_time'])){
				$pattern='/([\d]{4})\-([\d]{2})\-([\d]{2})/';
				preg_match($pattern,$post['last_time'],$time);
				$this->where['last_time >=']=mktime(0,0,0,$time[2],$time[3],$time[1]);
				$this->where['last_time <']=mktime(0,0,0,$time[2],$time[3]+1,$time[1]);
			}elseif($post['last_day']!='' && $post['last_day']!='请选择'){
				$tmp=D('subject')->get_where_time($post['last_day']);
				$this->where['last_time >=']=$tmp['ptime >='];
			}
			if(!empty($post['stand'])) $this->where['stand']=$post['stand'];
			if(!empty($post['id'])) $this->where['id']=$post['id'];
			$this->where['state']=$post['state'];

			
			return $this->where;

			
		}
		
		
		/**
		  *	组合延续的条件
		  * @return 组合后的延续条件
		  */
		public function deliver_condition($where=''){
			// 如果用户没有输入条件就从延续的GET 里面提取条件

			$condition='';
			if(empty($where)){
				foreach($_GET as $key=>$val){
					if($key!='a' && $key!='m'){
						$condition.="/{$key}/{$val}";
						$this->where[$key]=$val;
					}
				}
			}else{
				foreach($where as $key=>$val){
					$condition.="/{$key}/{$val}";
				}
			}
			return $condition;
		}
	}
