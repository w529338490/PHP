<?php
	class Login {
		function index(){
			debug();
			$this->caching=0;     //设置缓存关闭
			$this->display();
		}
		function dologin(){		
			$user=D("user")->where(array("username"=>$_POST["username"],"password"=>md5($_POST["password"])))->find();
			if($user && $user['allow_1']==1){
				$_SESSION=$user;
				$_SESSION["login"]=1;
				
				$this->redirect("index/index");
			}else{
				$this->error("帐号或密码错误或账号已被冻结！", 3);
			}
		}
		function logout(){
			$this->caching=0;     //设置缓存关闭
			$username=$_SESSION["username"];
			$_SESSION=array();
			D("user", "admin")->logout();
			
			$this->success("再见 $username , 退出成功!", 3, "index/index");
		}
		function insert(){
			debug();
			$this->caching=0;     //设置缓存关闭
			$user=D("user");

			if(strtoupper($_POST["code"])==$_SESSION["code"]){
			if(preg_match("/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/",$_POST["username"])){
				if(($_POST["password1"]==$_POST["password"])&&preg_match("/^[0-9A-Za-z]{6,20}$/",$_POST["password"])){
				$data = $user->field('username')->where(array("username"=>$_POST["username"]))->find();
				if(!empty($data)){
					echo 5;
				}else{
				$_POST["password"]=md5($_POST["password"]);
				$l =$user->insert($_POST);
				echo 6;}}else{echo 5;}
			}else{
				echo 5;
			}
			}else{
				echo 5;
			}
		}
		function unique(){
			$this->caching=0;     //设置缓存关闭
			debug(0);
			echo D("user")->total(array("username"=>$_GET["username"]));
		}

		function code(){
			$this->caching=0;     //设置缓存关闭
			echo new Vcode(63,23,4);
		}

		function vcode(){
			$this->caching=0;     //设置缓存关闭
			debug(0);
			if(strtoupper($_GET["code"])==$_SESSION["code"]){
				echo 5;
			}else{
				echo 6;
			}
		}
	}
