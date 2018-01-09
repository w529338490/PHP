<?php
	class CategoryOther{
		//调用页面并且查询选择的类别的CID,PATH,CATEGORY_NAME
		function createCategory(){
			$category=D('category');
			//如果分类下有文章将不允许在其下面创建子类
			$allCategory=$category->field('cid,path,category_name')->where(array('category_total'=>'0'))->select();
			$this->assign('allCategory',$allCategory);
			$this->display();
		}
		//将创建的类别存入数据库中
		function addCategory(){
			if(empty($_POST['category_name'])){
				$this->error("新建分类失败",4,"categoryManage/manageCategory");
			}
			$article=D('category');
			//如果不是根目录就查询path
			if($_POST['path']!= 0){
 				//查看字段中所选择的父类的path,cid组合后作为新建模块的path
				$Ppath=$article->field('path,cid')->where(array('cid'=>$_POST['path']))->find();
				$_POST['path']=$Ppath['path'].'-'.$Ppath['cid'];
				//获得该模块的父类的ID
				$_POST['pic']=$Ppath['cid'];
				//如果创建分类成功就将父级目录的subaction该为Y
				$updatePcat=$article->where(array('cid'=>$Ppath['cid']))->update(array('subAction'=>'Y'));
			}else{
				$_POST['path']='0';
				$_POST['pid']='0';
			}
			//是否有子类
			$_POST['subAction']='N';
			//创建时间
			$_POST['category_time']=time();
			//文章总数默认为0
			$_POST['category_total']='0';
			//插入语句
			//P($_POST);
			$insertCategory=$article->insert($_POST);
			
			//查看是否插将成功
			if($insertCategory){
				//添加删除操作，批量还原
				$Oper=new OperDate();
				$Oper->isOpers("add_atricle_group","添加了文章分类：{$_POST['category_name']}");
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success("新建分类{$_POST['category_name']}成功",3,"categoryManage/manageCategory");
			}else{
				$this->error("新建分类{$_POST['category_name']}失败",4,"categoryManage/manageCategory");
			}
		}
	}