<?php
	/**
	* 登录模块
	* 作者：卫聪
	* 功能：用户的登录
	*/
	class Login extends Action{
		function index(){//登陆页面
			$GLOBALS['debug']=0;
			$this->display();
		}
		function islogin(){
			if($_POST['user_username']==null && $_POST['user_password']==null){//如果用户名为空
				$this->error('用户名和密码不能为空',1,'');
			}
			$_POST['user_password']=md5($_POST['user_password']);
			$_POST['user_repassword']=md5($_POST['user_repassword']);
			if($_POST['user_repassword']!= $_POST['user_password']){//如果用户输入的两次密码不一致
				$this->error('两次密码不一致',1,'');
			}
			$user=D('user');
			$date=$user->field('uid,user_password')->where(array('user_username'=>$_POST['user_username']))->find();
			$_POST['uid']=$date['uid'];
			if($_POST['user_password'] != $date['user_password']){//如果输入的密码与数据库密码不匹配
				$this->error('密码不正确',1,'');
			}
			if(strtoupper($_POST['code']) != $_SESSION['code']){//如果输入的验证码不正确
				$this->error('验证码输入不正确',1,'');
			}
			$_SESSION=$_POST;//把posts所有的数据压入session
			$date=$user->query('select free_user_group.group_muser,free_user_group.group_mweb,free_user_group.group_marticle,free_user_group.group_sendarticle,free_user_group.group_mimage,free_user_group.group_sendcomment,free_user_group.group_sendmessage,free_user.user_lock from free_user,free_user_group where free_user.uid='.$_SESSION['uid'].' and free_user.gid=free_user_group.gid','select');
			if($date[0]['user_lock']){
				$this->error('您的帐号已被锁定，请与管理员联系后再登录',3,'index/index');
			}else{
				if($date[0]['group_muser'] || $date[0]['group_marticle'] || $date[0]['group_mweb'] || $date[0]['group_mimage']){
					//查询数据库中是否开启自动记录操作
					$opernote=D('foreground');
					//$_SESSION['oper']=D('OperDate');
					$isOpenNote=$opernote->where(array('fid'=>'1'))->field('operateNotes')->find();
					//$_SESSION['operAuthor']=$operAuthior->where(array('id'=>'1'))->find();
					$_SESSION['isOpenNotes']=$isOpenNote['operateNotes'];
					$_SESSION['islogin']=true;
					$_SESSION=array_merge($date[0],$_SESSION);
					$user->where($_SESSION['uid'])->update('user_onlinestatus=user_onlinestatus+1');
					$this->success('登陆成功',1,'index/index');
				}else{
					$this->error('您的权限不够无法进入后台',1,'');
				}	
			}
		}
		function logout(){//退出时销毁session
			$user=D('user');
				$_SESSION['islogin']=false;
				$_SESSION=array();
				if(isset($_COOKIE[session_name()])){
					setCookie(session_name(), '', time()-3600, '/');
				}
				session_destroy();
				$this->redirect('index');	
		}
		function code(){//显示验证码
			echo new Vcode();
		}
	
	}