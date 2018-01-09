<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 安装控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 16:51  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Index {			
		private $host;		//主机名
		private $dbname;	//库名
		private $user;		//用户名
		private $pass;		//密码
		private $drive;		//数据库驱动
		private $prefix;	//表前缀
		private $admin_user;//管理员
		private $admin_pass;//管理员密码
		private $email;		//管理员邮箱
		
		/*
			安装首页
		*/
		public function index(){
			$this->assign('env',check_env());
			$this->assign('auth',check_file());
			$this->assign('func',check_func());
			$this->display();
		}
		
		/*
			填写数据库和管理员信息的页面
		*/
		public function step2(){
			if(class_exists('PDO')){
				$this->assign('pdo','1');
			}else{
				$this->assign('pdo','0');
			}
			if(class_exists('mysqli')){
				$this->assign('mysqli','1');
			}else{
				$this->assign('mysqli','0');
			}
			$this->display();
		}
		
		/*
			检查数据库密码
		*/
		public function check_db_pass(){
			$host=$_POST['host'];
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$con=@mysql_connect($host,$user,$pass);
			if(mysql_errno()){
				echo 0;
			}else{
				echo 1;
			}
		}
		
		/*
			安装
		*/
		public function install(){
			$this->host=$_POST['host'];
			$this->dbname=$_POST['dbname'];
			$this->user=$_POST['user'];
			$this->pass=$_POST['pass'];
			$this->drive=$_POST['drive'];
			$this->prefix=$_POST['prefix'];
			$this->admin_user=$_POST['admin_name'];
			$this->admin_pass=$_POST['admin_pass'];
			$this->email=$_POST['email'];
			if($this->set_conf() && $this->create_data()){
				echo "<center>安装成功! <a href='".$GLOBALS["root"]."index.php'>点击进入首页</a></center>";
			}
			touch('install/lock');
		}
		
		/*
			正则替换配置文件
		*/
		private function set_conf(){
			$conf=array();
			$conf['HOST']=$this->host;
			$conf['DRIVER']=$this->drive;
			$conf['USER']=$this->user;
			$conf['PASS']=$this->pass;
			$conf['DBNAME']=$this->dbname;
			$conf['TABPREFIX']=$this->prefix;
			foreach($conf as $key=>$value){
				$old_conf=file_get_contents('config.inc.php');
				$pattern='/(\"'.$key.'\"\,)(.*?)(\)\;)/';
				if(preg_match($pattern,$old_conf)){
					$replace_content="\$1\"".$value."\"\$3";
					$new_conf=preg_replace($pattern,$replace_content,$old_conf);		
				}
				file_put_contents('config.inc.php',$new_conf);
			}
			return true;
		}
		
		/*
			创建数据库/数据表
		*/
		private function create_data(){
			$old_sql=file_get_contents('install/table/sourcecode.sql');
			$pattern='/sc_(\w+)/';
			if(preg_match($pattern,$old_sql)){
				$new_sql=preg_replace($pattern,$this->prefix."\${1}",$old_sql);
			}
			$mysqli=new mysqli($this->host,$this->user,$this->pass);
			//$mysqli->query("set names utf8");
			$mysqli->query("create database if not exists ".$this->dbname);
			$mysqli->query("use ".$this->dbname);
			$new_sql.="insert into ".$this->prefix."user(name,pass,email,stand) values('".$this->admin_user."',md5('".$this->admin_pass."'),'".$this->email."','1');";
			$mysqli->multi_query($new_sql);
			return true;
		}
	}