<?php
class login extends Action{
	/**
	 * 后台登陆界面
	 */
	function index(){
		$this->display();
	}
	/**
	 * 验证码
	 */
	function code(){
		echo new Vcode();
	}
	/**
	 * 验证登陆信息
	 */
	function login(){
		$user = D("user")->field('id,username,allow_1,allow_2,allow_3,allow_4')
			->where(array("username"=>$_POST["username"],"password"=>md5($_POST["password"])))
			->find();
		if($user && $_POST['code']==$_SESSION['code']){
			$_SESSION = $user;
			$_SESSION['islogin'] = 1; //是否登录
			$this->success("欢迎{$_POST["username"]}, 登录成功", 1, "index/index");
		}else{
			$this->error("管理员登录失败",1,"index");
		}
	}
	/**
	 * 退出登录
	 */
	function logout(){
		$username = $_SESSION["username"];
		$_SESSION = array();
		if(isset($_COOKIE[session_name()])){
			setCookie(session_name(),"",time()-3600,"/");
		}
		session_destroy();
		$this->success("再见{$username},重新登录！",3,"index");
	}
}
