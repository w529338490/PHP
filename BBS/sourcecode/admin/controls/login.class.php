<?php
	/*+------------------------------------------------+
	  | 用户登录管理控制器
	  +------------------------------------------------+
	  | 版权所有 lamp兄弟连源代码小组						
	  +------------------------------------------------+
	  | 作者: 杜承斌 (jt1dcb@163.com)							
	  | 最后修改时间: 2012-01-12									
	  +------------------------------------------------+
	 */

    class Login extends Action{

		/**
		  *	登陆页面
		  */
        public function index(){
			if(!empty($_SESSION['admin_login'])){
				if($_SESSION['admin_login']===1){
					$this->redirect('index/index');
				}
			}
			//debug();
            $this->display();
        }
		
		
		/*
			如果验证么正确,则调用自定义的user模型的pub_login()方法登陆,登陆成功后则调到后台首页
			如果验证码错误,或者登陆失败,则返回登陆页
		*/
		public function login(){
			$user=D('user');
			if($_POST['code']==$_SESSION['code']){
				if($user->pub_login()){
					//如果不是管理员
					if($_SESSION['user_info']['stand']!=1 && $_SESSION['user_info']['stand']!=2){
						$_SESSION['user_info']=array();
						$this->error('非法登录',2,'login/index');
					}else{
						$_SESSION['admin_login']=1;
						//设置等级
						$_SESSION['user_info']['grade_name']='管理员';
						$this->redirect('index/index');
					}
				}else{
					//$this->error('登录失败',2,'index');
					$this->redirect('index');
				}
			}else{
				$this->redirect('index');
			}
		}
		
		
		/*
			为登陆界面输出4位验证码
		*/
		public function code(){
			echo new Vcode();
		}
		
		/*
			调用user模型的logout()方法进行退出,成功后调到登陆页
		*/
		public function logout(){
			$user=D('user');
			if($user->pub_logout()){
				$this->redirect('index');
			}
		}
    }
?>
