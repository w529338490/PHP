<?php
/*******************************************************************
作者:闫海静														   *
功能:用于管理文章(查看详细，放入回收站，彻底删除，还原回收站中文章)*
日期:2011/11/28	        										   *
*******************************************************************/
	class ArticleManageAction extends Common {
		//管理文章界面,遍历所有文章
		function manageArticle(){
			//连接数据库
			$article=D('article');
			//查询数据库
			//声明page类
			$vaildArticle=$article->total(array('article_action'=>'1'));//有效文章数
			$vaild=new Page($vaildArticle,5);
			$viewResult=$article->order('article_time desc')->limit($vaild->limit)->where(array('article_action'=>'1'))->select();
			//查询无效文章
			$invalidArticle=$article->total(array('article_action'=>'0'));//无效文章数
			//查询所有文章分组
			$allCategory=D('category');
			$allCategory=$allCategory->field('category_name')->where(array('subAction'=>'N'))->select();
			//按月查询文章发布时间
			$issueTime=$article->field('article_month')->select();
			foreach($issueTime as $key=>$values){
				foreach($values as $value){
					$issueMonth[]=$value;				
				}
			}
			//剔除发文章时间重复的年份和月份
			$issueMonth=array_unique($issueMonth);
			//将前台需要的标题数据压入到数组
			$condition['vaildArticle']=$vaildArticle;//有效文章数
			$condition['invalidArticle']=$invalidArticle;//无效文章数
			$condition['totalArticle']=$invalidArticle+$vaildArticle;//文章总数
			//分配数据
			$this->assign('issueMonth',$issueMonth);
			$this->assign('condition',$condition);//分配前台标题使用数据
			$this->assign('viewResult',$viewResult);//查询的结果
			$this->assign('fpage',$vaild->fpage(4,5,6,0,3));//第一个选项卡分页
			$this->assign('allCategory',$allCategory);//所有文章分类
			if(!empty($_GET['page'])){
				$this->assign('page',"/page/".$_GET['page']);
			}
			//调用文章界面模板
			$this->display();
		}
		//清空回收站
		function clearRecycle(){
			$article=D('article');
			$categorys=D('category');
			//获得要删除文章的所有类别
			$countCate=$article->where(array('article_action'=>'0'))->field('article_category')->select();	
			$delArticle=$article->where(array('article_action'=>'0'))->delete();

			if($delArticle){
				foreach($countCate as $values){
					//将要删除的所有类别压入到数组
					$coCats[]=$values['article_category'];
				}
				//获得数组中所有相同类别的个数
				$coCats=array_count_values($coCats);
				
				foreach($coCats as $key=>$values){
					$results=$categorys->where(array('category_name'=>$key))->update("category_total=category_total-{$values}");
				}
				//如果清空成功直接跳转
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOpers("clear_recyle_article",'清空了回收站中的所有文章');
				$this->redirect('articleManage/manageArticle'); 
			}else{
				$this->error('删除失败',3,'articleManage/manageArticle');
			}
		}
		//查看回收站中的文章
		function viewRecycle(){
			$article=D('article');
			//查询出回收站中的记录
			$recycleArticle=$article->where(array('article_action'=>'0'))->field('uid,aid,article_title,article_author,article_time,article_category')->select();
			//分配变量
			$this->assign('recycleArticle',$recycleArticle);
			$this->display();
		}
		//查找想对应类别中的文章
		function searchAtricle(){
			$article=D('article');
			//分页时如果$_POST不存在使用url参数
			if(!isset($_POST['selectGroup'])){
				$_POST['selectGroup']=$_GET['selectGroup'];
			}
			if(!isset($_POST['selectMonth'])){
				$_POST['selectMonth']=$_GET['selectMonth'];
			}
			if(empty($_POST['selectMonth'])&&empty($_POST['selectGroup'])){
				//如果都为空还跳转到本页面
				$this->redirect('Article/manageArticle');
			//如果值选择了分类执行
			}elseif(empty($_POST['selectMonth'])&&!empty($_POST['selectGroup'])){
				$page=new Page($article->total(array('article_category'=>$_POST['selectGroup'])),5,"selectGroup/{$_POST['selectGroup']}");
				$resultSearch=$article->limit($page->limit)->where(array('article_category'=>$_POST['selectGroup']))->select();
			//如果值选择了月份执行
			}elseif(empty($_POST['selectGroup'])&&!empty($_POST['selectMonth'])){
				$page=new Page($article->total(array('article_month'=>$_POST['selectMonth'])),5,"selectMonth/{$_POST['selectMonth']}");
				$resultSearch=$article->limit($page->limit)->where(array('article_month'=>$_POST['selectMonth']))->select();
			//如果选择了月份和分类
			}elseif(!empty($_POST['selectGroup'])&&!empty($_POST['selectMonth'])){
				$page=new Page($article->total(array('article_month'=>$_POST['selectMonth'],'article_category'=>$_POST['selectGroup'])),5,"selectMonth/{$_POST['selectMonth']}/selectGroup/{$_POST['selectGroup']}");
				$resultSearch=$article->limit($page->limit)->where(array('article_month'=>$_POST['selectMonth'],'article_category'=>$_POST['selectGroup']))->select();
			}
			$this->assign('resultSearch',$resultSearch);
			$this->assign('fpage',$page->fpage(4,5,6,0,3));
			$this->display();
		}
		//将文章移至回收站
		function moveRecycle(){
			$article=D('article');
			//如果删除是分页中的文章,定位在本页面
			if(isset($_GET['page'])){
				$string="/page/{$_GET['page']}";
			}
			$move=$article->where(array('aid'=>$_GET['aid']))->update(array('article_action'=>'0'));
			if($move){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOper("recyle_article",'article',$_GET['aid'],'article_title','aid','回收了文章：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->redirect("{$_GLOBALS["app"]}/articleManage/manageArticle/{$string}");
			}else{
				$this->error('移至回收失败',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
			}
		}
		//将文章直接删除
		function delArticle(){
			$article=D('article');
			//如果是批量操作获得其文章类别
			if(is_array($_POST['check_article'])){
				$allCateNum=$article->where(array('aid'=>$_POST['check_article']))->field('article_category')->select();
				foreach($allCateNum as $values){
 					foreach($values as $value){
						$allCateNums[]=$value;
					}
					
				}
				$delId='';
				foreach($_POST['check_article'] as $va){
					$delId.=$va.',';
				}
				$delId=rtrim($delId,',');
				//删除的文章中每个类别的文章的个数
				$allCate=array_count_values($allCateNums);
			}
			//如果是批量还原时执行
			if(!empty($_POST['restorSelect'])){
				//如果还原是分页中的文章,定位在本页面
				if(isset($_GET['page'])){
					$string="/page/{$_GET['page']}";
				}
				//执行回复到列表操作
				$move=$article->where(array('aid'=>$_POST['check_article']))->update(array('article_action'=>'1'));
				if($move){
					$resultArt=$article->where(array('aid'=>$_POST['check_article']))->field('article_title')->select();
					foreach($resultArt as $values){
						foreach($values as $value){
							$string.=$value['article_title'].",";
						}
					}
					$string=rtrim($string,',');
					//写入还原记录
					//添加删除操作
					$Oper=new OperDate();
					$Oper->isOper("article_edit",'article',$_POST['check_article'],'article_title','aid','批量还原了文章：');
					////////////////////////////////////////////////////////////////////////////////////////////
					$this->success("成功还原该文章",3,"{$_GLOBALS["app"]}/articleManage/manageArticle/{$string}");					
				}else{
					$this->error('还原失败',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
				}
				return false;
			}
			//如果删除是分页中的文章,定位在本页面
			if(isset($_GET['page'])){
				$string="/page/{$_GET['page']}";
			}
			//添加删除操作
			$Oper=new OperDate();
			//判断是批量删除还是单个删除
			if(is_array($_POST['check_article'])){
				$Oper->isOper("multi_del_article",'article',$_POST['check_article'],'article_title','aid','批量删除了文章：');
				/////////////////////////////////////////////////////////////////////////////////////////////////////////////
				$del=$article->where($delId)->r_delete(array('review','aid'),array('rereview','aid'));
			}else{
				$Oper->isOper("single_del_userinfo",'article',$_GET['aid'],'article_title','aid','删除了文章：');
				$del=$article->where(array('aid'=>$_GET['aid']))->r_delete(array('review','aid'),array('rereview','aid'));
				//////////////////////////////////////////////////////////////////////////////////////////////////////////
			}
 			if($del){
				$category=D('category');
				$review=D('review');
				$rereview=D('rereview');
				//删除文章后更新文章类别的数量-----------------------------------
				if(!empty($_GET['cName'])){
					//更改该类别下的数量-1
					$updateCat=$category->where(array('category_name'=>$_GET['cName']))->update("category_total=category_total-1");
				}else{
					//所有操作的类别数量
					foreach($allCate as $key=>$value){
						$updateCat=$category->where(array('category_name'=>$key))->update("category_total=category_total-{$value}");
					}
				}
				//如果是从文章管理列表中删除的成功后跳转到管理列表
				if($_GET['flag']=='delete_manager'||$_POST['flag']=='delete_manager'){
					$this->redirect("{$_GLOBALS["app"]}/articleManage/manageArticle/{$string}");
				//如果是从回收站中删除的成功后跳转到回收站的删除页面
				}elseif($_GET['flag']=='delete_recycle'||$_POST['flag']=='delete_recycle'){
					$this->redirect("{$_GLOBALS["app"]}/articleManage/viewRecycle/{$string}");
				}elseif($_POST['flag']='delete_reviewManage'){
					if(isset($_POST['page'])){
						$string="/page/{$_POST['page']}";
					}
					$this->redirect("{$_GLOBALS["app"]}/reviewManage/viewReview/{$string}");
				}
				
			}else{
				$this->error('删除文章失败',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
			}
		}
		//还原文章
		function restoreArticle(){
			$article=D('article');
			//如果还原是分页中的文章,定位在本页面
			if(isset($_GET['page'])){
				$string="/page/{$_GET['page']}";
			}
			//执行回复到列表操作
			$move=$article->where(array('aid'=>$_GET['aid']))->update(array('article_action'=>'1'));
			if($move){
				//添加删除操作
				$Oper=new OperDate();
				$Oper->isOper("restore_article",'article',$_GET['aid'],'article_title','aid','还原了文章：');
				////////////////////////////////////////////////////////////////////////////////////////////
				$this->success("成功还原该文章",3,"{$_GLOBALS["app"]}/articleManage/manageArticle/{$string}");					
			}else{
				$this->error('还原失败',3,"{$_GLOBALS["app"]}/articleManage/manageArticle");
			}
		}	
	}
?>