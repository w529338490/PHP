<?php
	/*+------------------------------------------------+
	  | 后台首页控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	*/
	
	class Index {
		
		/* 输出首页模板 */
		function index(){
			$this->display();
		}
		
		/* 输出顶部模板 */
		function top(){
			debug();
			$this->display();
		}
		
		/* 输出菜单模板 */
		function menu(){
			debug();
			$this->display();
		}
		/* 输出导航模板 */
		function nav(){
			debug();
			$this->display();
		}
		
		/* 输出主体模板 */
		function main(){
		
			$server_info=check_env();
			$server_info['mysql_version']=mysql_get_server_info(mysql_connect(HOST,USER,PASS));
			
			//$arr=D('index');
			$this->assign('server_info',$server_info);
			$this->assign('nums',$this->simple());
			
			$this->display();
		}
		
		/*
			组合简单的数据统计.
			@return array 例：array(
									'subject'=>array(0=>今日数量,1=>全部数量),
									...
									);
		*/
		private function simple(){
			$nums['subject']=$this->today_total('subject');
			$nums['comment']=$this->today_total('comment');
			$nums['user']=$this->today_total('user','reg_time');
			$nums['album']=$this->today_total('album');
			$nums['speak']=$this->today_total('speak');
			$nums['message']=$this->today_total('message');
			$nums['sms']=$this->today_total('sms');
			$nums['notice']=$this->today_total('notice');
			
			return $nums;
		}
		
		/*
			得到今天/全部数据
			@param string 表名
			@param string 数据表中的时间字段名 默认为："ptime"
			@return array 例: array(0=>"今日数据",1=>"全部数据");
		*/
		public function today_total($tab='',$field='ptime'){
		
			$table=D($tab);
			$arr=array();
			
			$arr[]=$table->where($field.' > unix_timestamp(curdate())')->total();
			$arr[]=$table->total();
			
			return $arr;
		}
	}
