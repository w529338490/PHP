<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 注册控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 范培 (52web@sina.cn)							
	  | 最后修改时间: 2012-01-14 15:54  										
	  +-----------------------------------------------------------------------------------------+
	*/
	class Register{
		/*
			显示注册页面
		*/
		public function index(){
			$this->display();
		}
		
		/*
			输出验证码
		*/
		public function code(){
			echo new Vcode();
		}
		
		/*
			检测将要注册的用户是否存在
		*/
		public function check_user(){
			$userinfo=D('user')->field('id')->where(array('name'=>$_POST['name']))->find();
			if($userinfo){
				echo 1;
			}else{
				echo 0;
			}
		}
		
		/*
			检测验证码是否正确
		*/
		public function check_code(){
			if($_POST['code']!=$_SESSION['code']){
				echo 1;
			}else{
				echo 0;
			}
		}
		
		/*
			检测将要注册的邮箱是否存在
		*/
		public function check_email(){
			if(D('user')->field('id')->where(array('email'=>$_POST['email']))->find()){
				echo 1;
			}else{
				echo 0;
			}
		}
		
		/*
			用户注册
		*/
		public function register(){
			$user=D('user');
			$_POST['reg_time']=time();
			$_POST['pass']=md5($_POST['pass']);
			$_POST['last_ip']=ip2long($_SERVER['SERVER_ADDR']);			
			if($user->insert()){
				$this->success('注册成功!',1,'index/index');
			}
		}
	}
?>