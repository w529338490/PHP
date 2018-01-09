<?php
	/**
	* 用户模块
	* 作者：卫聪
	* 功能：用户的增，删，改，查
	*/
	class UserAction extends Common {
		function index(){//用户管理首页
			$group=D('user_group');
			$user=D('user');
			$num=5;
			$gid=$_POST['gid']?$_POST['gid']:null;
			$name=$_POST['search_username']?$_POST['search_username']:null;
			if($name){//如果用户输入用户名字搜索的话就直接定向到搜索方法
				$this->redirect("user/search/gid/$gid/name/$name");
			}
			if($gid){//如果用户用下拉菜单按用户组查看用户
				if($name){//如果用户既用下拉菜单查看用户，也输入了名字搜索
					$this->redirect("user/search/gid/$gid/name/$name");
				}
				$this->redirect("user/search/gid/$gid");//如果用户只是按照下拉菜单按照用户组查看用户
			}
			if($_GET['n']=='l'){//如果用户点击屏蔽用户查看
				$where='free_user_group.gid=free_user.gid and free_user.user_lock=1';
				$where2='free_user.user_lock=1';
			}elseif($_GET['n']=='h'){//如果用户点击活跃用户查看
				$where='free_user_group.gid=free_user.gid and free_user.user_onlinestatus > 10';
				$where2='free_user.user_onlinestatus > 10';
			}elseif($_GET['n']=='uh'){//如果用户点击不稳定用户查看
				$where='free_user_group.gid=free_user.gid and free_user.user_onlinestatus < 10';
				$where2='free_user.user_onlinestatus < 10';
			}else{
				$where='free_user_group.gid=free_user.gid';
			}
			$page=new page($user->where($where2)->total(),$num);//分页
			$date=$user->query('select free_user.user_ip,free_user.user_lock,free_user.uid,free_user.gid,free_user.user_mktime,free_user.user_onlinestatus,free_user.user_email,free_user.user_username,free_user_group.group_name,free_user_group.gid from free_user,free_user_group where '.$where.' order by free_user.uid desc limit '.$page->limit.' ','select');
			$this->assign('fpage',$page->fpage(4,5,6,0,3));//用户list分页
			$this->assign('grp',$group->field('gid,group_name')->select());//下拉菜单里面的用户组
			$this->assign('user_total',$user->total());//用户总数
			$this->assign('online',$user->where('user_onlinestatus>10')->total());//活跃用户
			$this->assign('unonline',$user->where('user_onlinestatus<10')->total());//活跃用户
			$this->assign('page',$_GET['page']?$_GET['page']:1);
			$this->assign('user_list',$date);
			$lock=$user->field('user_lock')->where(array('user_lock'=>1))->total();//屏蔽用户数量
			$this->assign('lock',$lock);
			$this->display();
		}
		function add(){//添加用户页面
			$group=D('user_group');
			$this->assign('grp',$group->field('gid,group_name')->order('gid desc')->select());
			$this->display();
		}
		function del(){//删除用户方法
			$user=D('user');
			$page=$_GET['page']?$_GET['page']:1;
			if(!empty($_POST['num'])){//如果用户是选择批量删除用户
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOper("multi_del_user",'user',$_POST['num'],'user_username','uid','批量删除了用户：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$row=$user->delete($_POST['num']);
				//$row=true;
				if($row){
					$this->success('删除成功',1,'user/index/page/'.$page.'');
				}else{
					$this->error('删除失败',1,'user/index/page/'.$page.'');
				}
			}
			if(!empty($_GET['uid'])){//如果用户选择的是单条删除用户
				//添加操作记录
				$Oper=new OperDate();
				$Oper->isOper("single_del_user",'user',$_GET['uid'],'user_username','uid','删除了用户：');
				///////////////////////////////////////////////////////////////////////////////////////
				$row=$user->delete($_GET['uid']);
				if($row){
					$this->success('删除成功',1,'user/index/page/'.$page.'');
				}else{
					$this->error('删除失败',1,'user/index/page/'.$page.'');
				}
			}
		}
		function insert(){//添加用户插入数据库
			$user=D('user');
			$_POST['user_password']=md5($_POST['user_password']);
			$_POST['user_repassword']=md5($_POST['user_repassword']);
			$_POST['user_ip']=$_SERVER['REMOTE_ADDR'];
			$_POST['user_mktime']=time();
			$row=$user->insert();//插入数据库方法
			if($row){
				//添加操作记录
				$Oper=new OperDate();
				$Oper->isOper("add_user",'user_group',$_POST['gid'],'group_name','gid',"添加了用户{$_POST['user_username']},将其分组到");
				///////////////////////////////////////////////////////////////////////////////////////
				$this->success('添加成功',1,'user/index');
			}else{
				$this->error('删除成功',2/'user/add');
			}
		}
		function update(){//修改用户页面
			$group=D('user_group');
			$user=D('user');
			$this->assign('grp',$group->field('gid,group_name')->order('gid desc')->select());
			$gid=$_GET['gid'];
			$this->assign('fgid',$gid);
			$page=$_GET['page']?$_GET['page']:1;
			$this->assign('page',$page);//分页
			$date=$user->field('uid,user_username,user_email,user_sex')->where('uid='.$_GET['uid'])->select();
			$this->assign('date',$date);//查出用户需要修改的原有的参数
			$this->display();
		}
		function exe_update(){//执行用户更新的方法
			$user=D('user');
			$_POST['user_password']=md5($_POST['user_password']);
			$row=$user->update();
			$page=$_GET['page']?$_GET['page']:1;
			if($row){
				//添加操作记录
				$Oper=new OperDate();
				$Oper->isOper("edit_userinfo",'user',$_POST['uid'],'user_username','uid',"用户信息被修改：");	
				//////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('修改成功',3,'user/index/page/'.$page.'');
			}else{
				$this->error('修改失败',2,'user/update/gid/'.$_POST['gid'].'/uid/'.$_POST['uid'].'/page/'.$page.'');
			}
		}
		function search(){//搜索用户方法
			$group=D('user_group');
			$user=D('user');
			$gid=$_GET['gid'];
			$name=$_GET['name'];
			$num=5;
			if($name){//如果用户输入的是用户名
				if(!$gid){//如果用户在输入了用户名的同时也使用了下拉菜单安装用户组查看
					$like='free_user.user_username LIKE "%'.$name.'%"';	
					$where='where '.$like.' and free_user_group.gid=free_user.gid';
					$page=new page($user->where(array('user_username'=>'%'.$name.'%'))->total(),$num,'gid/'.$gid.'');
				}else{//如果用户没有使用下拉菜单按照用户组查看用户，仅仅只是输入名字搜索
					$like='free_user.user_username LIKE "%'.$name.'%"';	
					$where='where '.$like.' and free_user_group.gid=free_user.gid and free_user_group.gid='.$gid.'';
					$page=new page($user->where(array('gid'=>$gid,'user_username'=>'%'.$name.'%'))->total(),$num,'gid/'.$gid.'');
				}
			}else{//如果用户没有使用下拉菜单按照用户组查看用户，仅仅只是输入名字搜索
				$where='where free_user_group.gid=free_user.gid and free_user_group.gid='.$gid.'';	
				$page=new page($user->where(array('gid'=>$gid))->total(),$num,'gid/'.$gid.'');
			}
			$date=$user->query('select free_user.gid,free_user.user_mktime,free_user.user_onlinestatus,free_user.user_email,free_user.user_username,free_user_group.group_name,free_user_group.gid from free_user,free_user_group '.$where.' limit '.$page->limit.'','select');
			$this->assign('user_list',$date);//用户列表
			$this->assign('fpage',$page->fpage(4,5,6,0,3));//分页
			$this->assign('user_total',$user->where(array('gid'=>$gid))->total());//用户总数
			$this->assign('online',$user->where(array('user_onlinestatus'=>1,'gid'=>$gid))->total());//用户总数
			$this->assign('grp',$group->field('gid,group_name')->select());
			$this->assign('gid',$gid);//用户组下拉菜单
			$this->display();
		}
		function online(){//活跃用户
			$group=D('user_group');
			$user=D('user');
			$num=5;
			$page=new page($user->where(array('user_onlinestatus'=>1))->total(),$num);
			$where='free_user.user_onlinestatus=1 and free_user_group.gid=free_user.gid';
			$date=$user->query('select free_user.gid,free_user.user_mktime,free_user.user_onlinestatus,free_user.user_email,free_user.user_username,free_user_group.group_name,free_user_group.gid from free_user,free_user_group where '.$where.' limit '.$page->limit.'','select');
			$this->assign('user_list',$date);//用户列表
			$this->assign('fpage',$page->fpage(4,5,6,0,3));
			$this->assign('user_total',$user->total());//总用户数量
			$this->assign('online',$user->where(array('user_onlinestatus'=>1))->total());//当前在线人数
			$this->assign('grp',$group->field('gid,group_name')->select());//用户组下拉菜单
			$this->display();
		}
		function lock(){//屏蔽的用户
			$GLOBALS['debug']=0;
			//添加操作记录
			$Oper=new OperDate();
			$user=D('user')->where(array('uid'=>$_GET['uid']))->update('user_lock=1');
			if($user){
				$Oper->isOper("shield_name",'user',$_GET['uid'],'user_username','uid',"锁定了用户：");
				////////////////////////////////////////////////////////////////////////////////////
			}else{
				$user=D('user')->where(array('uid'=>$_GET['uid']))->update('user_lock=0');
				if($user){
					$Oper->isOper("shield_name",'user',$_GET['uid'],'user_username','uid',"解锁了用户：");
					////////////////////////////////////////////////////////////////////////////////////
				}
			}
			$user2=D('user');
			$lock=$user2->field('user_lock')->where(array('user_lock'=>1))->total();
			echo $lock;
		}
	}