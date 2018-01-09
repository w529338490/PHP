<?php
	/**
	* 用户组模块
	* 作者：卫聪
	* 功能：用户组的增，删，改，查
	*/
	class Group{
		function index(){//首页遍历需要的数据
			$user=D('user_group');
			$date=$user->select();
			$this->assign('groupinfo',$date);
			$this->display();
		}
		function add(){//添加页面
			$this->display();
		}
		function insert(){//插入数据库方法
			$user=D('user_group');
			if($user->insert()){
				//添加添加组记录操作
				$Oper=new OperDate();
				$Oper->isOpers("add_user_group","添加了组：{$_POST['group_name']}");
				////////////////////////////////////////////////////////////////////////
				$this->success('添加成功',2,'index');
			}else{
				$this->error($user->getMsg(),2,'add');
			}
		}
		function update(){//更新页面
			$user=D('user_group');
			$this->assign('gid',$_GET['gid']);	
			$date=$user->where('gid='.$_GET['gid'])->select();
			$this->assign('arr',$date);
			$this->display();
		}
		function exe_update(){//执行更新方法
			$group=D('user_group');
			if(empty($_POST['group_muser'])){//以下六个判断是用户并没有选择的权限。就更改为0并插入到数据库
				$_POST['group_muser']=0;
			}
			if(empty($_POST['group_mweb'])){
				$_POST['group_mweb']=0;
			}
			if(empty($_POST['group_marticle'])){
				$_POST['group_marticle']=0;
			}
			if(empty($_POST['group_mimage'])){
				$_POST['group_mimage']=0;
			}
			if(empty($_POST['group_sendarticle'])){
				$_POST['group_sendarticle']=0;
			}
			if(empty($_POST['group_sendcomment'])){
				$_POST['group_sendcomment']=0;
			}
			if(empty($_POST['group_sendmessage'])){
				$_POST['group_sendmessage']=0;
			}
			$row=$group->update();
			if($row){
				//添加添加组记录操作
				$Oper=new OperDate();
				$Oper->isOper("edit_user_group",'user_group',$_POST['gid'],'group_name','gid','修改了组：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('修改成功',1,'index');
			}else{
				$this->error('修改失败',2,'');
			}
		}

		function del(){//删除方法
			$g=D('user_group');
			$rg=$g->where(array('gid'=>$_GET['gid']))->field('group_name')->find();
			//添加添加组记录操作
			$Oper=new OperDate();
			$Oper->isOper("del_user_group",'user_group',$_GET['gid'],'group_name','gid','删除了组：');
			/////////////////////////////////////////////////////////////////////////////////////////
			$row=$g->where('gid='.$_GET['gid'])->delete();
			if($row){	//如果有影响行数		
				$user=D('user');
				$rows=$user->where('gid='.$_GET['gid'])->update("gid=2");
				if($rows){
					$this->success('删除成功,该组所在成员将自动变成普通用户组',3,'index');		
				}
				//添加删除组记录操作
				$Oper=new OperDate('delete',$_SESSION['user_username'],"删除了组{$rg['group_name']}");
				$Oper->isOper();
				$this->success('删除成功,该组所在成员将自动变成普通用户组',3,'index');
			}else{
				$this->error('删除失败',2,'index');
				
			}
		}
	}
