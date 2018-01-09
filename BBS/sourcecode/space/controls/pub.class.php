<?php
	/*+-----------------------------------------------------------------------------------------+
	  | 用户注册登录及公共方法控制器
	  +-----------------------------------------------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +-----------------------------------------------------------------------------------------+
	  | 作者: 李捷 (lijie@li-jie.me)							
	  | 最后修改时间: 2011-12-25 03:50  										
	  +-----------------------------------------------------------------------------------------+
	*/

	Class Pub extends Action{
		
		/*
			用户退出方法
		*/
		public function dologout(){
			if(D("user","admin")->pub_logout()){
			//调用admin应用下的pub_logout方法
				$this->success("退出成功!",1,"index/index");
			}else{
				$this->error("退出失败了!您还是再玩玩吧!",1);
			}
		}
		
		/*
			用户登录方法
		*/
		public function dologin(){
			if($_POST['code']==$_SESSION['code']){
			//验证验证码是否正确
				if(D("user","admin")->pub_login()){
				//调用admin应用下的pub_login方法
					$this->success("登录成功!",1,"index/index/uid/{$_SESSION['user_info']['id']}");
				}else{
					$this->error("登录失败了!请稍后再试!",1);
				}
			}else{
				$this->error("验证码输入错误!",1);
			}
		}
		
		/*
			输出验证码
		*/
		public function code(){
			debug();//关闭debug
			echo new Vcode();//输出验证码
		}
		
		public function checkcode(){
			debug();//关闭debug
			if(strtoupper($_POST['code'])==$_SESSION['code']){
			//判断验证码是否正确
				echo "1";
			}else{
				echo "0";
			}
		}
		
		/*
			检测将要注册的用户是否存在
		*/
		public function check_user(){
			debug();//关闭debug
			$userinfo=D('user')->field('id')->where(array('name'=>$_POST['name']))->find();
			//查询此用户名是否存在用户ID
			if($userinfo){
			//若存在,输出1
				echo "1";
			}else{
			//否则输出0
				echo "0";
			}
			exit();
		}
		
		/*
			检测将要注册的邮箱是否存在
		*/
		public function check_email(){
			debug();//关闭debug
			if(D('user')->field('id')->where(array('email'=>$_POST['email']))->find()){
			//查询此邮箱是否存在用户ID,若存在,输出1
				echo "1";
			}else{
			//否则输出0
				echo "0";
			}
		}
		
		/*
			注册方法
		*/
		public function register(){
			$user=D('user');
			$_POST['reg_time']=time();
			//获取注册时间
			$_POST['pass']=md5($_POST['pass']);
			//md5加密输入的密码
			$_POST['last_ip']=ip2long($_SERVER['REMOTE_ADDR']);
			//获取注册IP
			if($user->insert()){
			//执行添加用户
				$this->success('注册成功!',1);
			}
		}
		
		/*
			检查用户名密码
		*/
		public function check_user_exist(){
			debug();//关闭debug
			$_POST['pass']=md5($_POST['pass']);
			if($_POST['type']==3){
			//判断用户登录类型,若为3,则判断用户名
				$user=D('user')->where(array("name"=>$_POST['name'],"pass"=>$_POST['pass']))->find();	
			}elseif($_POST['type']==1){
			//若为1,则判断邮箱
				$user=D('user')->where(array("email"=>$_POST['name'],"pass"=>$_POST['pass']))->find();
			}elseif($_POST['type']==2){
			//若为2,则判断id
				$user=D('user')->where(array("id"=>$_POST['name'],"pass"=>$_POST['pass']))->find();
			}
			if($user){
			//如果用户存在,则输出1
				echo "1";
			}else{
			//否则输出0
				echo "0";
			}
		}
		
		/*
			输出404页面
		*/
		public function error404(){
			$this->display("public/404");
			//输出404模板
		}
	}