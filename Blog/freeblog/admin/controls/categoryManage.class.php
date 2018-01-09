<?php
/*******************************************************************
作者:闫海静														   *
功能:管理文章分类(分类的删、改、查)                                *
日期:2011/11/28	        										   *
*******************************************************************/
	class CategoryManage{
		//进入管理分类界面，使用无线分类
		function manageCategory(){
			//要查找的类别库
			$dbCate=D('category');
			$article=D('article');
			//查询出类别库中的所有类别
			$allCate=$dbCate->order('abspath')->field('subAction,cid,category_name,path,concat(path,"-",cid) as abspath')->select();
			//对结果进行处理
			$i=0;
 			foreach($allCate as $values){
				//根据subAction字段得出该类别是否存在子类
				//分割数组，得出输出几组|-------
				$countSpace=count(explode('-',$values['abspath']))-2;
				//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				$data=str_repeat('|-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$countSpace).'|-'.$values['category_name'];
				//将得到的数据压入到数组
				$categoryData[$i]['category_name']=$data;
				$categoryData[$i]['cid']=$values['cid'];
				//$categoryData[$i]['subAction']=$values['subAction'];
				//查询模块下是否有文章如果有文章也不允许删除
				$articleCount=$article->field('count(article_title)')->where(array('article_category'=>$values['category_name']))->select();
				//如果类别表中有子类或者有文章不给其删除链接
				if($values['subAction'] == 'Y'){
					$categoryData[$i]['flag']="NO";	
				}else{
					if($articleCount[0]['count(article_title)'] > 0){
						$categoryData[$i]['flag']="NO";	
					}else{
						$categoryData[$i]['flag']="YES";
					}
					//$categoryData[$i]['flag']="YES";
				}
				$i++;
			} 
			$this->assign('allCates',$categoryData);
			$this->display();
		}
		//查看指定分类的具体内容
		function detaCategory(){
			//查看的模块id号
			$CateId=$_GET['CateId'];
			$cate=D('category');
			//查询类别名、父类ID分类下是否有文章，建立模块的时间
			$detaCate=$cate->where(array('cid'=>$CateId))->field('subAction,cid,path,category_name,category_content,category_total,category_time')->find();
			//查询父类子类关系
 			if($detaCate['subAction']!==0){
				$catePath=explode('-',$detaCate['path']);
				//类别ID中没有为0的,所以将其弹出(第一个位置)
				array_shift($catePath);
				//获得拥有父类的个数
				$Pcount=count($catePath);
				//对父类、子类关系进行组合
				$CateRelation="<a href={$GLOBALS['url']}manageCategory>"."全部"."</a>&nbsp;&nbsp;&nbsp;&nbsp;>>>&nbsp;&nbsp;&nbsp;&nbsp;";
				for($i=0;$i<$Pcount;$i++){
					//查询父子类的关系 顺序：父类->子类
					$parCate=$cate->where(array('cid'=>$catePath[$i]))->field('cid,category_name')->find();
					$CateRelation.="<a href='{$GLOBALS['url']}detaCategory/CateId/{$parCate['cid']}'>".$parCate['category_name'].'</a>'.'&nbsp;&nbsp;&nbsp;&nbsp;>>>&nbsp;&nbsp;&nbsp;&nbsp;';
				}
			} 
			//原来$detaCate['path']已经不再使用进行替换
			$detaCate['path']=$CateRelation.$detaCate['category_name'];
			//给模板分配变量
			$this->assign('detaCategory',$detaCate);
			$this->display();
		}
		//查询指定类别详细,修改标题，简介使用
		function categoryDeta(){
			//连接数据库
			$category=D('category');
			$result=$category->where(array('cid'=>$_GET['cid']))->find();
			return $result;
		}
		//修改类标内容
		function modCategoryName(){
			$this->assign('result',$this->categoryDeta());
			$this->display();
		}
		//修改类别简介
		function modCategoryContent(){
			$this->assign('result',$this->categoryDeta());
			$this->display();
		}
		//修改内容
		function updateCategory(){
			//连接数据库
			$category=D('category');
			//P($_GET['cid']);
			//修改内容
			$updateResult=$category->where(array('cid'=>$_GET['cid']))->update();
			if($updateResult){
				//添加删除操作，批量还原
				$Oper=new OperDate();
				$Oper->isOper("edit_article_group",'category',$_GET['cid'],'category_name','cid','修改了文章分类：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success('恭喜您修改成功',2,"categoryManage/detaCategory/CateId/{$_GET['cid']}");
			}else{
				$this->error('修改失败',4,"categoryManage/manageCategory");
			}
		}
		//删除分类
		function delCategory(){
			$category=D('category');
			
			//查询出分类id的path
			$cateResult=D('category')->where(array('cid'=>$_GET['Cid']))->field('path')->find();
			//查询该path是否为数据库中唯一的一个，如果不是唯一的一个证明父类下还有子类
			$PcateCount=D('category')->where(array('path'=>$cateResult['path']))->field('count(path)')->select();
			if($PcateCount[0]['count(path)'] ==1){
				//查找到该分类的父类
				$PID=array_pop(explode('-',$cateResult['path']));
				//如果删除的子类是父类的最后一个子类那么要把父类的subaction改为N;
				$updatePCate=$category->where(array('cid'=>$PID))->update("subAction='N'");
			}
				
			//删除分类
			//添加删除操作，批量还原
			$Oper=new OperDate();
			$Oper->isOper("del_article_group",'category',$_GET['Cid'],'category_name','cid','删除了文章分类：');
			////////////////////////////////////////////////////////////////////////////////////////////
  			$delResult=$category->where(array('cid'=>$_GET['Cid']))->delete();
			if($delResult){
				$this->success('删除成功',2,"categoryManage/manageCategory");
			}else{
				$this->error('删除失败',4,"categoryManage/manageCategory");
			} 
		}
		//发表文章
		function createArticle(){
			//分配类别变量给模板
			$this->assign('Cname',$_GET['Cname']);
			//调用编辑器
			$this->assign('ckeditor',Form::editor('article_content','basic','350','white',false));
			//分配模板
			$this->display();
			
		}
	}
