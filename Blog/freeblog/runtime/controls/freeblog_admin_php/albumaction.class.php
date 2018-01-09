<?php
/*
	相册无限分类模块
	作者：卫聪
	功能：相册的无限分类，增删改查
*/
	class albumAction extends Common {
		function index(){//首页遍历所有分类
			$list=D('album_form')->table_list();
			$this->assign('list',$list);
			$this->display();
		}
		function add(){//添加页面
			$select=D('album_form')->table_select('','根分类');//model类里面写的一个无限分类的select下拉菜单
			$this->assign('select',$select);
			$this->display();
		}
		function del(){//删除方法
			$album=D('album');
			$path=$album->field('album_path')->find($_GET['id']);
			$nextpath=$path['album_path'].'-'.$_GET['id'];
			$img=D('image')->field('pid')->where(array('pid'=>$_GET['id']))->select();
			if(!empty($img)){//如果该类别下有图片无法删除
				$this->error('该类别下有图片无法删除，请先删除该类别下的图片再做尝试',2,'');
			}else{
				$result=$album->where(array('album_path'=>$nextpath))->find();
				if(!$result){//如果该类下没有子类和图片才可以删除
					//添加操作记录
					$Oper=new OperDate();
					$Oper->isOper("del_photo_album",'album',$_GET['id'],'album_title','id','相册被删除：');
					$rows=$album->delete($_GET['id']);
					if($rows)
						$this->success('删除成功',1,'');
				}else{
					$this->error('该类别下有子类无法删除',2,'');
				}
			}
		}
		function insert(){//添加方法
			$album=D('album');
			if($_POST['id']==0){//如果postid是0，那就是父类
				$_POST['album_path']=0;//分类id就是父类的path
			}else{
				$path=$album->field('pid,album_path')->find($_POST['id']);
				$_POST['album_path']=$path['album_path'].'-'.$_POST['id'];
			}
			$arr=array('pid'=>$_POST['id'],'album_path'=>$_POST['album_path'],'album_title'=>$_POST['album_title'],'album_description'=>$_POST['album_description']);
			$row=$album->insert($arr);//经过判断后插入数据库
			//添加删除操作
			$Oper=new OperDate();
			$Oper->isOpers("add_photo_album","添加新相册：{$_POST['album_title']}");
			if($row){
				$this->success('添加相册成功',1,'');
			}else{
				$this->error('添加相册失败',1,'');
			}
		}
		function update(){//更改方法页面需要的参数遍历出来
			$date=D('album')->field('id,album_title,album_path,album_description')->where(array('id'=>$_GET['id']))->find();
			$select=D('album_form')->table_select($date['id']);	
			$this->assign('title',$date['album_title']);
			$this->assign('description',$date['album_description']);
			$this->assign('select',$select);
			$this->assign('id',$_GET['id']);
			$this->display();
		}
		function exe_update(){
			$date=D('album')->field('album_path')->where(array('id'=>$_POST['id']))->find();//通过修改过后的类别来找到上级类别的path
			$path=D('album')->field('pid,album_path')->where(array('id'=>$_POST['yid']))->find();
			if($_POST['id']!=$_POST['yid']){//如果用户选择新的类别栏目才更改path否则不动
				$_POST['album_path']=$date['album_path'].'-'.$path['pid'];
			}else{
				$_POST['album_path']=$path['album_path'];
			}
			$_POST['id']=$_POST['yid'];//把自己的id赋值给用户所选择的ID,否则修改的就是用户所选择的类别的ID
			unset($_POST['yid']);//然后卸载该参数
			$row=D('album')->update();
			if($row){
				//添加操作记录
				$Oper=new OperDate();
				$Oper->isOper("edit_photo_album",'album',$_POST['id'],'album_title','id','相册信息被修改：');
				$this->success('修改成功',1,'index');
			}else{
				$this->error('修改失败您已经在该类别下,如果要更改成同级栏目，请选择父类栏目',1,'');
			}
		}
	}
